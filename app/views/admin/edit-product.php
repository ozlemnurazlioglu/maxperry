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
            <form id="edit-product-form" action="<?php echo BASE_URL; ?>/admin/product/edit/<?php echo $product['id']; ?>/submit" method="POST" enctype="multipart/form-data">
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
                        <label style="display:block; margin-bottom: 8px;">Ürün Görselleri (Tıklayarak Kapak Resmi Seçebilirsiniz)</label>

                        <!-- Currently Uploaded Images Grid -->
                        <div id="current-images-container" style="display: flex; flex-wrap: wrap; gap: 15px; margin-bottom: 15px; padding: 10px; border: 1px solid var(--border-color); background-color: #fcfbfb; border-radius: 4px;">
                            <?php 
                            $images = array_filter(explode(',', $product['image_url'] ?? ''));
                            if (!empty($images)):
                                foreach ($images as $index => $img): 
                                    $img = trim($img);
                                    if (empty($img)) continue;
                                    $isCover = ($index === 0);
                                    
                                    $imgSrc = BASE_URL . '/public/assets/images/' . $img;
                                    if ($img === 'zumrut-saten.jpg') $imgSrc = 'https://images.unsplash.com/photo-1595777457583-95e059d581b8?auto=format&fit=crop&q=80&w=200';
                                    elseif ($img === 'rose-gold-saten.jpg') $imgSrc = 'https://images.unsplash.com/photo-1572804013309-59a88b7e92f1?auto=format&fit=crop&q=80&w=200';
                                    elseif ($img === 'gumus-payetli.jpg') $imgSrc = 'https://images.unsplash.com/photo-1515886657613-9f3515b0c78f?auto=format&fit=crop&q=80&w=200';
                                    elseif ($img === 'siyah-payetli.jpg') $imgSrc = 'https://images.unsplash.com/photo-1539008885868-47a40df6ee5f?auto=format&fit=crop&q=80&w=200';
                                    elseif ($img === 'pudra-dantel.jpg') $imgSrc = 'https://images.unsplash.com/photo-1496747611176-843222e1e57c?auto=format&fit=crop&q=80&w=200';
                                    elseif ($img === 'ekru-helen.jpg') $imgSrc = 'https://images.unsplash.com/photo-1594552072238-b8a33785b261?auto=format&fit=crop&q=80&w=200';
                                    elseif ($img === 'mavi-kadife.jpg') $imgSrc = 'https://images.unsplash.com/photo-1568252542512-9fe8fe9c87bb?auto=format&fit=crop&q=80&w=200';
                            ?>
                                <div class="thumb-wrapper existing-thumb" data-filename="<?php echo htmlspecialchars($img); ?>" onclick="makeExistingCover('<?php echo htmlspecialchars($img); ?>')" style="position: relative; width: 80px; height: 80px; border: 2px solid <?php echo $isCover ? 'var(--primary)' : 'var(--border-color)'; ?>; border-radius: 4px; overflow: visible; cursor: pointer; box-shadow: <?php echo $isCover ? '0 0 8px rgba(212, 172, 13, 0.4)' : 'none'; ?>; transition: var(--transition);">
                                    <img src="<?php echo $imgSrc; ?>" style="width: 100%; height: 100%; object-fit: cover; border-radius: 2px;">
                                    <button type="button" class="btn-remove-thumb" onclick="deleteExistingImage(event, '<?php echo htmlspecialchars($img); ?>')" style="position: absolute; top: -6px; right: -6px; background-color: var(--error); color: white; border: none; border-radius: 50%; width: 18px; height: 18px; display: flex; align-items: center; justify-content: center; cursor: pointer; font-size: 10px; font-weight: bold; box-shadow: 0 1px 4px rgba(0,0,0,0.2); z-index: 10;" title="Sil">×</button>
                                    <span class="cover-badge" style="position: absolute; bottom: 0; left: 0; right: 0; background-color: <?php echo $isCover ? 'var(--primary)' : 'rgba(0,0,0,0.5)'; ?>; color: white; font-size: 8px; font-weight: bold; text-align: center; padding: 2px 0; text-transform: uppercase; border-bottom-left-radius: 2px; border-bottom-right-radius: 2px;"><?php echo $isCover ? '★ KAPAK' : 'KAPAK YAP'; ?></span>
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

                        <!-- Elegant Interactive Thumbnail Previews with Cover Selector for NEW uploads -->
                        <div id="image-previews-container" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(80px, 1fr)); gap: 12px; margin-top: 15px;">
                            <!-- Dynamically populated via JS for newly selected files -->
                        </div>
                        
                        <!-- Fallback URL field -->
                        <div style="margin-top: 15px;">
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

<!-- Drag & Drop & Existing Cover Reordering Logic -->
<script>
// Choose existing cover image on click
function makeExistingCover(filename) {
    const input = document.getElementById('existing_images_input');
    let images = input.value.split(',').map(s => s.trim()).filter(Boolean);
    
    // Put selected filename at index 0 (as cover photo)
    images = images.filter(img => img !== filename);
    images.unshift(filename);
    input.value = images.join(',');
    
    // Update active UI classes, borders, and badges
    document.querySelectorAll('.existing-thumb').forEach(thumb => {
        const isSelected = (thumb.getAttribute('data-filename') === filename);
        thumb.style.borderColor = isSelected ? 'var(--primary)' : 'var(--border-color)';
        thumb.style.boxShadow = isSelected ? '0 0 8px rgba(212, 172, 13, 0.4)' : 'none';
        
        const badge = thumb.querySelector('.cover-badge');
        if (badge) {
            badge.innerHTML = isSelected ? '★ KAPAK' : 'KAPAK YAP';
            badge.style.backgroundColor = isSelected ? 'var(--primary)' : 'rgba(0,0,0,0.5)';
        }
    });
}

function deleteExistingImage(event, filename) {
    event.stopPropagation(); // Stop click event from selecting this as cover
    if (!confirm('Bu görseli silmek istediğinizden emin misiniz?')) {
        return;
    }
    const wrapper = document.querySelector(`.thumb-wrapper[data-filename="${filename}"]`);
    if (wrapper) {
        wrapper.remove();
    }
    
    const input = document.getElementById('existing_images_input');
    let images = input.value.split(',').map(s => s.trim()).filter(Boolean);
    images = images.filter(img => img !== filename);
    input.value = images.join(',');
    
    // If the deleted image was the cover, automatically make the new index 0 the cover
    if (images.length > 0) {
        makeExistingCover(images[0]);
    } else {
        const container = document.getElementById('current-images-container');
        container.innerHTML = '<p style="font-size: 11px; color: var(--text-muted); margin: 0; padding: 5px;">Mevcut görsel bulunmuyor.</p>';
    }
}

document.addEventListener('DOMContentLoaded', function() {
    const dropzone = document.getElementById('image-dropzone');
    const fileInput = document.getElementById('image');
    const dropzoneText = document.getElementById('dropzone-text');
    const previewsContainer = document.getElementById('image-previews-container');
    const form = document.getElementById('edit-product-form');

    let selectedFiles = [];
    let coverIndex = -1; // Default -1 means we are not overriding cover with newly uploaded images

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
            handleFilesSelection(e.dataTransfer.files);
        }
    });

    fileInput.addEventListener('change', () => {
        if (fileInput.files.length) {
            handleFilesSelection(fileInput.files);
        }
    });

    function handleFilesSelection(files) {
        selectedFiles = Array.from(files);
        coverIndex = 0; // Default first newly uploaded file is cover
        
        // Uncheck all existing cover highlights since a new file is set as cover
        document.querySelectorAll('.existing-thumb').forEach(thumb => {
            thumb.style.borderColor = 'var(--border-color)';
            thumb.style.boxShadow = 'none';
            const badge = thumb.querySelector('.cover-badge');
            if (badge) {
                badge.innerHTML = 'KAPAK YAP';
                badge.style.backgroundColor = 'rgba(0,0,0,0.5)';
            }
        });

        updatePreviews();
        updateDropzoneText(selectedFiles);
    }

    function updatePreviews() {
        previewsContainer.innerHTML = '';
        
        selectedFiles.forEach((file, index) => {
            const isCover = (index === coverIndex);
            const previewUrl = URL.createObjectURL(file);
            
            const thumbWrapper = document.createElement('div');
            thumbWrapper.className = 'thumb-wrapper';
            thumbWrapper.style.cssText = `
                position: relative; 
                width: 80px; 
                height: 80px; 
                border: 2px solid ${isCover ? 'var(--primary)' : 'var(--border-color)'}; 
                border-radius: 4px; 
                overflow: visible;
                cursor: pointer;
                box-shadow: ${isCover ? '0 0 8px rgba(212, 172, 13, 0.4)' : 'none'};
                transition: var(--transition);
            `;
            
            thumbWrapper.innerHTML = `
                <img src="${previewUrl}" style="width: 100%; height: 100%; object-fit: cover; border-radius: 2px;">
                <span class="cover-badge" style="
                    position: absolute; 
                    bottom: 0; 
                    left: 0; 
                    right: 0;
                    background-color: ${isCoverActive(index) ? 'var(--primary)' : 'rgba(0,0,0,0.6)'};
                    color: white;
                    font-size: 8px; 
                    font-weight: bold; 
                    text-align: center; 
                    padding: 2px 0;
                    text-transform: uppercase;
                    border-bottom-left-radius: 2px;
                    border-bottom-right-radius: 2px;
                ">${isCover ? '★ KAPAK' : 'KAPAK YAP'}</span>
            `;
            
            thumbWrapper.addEventListener('click', () => {
                coverIndex = index;
                // De-highlight any existing thumbnails since a newly uploaded file is now cover
                document.querySelectorAll('.existing-thumb').forEach(thumb => {
                    thumb.style.borderColor = 'var(--border-color)';
                    thumb.style.boxShadow = 'none';
                    const badge = thumb.querySelector('.cover-badge');
                    if (badge) {
                        badge.innerHTML = 'KAPAK YAP';
                        badge.style.backgroundColor = 'rgba(0,0,0,0.5)';
                    }
                });
                updatePreviews();
            });
            
            previewsContainer.appendChild(thumbWrapper);
        });
    }

    function isCoverActive(index) {
        return index === coverIndex;
    }

    function updateDropzoneText(files) {
        if (files.length > 1) {
            dropzoneText.innerHTML = `<i class="fa-solid fa-circle-check" style="color: var(--success); margin-right: 5px;"></i> <strong>${files.length} adet yeni görsel</strong> seçildi.`;
        } else if (files.length === 1) {
            dropzoneText.innerHTML = `<i class="fa-solid fa-circle-check" style="color: var(--success); margin-right: 5px;"></i> <strong>${files[0].name}</strong> seçildi.`;
        }
        dropzone.style.borderColor = 'var(--success)';
    }

    // Intercept form submission to rearrange newly selected files with cover file at index 0 (if applicable)
    form.addEventListener('submit', function(e) {
        if (selectedFiles.length > 0 && coverIndex !== -1) {
            const dt = new DataTransfer();
            
            // 1. Add the selected cover file first! (so it occupies index 0 of newly uploaded files list)
            dt.items.add(selectedFiles[coverIndex]);
            
            // 2. Add all other files
            selectedFiles.forEach((file, index) => {
                if (index !== coverIndex) {
                    dt.items.add(file);
                }
            });
            
            // Overwrite file input files list
            fileInput.files = dt.files;
        }
    });

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
