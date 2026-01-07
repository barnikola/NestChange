<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'FAQ' ?> - NestChange</title>
    <!-- Use existing CSS if available, otherwise minimal styling for now -->
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; margin: 0; padding: 20px; background: #f9f9f9; }
        .container { max-width: 800px; margin: 0 auto; background: white; padding: 40px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.05); }
        h1 { text-align: center; color: #333; margin-bottom: 30px; }
        
        .accordion { border: 1px solid #ddd; border-radius: 5px; overflow: hidden; }
        .accordion-item { border-bottom: 1px solid #ddd; }
        .accordion-item:last-child { border-bottom: none; }
        .accordion-header {
            background: #fff;
            padding: 15px 20px;
            cursor: pointer;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-weight: bold;
            color: #444;
            transition: background 0.2s;
        }
        .accordion-header:hover { background: #f1f1f1; }
        .accordion-content {
            display: none;
            padding: 20px;
            background: #fafafa;
            border-top: 1px solid #eee;
            color: #666;
        }
        .accordion-content.active { display: block; }
        .icon { font-size: 1.2em; transition: transform 0.3s; }
        .accordion-header.active .icon { transform: rotate(45deg); }
    </style>
</head>
<body>

<div class="container">
    <h1>Frequently Asked Questions</h1>

    <div class="accordion">
        <div class="accordion-item">
            <div class="accordion-header">
                How does NestChange work?
                <span class="icon">+</span>
            </div>
            <div class="accordion-content">
                NestChange is a platform connecting students for housing exchanges. You can list your current accommodation, search for others, and swap seamlessly.
            </div>
        </div>

        <div class="accordion-item">
            <div class="accordion-header">
                Is it free to use?
                <span class="icon">+</span>
            </div>
            <div class="accordion-content">
                Yes, browsing listings is free. Some premium features or final booking confirmations may have a small service fee to ensure security.
            </div>
        </div>

        <div class="accordion-item">
            <div class="accordion-header">
                How do I book a place?
                <span class="icon">+</span>
            </div>
            <div class="accordion-content">
                Once you find a listing, click "Apply". If the owner accepts, you can proceed to chat and finalize the exchange agreement.
            </div>
        </div>

        <div class="accordion-item">
            <div class="accordion-header">
                What documents do I need?
                <span class="icon">+</span>
            </div>
            <div class="accordion-content">
                You typically need a valid student ID and proof of enrollment. Some landlords may require additional ID verification.
            </div>
        </div>
    </div>
     <div style="margin-top: 20px; text-align: center;">
        <a href="/NestChange/public/" style="color: #007bff; text-decoration: none;">&larr; Back to Home</a>
    </div>
</div>

<script>
    document.querySelectorAll('.accordion-header').forEach(header => {
        header.addEventListener('click', () => {
            const content = header.nextElementSibling;
            
            // Toggle active state
            header.classList.toggle('active');
            content.classList.toggle('active');

            // Close other items (optional, currently independent)
        });
    });
</script>

</body>
</html>
