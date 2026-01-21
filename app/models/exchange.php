<?php

require_once dirname(__DIR__) . '/core/model.php';

class Exchange extends Model
{
    protected string $table = 'booking';
    protected string $primaryKey = 'id';

    /**
     * Get exchanges (bookings that have started or finished) for a user
     */
    public function getExchangesForUser(int $accountId, ?string $profileId): array
    {
        if (empty($profileId)) {
            return [];
        }

        $sql = "SELECT 
                    b.id AS booking_id,
                    la.id AS application_id,
                    la.listing_id,
                    la.applicant_id,
                    la.applicant_profile_id,
                    la.start_date,
                    la.end_date,
                    la.status AS application_status,
                    la.created_at AS application_created_at,
                    l.title AS listing_title,
                    l.city AS listing_city,
                    l.country AS listing_country,
                    l.host_profile_id,
                    hp.first_name AS host_first_name,
                    hp.last_name AS host_last_name,
                    ap.first_name AS guest_first_name,
                    ap.last_name AS guest_last_name
                FROM listing_application la
                INNER JOIN listing l ON la.listing_id = l.id
                LEFT JOIN booking b ON la.id = b.application_id
                LEFT JOIN user_profile hp ON l.host_profile_id = hp.id
                LEFT JOIN user_profile ap ON la.applicant_profile_id = ap.id
                WHERE la.applicant_id = ? OR l.host_profile_id = ?
                ORDER BY COALESCE(la.start_date, la.end_date, la.created_at) DESC";

        $rows = $this->db->fetchAll($sql, [$accountId, $profileId]);

        return array_map(fn($row) => $this->formatExchange($row, $profileId), $rows);
    }

    private function formatExchange(array $row, string $profileId): array
    {
        $today = new DateTimeImmutable('today');
        $start = $this->toDate($row['start_date'] ?? null);
        $end = $this->toDate($row['end_date'] ?? null);

        $status = 'upcoming';
        $statusClass = 'active';

        $isCancelled = in_array($row['application_status'], ['cancelled', 'withdrawn', 'rejected'], true);
        $isCompleted = strtolower($row['application_status'] ?? '') === 'completed';

        if ($isCancelled) {
            $status = 'cancelled';
            $statusClass = 'cancelled';
        } elseif ($isCompleted) {
            $status = 'completed';
            $statusClass = 'done';
        } elseif ($end && $end < $today) {
            $status = 'completed';
            $statusClass = 'done';
        } elseif ($start && $start <= $today) {
            $status = 'active';
            $statusClass = 'active';
        }

        $isExchange = ($start && $start <= $today) || ($end && $end < $today) || $status === 'completed';
        
        $role = ($row['applicant_profile_id'] ?? '') === $profileId ? 'guest' : 'host';
        $otherName = $role === 'guest'
            ? trim(($row['host_first_name'] ?? '') . ' ' . ($row['host_last_name'] ?? ''))
            : trim(($row['guest_first_name'] ?? '') . ' ' . ($row['guest_last_name'] ?? ''));

        return array_merge($row, [
            'status' => $status,
            'status_class' => $statusClass,
            'role' => $role,
            'other_name' => $otherName,
            'date_range' => $this->formatDateRange($start, $end),
            'is_exchange' => $isExchange,
        ]);
    }

    private function toDate(?string $date): ?DateTimeImmutable
    {
        if (empty($date)) {
            return null;
        }

        try {
            return new DateTimeImmutable($date);
        } catch (Exception) {
            return null;
        }
    }

    private function formatDateRange(?DateTimeImmutable $start, ?DateTimeImmutable $end): string
    {
        if ($start && $end) {
            return $start->format('M j, Y') . ' - ' . $end->format('M j, Y');
        }

        if ($start) {
            return 'From ' . $start->format('M j, Y');
        }

        if ($end) {
            return 'Until ' . $end->format('M j, Y');
        }

        return 'Dates not set';
    }
}
