<?php

require_once dirname(__DIR__) . '/core/model.php';
require_once dirname(__DIR__) . '/helpers/Validator.php';

/**
 * Review Model
 *
 * Handles read/write operations for the dual-sided review data that lives on the
 * booking table. All review lookups go through booking -> listing_application so
 * we can enforce ownership and exchange completion rules.
 */
class Review extends Model
{
    protected string $table = 'booking';
    protected string $primaryKey = 'id';

    private const TERMINAL_APPLICATION_STATUSES = ['cancelled', 'withdrawn', 'rejected'];

    /**
     * Persist a new review (host or guest) after validating eligibility.
     *
     * @param string $bookingId  Target booking/exchange id
     * @param string $profileId  Logged-in user's profile id
     * @param array  $payload    ['rating' => int, 'review' => string|null]
     * @return array [valid => bool, errors => array, role => ?string, context => ?array]
     */
    public function saveReview(string $bookingId, string $profileId, array $payload): array
    {
        $validation = $this->validateReviewRequest($payload, $bookingId, $profileId);

        if (!$validation['valid']) {
            return $validation;
        }

        $fields = $validation['role'] === 'guest'
            ? ['listing_review', 'listing_rating', 'listing_reviewed_at']
            : ['guest_review', 'guest_rating', 'guest_reviewed_at'];

        $updateData = [
            $fields[0] => ($payload['review'] ?? '') !== '' ? $payload['review'] : null,
            $fields[1] => (int) $payload['rating'],
        ];

        if (!$validation['editing']) {
            $updateData[$fields[2]] = $this->currentTimestamp();
        }

        $this->update($bookingId, $updateData);

        return [
            'valid' => true,
            'errors' => [],
            'role' => $validation['role'],
            'context' => $validation['context'],
        ];
    }

    /**
     * Centralized validation for creating or updating a review.
     */
    public function validateReviewRequest(array $payload, string $bookingId, string $profileId): array
    {
        $context = $this->fetchBookingContext($bookingId);

        if (!$context) {
            return [
                'valid' => false,
                'errors' => ['Booking not found.'],
                'role' => null,
                'context' => null,
            ];
        }

        $errors = [];
        $role = $this->determineRole($profileId, $context);

        if ($role === null) {
            $errors[] = 'You are not part of this exchange.';
        }

        if ($this->isCancelled($context)) {
            $errors[] = 'This exchange was cancelled.';
        } elseif (!$this->isCompletedExchange($context)) {
            $errors[] = 'You can only review an exchange after it has been completed.';
        }

        $reviewExists = $role === 'guest'
            ? $this->hasListingReview($context)
            : $this->hasGuestReview($context);

        if ($reviewExists && !$this->canEditReview($context, $role)) {
            $errors[] = 'You can only edit your review within 24 hours of submitting it.';
        }

        $validator = Validator::make($payload)
            ->required('rating', 'Rating is required.')
            ->integer('rating', 'Rating must be a whole number.')
            ->min('rating', 1, 'Rating must be between 1 and 5 stars.')
            ->max('rating', 5, 'Rating must be between 1 and 5 stars.')
            ->maxLength('review', 2000, 'Review text must be 2000 characters or fewer.');

        if ($validator->fails()) {
            $errors = array_merge($errors, $validator->allErrors());
        }

        return [
            'valid' => empty($errors),
            'errors' => $errors,
            'role' => $role,
            'context' => $context,
            'editing' => $reviewExists,
        ];
    }

    /**
     * Get all reviews for a given listing (guest feedback about the listing/host).
     */
    public function getListingReviews(string $listingId): array
    {
        $sql = "SELECT
                    b.id,
                    b.listing_review,
                    b.listing_rating,
                    la.listing_id,
                    la.start_date,
                    la.end_date,
                    la.status AS application_status,
                    la.created_at AS application_created_at,
                    la.updated_at AS application_updated_at,
                    la.applicant_profile_id,
                    reviewer.first_name AS reviewer_first_name,
                    reviewer.last_name AS reviewer_last_name,
                    reviewer.profile_picture AS reviewer_avatar
                FROM booking b
                INNER JOIN listing_application la ON b.application_id = la.id
                LEFT JOIN user_profile reviewer ON la.applicant_profile_id = reviewer.id
                WHERE la.listing_id = ?
                ORDER BY la.end_date DESC, la.updated_at DESC";

        $rows = $this->db->fetchAll($sql, [$listingId]);
        $reviews = [];

        foreach ($rows as $row) {
            if (!$this->eligibleStoredReview($row, 'listing')) {
                continue;
            }

            $reviews[] = [
                'booking_id' => $row['id'],
                'listing_id' => $row['listing_id'],
                'rating' => (int) $row['listing_rating'],
                'review' => $row['listing_review'],
                'reviewer_profile_id' => $row['applicant_profile_id'],
                'reviewer_name' => $this->formatPersonName(
                    $row['reviewer_first_name'] ?? '',
                    $row['reviewer_last_name'] ?? ''
                ),
                'reviewed_at' => $this->formatReviewDate($row),
            ];
        }

        return $reviews;
    }

    /**
     * Return review summary and averages for a profile (host + guest perspectives).
     */
    public function getProfileReviewSummary(string $profileId): array
    {
        return [
            'as_host' => $this->aggregateRatingForProfile($profileId, 'host'),
            'as_guest' => $this->aggregateRatingForProfile($profileId, 'guest'),
        ];
    }

    /**
     * Fetch both sides of the review associated with a booking record.
     */
    public function getBookingReview(string $bookingId): ?array
    {
        $context = $this->fetchBookingContext($bookingId);

        if (!$context) {
            return null;
        }

        return [
            'booking_id' => $context['id'],
            'listing_id' => $context['listing_id'],
            'host_profile_id' => $context['host_profile_id'],
            'guest_profile_id' => $context['applicant_profile_id'],
            'listing_rating' => $context['listing_rating'] !== null ? (int) $context['listing_rating'] : null,
            'listing_review' => $context['listing_review'],
            'guest_rating' => $context['guest_rating'] !== null ? (int) $context['guest_rating'] : null,
            'guest_review' => $context['guest_review'],
            'is_cancelled' => $this->isCancelled($context),
            'is_completed' => $this->isCompletedExchange($context),
        ];
    }

    /**
     * Fetch concrete review rows for a profile.
     *
     * @param string $profileId Profile to inspect
     * @param string $role      'host' (default) or 'guest'
     */
    public function getProfileReviews(string $profileId, string $role = 'host'): array
    {
        $role = $role === 'guest' ? 'guest' : 'host';
        $reviewColumn = $role === 'guest' ? 'guest_review' : 'listing_review';
        $ratingColumn = $role === 'guest' ? 'guest_rating' : 'listing_rating';
        $profileColumn = $role === 'guest' ? 'la.applicant_profile_id' : 'l.host_profile_id';
        $authorJoin = $role === 'guest'
            ? 'LEFT JOIN user_profile host ON l.host_profile_id = host.id'
            : 'LEFT JOIN user_profile reviewer ON la.applicant_profile_id = reviewer.id';
        $authorFields = $role === 'guest'
            ? 'host.first_name AS reviewer_first_name, host.last_name AS reviewer_last_name, host.id AS reviewer_profile_id'
            : 'reviewer.first_name AS reviewer_first_name, reviewer.last_name AS reviewer_last_name, reviewer.id AS reviewer_profile_id';

        $sql = "SELECT
                    b.id,
                    b.{$reviewColumn} AS review_text,
                    b.{$ratingColumn} AS rating_value,
                    la.start_date,
                    la.end_date,
                    la.status AS application_status,
                    la.created_at AS application_created_at,
                    la.updated_at AS application_updated_at,
                    la.listing_id,
                    {$authorFields}
                FROM booking b
                INNER JOIN listing_application la ON b.application_id = la.id
                INNER JOIN listing l ON la.listing_id = l.id
                {$authorJoin}
                WHERE {$profileColumn} = ?
                ORDER BY la.end_date DESC, la.updated_at DESC";

        $rows = $this->db->fetchAll($sql, [$profileId]);
        $reviews = [];

        foreach ($rows as $row) {
            if (!$this->eligibleStoredReview($row, $role, $row['rating_value'] ?? null)) {
                continue;
            }

            $reviews[] = [
                'booking_id' => $row['id'],
                'listing_id' => $row['listing_id'],
                'rating' => (int) $row['rating_value'],
                'review' => $row['review_text'],
                'reviewer_profile_id' => $row['reviewer_profile_id'] ?? null,
                'reviewer_name' => $this->formatPersonName(
                    $row['reviewer_first_name'] ?? '',
                    $row['reviewer_last_name'] ?? ''
                ),
                'reviewed_at' => $this->formatReviewDate($row),
            ];
        }

        return $reviews;
    }

    /**
     * Aggregate average/count for host or guest ratings.
     */
    private function aggregateRatingForProfile(string $profileId, string $role): array
    {
        $role = $role === 'guest' ? 'guest' : 'host';
        $ratingColumn = $role === 'guest' ? 'guest_rating' : 'listing_rating';
        $profileColumn = $role === 'guest' ? 'la.applicant_profile_id' : 'l.host_profile_id';

        $sql = "SELECT COUNT(*) AS total_reviews, AVG({$ratingColumn}) AS avg_rating
                FROM booking b
                INNER JOIN listing_application la ON b.application_id = la.id
                INNER JOIN listing l ON la.listing_id = l.id
                WHERE {$profileColumn} = ?
                  AND {$ratingColumn} BETWEEN 1 AND 5";

        $result = $this->db->fetchOne($sql, [$profileId]) ?: ['total_reviews' => 0, 'avg_rating' => null];

        return [
            'count' => (int) $result['total_reviews'],
            'average' => $result['avg_rating'] !== null ? round((float) $result['avg_rating'], 2) : null,
        ];
    }

    /**
     * Load booking + participant context for validation.
     */
    private function fetchBookingContext(string $bookingId): ?array
    {
        $sql = "SELECT
                    b.id,
                    b.listing_review,
                    b.listing_rating,
                    b.guest_review,
                    b.guest_rating,
                    b.listing_reviewed_at,
                    b.guest_reviewed_at,
                    b.application_id,
                    la.listing_id,
                    la.applicant_profile_id,
                    la.start_date,
                    la.end_date,
                    la.status AS application_status,
                    la.created_at AS application_created_at,
                    la.updated_at AS application_updated_at,
                    l.host_profile_id
                FROM booking b
                INNER JOIN listing_application la ON b.application_id = la.id
                INNER JOIN listing l ON la.listing_id = l.id
                WHERE b.id = ?
                LIMIT 1";

        $row = $this->db->fetchOne($sql, [$bookingId]);

        return $row ?: null;
    }

    /**
     * Determine reviewer role (host vs guest) for the exchange.
     */
    private function determineRole(string $profileId, array $context): ?string
    {
        if (($context['applicant_profile_id'] ?? null) === $profileId) {
            return 'guest';
        }

        if (($context['host_profile_id'] ?? null) === $profileId) {
            return 'host';
        }

        return null;
    }

    private function hasListingReview(array $context): bool
    {
        return !empty($context['listing_rating']) || ($context['listing_review'] ?? '') !== '';
    }

    private function hasGuestReview(array $context): bool
    {
        return !empty($context['guest_rating']) || ($context['guest_review'] ?? '') !== '';
    }

    private function eligibleStoredReview(array $row, string $role, mixed $ratingOverride = null): bool
    {
        $rating = $ratingOverride ?? ($role === 'guest' ? $row['guest_rating'] ?? null : $row['listing_rating'] ?? null);

        if ($rating === null) {
            return false;
        }

        if ($rating < 1 || $rating > 5) {
            return false;
        }

        if ($this->isCancelled($row) || !$this->isCompletedExchange($row)) {
            return false;
        }

        $reviewField = $role === 'guest' ? 'guest_review' : 'listing_review';
        $review = $row[$reviewField] ?? null;

        return $review !== null && $review !== '';
    }

    private function isCancelled(array $context): bool
    {
        $status = strtolower($context['application_status'] ?? '');
        return in_array($status, self::TERMINAL_APPLICATION_STATUSES, true);
    }

    private function isCompletedExchange(array $context): bool
    {
        if ($this->isCancelled($context)) {
            return false;
        }

        $today = new DateTimeImmutable('today');
        $end = $this->parseDate($context['end_date'] ?? null);
        if ($end) {
            return $end < $today;
        }

        $start = $this->parseDate($context['start_date'] ?? null);
        return $start !== null && $start < $today;
    }

    private function parseDate(?string $value): ?DateTimeImmutable
    {
        if (!$value) {
            return null;
        }

        try {
            return new DateTimeImmutable($value);
        } catch (Exception) {
            return null;
        }
    }

    private function formatReviewDate(array $row): ?string
    {
        $candidates = [
            $row['end_date'] ?? null,
            $row['start_date'] ?? null,
            $row['application_updated_at'] ?? null,
            $row['application_created_at'] ?? null,
        ];

        foreach ($candidates as $value) {
            if (!$value) {
                continue;
            }

            try {
                $dt = new DateTimeImmutable($value);
                return $dt->format('Y-m-d');
            } catch (Exception) {
                continue;
            }
        }

        return null;
    }

    private function formatPersonName(string $first, string $last): string
    {
        return trim(trim($first) . ' ' . trim($last));
    }

    private function canEditReview(array $context, string $role): bool
    {
        $timestamp = $this->getReviewTimestamp($context, $role);

        if (!$timestamp) {
            return true;
        }

        try {
            $submittedAt = new DateTimeImmutable($timestamp);
        } catch (Exception) {
            return false;
        }

        try {
            $deadline = $submittedAt->add(new DateInterval('PT24H'));
        } catch (Exception) {
            return false;
        }

        return $this->now() <= $deadline;
    }

    private function getReviewTimestamp(array $context, string $role): ?string
    {
        $field = $role === 'guest' ? 'listing_reviewed_at' : 'guest_reviewed_at';
        return $context[$field] ?? null;
    }

    private function currentTimestamp(): string
    {
        return $this->now()->format('Y-m-d H:i:s');
    }

    private function now(): DateTimeImmutable
    {
        try {
            return new DateTimeImmutable('now', new DateTimeZone(APP_TIMEZONE));
        } catch (Exception) {
            return new DateTimeImmutable('now');
        }
    }
}
