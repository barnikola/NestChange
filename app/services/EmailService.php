<?php

class EmailService
{
    private string $logFile;

    public function __construct()
    {
        // Define log file path relative to project root
        // Using dirname(__DIR__, 2) to get back to project root from app/services
        $this->logFile = dirname(__DIR__, 2) . '/temp/email-demo.log';
        
        // Ensure temp directory exists
        $dir = dirname($this->logFile);
        if (!is_dir($dir)) {
            mkdir($dir, 0777, true);
        }
    }

    /**
     * Send "Account Approved" email (mock)
     */
    public function sendAccountApproved(array $user): void
    {
        $to = $user['email'];
        $name = $user['username'] ?? 'User';
        $subject = 'Account Approved';
        $body = "Hi {$name},\n\nYour account has been approved by our administrators. You can now log in and access all features.\n\nWelcome to NestChange!";
        
        $this->logEmail($to, $subject, $body);
    }

    /**
     * Send "Cancellation Notification" emails
     */
    public function sendCancellationNotification(array $application, array $refundDetails): void
    {
        // 1. Notify Guest (Applicant)
        // We need applicant email. Application array might not have it unless joined.
        // Assuming controller fetches it or we pass it.
        // Let's rely on finding it or passing it. 
        // Actually, let's update signature to accept explicit data or fetch within.
        // Better: Controller fetches detailed info and passes 'applicant_email' and 'host_email'.
        
        if (!empty($application['applicant_email'])) {
            $to = $application['applicant_email'];
            $subject = 'Application Cancelled: ' . ($application['listing_title'] ?? 'Listing');
            $body = "Hi " . ($application['applicant_name'] ?? 'Guest') . ",\n\n" .
                    "Your application has been cancelled.\n" .
                    "Refund Status: " . ($refundDetails['refund'] ?? 'None') . "\n" .
                    "Details: " . ($refundDetails['message'] ?? '') . "\n\n" .
                    "We hope to see you again soon!";
            $this->logEmail($to, $subject, $body);
        }

        // 2. Notify Host
        if (!empty($application['host_email'])) {
            $toHost = $application['host_email'];
            $subjectHost = 'Booking Cancelled: ' . ($application['listing_title'] ?? 'Listing');
            $bodyHost = "Hi " . ($application['host_name'] ?? 'Host') . ",\n\n" .
                        "A booking for your listing has been cancelled by the guest.\n" .
                        "Guest: " . ($application['applicant_name'] ?? 'Guest') . "\n" .
                        "Refund applied: " . ($refundDetails['refund'] ?? 'None') . "\n\n" .
                        "Your calendar has been updated.";
            $this->logEmail($toHost, $subjectHost, $bodyHost);
        }
    }

    /**
     * Send "Report Status Updated" email
     */
    public function sendReportStatusUpdate(array $report, string $newStatus): void
    {
        if (empty($report['reporter_email'])) {
            return; // No email to send to
        }

        $to = $report['reporter_email'];
        $reporterName = trim($report['reporter_name'] ?? 'User');
        if (empty($reporterName)) {
            $reporterName = 'User';
        }

        $statusLabels = [
            'pending' => 'Pending Review',
            'reviewed' => 'Under Review',
            'resolved' => 'Resolved'
        ];
        
        $statusLabel = $statusLabels[$newStatus] ?? ucfirst($newStatus);
        
        $reportedItem = '';
        if ($report['reported_type'] === 'listing') {
            $reportedItem = "Listing #{$report['reported_id']}";
        } elseif ($report['reported_type'] === 'user') {
            $reportedItem = "User Profile #{$report['reported_id']}";
        } elseif ($report['reported_type'] === 'message') {
            $reportedItem = "Message #{$report['reported_id']}";
        } else {
            $reportedItem = "Item #{$report['reported_id']}";
        }

        $subject = "Report Status Update: {$statusLabel}";
        $body = "Hi {$reporterName},\n\n" .
                "Your report regarding {$reportedItem} has been updated.\n\n" .
                "Report ID: {$report['id']}\n" .
                "Reason: {$report['reason']}\n" .
                "New Status: {$statusLabel}\n\n" .
                "Thank you for helping us maintain a safe community.\n\n" .
                "Best regards,\n" .
                "NestChange Team";

        $this->logEmail($to, $subject, $body);
    }

    /**
     * Send "Password Reset" email
     */
    public function sendPasswordReset(string $email, string $token): void
    {
        $resetUrl = BASE_URL . '/reset-password?token=' . $token;
        $subject = 'Password Reset Request';
        $body = "Hi,\n\n" .
                "You requested a password reset for your NestChange account.\n" .
                "Click the link below to verify your email and set a new password:\n\n" .
                "{$resetUrl}\n\n" .
                "If you didn't make this request, please ignore receive this email.\n\n" .
                "This link will expire in 1 hour.";
        
        $this->logEmail($email, $subject, $body);
    }

    /**
     * Log email to file
     */
    private function logEmail(string $to, string $subject, string $body): void
    {
        $timestamp = date('Y-m-d H:i:s');
        $entry = "[$timestamp] To: $to | Subject: $subject\nBody: $body\n" . str_repeat('-', 40) . "\n";
        
        file_put_contents($this->logFile, $entry, FILE_APPEND);
    }
}
