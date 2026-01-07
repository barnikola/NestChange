<?php

class EmailService
{
    /**
     * Send an email
     *
     * @param string $to Recipient email
     * @param string $subject Subject of the email
     * @param string $message content of the email
     * @return bool True if sent, false otherwise
     */
    public static function send(string $to, string $subject, string $message): bool
    {
        // Headers
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= 'From: noreply@nestchange.local' . "\r\n";

        // In a real environment, you might use PHPMailer or similar libraries.
        // For local development on XAMPP, mail() requires configuration in php.ini (sendmail).
        // If not configured, this will return false or fail silently.
        
        if (APP_DEBUG) {
            // Log email in debug mode instead of failing if mail server isn't set up
            error_log("=== EMAIL SENT ===");
            error_log("To: $to");
            error_log("Subject: $subject");
            error_log("Message: $message");
            error_log("==================");
            return true; 
        }

        return mail($to, $subject, $message, $headers);
    }
}
