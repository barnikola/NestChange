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
     * Log email to file
     */
    private function logEmail(string $to, string $subject, string $body): void
    {
        $timestamp = date('Y-m-d H:i:s');
        $entry = "[$timestamp] To: $to | Subject: $subject\nBody: $body\n" . str_repeat('-', 40) . "\n";
        
        file_put_contents($this->logFile, $entry, FILE_APPEND);
    }
}
