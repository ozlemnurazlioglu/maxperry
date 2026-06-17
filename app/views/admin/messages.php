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
            <a href="<?php echo BASE_URL; ?>/admin/categories" class="admin-menu-link"><i class="fa-solid fa-tags" style="margin-right: 8px;"></i> Kategori Yönetimi</a>
            <a href="<?php echo BASE_URL; ?>/admin/users" class="admin-menu-link"><i class="fa-solid fa-users" style="margin-right: 8px;"></i> Kullanıcı Yönetimi</a>
            <a href="<?php echo BASE_URL; ?>/admin/messages" class="admin-menu-link active"><i class="fa-solid fa-envelope" style="margin-right: 8px;"></i> Gelen Mesajlar</a>
        </div>

        <div class="admin-menu-title">Mağazaya Dön</div>
        <div class="admin-menu-list">
            <a href="<?php echo BASE_URL; ?>/" class="admin-menu-link"><i class="fa-solid fa-house" style="margin-right: 8px;"></i> Mağaza Ön Sayfa</a>
        </div>
    </aside>

    <!-- Admin Messages Content -->
    <main class="admin-content">
        <div class="admin-header-row">
            <h1 style="font-size: 28px; color: var(--text-dark);">Gelen İletişim Mesajları</h1>
        </div>

        <div style="background-color: var(--bg-white); border: 1px solid var(--border-color); padding: 25px; box-shadow: var(--shadow-soft); border-radius: 4px;">
            <?php if (empty($messages)): ?>
                <p style="text-align: center; color: var(--text-muted); padding: 40px 0; font-size: 13px;">Gelen kutunuzda henüz bir mesaj bulunmuyor.</p>
            <?php else: ?>
                <div style="display: flex; flex-direction: column; gap: 20px;">
                    <?php foreach ($messages as $msg): ?>
                        <div style="border: 1px solid var(--border-color); border-radius: 4px; padding: 20px; background-color: var(--bg-white);">
                            <div style="display: flex; justify-content: space-between; align-items: flex-start; flex-wrap: wrap; gap: 15px; border-bottom: 1px solid var(--bg-light); padding-bottom: 12px; margin-bottom: 12px;">
                                <div>
                                    <h4 style="font-size: 14px; color: var(--text-dark); margin-bottom: 3px; font-weight: 600;"><?php echo htmlspecialchars($msg['name']); ?></h4>
                                    <span style="font-size: 11px; color: var(--text-muted); display: block;">
                                        <i class="fa-regular fa-envelope" style="margin-right: 5px;"></i> <?php echo htmlspecialchars($msg['email']); ?>
                                        <?php if (!empty($msg['phone'])): ?>
                                            &nbsp;|&nbsp; <i class="fa-solid fa-phone" style="margin-right: 5px;"></i> <?php echo htmlspecialchars($msg['phone']); ?>
                                        <?php endif; ?>
                                    </span>
                                </div>
                                <div style="display: flex; align-items: center; gap: 15px;">
                                    <span style="font-size: 11px; color: var(--text-muted);"><?php echo date('d.m.Y H:i', strtotime($msg['created_at'])); ?></span>
                                    <a href="<?php echo BASE_URL; ?>/admin/messages/delete/<?php echo $msg['id']; ?>" 
                                       onclick="return confirm('Bu mesajı silmek istediğinize emin misiniz?');" 
                                       style="color: var(--error); font-size: 13px; text-decoration: none;" 
                                       title="Mesajı Sil">
                                        <i class="fa-regular fa-trash-can" style="margin-right: 5px;"></i> Sil
                                    </a>
                                </div>
                            </div>
                            <p style="font-size: 13px; color: var(--text-dark); line-height: 1.6; white-space: pre-wrap;"><?php echo htmlspecialchars($msg['message']); ?></p>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </main>

</div>
