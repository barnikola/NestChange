<?php

require_once dirname(__DIR__) . '/core/controller.php';
require_once dirname(__DIR__) . '/models/review.php';

class ReviewController extends Controller
{
    private Review $reviewModel;

    public function __construct()
    {
        parent::__construct();
        $this->reviewModel = $this->model('Review');
    }

    /**
     * List all public reviews for a listing.
     */
    public function index(string $listingId): void
    {
        $reviews = $this->reviewModel->getListingReviews($listingId);
        $count = count($reviews);
        $average = $count > 0
            ? round(array_sum(array_map(fn($review) => (int) ($review['rating'] ?? 0), $reviews)) / $count, 2)
            : null;

        $this->json([
            'success' => true,
            'listing_id' => $listingId,
            'count' => $count,
            'average_rating' => $average,
            'reviews' => $reviews,
        ]);
    }

    /**
     * Display a single review pair (host + guest feedback) for a booking.
     */
    public function show(string $bookingId): void
    {
        $review = $this->reviewModel->getBookingReview($bookingId);

        if (!$review) {
            $this->json([
                'success' => false,
                'error' => 'Review not found.',
            ], 404);
        }

        $this->json([
            'success' => true,
            'review' => $review,
        ]);
    }

    /**
     * Persist a review for a given booking.
     */
    public function create(string $bookingId): void
    {
        $isAjax = $this->isAjax();

        if (!$this->isPost()) {
            $this->respondMethodNotAllowed(['POST']);
            return;
        }

        if (!Session::isLoggedIn()) {
            if ($isAjax) {
                $this->json([
                    'success' => false,
                    'error' => 'Please log in to leave a review.',
                    'login_required' => true,
                ], 401);
            }

            $this->flash('error', 'Please log in to leave a review.');
            $this->redirect(BASE_URL . '/login');
        }

        if (!$isAjax && !$this->verifyCsrf()) {
            $this->flash('error', 'Invalid request. Please refresh and try again.');
            $this->redirect($this->fallbackRedirect());
        }

        $profileId = $this->currentUser()['profile_id'] ?? null;
        if (!$profileId) {
            $this->respondReviewError('Complete your profile before leaving a review.', 400);
            return;
        }

        $payload = [
            'rating' => $this->postInput('rating'),
            'review' => $this->postInput('review'),
        ];

        $result = $this->reviewModel->saveReview($bookingId, $profileId, $payload);
        if (!$result['valid']) {
            $message = $result['errors'][0] ?? 'Unable to submit review.';
            $this->respondReviewError($message, 422, $result['errors'], $result['context']['listing_id'] ?? null);
            return;
        }

        $reviewData = [
            'booking_id' => $bookingId,
            'listing_id' => $result['context']['listing_id'] ?? null,
            'role' => $result['role'],
            'rating' => (int) $payload['rating'],
            'review' => $payload['review'],
        ];

        $this->respondReviewSuccess('Review submitted successfully.', $reviewData, $reviewData['listing_id']);
    }

    private function respondReviewError(string $message, int $status, array $errors = [], ?string $listingId = null): void
    {
        if ($this->isAjax()) {
            $this->json([
                'success' => false,
                'error' => $message,
                'errors' => $errors,
            ], $status);
        }

        $this->flash('error', $message);
        $this->redirect($this->fallbackRedirect($listingId));
    }

    private function respondReviewSuccess(string $message, array $review, ?string $listingId = null): void
    {
        if ($this->isAjax()) {
            $this->json([
                'success' => true,
                'message' => $message,
                'review' => $review,
            ]);
        }

        $this->flash('success', $message);
        $this->redirect($this->fallbackRedirect($listingId));
    }

    private function fallbackRedirect(?string $listingId = null): string
    {
        if ($listingId) {
            return BASE_URL . '/listings/' . $listingId;
        }

        return $_SERVER['HTTP_REFERER'] ?? (BASE_URL . '/listings/my-exchanges');
    }

    private function respondMethodNotAllowed(array $methods): void
    {
        $allowHeader = implode(', ', $methods);
        if ($this->isAjax()) {
            $this->json([
                'success' => false,
                'error' => 'Method not allowed.',
            ], 405);
        }

        http_response_code(405);
        header('Allow: ' . $allowHeader);
        echo 'Method Not Allowed';
        exit;
    }
}
