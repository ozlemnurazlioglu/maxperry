<?php
// Split multiple images if comma-separated
$imageFiles = explode(',', $product['image_url']);
?>

<div class="container" style="max-width: 700px; padding: 0 15px; margin: 0 auto;">
    <!-- Breadcrumb or Return Link -->
    <div style="margin: 20px 0 30px 0; font-size: 11px; color: var(--text-muted); letter-spacing: 0.5px; text-align: center;">
        <a href="<?php echo BASE_URL; ?>/">Ana Sayfa</a>
        <i class="fa-solid fa-chevron-right" style="font-size: 8px; margin: 0 8px; color: var(--primary);"></i>
        <a href="<?php echo BASE_URL; ?>/products">Koleksiyonlar</a>
        <i class="fa-solid fa-chevron-right" style="font-size: 8px; margin: 0 8px; color: var(--primary);"></i>
        <span style="color: var(--text-dark); font-weight: 500;"><?php echo htmlspecialchars($product['name']); ?></span>
    </div>

    <!-- Product Detail Centered Single Column Layout (Pure Visual Presentation - Just Images & Videos) -->
    <div style="background-color: var(--bg-white); border: 1px solid var(--border-color); padding: 40px; box-shadow: var(--shadow-soft); margin-bottom: 60px; display: flex; flex-direction: column; gap: 30px; border-radius: 4px;">
        
        <!-- Media Section (Images & Videos stacked perfectly in center) -->
        <div style="display: flex; flex-direction: column; gap: 30px; width: 100%;">
            
            <!-- Stack of All Product Images -->
            <?php foreach ($imageFiles as $imgFile): 
                $imgFile = trim($imgFile);
                if (empty($imgFile)) continue;
                
                // Determine high-fashion image mapping
                $imgSrc = BASE_URL . '/public/assets/images/' . $imgFile;
                $isPlaceholder = false;

                if ($imgFile === 'zumrut-saten.jpg') {
                    $imgSrc = 'https://images.unsplash.com/photo-1595777457583-95e059d581b8?auto=format&fit=crop&q=80&w=600';
                } elseif ($imgFile === 'rose-gold-saten.jpg') {
                    $imgSrc = 'https://images.unsplash.com/photo-1572804013309-59a88b7e92f1?auto=format&fit=crop&q=80&w=600';
                } elseif ($imgFile === 'gumus-payetli.jpg') {
                    $imgSrc = 'https://images.unsplash.com/photo-1515886657613-9f3515b0c78f?auto=format&fit=crop&q=80&w=600';
                } elseif ($imgFile === 'siyah-payetli.jpg') {
                    $imgSrc = 'https://images.unsplash.com/photo-1539008885868-47a40df6ee5f?auto=format&fit=crop&q=80&w=600';
                } elseif ($imgFile === 'pudra-dantel.jpg') {
                    $imgSrc = 'https://images.unsplash.com/photo-1496747611176-843222e1e57c?auto=format&fit=crop&q=80&w=600';
                } elseif ($imgFile === 'ekru-helen.jpg') {
                    $imgSrc = 'https://images.unsplash.com/photo-1594552072238-b8a33785b261?auto=format&fit=crop&q=80&w=600';
                } elseif ($imgFile === 'mavi-kadife.jpg') {
                    $imgSrc = 'https://images.unsplash.com/photo-1568252542512-9fe8fe9c87bb?auto=format&fit=crop&q=80&w=600';
                } elseif (strpos($imgFile, 'http://') === false && strpos($imgFile, 'https://') === false && !file_exists(__DIR__ . '/../../public/assets/images/' . $imgFile)) {
                    $isPlaceholder = true;
                }
            ?>
                <div class="zoom-container" style="position: relative; border: 1px solid var(--border-color); box-shadow: var(--shadow-soft); overflow: hidden; cursor: zoom-in;">
                    <?php if ($isPlaceholder): ?>
                        <div class="image-placeholder" style="height: 550px;">
                            <span style="font-size: 18px; margin-top: 15px;"><?php echo htmlspecialchars($product['name']); ?></span>
                        </div>
                    <?php else: ?>
                        <img class="zoom-image" src="<?php echo $imgSrc; ?>" alt="<?php echo htmlspecialchars($product['name']); ?>" style="width: 100%; height: auto; display: block; transition: transform 0.15s ease-out;" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                        <div class="image-placeholder" style="display: none; height: 550px;">
                            <span style="font-size: 18px; margin-top: 15px;"><?php echo htmlspecialchars($product['name']); ?></span>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>

            <!-- Autoplay Runway Video (High fashion ratio, perfectly inline stacked) -->
            <?php if (!empty($product['video_url'])): ?>
                <div style="border: 1px solid var(--border-color); box-shadow: var(--shadow-soft); background-color: var(--bg-white); padding: 15px; text-align: center;">
                    <h4 style="font-size: 11px; text-transform: uppercase; margin-bottom: 12px; color: var(--text-dark); display: flex; align-items: center; justify-content: center; gap: 8px; font-weight: bold; letter-spacing: 1.5px;">
                        <i class="fa-solid fa-clapperboard" style="color: var(--primary);"></i> PODYUM / TASARIM VİDEOSU
                    </h4>
                    
                    <div style="position: relative; width: 100%; padding-bottom: 140%; height: 0; overflow: hidden; border-radius: 2px; border: 1px solid var(--border-color);">
                        <?php 
                        $vUrl = $product['video_url'];
                        $isLocalVideo = false;
                        
                        if (strpos($vUrl, 'http://') === false && strpos($vUrl, 'https://') === false) {
                            $vUrl = BASE_URL . '/public/assets/videos/' . $vUrl;
                            $isLocalVideo = true;
                        }
                        
                        if (!$isLocalVideo && strpos($vUrl, 'youtube.com/watch?v=') !== false) {
                            $vUrl = str_replace('watch?v=', 'embed/', $vUrl);
                        } elseif (!$isLocalVideo && strpos($vUrl, 'youtu.be/') !== false) {
                            $parts = explode('youtu.be/', $vUrl);
                            $vUrl = 'https://www.youtube.com/embed/' . end($parts);
                        }
                        
                        if (!$isLocalVideo && strpos($vUrl, 'youtube.com/embed/') !== false) {
                            $parts = explode('embed/', $vUrl);
                            $videoId = end($parts);
                            if (strpos($videoId, '?') !== false) {
                                $videoId = explode('?', $videoId)[0];
                            }
                            $vUrl = "https://www.youtube.com/embed/{$videoId}?autoplay=1&loop=1&playlist={$videoId}&mute=1&playsinline=1&controls=1";
                        }
                        
                        if (!$isLocalVideo && (strpos($vUrl, 'youtube.com/embed/') !== false || strpos($vUrl, 'player.vimeo.com') !== false)): ?>
                            <iframe src="<?php echo htmlspecialchars($vUrl); ?>" 
                                    style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; border: 0;" 
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                                    allowfullscreen>
                            </iframe>
                        <?php else: ?>
                            <video autoplay loop muted playsinline controls style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover;">
                                <source src="<?php echo htmlspecialchars($vUrl); ?>" type="video/mp4">
                                Tarayıcınız video oynatmayı desteklemiyor.
                            </video>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>

    </div>
</div>

<!-- High-Fidelity Hover Zoom Magnifier Script -->
<script>
document.querySelectorAll('.zoom-container').forEach(container => {
    const img = container.querySelector('.zoom-image');
    if (!img) return;

    // Use passive listener option where appropriate or prevent defaults if dragging
    container.addEventListener('mousemove', e => {
        const rect = container.getBoundingClientRect();
        
        // Calculate pointer X/Y coordinates relative to container
        const x = e.clientX - rect.left;
        const y = e.clientY - rect.top;
        
        // Convert to percentage values
        const xPercent = (x / rect.width) * 100;
        const yPercent = (y / rect.height) * 100;
        
        // Dynamically adjust transform-origin and scale up
        img.style.transformOrigin = `${xPercent}% ${yPercent}%`;
        img.style.transform = 'scale(1.8)';
    });

    container.addEventListener('mouseleave', () => {
        // Reset origin and scale slowly/smoothly
        img.style.transformOrigin = 'center center';
        img.style.transform = 'scale(1)';
    });
});
</script>
