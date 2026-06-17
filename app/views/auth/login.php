<div class="auth-wrapper">
    <div class="auth-header">
        <h2>Giriş Yap</h2>
        <p style="font-size: 11px; color: var(--text-muted); margin-top: 5px; letter-spacing: 1px;">MaxPerry dünyasına geri adım atın.</p>
    </div>

    <form action="<?php echo BASE_URL; ?>/login/submit" method="POST">
        <!-- Email Input -->
        <div class="form-group">
            <label for="email">E-Posta Adresi</label>
            <input type="email" id="email" name="email" class="form-control" placeholder="ornek@alan.com" required>
        </div>

        <!-- Password Input -->
        <div class="form-group" style="margin-bottom: 25px;">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px;">
                <label for="password" style="margin-bottom: 0;">Şifre</label>
                <a href="<?php echo BASE_URL; ?>/forgot-password" style="font-size: 11px; color: var(--primary-hover); font-weight: 500;">Şifremi Unuttum</a>
            </div>
            <input type="password" id="password" name="password" class="form-control" placeholder="••••••••" required>
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-rose" style="width: 100%; padding: 13px; font-weight: bold; font-size: 12px; letter-spacing: 1px;">
            GİRİŞ YAP <i class="fa-solid fa-arrow-right" style="margin-left: 5px;"></i>
        </button>
    </form>

    <div class="auth-switch" style="margin-top: 25px; text-align: center; font-size: 11px;">
        Hesabınız yok mu? <a href="<?php echo BASE_URL; ?>/register" style="color: var(--primary); font-weight: bold; text-decoration: underline;">Hemen Kayıt Olun</a>
    </div>
</div>
