<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Contact Us' ?> - NestChange</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; margin: 0; padding: 20px; background: #f4f6f8; }
        .container { max-width: 600px; margin: 0 auto; background: white; padding: 40px; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); }
        h1 { text-align: center; color: #333; margin-bottom: 20px; }
        
        .form-group { margin-bottom: 20px; }
        label { display: block; margin-bottom: 8px; font-weight: bold; color: #555; }
        input[type="text"], input[type="email"], textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-size: 16px;
            box-sizing: border-box; /* Fixes padding issue */
        }
        textarea { height: 150px; resize: vertical; }
        
        .btn-submit {
            display: block;
            width: 100%;
            padding: 15px;
            background: #007bff;
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 18px;
            cursor: pointer;
            transition: background 0.3s;
        }
        .btn-submit:hover { background: #0056b3; }

        .alert { padding: 15px; border-radius: 6px; margin-bottom: 20px; }
        .alert-success { background: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
        .alert-error { background: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }
    </style>
</head>
<body>

<div class="container">
    <h1>Contact Us</h1>
    
    <?php if (isset($success) && $success): ?>
        <div class="alert alert-success"><?= htmlspecialchars($success) ?></div>
    <?php endif; ?>

    <?php if (isset($errors) && !empty($errors)): ?>
        <div class="alert alert-error">
            <ul style="margin: 0; padding-left: 20px;">
                <?php foreach ($errors as $error): ?>
                    <li><?= htmlspecialchars($error) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <form method="POST" action="">
        <div class="form-group">
            <label for="name">Full Name</label>
            <input type="text" id="name" name="name" required placeholder="John Doe">
        </div>

        <div class="form-group">
            <label for="email">Email Address</label>
            <input type="email" id="email" name="email" required placeholder="john@example.com">
        </div>

        <div class="form-group">
            <label for="subject">Subject</label>
            <input type="text" id="subject" name="subject" required placeholder="How can we help?">
        </div>

        <div class="form-group">
            <label for="message">Message</label>
            <textarea id="message" name="message" required placeholder="Your message here..."></textarea>
        </div>

        <button type="submit" class="btn-submit">Send Message</button>
    </form>
    
    <div style="margin-top: 20px; text-align: center;">
        <a href="/NestChange/public/" style="color: #666; text-decoration: none;">Cancel</a>
    </div>
</div>

</body>
</html>
