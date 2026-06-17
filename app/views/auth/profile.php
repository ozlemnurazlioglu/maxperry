<div class="container" style="max-width: 600px; padding: 60px 20px;">
    <div style="background-color: var(--bg-white); border: 1px solid var(--border-color); padding: 40px; box-shadow: var(--shadow-soft); text-align: center; border-radius: 4px;">
        <div style="width: 80px; height: 80px; background-color: var(--bg-light); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px auto; border: 1px solid var(--border-color);">
            <i class="fa-regular fa-user" style="font-size: 32px; color: var(--primary);"></i>
        </div>
        
        <h1 style="font-size: 24px; color: var(--text-dark); margin-bottom: 5px;"><?php echo htmlspecialchars($user['name']); ?></h1>
        <p style="color: var(--text-muted); font-size: 13px; margin-bottom: 30px;"><code><?php echo htmlspecialchars($user['email']); ?></code></p>
        
        <div style="background-color: rgba(220, 161, 145, 0.1); border: 1px solid rgba(220, 161, 145, 0.2); padding: 20px; border-radius: 4px; margin-bottom: 30px;">
            <p style="font-size: 13px; color: var(--text-dark); line-height: 1.6;">
                <strong>MaxPerry Müşteri Hesabınıza Hoş Geldiniz.</strong><br>
                Ayrıcalıklı koleksiyonlarımızı incelemeye başlayabilir, dilediğiniz tasarım için randevu oluşturabilirsiniz.
            </p>
        </div>

        <div style="display: flex; gap: 15px; justify-content: center;">
            <a href="<?php echo BASE_URL; ?>/products" class="btn btn-rose" style="font-size: 11px; padding: 12px 25px;"><i class="fa-solid fa-shirt" style="margin-right: 8px;"></i> Koleksiyonları İncele</a>
            <a href="<?php echo BASE_URL; ?>/logout" class="btn btn-secondary" style="font-size: 11px; padding: 12px 25px;"><i class="fa-solid fa-arrow-right-from-bracket" style="margin-right: 8px;"></i> Çıkış Yap</a>
        </div>
    </div>
</div>
