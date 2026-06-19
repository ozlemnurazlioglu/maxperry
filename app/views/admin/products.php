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
            <a href="<?php echo BASE_URL; ?>/admin/products" class="admin-menu-link active"><i class="fa-solid fa-shirt" style="margin-right: 8px;"></i> Ürün Yönetimi</a>
            <a href="<?php echo BASE_URL; ?>/admin/categories" class="admin-menu-link"><i class="fa-solid fa-tags" style="margin-right: 8px;"></i> Kategori Yönetimi</a>
            <a href="<?php echo BASE_URL; ?>/admin/users" class="admin-menu-link"><i class="fa-solid fa-users" style="margin-right: 8px;"></i> Kullanıcı Yönetimi</a>
            <a href="<?php echo BASE_URL; ?>/admin/messages" class="admin-menu-link"><i class="fa-solid fa-envelope" style="margin-right: 8px;"></i> Gelen Mesajlar</a>
        </div>

        <div class="admin-menu-title">Mağazaya Dön</div>
        <div class="admin-menu-list">
            <a href="<?php echo BASE_URL; ?>/" class="admin-menu-link"><i class="fa-solid fa-house" style="margin-right: 8px;"></i> Mağaza Ön Sayfa</a>
        </div>
    </aside>

    <!-- Admin Products Content -->
    <main class="admin-content">
        <div class="admin-header-row">
            <h1 style="font-size: 28px; color: var(--text-dark);">Ürün Kataloğu Yönetimi</h1>
            <a href="<?php echo BASE_URL; ?>/admin/product/add" class="btn btn-rose" style="font-size: 11px; padding: 10px 20px;"><i class="fa-solid fa-plus"></i> Yeni Ürün Ekle</a>
        </div>

        <div style="background-color: var(--bg-white); border: 1px solid var(--border-color); padding: 25px; box-shadow: var(--shadow-soft);">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th style="width: 80px;">Görsel</th>
                        <th>Ürün Adı</th>
                        <th style="text-align: center;">İşlemler</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($products)): ?>
                        <tr>
                            <td colspan="3" style="text-align: center; padding: 30px; color: var(--text-muted); Katalogda henüz ürün bulunmuyor.</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($products as $prod): 
                            // Extract first image in case of multiple uploaded lookbook images
                            $images = explode(',', $prod['image_url']);
                            $firstImage = trim($images[0] ?? 'default-dress.jpg');
                            
                            // Determine high-fashion image mapping
                            $imgSrc = BASE_URL . '/public/assets/images/' . $firstImage;
                            
                            if ($firstImage === 'zumrut-saten.jpg') {
                                $imgSrc = 'https://images.unsplash.com/photo-1595777457583-95e059d581b8?auto=format&fit=crop&q=80&w=150';
                            } elseif ($firstImage === 'rose-gold-saten.jpg') {
                                $imgSrc = 'https://images.unsplash.com/photo-1572804013309-59a88b7e92f1?auto=format&fit=crop&q=80&w=150';
                            } elseif ($firstImage === 'gumus-payetli.jpg') {
                                $imgSrc = 'https://images.unsplash.com/photo-1515886657613-9f3515b0c78f?auto=format&fit=crop&q=80&w=150';
                            } elseif ($firstImage === 'siyah-payetli.jpg') {
                                $imgSrc = 'https://images.unsplash.com/photo-1539008885868-47a40df6ee5f?auto=format&fit=crop&q=80&w=150';
                            } elseif ($firstImage === 'pudra-dantel.jpg') {
                                $imgSrc = 'https://images.unsplash.com/photo-1496747611176-843222e1e57c?auto=format&fit=crop&q=80&w=150';
                            } elseif ($firstImage === 'ekru-helen.jpg') {
                                $imgSrc = 'https://images.unsplash.com/photo-1594552072238-b8a33785b261?auto=format&fit=crop&q=80&w=150';
                            } elseif ($firstImage === 'mavi-kadife.jpg') {
                                $imgSrc = 'https://images.unsplash.com/photo-1568252542512-9fe8fe9c87bb?auto=format&fit=crop&q=80&w=150';
                            }
                        ?>
                            <tr>
                                <td>
                                    <img src="<?php echo $imgSrc; ?>" alt="<?php echo htmlspecialchars($prod['name']); ?>" style="width: 45px; height: 60px; object-fit: cover; border: 1px solid var(--border-color);" onerror="this.src='https://placehold.co/45x60/faf3f0/2c2c2c?text=Dress';">
                                </td>
                                <td>
                                    <strong><?php echo htmlspecialchars($prod['name']); ?></strong><br>
                                    <span style="font-size: 11px; color: var(--text-muted);"><?php echo htmlspecialchars($prod['slug']); ?></span>
                                </td>
                                <td style="text-align: center;">
                                    <a href="<?php echo BASE_URL; ?>/admin/product/edit/<?php echo $prod['id']; ?>" 
                                       style="color: var(--primary-hover); font-size: 14px; margin-right: 15px;" 
                                       title="Düzenle">
                                        <i class="fa-regular fa-pen-to-square"></i>
                                    </a>
                                    <a href="<?php echo BASE_URL; ?>/admin/product/delete/<?php echo $prod['id']; ?>" 
                                       onclick="return confirm('\'<?php echo htmlspecialchars($prod['name']); ?>\' ürününü silmek istediğinize emin misiniz? Bu işlem geri alınamaz!');" 
                                       style="color: var(--error); font-size: 14px;" 
                                       title="Katalogdan Sil">
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
