<div class="auth-wrapper">
    <div class="auth-header">
        <h2>Yeni Şifre Belirleyin</h2>
        <p style="font-size: 11px; color: var(--text-muted); margin-top: 5px; letter-spacing: 1px;">Lütfen yeni, güvenli ve akılda kalıcı bir şifre girin.</p>
    </div>

    <form action="<?php echo BASE_URL; ?>/reset-password/submit" method="POST">
        <input type="hidden" name="token" value="<?php echo htmlspecialchars($token); ?>">

        <!-- Password Input -->
        <div class="form-group" style="margin-bottom: 25px;">
            <label for="password">Yeni Şifre</label>
            <input type="password" id="password" name="password" class="form-control" placeholder="••••••••" required>
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-rose" style="width: 100%; padding: 13px; font-weight: bold; font-size: 12px; letter-spacing: 1px;">
            ŞİFREYİ GÜNCELLE <i class="fa-solid fa-circle-check" style="margin-left: 5px;"></i>
        </button>
    </form>
</div>
