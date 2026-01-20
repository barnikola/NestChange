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
            self::POLICY_FLEXIBLE => 'Cancellation allowed until 24 hours before check-in.',
            self::POLICY_MODERATE => 'Cancellation allowed up to 5 days prior.',
            self::POLICY_STRICT => 'Cancellation allowed up to 14 days prior.',
            default => '',
        };
    }

    public static function getDetails(string $policy): array
    {
        return match ($policy) {
            self::POLICY_FLEXIBLE => [
                'Cancellation allowed if cancelled at least 24 hours before the local check-in time.',
                'Late cancellation if cancelled less than 24 hours before check-in.'
            ],
            self::POLICY_MODERATE => [
                'Cancellation allowed if cancelled at least 5 days before check-in.',
                'Late cancellation warning if cancelled between 5 days and 24 hours before check-in.',
                'Strict restrictions apply if cancelled less than 24 hours before check-in.'
            ],
            self::POLICY_STRICT => [
                'Cancellation allowed if cancelled at least 14 days before check-in.',
                'Late cancellation warning if cancelled between 14 days and 7 days before check-in.',
                'Strict restrictions apply if cancelled less than 7 days before check-in.'
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
                // Deadline: 24 hours before check-in
                $deadlineFull = (clone $start)->modify('-1 day');
                
                if ($interval->days >= 1) {
                    $refund = 'Allowed';
                    $message = 'Cancellation allowed. (Deadline: ' . $deadlineFull->format('d M Y, H:i') . ')';
                } else {
                    $refund = 'Restricted';
                    $message = 'Late cancellation. (Deadline was ' . $deadlineFull->format('d M Y, H:i') . ')';
                }
                break;

            case self::POLICY_MODERATE:
                // Deadline: 5 days prior
                $deadlineFull = (clone $start)->modify('-5 days');
                $deadlinePartial = (clone $start)->modify('-1 day');

                if ($daysBefore >= 5) {
                    $refund = 'Allowed';
                    $message = 'Cancellation allowed. (Deadline: ' . $deadlineFull->format('d M Y, H:i') . ')';
                } elseif ($daysBefore >= 1) {
                    $refund = 'Warning';
                    $message = 'Late cancellation warning. (Next deadline: ' . $deadlinePartial->format('d M Y, H:i') . ')';
                } else {
                    $refund = 'Restricted';
                    $message = 'Cancellation restricted. (Deadline was ' . $deadlinePartial->format('d M Y, H:i') . ')';
                }
                break;

            case self::POLICY_STRICT:
                // Deadline: 14 days prior
                $deadlineFull = (clone $start)->modify('-14 days');
                $deadlinePartial = (clone $start)->modify('-7 days');
                
                if ($daysBefore >= 14) {
                    $refund = 'Allowed';
                    $message = 'Cancellation allowed. (Deadline: ' . $deadlineFull->format('d M Y, H:i') . ')';
                } elseif ($daysBefore >= 7) {
                    $refund = 'Warning';
                    $message = 'Late cancellation warning. (Next deadline: ' . $deadlinePartial->format('d M Y, H:i') . ')';
                } else {
                    $refund = 'Restricted';
                    $message = 'Cancellation restricted. (Deadline was ' . $deadlinePartial->format('d M Y, H:i') . ')';
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
