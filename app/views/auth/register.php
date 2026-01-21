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
            <?php if (isset($_SESSION['_flash']['error'])): ?>
                <div class="alert alert-error">
                    <p><?= htmlspecialchars($_SESSION['_flash']['error']) ?></p>
                </div>
                <?php unset($_SESSION['_flash']['error']); ?>
            <?php endif; ?>

            <?php if (isset($_SESSION['_flash']['success'])): ?>
                <div class="alert alert-success">
                    <p><?= htmlspecialchars($_SESSION['_flash']['success']) ?></p>
                </div>
                <?php unset($_SESSION['_flash']['success']); ?>
            <?php endif; ?>

            <!-- DEBUG: Form tag should have method="POST" action="/register" enctype="multipart/form-data" -->
            <form class="auth-form" method="POST" action="/register" enctype="multipart/form-data" data-no-loading="true">
                <input type="hidden" name="csrf_token" value="<?= $csrf_token ?? '' ?>">
                
                <div class="form-group">
                    <label for="name" class="form-label">Name</label>
                    <input 
                        type="text" 
                        id="name" 
                        name="name" 
                        class="form-input<?php echo isset($errors['name']) ? ' is-invalid' : ''; ?>" 
                        placeholder="John" 
                        value="<?= htmlspecialchars($old['name'] ?? '') ?>"
                        <?php echo isset($errors['name']) ? 'aria-invalid="true"' : ''; ?>
                        required
                    >
                    <?php if (isset($errors['name'])): ?>
                        <?php foreach ($errors['name'] as $error): ?>
                            <span class="form-error"><?= htmlspecialchars($error) ?></span>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
                
                <div class="form-group">
                    <label for="surname" class="form-label">Surname</label>
                    <input 
                        type="text" 
                        id="surname" 
                        name="surname" 
                        class="form-input<?php echo isset($errors['surname']) ? ' is-invalid' : ''; ?>" 
                        placeholder="Doe" 
                        value="<?= htmlspecialchars($old['surname'] ?? '') ?>"
                        <?php echo isset($errors['surname']) ? 'aria-invalid="true"' : ''; ?>
                        required
                    >
                    <?php if (isset($errors['surname'])): ?>
                        <?php foreach ($errors['surname'] as $error): ?>
                            <span class="form-error"><?= htmlspecialchars($error) ?></span>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
                
                <div class="form-group">
                    <label for="email" class="form-label">Email</label>
                    <input 
                        type="email" 
                        id="email" 
                        name="email" 
                        class="form-input<?php echo isset($errors['email']) ? ' is-invalid' : ''; ?>" 
                        placeholder="your@email.com" 
                        value="<?= htmlspecialchars($old['email'] ?? '') ?>"
                        <?php echo isset($errors['email']) ? 'aria-invalid="true"' : ''; ?>
                        required
                    >
                    <?php if (isset($errors['email'])): ?>
                        <?php foreach ($errors['email'] as $error): ?>
                            <span class="form-error"><?= htmlspecialchars($error) ?></span>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
                
                <div class="form-group">
                    <label for="password" class="form-label">Password</label>
                    <div class="password-input-wrapper">
                        <input 
                            type="password" 
                            id="password" 
                            name="password" 
                            class="form-input<?php echo isset($errors['password']) ? ' is-invalid' : ''; ?>" 
                            placeholder="••••••••"
                            <?php echo isset($errors['password']) ? 'aria-invalid="true"' : ''; ?>
                            required
                        >
                        <button type="button" class="password-toggle" aria-label="Show password" data-target="password">
                            <svg aria-hidden="true" class="svg-icon iconEye" width="18" height="18" viewBox="0 0 18 18"><path d="M9.06 3C4 3 1 9 1 9s3 6 8.06 6C14 15 17 9 17 9s-3-6-7.94-6M9 13a4 4 0 1 1 0-8 4 4 0 0 1 0 8m0-2a2 2 0 0 0 2-2 2 2 0 0 0-2-2 2 2 0 0 0-2 2 2 2 0 0 0 2 2"></path></svg>
                            <svg aria-hidden="true" class="svg-icon iconEyeOff" width="18" height="18" viewBox="0 0 18 18" style="display: none;"><path d="m5.02 9.44-2.22 2.2C1.63 10.25 1 9 1 9s3-6 8.06-6q1.13.01 2.12.38L9.5 5.03 9 5a4 4 0 0 0-3.98 4.44m2.03 3.05A4 4 0 0 0 13 9q-.01-1.1-.54-2l-1.51 1.54q.05.22.05.46a2 2 0 0 1-2.44 1.95zm7.11-7.22A15 15 0 0 1 17 9s-3 6-7.94 6c-1.31 0-2.48-.4-3.5-1l-1.97 2L2 14.41 14.59 2 16 3.41z"></path></svg>
                        </button>
                    </div>
                    <?php if (isset($errors['password'])): ?>
                        <?php foreach ($errors['password'] as $error): ?>
                            <span class="form-error"><?= htmlspecialchars($error) ?></span>
                        <?php endforeach; ?>
                    <?php endif; ?>
                    <span class="form-help">At least 8 characters</span>
                </div>
                
                <div class="form-group">
                    <label for="confirm-password" class="form-label">Confirm password</label>
                    <div class="password-input-wrapper">
                        <input 
                            type="password" 
                            id="confirm-password" 
                            name="password_confirm" 
                            class="form-input<?php echo isset($errors['password_confirm']) ? ' is-invalid' : ''; ?>" 
                            placeholder="••••••••"
                            <?php echo isset($errors['password_confirm']) ? 'aria-invalid="true"' : ''; ?>
                            required
                        >
                        <button type="button" class="password-toggle" aria-label="Show password" data-target="confirm-password">
                            <svg aria-hidden="true" class="svg-icon iconEye" width="18" height="18" viewBox="0 0 18 18"><path d="M9.06 3C4 3 1 9 1 9s3 6 8.06 6C14 15 17 9 17 9s-3-6-7.94-6M9 13a4 4 0 1 1 0-8 4 4 0 0 1 0 8m0-2a2 2 0 0 0 2-2 2 2 0 0 0-2-2 2 2 0 0 0-2 2 2 2 0 0 0 2 2"></path></svg>
                            <svg aria-hidden="true" class="svg-icon iconEyeOff" width="18" height="18" viewBox="0 0 18 18" style="display: none;"><path d="m5.02 9.44-2.22 2.2C1.63 10.25 1 9 1 9s3-6 8.06-6q1.13.01 2.12.38L9.5 5.03 9 5a4 4 0 0 0-3.98 4.44m2.03 3.05A4 4 0 0 0 13 9q-.01-1.1-.54-2l-1.51 1.54q.05.22.05.46a2 2 0 0 1-2.44 1.95zm7.11-7.22A15 15 0 0 1 17 9s-3 6-7.94 6c-1.31 0-2.48-.4-3.5-1l-1.97 2L2 14.41 14.59 2 16 3.41z"></path></svg>
                        </button>
                    </div>
                    <?php if (isset($errors['password_confirm'])): ?>
                        <?php foreach ($errors['password_confirm'] as $error): ?>
                            <span class="form-error"><?= htmlspecialchars($error) ?></span>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
                
                <div class="form-group">
                    <label for="profile-picture" class="form-label">Profile Picture (Optional)</label>
                    <div class="file-input-wrapper">
                        <input 
                            type="file" 
                            id="profile-picture" 
                            name="profile_picture" 
                            class="form-input file-input" 
                            accept=".jpg, .jpeg, image/jpg, image/jpeg"
                        >
                        <span class="file-icon">📎</span>
                    </div>
                    <?php if (isset($errors['profile_picture'])): ?>
                        <?php foreach ($errors['profile_picture'] as $error): ?>
                            <span class="form-error"><?= htmlspecialchars($error) ?></span>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
                
                <div class="form-group">
                    <label for="id-document" class="form-label">Identification document</label>
                    <div class="file-input-wrapper">
                        <input 
                            type="file" 
                            id="id-document" 
                            name="id-document" 
                            class="form-input file-input" 
                            placeholder="Value"
                            accept=".pdf, .jpg, .jpeg, image/jpeg, application/pdf"
                        >
                        <span class="file-icon">📎</span>
                    </div>
                    <?php if (isset($errors['id-document'])): ?>
                        <?php foreach ($errors['id-document'] as $error): ?>
                            <span class="form-error"><?= htmlspecialchars($error) ?></span>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
                
                <div class="form-group">
                    <label for="student-id" class="form-label">Student-ID</label>
                    <div class="file-input-wrapper">
                        <input 
                            type="file" 
                            id="student-id" 
                            name="student-id" 
                            class="form-input file-input" 
                            placeholder="Value"
                            accept=".pdf, .jpg, .jpeg, image/jpeg, application/pdf"
                        >
                        <span class="file-icon">📎</span>
                    </div>
                    <?php if (isset($errors['student-id'])): ?>
                        <?php foreach ($errors['student-id'] as $error): ?>
                            <span class="form-error"><?= htmlspecialchars($error) ?></span>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
                
                <div class="form-group">
                    <label for="end-date" class="form-label">End of student period</label>
                    <input 
                        type="date" 
                        id="end-date" 
                        name="student_status_until" 
                        class="form-input" 
                        placeholder="dd/mm/yyyy" 
                        value="<?= htmlspecialchars($old['student_status_until'] ?? '') ?>"
                        required
                    >
                </div>

                <div class="form-group">
                    <label class="form-label">Verify you are a human</label>
                    <div class="form-row">
                        <span class="form-label" style="white-space: nowrap; flex: 0 0 auto;"><?= $_SESSION['captcha_x']?> + <?= $_SESSION['captcha_y']?> =</span>
                        <input 
                            type="number" 
                            class="form-input<?php echo isset($errors['captcha']) ? ' is-invalid' : ''; ?>" 
                            name="captcha"
                            <?php echo isset($errors['captcha']) ? 'aria-invalid="true"' : ''; ?>
                        >
                    </div>
                    <?php if (isset($errors['captcha'])): ?>
                        <?php foreach ($errors['captcha'] as $error): ?>
                            <span class="form-error"><?= htmlspecialchars($error) ?></span>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>


                <button type="submit" class="btn-submit">Register</button>
            </form>
        </div>
    </div>
    </div>
</section>
<script src="/js/register-validation.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const toggleButtons = document.querySelectorAll('.password-toggle');
    
    toggleButtons.forEach(function(toggleButton) {
        const targetId = toggleButton.getAttribute('data-target');
        const passwordInput = document.getElementById(targetId);
        
        if (passwordInput && toggleButton) {
            const eyeIcon = toggleButton.querySelector('.iconEye');
            const eyeOffIcon = toggleButton.querySelector('.iconEyeOff');
            
            toggleButton.addEventListener('click', function() {
                const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInput.setAttribute('type', type);
                toggleButton.setAttribute('aria-label', type === 'password' ? 'Show password' : 'Hide password');
                
                if (type === 'password') {
                    eyeIcon.style.display = 'block';
                    eyeOffIcon.style.display = 'none';
                } else {
                    eyeIcon.style.display = 'none';
                    eyeOffIcon.style.display = 'block';
                }
            });
        }
    });
});
</script>
<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/main.php';
