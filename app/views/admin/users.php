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
            <a href="<?php echo BASE_URL; ?>/admin/users" class="admin-menu-link active"><i class="fa-solid fa-users" style="margin-right: 8px;"></i> Kullanıcı Yönetimi</a>
            <a href="<?php echo BASE_URL; ?>/admin/messages" class="admin-menu-link"><i class="fa-solid fa-envelope" style="margin-right: 8px;"></i> Gelen Mesajlar</a>
        </div>

        <div class="admin-menu-title">Mağazaya Dön</div>
        <div class="admin-menu-list">
            <a href="<?php echo BASE_URL; ?>/" class="admin-menu-link"><i class="fa-solid fa-house" style="margin-right: 8px;"></i> Mağaza Ön Sayfa</a>
        </div>
    </aside>

    <!-- Admin Users Content -->
    <main class="admin-content">
        <div class="admin-header-row">
            <h1 style="font-size: 28px; color: var(--text-dark);">Kayıtlı Kullanıcı Listesi</h1>
            <p style="font-size: 12px; color: var(--text-muted);">Sitenize kayıt olmuş tüm üyelerin bilgilerini izleyin.</p>
        </div>

        <div style="background-color: var(--bg-white); border: 1px solid var(--border-color); padding: 25px; box-shadow: var(--shadow-soft);">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th style="width: 60px;">ID</th>
                        <th>Ad Soyad</th>
                        <th>E-Posta Adresi</th>
                        <th>Kullanıcı Rolü</th>
                        <th>Kayıt Tarihi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($users)): ?>
                        <tr>
                            <td colspan="5" style="text-align: center; padding: 30px; color: var(--text-muted);">Sistemde kayıtlı kullanıcı bulunmuyor.</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($users as $user): 
                            // Determine role badge style
                            $roleText = 'Müşteri';
                            $roleStyle = 'background-color: #ebf5fb; color: #2e86c1;'; // Light blue for customer
                            
                            if ($user['role'] === 'admin') {
                                $roleText = 'Yönetici';
                                $roleStyle = 'background-color: rgba(220, 161, 145, 0.15); color: var(--primary-hover); border: 1px solid rgba(220, 161, 145, 0.3);'; // Premium rose for admin
                            }
                        ?>
                            <tr>
                                <td><strong>#<?php echo $user['id']; ?></strong></td>
                                <td><strong><?php echo htmlspecialchars($user['name']); ?></strong></td>
                                <td><code><?php echo htmlspecialchars($user['email']); ?></code></td>
                                <td>
                                    <span class="stock-badge" style="<?php echo $roleStyle; ?> font-size: 11px; padding: 4px 10px; font-weight: 600;">
                                        <?php echo $roleText; ?>
                                    </span>
                                </td>
                                <td style="color: var(--text-muted); font-size: 12px;"><?php echo date('d.m.Y H:i', strtotime($user['created_at'])); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </main>

</div>
