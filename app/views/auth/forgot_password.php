<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NestChange - Forgot Password</title>
    <link rel="stylesheet" href="/css/theme.css">
</head>
<body>

    <!-- Header -->
    <header class="header">
        <div class="header-container">
            <div class="header-left">
                <a href="/">
                    <img src="/assets/logo.png" alt="NestChange Logo" class="logo-icon">
                </a>
                <nav class="nav-links">
                    <a href="/" class="nav-link">Home</a>
                    <a href="#" class="nav-link">Listings</a>
                    <a href="#" class="nav-link">Chat</a>
                    <a href="#" class="nav-link">Pricing</a>
                    <a href="#" class="nav-link">Contact</a>
                </nav>
            </div>
            <div class="header-right">
                <a href="signin.php" class="btn-signin">Sign in</a>
                <a href="register.php" class="btn-register">Register</a>
            </div>
        </div>
    </header>

    <!-- Breadcrumbs -->
    <div class="breadcrumbs">
        <div class="breadcrumbs-container">
            <a href="/" class="breadcrumb-link">Home</a>
            <span class="breadcrumb-separator">/</span>
            <span class="breadcrumb-current">Forgot Password</span>
        </div>
    </div>

    <!-- Forgot Password Form Section -->
    <section class="form-section">
        <div class="form-container">
            <h1 class="form-title">
                <span class="form-title-main">Forgot Password</span>
            </h1>
            
            <div class="form-box">
                <form class="auth-form">
                    <div class="form-group">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" id="email" name="email" class="form-input" placeholder="Enter your email" required>
                    </div>
                    
                    <button type="submit" class="btn-submit">Send Reset Link</button>
                    
                    <div class="form-links">
                        <a href="signin.php" class="form-link">Back to Sign in</a>
                        <a href="register.php" class="form-link">Register</a>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-container">
            <div class="footer-left">
                <a href="/">
                    <img src="/assets/logo.png" alt="NestChange Logo" class="footer-logo">
                </a>
            </div>
            <div class="footer-nav">
                <div class="footer-nav-column">
                    <h4 class="footer-nav-title">Use cases</h4>
                    <ul class="footer-nav-links">
                        <li><a href="#">UI design</a></li>
                        <li><a href="#">UX design</a></li>
                        <li><a href="#">Wireframing</a></li>
                        <li><a href="#">Diagramming</a></li>
                        <li><a href="#">Brainstorming</a></li>
                        <li><a href="#">Online whiteboard</a></li>
                        <li><a href="#">Team collaboration</a></li>
                    </ul>
                </div>
                <div class="footer-nav-column">
                    <h4 class="footer-nav-title">Explore</h4>
                    <ul class="footer-nav-links">
                        <li><a href="#">Design</a></li>
                        <li><a href="#">Prototyping</a></li>
                        <li><a href="#">Development features</a></li>
                        <li><a href="#">Design systems</a></li>
                        <li><a href="#">Collaboration features</a></li>
                        <li><a href="#">Design process</a></li>
                        <li><a href="#">FigJam</a></li>
                    </ul>
                </div>
                <div class="footer-nav-column">
                    <h4 class="footer-nav-title">Resources</h4>
                    <ul class="footer-nav-links">
                        <li><a href="#">Blog</a></li>
                        <li><a href="#">Best practices</a></li>
                        <li><a href="#">Colors</a></li>
                        <li><a href="#">Color wheel</a></li>
                        <li><a href="#">Support</a></li>
                        <li><a href="#">Developers</a></li>
                        <li><a href="#">Resource library</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>

</body>
</html>
