<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Login - TWILL Studio</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="<?= base_url('assets/css/admin/login.css'); ?>">
</head>
<body>
    <div class="login-container">
        <div class="login-card">
            <!-- Logo -->
            <div class="login-logo">
                <img src="<?= base_url('assets/images/twll LOGO.png'); ?>" alt="TWILL Studio" class="login-logo-img">
                <h1>LOGIN</h1>
                <p>Masuk ke dashboard admin</p>
            </div>

            <!-- System Feedback: Success -->
            <?php if (session()->getFlashdata('success')): ?>
                <div class="alert alert-success">
                    <span class="alert-icon">✓</span>
                    <span><?= esc(session()->getFlashdata('success')) ?></span>
                </div>
            <?php endif; ?>

            <!-- System Feedback: Error -->
            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-error">
                    <span class="alert-icon">⚠</span>
                    <span><?= esc(session()->getFlashdata('error')) ?></span>
                </div>
            <?php endif; ?>

            <!-- System Feedback: Validation Errors -->
            <?php $errors = session()->getFlashdata('errors'); ?>
            <?php if (is_array($errors) && !empty($errors)): ?>
                <div class="alert alert-error">
                    <span class="alert-icon">⚠</span>
                    <div>
                        <strong>Perbaiki error berikut:</strong>
                        <ul>
                            <?php foreach ($errors as $e): ?>
                                <li><?= esc($e) ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            <?php endif; ?>

            <!-- System Feedback: Warning -->
            <?php if (session()->getFlashdata('warning')): ?>
                <div class="alert alert-warning">
                    <span class="alert-icon">ℹ</span>
                    <span><?= esc(session()->getFlashdata('warning')) ?></span>
                </div>
            <?php endif; ?>

            <!-- Login Form -->
            <form method="POST" action="<?= site_url('admin/login'); ?>" id="loginForm">
                <?= csrf_field(); ?>

                <!-- Username -->
                <div class="form-group">
                    <label for="username" class="form-label">
                        Username
                        <span class="required">*</span>
                    </label>
                    <input 
                        id="username" 
                        type="text" 
                        name="username" 
                        class="form-input" 
                        value="<?= esc(old('username')) ?>" 
                        placeholder="Masukkan username"
                        autocomplete="username"
                        required
                    />
                </div>

                <!-- Password -->
                <div class="form-group">
                    <label for="password" class="form-label">
                        Password
                        <span class="required">*</span>
                    </label>
                    <div class="password-wrapper">
                        <input 
                            id="password" 
                            type="password" 
                            name="password" 
                            class="form-input" 
                            placeholder="Masukkan password"
                            autocomplete="current-password"
                            required
                        />
                        <button type="button" class="password-toggle" id="togglePassword" aria-label="Toggle password visibility">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn-submit" id="submitBtn">
                    <span class="btn-text">SIGN IN</span>
                    <span class="loading-spinner"></span>
                </button>
            </form>

            <!-- Footer -->
            <div class="login-footer">
                <p>
                    &copy; <?= date('Y'); ?> TWILL Studio.
                    <a href="<?= base_url('/'); ?>" target="_blank">Kembali ke Website</a>
                </p>
            </div>
        </div>
    </div>

    <script>
        // Password Toggle
        const togglePassword = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('password');
        
        if (togglePassword && passwordInput) {
            togglePassword.addEventListener('click', function() {
                const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInput.setAttribute('type', type);
                
                this.innerHTML = type === 'password' 
                    ? `<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                       </svg>`
                    : `<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                       </svg>`;
            });
        }

        // Form Loading State
        const loginForm = document.getElementById('loginForm');
        const submitBtn = document.getElementById('submitBtn');
        
        if (loginForm && submitBtn) {
            loginForm.addEventListener('submit', function() {
                submitBtn.classList.add('loading');
                submitBtn.disabled = true;
            });
        }

        // Auto Focus
        const usernameInput = document.getElementById('username');
        if (usernameInput && !usernameInput.value) {
            usernameInput.focus();
        }
    </script>
</body>
</html>