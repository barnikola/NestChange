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
                    <input 
                        type="password" 
                        id="password" 
                        name="password" 
                        class="form-input<?php echo isset($errors['password']) ? ' is-invalid' : ''; ?>" 
                        placeholder="••••••••"
                        <?php echo isset($errors['password']) ? 'aria-invalid="true"' : ''; ?>
                        required
                    >
                    <?php if (isset($errors['password'])): ?>
                        <?php foreach ($errors['password'] as $error): ?>
                            <span class="form-error"><?= htmlspecialchars($error) ?></span>
                        <?php endforeach; ?>
                    <?php endif; ?>
                    <span class="form-help">At least 8 characters</span>
                </div>
                
                <div class="form-group">
                    <label for="confirm-password" class="form-label">Confirm password</label>
                    <input 
                        type="password" 
                        id="confirm-password" 
                        name="password_confirm" 
                        class="form-input<?php echo isset($errors['password_confirm']) ? ' is-invalid' : ''; ?>" 
                        placeholder="••••••••"
                        <?php echo isset($errors['password_confirm']) ? 'aria-invalid="true"' : ''; ?>
                        required
                    >
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
<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/main.php';
