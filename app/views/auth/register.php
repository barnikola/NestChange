<?php
$pageTitle = 'NestChange - Register';
$activeNav = '';
$breadcrumbs = [
    ['label' => 'Home', 'url' => '/'],
    ['label' => 'Register'],
];

ob_start();
?>
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
<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/main.php';
