<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NestChange - Register</title>
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
                    <a href="/listings" class="nav-link">Listings</a>
                    <a href="#" class="nav-link">Chat</a>
                    <a href="#" class="nav-link">Pricing</a>
                    <a href="#" class="nav-link">Contact</a>
                </nav>
            </div>
            <div class="header-right">
                <a href="/auth/signin" class="btn-signin">Sign in</a>
                <a href="/auth/register" class="btn-register">Register</a>
            </div>
        </div>
    </header>

    <!-- Breadcrumbs -->
    <div class="breadcrumbs">
        <div class="breadcrumbs-container">
            <a href="/" class="breadcrumb-link">Home</a>
            <span class="breadcrumb-separator">/</span>
            <span class="breadcrumb-current">Register</span>
        </div>
    </div>

    <!-- Register Form Section -->
    <section class="form-section">
        <div class="form-container">
            <h1 class="form-title">
                <span class="form-title-main">Register</span>
            </h1>
            
            <div class="form-box">
                <form class="auth-form">
                    <div class="form-group">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" id="name" name="name" class="form-input" placeholder="Value" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="surname" class="form-label">Surname</label>
                        <input type="text" id="surname" name="surname" class="form-input" placeholder="Value" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" id="email" name="email" class="form-input" placeholder="Value" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" id="password" name="password" class="form-input" placeholder="Value" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="confirm-password" class="form-label">Confirm password</label>
                        <input type="password" id="confirm-password" name="confirm-password" class="form-input" placeholder="Value" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="id-document" class="form-label">Identification document</label>
                        <div class="file-input-wrapper">
                            <input type="file" id="id-document" name="id-document" class="form-input file-input" placeholder="Value">
                            <span class="file-icon">📎</span>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="student-id" class="form-label">Student-ID</label>
                        <div class="file-input-wrapper">
                            <input type="file" id="student-id" name="student-id" class="form-input file-input" placeholder="Value">
                            <span class="file-icon">📎</span>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="end-date" class="form-label">End of student period</label>
                        <input type="date" id="end-date" name="end-date" class="form-input" placeholder="dd/mm/yyyy" required>
                    </div>
                    
                    <button type="submit" class="btn-submit">Register</button>
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

