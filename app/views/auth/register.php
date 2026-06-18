<div class="auth-wrapper">
    <div class="auth-header">
        <h2>Kayıt Ol</h2>
        <p style="font-size: 11px; color: var(--text-muted); margin-top: 5px; letter-spacing: 1px;">MaxPerry ayrıcalıklarını keşfetmek için hesap oluşturun.</p>
    </div>

    <form action="<?php echo BASE_URL; ?>/register/submit" method="POST">
        <!-- CSRF Token -->
        <input type="hidden" name="csrf_token" value="<?php echo generateCsrfToken(); ?>">
        <!-- Name Input -->
        <div class="form-group">
            <label for="name">Ad Soyad</label>
            <input type="text" id="name" name="name" class="form-control" placeholder="Örn: Ayşe Yılmaz" required>
        </div>

        <!-- Email Input -->
        <div class="form-group">
            <label for="email">E-Posta Adresi</label>
            <input type="email" id="email" name="email" class="form-control" placeholder="ornek@alan.com" required>
        </div>

        <!-- Password Input -->
        <div class="form-group" style="margin-bottom: 25px;">
            <label for="password">Şifre</label>
            <input type="password" id="password" name="password" class="form-control" placeholder="••••••••" required>
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-rose" style="width: 100%; padding: 13px; font-weight: bold; font-size: 12px; letter-spacing: 1px;">
            HESAP OLUŞTUR <i class="fa-solid fa-arrow-right" style="margin-left: 5px;"></i>
        </button>
    </form>

    <div class="auth-switch" style="margin-top: 25px; text-align: center; font-size: 11px;">
        Zaten bir hesabınız var mı? <a href="<?php echo BASE_URL; ?>/login" style="color: var(--primary); font-weight: bold; text-decoration: underline;">Giriş Yapın</a>
    </div>
</div>
