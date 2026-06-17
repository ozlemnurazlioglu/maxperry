<div class="admin-dashboard">
    
    <!-- Admin Left Sidebar Menu -->
    <aside class="admin-sidebar">
        <div style="text-align: center; margin-bottom: 30px;">
            <i class="fa-solid fa-crown" style="font-size: 32px; color: var(--primary); margin-bottom: 10px;"></i>
            <h4 style="font-size: 14px; text-transform: uppercase; letter-spacing: 1px;">Yönetim Paneli</h4>
            <p style="font-size: 10px; color: var(--text-muted); margin-top: 3px;">Hoş geldiniz, Admin</p>
        </div>

        <div class="admin-menu-title">Mağaza Yönetimi</div>
        <div class="admin-menu-list" style="margin-bottom: 25px;">
            <a href="<?php echo BASE_URL; ?>/admin" class="admin-menu-link active"><i class="fa-solid fa-gauge" style="margin-right: 8px;"></i> Genel Bakış</a>
            <a href="<?php echo BASE_URL; ?>/admin/products" class="admin-menu-link"><i class="fa-solid fa-shirt" style="margin-right: 8px;"></i> Ürün Yönetimi</a>
            <a href="<?php echo BASE_URL; ?>/admin/categories" class="admin-menu-link"><i class="fa-solid fa-tags" style="margin-right: 8px;"></i> Kategori Yönetimi</a>
            <a href="<?php echo BASE_URL; ?>/admin/users" class="admin-menu-link"><i class="fa-solid fa-users" style="margin-right: 8px;"></i> Kullanıcı Yönetimi</a>
            <a href="<?php echo BASE_URL; ?>/admin/messages" class="admin-menu-link"><i class="fa-solid fa-envelope" style="margin-right: 8px;"></i> Gelen Mesajlar</a>
        </div>

        <div class="admin-menu-title">Mağazaya Dön</div>
        <div class="admin-menu-list">
            <a href="<?php echo BASE_URL; ?>/" class="admin-menu-link"><i class="fa-solid fa-house" style="margin-right: 8px;"></i> Mağaza Ön Sayfa</a>
        </div>
    </aside>

    <!-- Admin Dashboard Main Content -->
    <main class="admin-content">
        <div class="admin-header-row">
            <h1 style="font-size: 28px; color: var(--text-dark);">Genel Bakış</h1>
            <p style="font-size: 12px; color: var(--text-muted);"><?php echo date('d F Y'); ?></p>
        </div>

        <!-- Metric Stat Cards -->
        <div class="admin-card-row" style="grid-template-columns: 1fr;">
            <div class="admin-stat-card" style="max-width: 300px; margin: 0 auto;">
                <h3><?php echo $totalProducts; ?></h3>
                <p>Toplam Ürün</p>
            </div>
        </div>

        <div style="background-color: var(--bg-white); border: 1px solid var(--border-color); padding: 40px; box-shadow: var(--shadow-soft); margin-top: 30px; text-align: center;">
            <i class="fa-solid fa-gem" style="font-size: 48px; color: var(--primary); margin-bottom: 20px;"></i>
            <h2 style="font-family: var(--font-heading); font-size: 22px; color: var(--text-dark); margin-bottom: 10px;">MaxPerry Yönetim Paneline Hoş Geldiniz</h2>
            <p style="font-size: 13px; color: var(--text-muted); max-width: 600px; margin: 0 auto; line-height: 1.6;">
                Bu panelden ürün kataloğunuzu, kategorilerinizi, kayıtlı kullanıcılarınızı ve e-posta bülten abonelerinizi kolayca yönetebilir; bülten abonelerine özel kampanya mailleri gönderebilirsiniz.
            </p>
        </div>
    </main>

</div>
