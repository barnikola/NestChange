<?php

class AvailabilityValidator
{
    /**
     * Check if a requested date range is covered by any of the available slots.
     * 
     * @param string $startDate Requested start date (Y-m-d)
     * @param string $endDate Requested end date (Y-m-d)
     * @param array $slots List of availability slots. Each slot must have 'available_from' and optional 'available_until'.
     * @return bool True if allowed, False otherwise.
     */
    public static function isAvailable(string $startDate, string $endDate, array $slots): bool
    {
        try {
            if (empty($startDate) || empty($endDate)) {
                return false;
            }

            $requestedStart = new DateTime($startDate);
            $requestedEnd = new DateTime($endDate);

            if ($requestedEnd < $requestedStart) {
                return false;
            }

            foreach ($slots as $slot) {
                $slotStart = new DateTime($slot['available_from']);
                
                $slotEnd = null;
                if (!empty($slot['available_until'])) {
                    $slotEnd = new DateTime($slot['available_until']);
                }

                if ($requestedStart < $slotStart) {
                    continue;
                }

                if ($slotEnd !== null) {
                    if ($requestedEnd > $slotEnd) {
                        continue;
                    }
                }

                return true;
            }

            return false;

        } catch (Exception $e) {
            return false;
        }
    }
}
