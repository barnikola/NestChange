<?php

class CancellationPolicyHelper
{
    public const POLICY_FLEXIBLE = 'flexible';
    public const POLICY_MODERATE = 'moderate';
    public const POLICY_STRICT = 'strict';

    public static function getAll(): array
    {
        return [
            self::POLICY_FLEXIBLE,
            self::POLICY_MODERATE,
            self::POLICY_STRICT,
        ];
    }

    public static function getLabel(string $policy): string
    {
        return match ($policy) {
            self::POLICY_FLEXIBLE => 'Flexible',
            self::POLICY_MODERATE => 'Moderate',
            self::POLICY_STRICT => 'Strict',
            default => 'Unknown Policy',
        };
    }

    public static function getDescription(string $policy): string
    {
        return match ($policy) {
            self::POLICY_FLEXIBLE => 'Free cancellation until 24 hours before check-in.',
            self::POLICY_MODERATE => 'Full refund 5 days prior to arrival.',
            self::POLICY_STRICT => 'Full refund 14 days prior to arrival.',
            default => '',
        };
    }

    public static function getDetails(string $policy): array
    {
        return match ($policy) {
            self::POLICY_FLEXIBLE => [
                'Full refund if cancelled at least 24 hours before the local check-in time.',
                'No refund if cancelled less than 24 hours before check-in.'
            ],
            self::POLICY_MODERATE => [
                'Full refund if cancelled at least 5 days before check-in.',
                '50% refund if cancelled between 5 days and 24 hours before check-in.',
                'No refund if cancelled less than 24 hours before check-in.'
            ],
            self::POLICY_STRICT => [
                'Full refund if cancelled at least 14 days before check-in.',
                '50% refund if cancelled between 14 days and 7 days before check-in.',
                'No refund if cancelled less than 7 days before check-in.'
            ],
            default => [],
        };
    }
    public static function checkEligibility(string $policy, string $startDate): array
    {
        $now = new DateTime();
        $start = new DateTime($startDate);
        $interval = $now->diff($start);
        $daysBefore = $interval->days; // integer total days
        
        // If start date is in the past or today (and we assume check-in is effectively "now" or earlier),
        // we might handle differently. For simplicity, if today > start, no refund.
        if ($now > $start) {
             return [
                'allowed' => false,
                'refund' => 'None',
                'message' => 'Cannot cancel after start date.'
            ];
        }

        // Default
        $allowed = true;
        $refund = 'None';
        $message = 'Cancellation allowed.';

        switch ($policy) {
            case self::POLICY_FLEXIBLE:
                // Full refund if cancelled at least 24 hours before
                // Diffs: if days > 0, it means at least 24h. 
                // Actually, DateTime::diff returns days as complete 24h periods.
                // If it's the same day, days=0. If it's tomorrow, days=1 (if >24h).
                // Let's rely on hours or just day difference.
                // "Until 24 hours before check-in"
                
                // Deadlines
                $deadlineFull = (clone $start)->modify('-1 day');
                
                if ($interval->days >= 1) {
                    $refund = 'Full';
                    $message = 'Full refund applied. (Deadline: ' . $deadlineFull->format('d M Y, H:i') . ')';
                } else {
                    $refund = 'None';
                    // Passed deadline
                    $message = 'No refund. (Deadline was ' . $deadlineFull->format('d M Y, H:i') . ')';
                }
                break;

            case self::POLICY_MODERATE:
                // Full refund 5 days prior
                // 50% between 5 days and 24 hours
                $deadlineFull = (clone $start)->modify('-5 days');
                $deadlinePartial = (clone $start)->modify('-1 day');

                if ($daysBefore >= 5) {
                    $refund = 'Full';
                    $message = 'Full refund applied. (Deadline: ' . $deadlineFull->format('d M Y, H:i') . ')';
                } elseif ($daysBefore >= 1) {
                    $refund = '50%';
                    $message = '50% refund applied. (Next deadline: ' . $deadlinePartial->format('d M Y, H:i') . ')';
                } else {
                    $refund = 'None';
                    $message = 'No refund. (Deadline was ' . $deadlinePartial->format('d M Y, H:i') . ')';
                }
                break;

            case self::POLICY_STRICT:
                // Full refund 14 days prior
                // 50% between 14 days and 7 days
                $deadlineFull = (clone $start)->modify('-14 days');
                $deadlinePartial = (clone $start)->modify('-7 days');
                
                if ($daysBefore >= 14) {
                    $refund = 'Full';
                    $message = 'Full refund applied. (Deadline: ' . $deadlineFull->format('d M Y, H:i') . ')';
                } elseif ($daysBefore >= 7) {
                    $refund = '50%';
                    $message = '50% refund applied. (Next deadline: ' . $deadlinePartial->format('d M Y, H:i') . ')';
                } else {
                    $refund = 'None';
                    $message = 'No refund. (Deadline was ' . $deadlinePartial->format('d M Y, H:i') . ')';
                }
                break;
        }

        return [
            'allowed' => $allowed,
            'refund' => $refund,
            'message' => $message
        ];
    }
}
