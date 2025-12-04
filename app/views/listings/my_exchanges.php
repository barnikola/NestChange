<!DOCTYPE html>
<html lang="en">
    <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>NestChange - My Exchanges</title>
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

        <!-- Exchange Section -->

        <section id="exc-section">

          <div class="exc-search">
            <input type="text" placeholder="Search by location or date">
            
          </div>

          <div id="exc-filter">
            <ul>
              <li>Filter:</li>
              <li><a href="#">All</a></li>
              <li><a href="#">Active</a></li>
              <li><a href="#">Completed</a></li>
              <li><a href="#">Cancelled</a></li>
            </ul>
          </div>

          <div class="exc-box">
            <h4>EXCHANGES LIST</h4>
            <div class="exc-images">
              <img src="/assets/listing.jpg">
              <img src="/assets/listing.jpg">
              <img src="/assets/listing.jpg">
              <img src="/assets/listing.jpg">
              <img src="/assets/listing.jpg">
              <img src="/assets/listing.jpg">
              <img src="/assets/listing.jpg">
              <img src="/assets/listing.jpg">
            </div>

            <table class="exc-table">
                <tr>
                  <th>Exchange ID</th>
                  <th>Accommodation</th>
                  <th>Dates</th>
                  <th>Status</th>
                  <th>View</th>
                </tr>

                <tr>
                  <td>12345</td>
                  <td>Beach House</td>
                  <td>July 10 - 23</td>
                  <td class="done">Finalized</td>
                  <td><a href="exchange_details.php">View Details</a></td>
                </tr>
                <tr>
                  <td>22341</td>
                  <td>Beach House</td>
                  <td>July 10 - 23</td>
                  <td class="done">Finalized</td>
                  <td><a href="exchange_details.php">View Details</a></td>
                </tr>
                <tr>
                  <td>99911</td>
                  <td>Beach House</td>
                  <td>July 10 - 23</td>
                  <td class="active">Confirmed</td>
                  <td><a href="exchange_details.php">View Details</a></td>
                </tr>
                <tr>
                  <td>77882</td>
                  <td>Beach House</td>
                  <td>July 10 - 23</td>
                  <td class="active">Confirmed</td>
                  <td><a href="exchange_details.php">View Details</a></td>
                </tr>
                <tr>
                  <td>33221</td>
                  <td>Beach House</td>
                  <td>July 10 - 23</td>
                  <td class="active">Confirmed</td>
                  <td><a href="exchange_details.php">View Details</a></td>
                </tr>
              
            </table>

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
