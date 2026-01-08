<?php

require_once dirname(__DIR__) . '/core/controller.php';
require_once dirname(__DIR__) . '/helpers/EmailService.php';

class StaticController extends Controller
{
    public function faq(): void
    {
        $this->view('static/faq', [
            'title' => 'Frequency Asked Questions'
        ]);
    }

    public function contact(): void
    {
        $data = [
            'title' => 'Contact Us',
            'errors' => [],
            'success' => null
        ];

        if ($this->isPost()) {
            $name = $this->postInput('name');
            $email = $this->postInput('email');
            $subject = $this->postInput('subject');
            $message = $this->postInput('message');

            // Basic Validation
            if (empty($name) || empty($email) || empty($subject) || empty($message)) {
                $data['errors'][] = 'All fields are required.';
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $data['errors'][] = 'Invalid email format.';
            } else {
                // Send Email
                $body = "Name: $name<br>Email: $email<br><br>Message:<br>$message";
                if (EmailService::send('support@nestchange.local', "Contact Form: $subject", $body)) {
                    $data['success'] = 'Thank you! Your message has been sent.';
                } else {
                    $data['errors'][] = 'Failed to send message. Please try again later.';
                }
            }
        }

        $this->view('static/contact', $data);
    }

    public function legal(): void
    {
        // Default to 'terms' if no type specified
        $type = $_GET['type'] ?? 'terms';
        
        // Allowed types to prevent SQL injection or invalid queries via URL
        $allowedTypes = ['terms', 'privacy', 'cookies'];
        if (!in_array($type, $allowedTypes)) {
            $type = 'terms';
        }

        // Fetch content from database
        $db = Database::getInstance();
        $content = $db->fetchOne("SELECT * FROM legal_content WHERE type = ?", [$type]);

        $this->view('static/legal', [
            'title' => ucfirst($type) . ' - Legal',
            'currentType' => $type,
            'content' => $content
        ]);
    }
}
