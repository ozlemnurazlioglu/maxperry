<div class="auth-wrapper">
    <div class="auth-header">
        <h2>Şifremi Unuttum</h2>
        <p style="font-size: 11px; color: var(--text-muted); margin-top: 5px; letter-spacing: 1px;">Kayıtlı e-posta adresinizi girerek şifre sıfırlama bağlantısı talep edin.</p>
    </div>

    <form action="<?php echo BASE_URL; ?>/forgot-password/submit" method="POST">
        <!-- Email Input -->
        <div class="form-group" style="margin-bottom: 25px;">
            <label for="email">E-Posta Adresi</label>
            <input type="email" id="email" name="email" class="form-control" placeholder="ornek@alan.com" required>
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-rose" style="width: 100%; padding: 13px; font-weight: bold; font-size: 12px; letter-spacing: 1px;">
            BAĞLANTI GÖNDER <i class="fa-solid fa-paper-plane" style="margin-left: 5px;"></i>
        </button>
    </form>

    <div class="auth-switch" style="margin-top: 25px; text-align: center; font-size: 11px;">
        Hatırladınız mı? <a href="<?php echo BASE_URL; ?>/login" style="color: var(--primary); font-weight: bold; text-decoration: underline;">Giriş Yapın</a>
    </div>
</div>
