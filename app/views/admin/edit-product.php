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
        </div>

        <div class="admin-menu-title">Mağazaya Dön</div>
        <div class="admin-menu-list">
            <a href="<?php echo BASE_URL; ?>/" class="admin-menu-link"><i class="fa-solid fa-house" style="margin-right: 8px;"></i> Mağaza Ön Sayfa</a>
        </div>
    </aside>

    <!-- Edit Product Main Content -->
    <main class="admin-content" style="max-width: 700px;">
        <div class="admin-header-row">
            <h1 style="font-size: 28px; color: var(--text-dark);">Tasarımı Düzenle</h1>
            <a href="<?php echo BASE_URL; ?>/admin/products" class="btn btn-secondary" style="font-size: 11px; padding: 10px 15px;"><i class="fa-solid fa-chevron-left"></i> Vazgeç</a>
        </div>

        <div style="background-color: var(--bg-white); border: 1px solid var(--border-color); padding: 35px; box-shadow: var(--shadow-soft); border-radius: 4px;">
            <form action="<?php echo BASE_URL; ?>/admin/product/edit/<?php echo $product['id']; ?>/submit" method="POST" enctype="multipart/form-data">
                <!-- CSRF Token -->
                <input type="hidden" name="csrf_token" value="<?php echo generateCsrfToken(); ?>">
                
                <!-- Product Name -->
                <div class="form-group">
                    <label for="name">Tasarım / Ürün Adı <span style="color: var(--error);">*</span></label>
                    <input type="text" id="name" name="name" class="form-control" value="<?php echo htmlspecialchars($product['name']); ?>" style="background-color: var(--bg-white);" required>
                </div>



                <!-- Image and Product Video -->
                <div class="form-group" style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 25px;">
                    <div>
                        <label style="display:block; margin-bottom: 8px;">Ürün Görseli</label>

                        <!-- Currently Uploaded Images Grid -->
                        <div id="current-images-container" style="display: flex; flex-wrap: wrap; gap: 15px; margin-bottom: 15px; padding: 10px; border: 1px solid var(--border-color); background-color: #fcfbfb; border-radius: 4px;">
                            <?php 
                            $images = array_filter(explode(',', $product['image_url'] ?? ''));
                            if (!empty($images)):
                                foreach ($images as $img): 
                                    $img = trim($img);
                                    if (empty($img)) continue;
                                    $imgSrc = BASE_URL . '/public/assets/images/' . $img;
                                    if ($img === 'zumrut-saten.jpg') $imgSrc = 'https://images.unsplash.com/photo-1595777457583-95e059d581b8?auto=format&fit=crop&q=80&w=200';
                                    elseif ($img === 'rose-gold-saten.jpg') $imgSrc = 'https://images.unsplash.com/photo-1572804013309-59a88b7e92f1?auto=format&fit=crop&q=80&w=200';
                                    elseif ($img === 'gumus-payetli.jpg') $imgSrc = 'https://images.unsplash.com/photo-1515886657613-9f3515b0c78f?auto=format&fit=crop&q=80&w=200';
                                    elseif ($img === 'siyah-payetli.jpg') $imgSrc = 'https://images.unsplash.com/photo-1539008885868-47a40df6ee5f?auto=format&fit=crop&q=80&w=200';
                                    elseif ($img === 'pudra-dantel.jpg') $imgSrc = 'https://images.unsplash.com/photo-1496747611176-843222e1e57c?auto=format&fit=crop&q=80&w=200';
                                    elseif ($img === 'ekru-helen.jpg') $imgSrc = 'https://images.unsplash.com/photo-1594552072238-b8a33785b261?auto=format&fit=crop&q=80&w=200';
                                    elseif ($img === 'mavi-kadife.jpg') $imgSrc = 'https://images.unsplash.com/photo-1568252542512-9fe8fe9c87bb?auto=format&fit=crop&q=80&w=200';
                            ?>
                                <div class="thumb-wrapper" data-filename="<?php echo htmlspecialchars($img); ?>" style="position: relative; width: 80px; height: 80px; border: 1px solid var(--border-color); border-radius: 4px; overflow: visible;">
                                    <img src="<?php echo $imgSrc; ?>" style="width: 100%; height: 100%; object-fit: cover; border-radius: 4px;">
                                    <button type="button" class="btn-remove-thumb" onclick="deleteExistingImage('<?php echo htmlspecialchars($img); ?>')" style="position: absolute; top: -6px; right: -6px; background-color: var(--error); color: white; border: none; border-radius: 50%; width: 18px; height: 18px; display: flex; align-items: center; justify-content: center; cursor: pointer; font-size: 10px; font-weight: bold; box-shadow: 0 1px 4px rgba(0,0,0,0.2);" title="Sil">×</button>
                                </div>
                            <?php 
                                endforeach;
                            else:
                            ?>
                                <p style="font-size: 11px; color: var(--text-muted); margin: 0; padding: 5px;">Mevcut görsel bulunmuyor.</p>
                            <?php endif; ?>
                        </div>

                        <!-- Hidden Input for remaining existing images -->
                        <input type="hidden" name="existing_images" id="existing_images_input" value="<?php echo htmlspecialchars($product['image_url'] ?? ''); ?>">
                        
                        <!-- Drag and Drop Dropzone -->
                        <div id="image-dropzone" style="border: 2px dashed var(--primary); padding: 20px; text-align: center; cursor: pointer; background-color: var(--bg-light); border-radius: 4px; transition: var(--transition);">
                            <i class="fa-solid fa-cloud-arrow-up" style="font-size: 24px; color: var(--primary); margin-bottom: 8px;"></i>
                            <p id="dropzone-text" style="font-size: 11px; color: var(--text-muted); font-weight: 500;">Yeni görseller yüklemek için sürükleyin veya tıklayın</p>
                            <input type="file" id="image" name="image[]" accept="image/*" multiple style="display: none;">
                        </div>
                        
                        <!-- Fallback URL field -->
                        <div style="margin-top: 10px;">
                            <label for="image_url" style="font-size: 10px; text-transform: none; color: var(--text-muted);">Mevcut görsel adı/linki:</label>
                            <input type="text" id="image_url" name="image_url" class="form-control" value="<?php echo htmlspecialchars($product['image_url']); ?>" style="background-color: var(--bg-white); padding: 8px; font-size: 11px;">
                        </div>
                    </div>
                    <div>
                        <label style="display:block; margin-bottom: 8px;">Ürün Tanıtım Videosu</label>
                        
                        <!-- Video File Selector Box (Sürükle-Bırak & Tıkla) -->
                        <div id="video-selector-box" style="border: 2px dashed var(--primary); padding: 15px; text-align: center; cursor: pointer; background-color: var(--bg-light); border-radius: 4px; transition: var(--transition); margin-bottom: 10px;">
                            <i class="fa-solid fa-video" style="font-size: 20px; color: var(--primary); margin-bottom: 5px;"></i>
                            <p id="video-selector-text" style="font-size: 10px; color: var(--text-muted); font-weight: 500;">Yeni video yüklemek için sürükleyin veya tıklayın (Max 50MB)</p>
                            <input type="file" id="video" name="video" accept="video/*" style="display: none;">
                        </div>
                        
                        <!-- Fallback Video URL input -->
                        <div style="margin-top: 10px;">
                            <label for="video_url" style="font-size: 10px; text-transform: none; color: var(--text-muted);">Mevcut video adı/linki (YouTube / MP4):</label>
                            <input type="text" id="video_url" name="video_url" class="form-control" value="<?php echo htmlspecialchars($product['video_url'] ?? ''); ?>" placeholder="Örn: video.mp4 veya YouTube linki" style="background-color: var(--bg-white); padding: 8px; font-size: 11px;">
                        </div>
                    </div>
                </div>

                <!-- Update Button -->
                <button type="submit" class="btn btn-rose" style="width: 100%; padding: 15px; font-weight: bold; letter-spacing: 1px; margin-top: 10px;">
                    TASARIMI GÜNCELLE <i class="fa-solid fa-circle-check" style="margin-left: 5px;"></i>
                </button>
            </form>
        </div>
    </main>

</div>

<!-- Drag & Drop JS Logic -->
<script>
function deleteExistingImage(filename) {
    if (!confirm('Bu görseli silmek istediğinizden emin misiniz?')) {
        return;
    }
    const wrapper = document.querySelector(`.thumb-wrapper[data-filename="${filename}"]`);
    if (wrapper) {
        wrapper.remove();
    }
    
    // Update hidden field value
    const input = document.getElementById('existing_images_input');
    let images = input.value.split(',').map(s => s.trim()).filter(Boolean);
    images = images.filter(img => img !== filename);
    input.value = images.join(',');
    
    // Show placeholder if no images are left
    const container = document.getElementById('current-images-container');
    if (images.length === 0) {
        container.innerHTML = '<p style="font-size: 11px; color: var(--text-muted); margin: 0; padding: 5px;">Mevcut görsel bulunmuyor.</p>';
    }
}

document.addEventListener('DOMContentLoaded', function() {
    const dropzone = document.getElementById('image-dropzone');
    const fileInput = document.getElementById('image');
    const dropzoneText = document.getElementById('dropzone-text');

    dropzone.addEventListener('click', () => fileInput.click());

    dropzone.addEventListener('dragover', (e) => {
        e.preventDefault();
        dropzone.style.borderColor = 'var(--primary-hover)';
        dropzone.style.backgroundColor = '#fff';
    });

    dropzone.addEventListener('dragleave', () => {
        dropzone.style.borderColor = 'var(--primary)';
        dropzone.style.backgroundColor = 'var(--bg-light)';
    });

    dropzone.addEventListener('drop', (e) => {
        e.preventDefault();
        dropzone.style.borderColor = 'var(--primary)';
        dropzone.style.backgroundColor = 'var(--bg-light)';

        if (e.dataTransfer.files.length) {
            // Use standard DataTransfer for perfect cross-browser multi-file assignment
            const dt = new DataTransfer();
            for (let i = 0; i < e.dataTransfer.files.length; i++) {
                dt.items.add(e.dataTransfer.files[i]);
            }
            fileInput.files = dt.files;
            updateDropzoneText(fileInput.files);
        }
    });

    fileInput.addEventListener('change', () => {
        if (fileInput.files.length) {
            updateDropzoneText(fileInput.files);
        }
    });

    function updateDropzoneText(files) {
        if (files.length > 1) {
            dropzoneText.innerHTML = `<i class="fa-solid fa-circle-check" style="color: var(--success); margin-right: 5px;"></i> <strong>${files.length} adet görsel</strong> seçildi.`;
        } else if (files.length === 1) {
            dropzoneText.innerHTML = `<i class="fa-solid fa-circle-check" style="color: var(--success); margin-right: 5px;"></i> <strong>${files[0].name}</strong> seçildi.`;
        }
        dropzone.style.borderColor = 'var(--success)';
    }

    // Video Selector Box (Click & Drag and Drop for editing)
    const videoSelectorBox = document.getElementById('video-selector-box');
    const videoInput = document.getElementById('video');
    const videoSelectorText = document.getElementById('video-selector-text');

    if (videoSelectorBox && videoInput && videoSelectorText) {
        videoSelectorBox.addEventListener('click', () => videoInput.click());

        videoSelectorBox.addEventListener('dragover', (e) => {
            e.preventDefault();
            videoSelectorBox.style.borderColor = 'var(--primary-hover)';
            videoSelectorBox.style.backgroundColor = '#fff';
        });

        videoSelectorBox.addEventListener('dragleave', () => {
            videoSelectorBox.style.borderColor = 'var(--primary)';
            videoSelectorBox.style.backgroundColor = 'var(--bg-light)';
        });

        videoSelectorBox.addEventListener('drop', (e) => {
            e.preventDefault();
            videoSelectorBox.style.borderColor = 'var(--primary)';
            videoSelectorBox.style.backgroundColor = 'var(--bg-light)';

            if (e.dataTransfer.files.length) {
                videoInput.files = e.dataTransfer.files;
                updateVideoSelectorText(e.dataTransfer.files[0].name);
            }
        });

        videoInput.addEventListener('change', () => {
            if (videoInput.files.length) {
                updateVideoSelectorText(videoInput.files[0].name);
            }
        });

        function updateVideoSelectorText(name) {
            videoSelectorText.innerHTML = `<i class="fa-solid fa-circle-check" style="color: var(--success); margin-right: 5px;"></i> <strong>${name}</strong> seçildi.`;
            videoSelectorBox.style.borderColor = 'var(--success)';
        }
    }
});
</script>
