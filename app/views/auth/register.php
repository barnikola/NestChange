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
            <?php if (isset($errors) && !empty($errors)): ?>
                <div class="alert alert-error">
                    <?php foreach ($errors as $fieldErrors): ?>
                        <?php foreach ($fieldErrors as $error): ?>
                            <p><?= htmlspecialchars($error) ?></p>
                        <?php endforeach; ?>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

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
            <form class="auth-form" method="POST" action="/register" enctype="multipart/form-data">
                <input type="hidden" name="csrf_token" value="<?= $csrf_token ?? '' ?>">
                
                <div class="form-group">
                    <label for="name" class="form-label">Name</label>
                    <input 
                        type="text" 
                        id="name" 
                        name="name" 
                        class="form-input" 
                        placeholder="Value" 
                        value="<?= htmlspecialchars($old['name'] ?? '') ?>"
                        required
                    >
                </div>
                
                <div class="form-group">
                    <label for="surname" class="form-label">Surname</label>
                    <input 
                        type="text" 
                        id="surname" 
                        name="surname" 
                        class="form-input" 
                        placeholder="Value" 
                        value="<?= htmlspecialchars($old['surname'] ?? '') ?>"
                        required
                    >
                </div>
                
                <div class="form-group">
                    <label for="email" class="form-label">Email</label>
                    <input 
                        type="email" 
                        id="email" 
                        name="email" 
                        class="form-input" 
                        placeholder="Value" 
                        value="<?= htmlspecialchars($old['email'] ?? '') ?>"
                        required
                    >
                </div>
                
                <div class="form-group">
                    <label for="password" class="form-label">Password</label>
                    <input 
                        type="password" 
                        id="password" 
                        name="password" 
                        class="form-input" 
                        placeholder="Value" 
                        required
                    >
                </div>
                
                <div class="form-group">
                    <label for="confirm-password" class="form-label">Confirm password</label>
                    <input 
                        type="password" 
                        id="confirm-password" 
                        name="password_confirm" 
                        class="form-input" 
                        placeholder="Value" 
                        required
                    >
                </div>
                
                <div class="form-group">
                    <label for="profile-picture" class="form-label">Profile Picture (Optional)</label>
                    <div class="file-input-wrapper">
                        <input 
                            type="file" 
                            id="profile-picture" 
                            name="profile_picture" 
                            class="form-input file-input" 
                            accept="image/jpeg,image/png,image/jpg,image/gif,image/webp"
                        >
                        <span class="file-icon">📎</span>
                    </div>
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

                <div class="captcha-box">
                    <label class="form-label"> Verify you are a human: </label>
                    <div style="gap: 10px ; margin: 10px 0 0 10px; align-items:center; display: flex; flex-direction: row">
                    <label style="text-wrap: nowrap" class="form-label"><?= $_SESSION['captcha_x']?> + <?= $_SESSION['captcha_y']?> =</label>
                    <input type="number" class="form-input" style="width: 6vw; " name="captcha">
                    </div>
                </div>


                <button type="submit" class="btn-submit">Register</button>
            </form>
        </div>
    </div>
</section>
<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/main.php';
