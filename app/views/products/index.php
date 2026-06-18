<!-- Page Header & Breadcrumb -->
<div style="background-color: var(--bg-white); border: 1px solid var(--border-color); padding: 40px 0; text-align: center; margin-bottom: 40px; box-shadow: var(--shadow-soft);">
    <div class="container">
        <h1 style="font-size: 36px; color: var(--text-dark); margin-bottom: 10px;">
            <?php echo isset($activeCategory) ? htmlspecialchars($activeCategory['name']) : 'Tüm Koleksiyonlar'; ?>
        </h1>
        <p style="font-size: 13px; color: var(--text-muted); letter-spacing: 1px;">
            <a href="<?php echo BASE_URL; ?>/">Ana Sayfa</a> 
            <i class="fa-solid fa-chevron-right" style="font-size: 9px; margin: 0 10px; color: var(--primary);"></i> 
            <?php if (isset($activeCategory)): ?>
                <a href="<?php echo BASE_URL; ?>/products">Koleksiyonlar</a>
                <i class="fa-solid fa-chevron-right" style="font-size: 9px; margin: 0 10px; color: var(--primary);"></i>
                <span><?php echo htmlspecialchars($activeCategory['name']); ?></span>
            <?php else: ?>
                <span>Koleksiyonlar</span>
            <?php endif; ?>
        </p>
    </div>
</div>

<div class="container products-layout-container" style="margin-bottom: 60px;">
    
    <!-- Left Sidebar: Category Filters -->
    <aside class="products-sidebar">
        <h3 class="products-sidebar-title">Kategoriler</h3>
        <ul class="products-sidebar-list">
            <li>
                <a href="<?php echo BASE_URL; ?>/products" style="font-size: 13px; font-weight: <?php echo !isset($activeCategory) ? '600; color: var(--primary);' : '500;'; ?>">
                    Tüm Koleksiyonlar
                </a>
            </li>
            <?php if (isset($categories)): ?>
                <?php foreach ($categories as $cat): ?>
                    <li>
                        <a href="<?php echo BASE_URL; ?>/category/<?php echo htmlspecialchars($cat['slug']); ?>" 
                           style="font-size: 13px; font-weight: <?php echo (isset($activeCategory) && $activeCategory['id'] == $cat['id']) ? '600; color: var(--primary);' : '500;'; ?>">
                            <?php echo htmlspecialchars($cat['name']); ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            <?php endif; ?>
        </ul>
    </aside>

    <!-- Main Section: Products Grid -->
    <main>
        
        <!-- Product Sorting & Counter Header (Visual matching user screenshot) -->
        <div style="display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid var(--border-color); padding-bottom: 15px; margin-bottom: 25px; flex-wrap: wrap; gap: 15px;">
            <div style="font-size: 14px; font-weight: 500; color: var(--text-dark);">
                Toplam <span style="font-weight: bold; color: var(--primary-hover);"><?php echo count($products); ?></span> ürün listeleniyor
            </div>
        </div>
        
        <div class="products-grid" style="grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));">
            <?php if (isset($products) && !empty($products)): ?>
                <?php foreach ($products as $prod): 
                    // High-fashion fallback mappings for visual perfection
                    $imgSrc = BASE_URL . '/public/assets/images/' . $prod['image_url'];
                    $isPlaceholder = false;

                    if ($prod['image_url'] === 'zumrut-saten.jpg') {
                        $imgSrc = 'https://images.unsplash.com/photo-1595777457583-95e059d581b8?auto=format&fit=crop&q=80&w=600';
                    } elseif ($prod['image_url'] === 'rose-gold-saten.jpg') {
                        $imgSrc = 'https://images.unsplash.com/photo-1572804013309-59a88b7e92f1?auto=format&fit=crop&q=80&w=600';
                    } elseif ($prod['image_url'] === 'gumus-payetli.jpg') {
                        $imgSrc = 'https://images.unsplash.com/photo-1515886657613-9f3515b0c78f?auto=format&fit=crop&q=80&w=600';
                    } elseif ($prod['image_url'] === 'siyah-payetli.jpg') {
                        $imgSrc = 'https://images.unsplash.com/photo-1539008885868-47a40df6ee5f?auto=format&fit=crop&q=80&w=600';
                    } elseif ($prod['image_url'] === 'pudra-dantel.jpg') {
                        $imgSrc = 'https://images.unsplash.com/photo-1496747611176-843222e1e57c?auto=format&fit=crop&q=80&w=600';
                    } elseif ($prod['image_url'] === 'ekru-helen.jpg') {
                        $imgSrc = 'https://images.unsplash.com/photo-1594552072238-b8a33785b261?auto=format&fit=crop&q=80&w=600';
                    } elseif ($prod['image_url'] === 'mavi-kadife.jpg') {
                        $imgSrc = 'https://images.unsplash.com/photo-1568252542512-9fe8fe9c87bb?auto=format&fit=crop&q=80&w=600';
                    } else {
                        $isPlaceholder = true;
                    }
                ?>
                    <div class="product-card">
                        <!-- Product Image (Clickable Link) -->
                        <a href="<?php echo BASE_URL; ?>/product/<?php echo htmlspecialchars($prod['slug']); ?>" style="display: block;">
                            <div class="product-image">
                                <?php if ($isPlaceholder): ?>
                                    <div class="image-placeholder">
                                        <span style="font-size: 14px; margin-top: 10px;"><?php echo htmlspecialchars($prod['name']); ?></span>
                                    </div>
                                <?php else: ?>
                                    <img src="<?php echo $imgSrc; ?>" alt="<?php echo htmlspecialchars($prod['name']); ?>" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                                    <div class="image-placeholder" style="display: none;">
                                        <span style="font-size: 14px; margin-top: 10px;"><?php echo htmlspecialchars($prod['name']); ?></span>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </a>

                        <div class="product-info">
                            <p class="product-category">
                                <?php echo htmlspecialchars($prod['category_name']); ?> 
                            </p>
                            <h3 class="product-title">
                                <a href="<?php echo BASE_URL; ?>/product/<?php echo htmlspecialchars($prod['slug']); ?>">
                                    <?php echo htmlspecialchars($prod['name']); ?>
                                </a>
                            </h3>
                            
                            <div class="product-action" style="margin-top: 15px;">
                                <a href="<?php echo BASE_URL; ?>/product/<?php echo htmlspecialchars($prod['slug']); ?>" class="btn btn-rose" style="width: 100%; text-align: center; padding: 10px; font-size: 11px; font-weight: bold;">DETAYLARI İNCELE</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div style="text-align: center; padding: 40px; border: 1px solid var(--border-color); background-color: var(--bg-white); grid-column: 1/-1;">
                    <i class="fa-solid fa-dress" style="font-size: 48px; color: var(--primary); margin-bottom: 15px;"></i>
                    <p style="color: var(--text-muted); font-size: 14px;">Bu kategoride henüz sergilenecek bir ürün bulunmuyor.</p>
                </div>
            <?php endif; ?>
        </div>
    </main>
</div>
