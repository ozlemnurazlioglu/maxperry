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
            <a href="<?php echo BASE_URL; ?>/admin/messages" class="admin-menu-link"><i class="fa-solid fa-envelope" style="margin-right: 8px;"></i> Gelen Mesajlar</a>
        </div>

        <div class="admin-menu-title">Mağazaya Dön</div>
        <div class="admin-menu-list">
            <a href="<?php echo BASE_URL; ?>/" class="admin-menu-link"><i class="fa-solid fa-house" style="margin-right: 8px;"></i> Mağaza Ön Sayfa</a>
        </div>
    </aside>

    <!-- Admin Categories Content -->
    <main class="admin-content">
        <div class="admin-header-row">
            <h1 style="font-size: 28px; color: var(--text-dark);">Kategori Yönetimi</h1>
            <a href="<?php echo BASE_URL; ?>/admin/category/add" class="btn btn-rose" style="font-size: 11px; padding: 10px 20px;"><i class="fa-solid fa-plus"></i> Yeni Kategori Ekle</a>
        </div>

        <div style="background-color: var(--bg-white); border: 1px solid var(--border-color); padding: 25px; box-shadow: var(--shadow-soft);">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th style="width: 60px;">ID</th>
                        <th>Kategori Adı</th>
                        <th>Açıklama</th>
                        <th>Slug (URL)</th>
                        <th style="text-align: center; width: 150px;">İşlemler</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($categories)): ?>
                        <tr>
                            <td colspan="5" style="text-align: center; padding: 30px; color: var(--text-muted);">Sistemde kayıtlı kategori bulunmuyor.</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($categories as $cat): ?>
                            <tr>
                                <td><strong>#<?php echo $cat['id']; ?></strong></td>
                                <td><strong><?php echo htmlspecialchars($cat['name']); ?></strong></td>
                                <td style="color: var(--text-muted); font-size: 12px;"><?php echo htmlspecialchars($cat['description'] ?? 'Açıklama belirtilmemiş.'); ?></td>
                                <td><code><?php echo htmlspecialchars($cat['slug']); ?></code></td>
                                <td style="text-align: center;">
                                    <a href="<?php echo BASE_URL; ?>/admin/category/edit/<?php echo $cat['id']; ?>" 
                                       style="color: var(--primary-hover); font-size: 14px; margin-right: 15px;" 
                                       title="Düzenle">
                                        <i class="fa-regular fa-pen-to-square"></i>
                                    </a>
                                    <a href="<?php echo BASE_URL; ?>/admin/category/delete/<?php echo $cat['id']; ?>" 
                                       onclick="return confirm('\'<?php echo htmlspecialchars($cat['name']); ?>\' kategorisini silmek istediğinize emin misiniz? Bu kategori altındaki tüm ürünler de silinebilir!');" 
                                       style="color: var(--error); font-size: 14px;" 
                                       title="Kategoriyi Sil">
                                        <i class="fa-regular fa-trash-can"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </main>

</div>
