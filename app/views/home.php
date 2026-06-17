<!-- Hero Banner -->
<section class="hero">
    <div class="hero-content">
        <p>MaxPerry'nin ince dikiş sanatı ve lüks kumaşlarla hazırlanan yeni sezon abiye koleksiyonunu keşfedin.</p>
        <a href="<?php echo BASE_URL; ?>/products" class="btn">Koleksiyonu Keşfet</a>
    </div>
</section>

<!-- Categories Section -->
<section>
    <div class="categories-grid">
        <?php if (isset($categories) && !empty($categories)): ?>
            <?php foreach ($categories as $cat): ?>
                <div class="category-card">
                    <h3><?php echo htmlspecialchars($cat['name']); ?></h3>
                    <p><?php echo htmlspecialchars($cat['description']); ?></p>
                    <a href="<?php echo BASE_URL; ?>/category/<?php echo htmlspecialchars($cat['slug']); ?>" class="link">
                        Keşfet <i class="fa-solid fa-chevron-right" style="font-size: 9px; margin-left: 3px;"></i>
                    </a>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p style="text-align: center; color: var(--text-muted); grid-column: 1/-1;">Kategori bulunamadı.</p>
        <?php endif; ?>
    </div>
</section>

<!-- Latest / Featured Products Section -->
<section style="margin-top: 60px;">
    <div class="products-grid">
        <?php if (isset($latestProducts) && !empty($latestProducts)): ?>
            <?php foreach ($latestProducts as $prod): 
                // High fashion fallbacks for visual perfection
                $imgSrc = BASE_URL . '/public/assets/images/' . $prod['image_url'];
                $isPlaceholder = false;

                // Let's map high-fidelity Unsplash images for our seed products so they look stunning immediately!
                if ($prod['image_url'] === 'zumrut-saten.jpg') {
                    $imgSrc = 'https://images.unsplash.com/photo-1595777457583-95e059d581b8?auto=format&fit=crop&q=80&w=600'; // Elegant green dress
                } elseif ($prod['image_url'] === 'rose-gold-saten.jpg') {
                    $imgSrc = 'https://images.unsplash.com/photo-1572804013309-59a88b7e92f1?auto=format&fit=crop&q=80&w=600'; // Blush pink/gold dress
                } elseif ($prod['image_url'] === 'gumus-payetli.jpg') {
                    $imgSrc = 'https://images.unsplash.com/photo-1515886657613-9f3515b0c78f?auto=format&fit=crop&q=80&w=600'; // Silver sparkles
                } elseif ($prod['image_url'] === 'siyah-payetli.jpg') {
                    $imgSrc = 'https://images.unsplash.com/photo-1539008885868-47a40df6ee5f?auto=format&fit=crop&q=80&w=600'; // Elegant dark dress
                } elseif ($prod['image_url'] === 'pudra-dantel.jpg') {
                    $imgSrc = 'https://images.unsplash.com/photo-1496747611176-843222e1e57c?auto=format&fit=crop&q=80&w=600'; // Tulle lace pink dress
                } elseif ($prod['image_url'] === 'ekru-helen.jpg') {
                    $imgSrc = 'https://images.unsplash.com/photo-1594552072238-b8a33785b261?auto=format&fit=crop&q=80&w=600'; // Ekru dress
                } elseif ($prod['image_url'] === 'mavi-kadife.jpg') {
                    $imgSrc = 'https://images.unsplash.com/photo-1568252542512-9fe8fe9c87bb?auto=format&fit=crop&q=80&w=600'; // Blue dress
                } else {
                    // Fallback to stylized CSS placeholder if we don't have matching Unsplash and local image file doesn't exist
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

                    <!-- Product Metadata -->
                    <div class="product-info">
                        <p class="product-category"><?php echo htmlspecialchars($prod['category_name']); ?></p>
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
            <p style="text-align: center; color: var(--text-muted); grid-column: 1/-1;">Koleksiyonda henüz ürün bulunmuyor.</p>
        <?php endif; ?>
    </div>
</section>
