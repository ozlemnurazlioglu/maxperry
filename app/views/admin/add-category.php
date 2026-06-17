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
            <a href="<?php echo BASE_URL; ?>/admin" class="admin-menu-link"><i class="fa-solid fa-gauge" style="margin-right: 8px;"></i> Genel Bakış</a>
            <a href="<?php echo BASE_URL; ?>/admin/products" class="admin-menu-link"><i class="fa-solid fa-shirt" style="margin-right: 8px;"></i> Ürün Yönetimi</a>
            <a href="<?php echo BASE_URL; ?>/admin/categories" class="admin-menu-link active"><i class="fa-solid fa-tags" style="margin-right: 8px;"></i> Kategori Yönetimi</a>
            <a href="<?php echo BASE_URL; ?>/admin/users" class="admin-menu-link"><i class="fa-solid fa-users" style="margin-right: 8px;"></i> Kullanıcı Yönetimi</a>
        </div>

        <div class="admin-menu-title">Mağazaya Dön</div>
        <div class="admin-menu-list">
            <a href="<?php echo BASE_URL; ?>/" class="admin-menu-link"><i class="fa-solid fa-house" style="margin-right: 8px;"></i> Mağaza Ön Sayfa</a>
        </div>
    </aside>

    <!-- Add Category Main Content -->
    <main class="admin-content" style="max-width: 600px;">
        <div class="admin-header-row">
            <h1 style="font-size: 28px; color: var(--text-dark);">Yeni Kategori Ekle</h1>
            <a href="<?php echo BASE_URL; ?>/admin/categories" class="btn btn-secondary" style="font-size: 11px; padding: 10px 15px;"><i class="fa-solid fa-chevron-left"></i> Vazgeç</a>
        </div>

        <div style="background-color: var(--bg-white); border: 1px solid var(--border-color); padding: 35px; box-shadow: var(--shadow-soft);">
            <form action="<?php echo BASE_URL; ?>/admin/category/add/submit" method="POST">
                
                <!-- Category Name -->
                <div class="form-group">
                    <label for="name">Kategori Adı <span style="color: var(--error);">*</span></label>
                    <input type="text" id="name" name="name" class="form-control" placeholder="Örn: Balık Gelinlik & Nikah Abiyeleri" style="background-color: var(--bg-white);" required>
                </div>

                <!-- Description -->
                <div class="form-group" style="margin-bottom: 30px;">
                    <label for="description">Kategori Açıklaması</label>
                    <textarea id="description" name="description" rows="4" class="form-control" placeholder="Bu kategori altındaki tasarımların genel özellikleri..." style="resize: none; background-color: var(--bg-white);"></textarea>
                </div>

                <!-- Save Button -->
                <button type="submit" class="btn btn-rose" style="width: 100%; padding: 15px; font-weight: bold; letter-spacing: 1px;">
                    KATEGORİYİ OLUŞTUR <i class="fa-solid fa-circle-check" style="margin-left: 5px;"></i>
                </button>
            </form>
        </div>
    </main>

</div>
