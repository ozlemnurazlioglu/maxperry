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

    <!-- Add Product Main Content -->
    <main class="admin-content" style="max-width: 700px;">
        <div class="admin-header-row">
            <h1 style="font-size: 28px; color: var(--text-dark);">Yeni Tasarım Ekle</h1>
            <a href="<?php echo BASE_URL; ?>/admin/products" class="btn btn-secondary" style="font-size: 11px; padding: 10px 15px;"><i class="fa-solid fa-chevron-left"></i> Vazgeç</a>
        </div>

        <div style="background-color: var(--bg-white); border: 1px solid var(--border-color); padding: 35px; box-shadow: var(--shadow-soft); border-radius: 4px;">
            <form id="add-product-form" action="<?php echo BASE_URL; ?>/admin/product/add/submit" method="POST" enctype="multipart/form-data">
                <!-- CSRF Token -->
                <input type="hidden" name="csrf_token" value="<?php echo generateCsrfToken(); ?>">
                
                <!-- Product Name -->
                <div class="form-group">
                    <label for="name">Tasarım / Ürün Adı <span style="color: var(--error);">*</span></label>
                    <input type="text" id="name" name="name" class="form-control" placeholder="Örn: Siyah Balık Model Abiye" style="background-color: var(--bg-white);" required>
                </div>

                <!-- Image and Product Video -->
                <div class="form-group" style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 25px;">
                    <div>
                        <label style="display:block; margin-bottom: 8px;">Ürün Görselleri <span style="color: var(--error);">*</span></label>
                        
                        <!-- Drag and Drop Dropzone -->
                        <div id="image-dropzone" style="border: 2px dashed var(--primary); padding: 20px; text-align: center; cursor: pointer; background-color: var(--bg-light); border-radius: 4px; transition: var(--transition);">
                            <i class="fa-solid fa-cloud-arrow-up" style="font-size: 24px; color: var(--primary); margin-bottom: 8px;"></i>
                            <p id="dropzone-text" style="font-size: 11px; color: var(--text-muted); font-weight: 500;">Görselleri sürükleyip bırakın veya tıklayın</p>
                            <input type="file" id="image" name="image[]" accept="image/*" multiple style="display: none;">
                        </div>

                        <!-- Elegant Interactive Thumbnail Previews with Cover Selector -->
                        <div id="image-previews-container" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(80px, 1fr)); gap: 12px; margin-top: 15px;">
                            <!-- Dynamically populated via JS -->
                        </div>
                        
                        <!-- Fallback URL field -->
                        <div style="margin-top: 15px;">
                            <label for="image_url" style="font-size: 10px; text-transform: none; color: var(--text-muted);">Veya alternatif görsel adı/linki girin:</label>
                            <input type="text" id="image_url" name="image_url" class="form-control" value="default-dress.jpg" style="background-color: var(--bg-white); padding: 8px; font-size: 11px;">
                        </div>
                    </div>
                    <div>
                        <label style="display:block; margin-bottom: 8px;">Ürün Tanıtım Videosu</label>
                        
                        <!-- Video File Selector Box -->
                        <div id="video-selector-box" style="border: 2px dashed var(--primary); padding: 15px; text-align: center; cursor: pointer; background-color: var(--bg-light); border-radius: 4px; transition: var(--transition); margin-bottom: 10px;">
                            <i class="fa-solid fa-video" style="font-size: 20px; color: var(--primary); margin-bottom: 5px;"></i>
                            <p id="video-selector-text" style="font-size: 10px; color: var(--text-muted); font-weight: 500;">Bilgisayardan video seçmek için tıklayın (Max 50MB)</p>
                            <input type="file" id="video" name="video" accept="video/*" style="display: none;">
                        </div>
                        
                        <!-- Fallback Video URL input -->
                        <label for="video_url" style="font-size: 10px; text-transform: none; color: var(--text-muted);">Veya video linki (YouTube/Vimeo) girin:</label>
                        <input type="text" id="video_url" name="video_url" class="form-control" placeholder="Örn: https://www.youtube.com/watch?v=dQw4w9WgXcQ" style="background-color: var(--bg-white); padding: 8px; font-size: 11px;">
                    </div>
                </div>

                <!-- Save Button -->
                <button type="submit" class="btn btn-rose" style="width: 100%; padding: 15px; font-weight: bold; letter-spacing: 1px; margin-top: 10px;">
                    TASARIMI KATALOĞA EKLE <i class="fa-solid fa-circle-check" style="margin-left: 5px;"></i>
                </button>
            </form>
        </div>
    </main>

</div>

<!-- Drag & Drop & Interactive Cover Selector JS Logic -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const dropzone = document.getElementById('image-dropzone');
    const fileInput = document.getElementById('image');
    const dropzoneText = document.getElementById('dropzone-text');
    const previewsContainer = document.getElementById('image-previews-container');
    const form = document.getElementById('add-product-form');

    let selectedFiles = [];
    let coverIndex = 0; // Default first file is cover image

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
        coverIndex = 0; // Reset cover index to first file
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
                    background-color: ${isCover ? 'var(--primary)' : 'rgba(0,0,0,0.5)'}; 
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
            
            // Set cover on click
            thumbWrapper.addEventListener('click', () => {
                coverIndex = index;
                updatePreviews();
            });
            
            previewsContainer.appendChild(thumbWrapper);
        });
    }

    function updateDropzoneText(files) {
        if (files.length > 1) {
            dropzoneText.innerHTML = `<i class="fa-solid fa-circle-check" style="color: var(--success); margin-right: 5px;"></i> <strong>${files.length} adet görsel</strong> seçildi.`;
        } else if (files.length === 1) {
            dropzoneText.innerHTML = `<i class="fa-solid fa-circle-check" style="color: var(--success); margin-right: 5px;"></i> <strong>${files[0].name}</strong> seçildi.`;
        }
        dropzone.style.borderColor = 'var(--success)';
    }

    // Intercept form submission to rearrange files with cover file at index 0
    form.addEventListener('submit', function(e) {
        if (selectedFiles.length > 0) {
            const dt = new DataTransfer();
            
            // 1. Add the selected cover file first! (so it occupies index 0)
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

    // Video Selector Box click handler
    const videoSelectorBox = document.getElementById('video-selector-box');
    const videoInput = document.getElementById('video');
    const videoSelectorText = document.getElementById('video-selector-text');

    if (videoSelectorBox && videoInput && videoSelectorText) {
        videoSelectorBox.addEventListener('click', () => videoInput.click());

        videoInput.addEventListener('change', () => {
            if (videoInput.files.length) {
                const videoName = videoInput.files[0].name;
                videoSelectorText.innerHTML = `<i class="fa-solid fa-circle-check" style="color: var(--success); margin-right: 5px;"></i> <strong>${videoName}</strong> seçildi.`;
                videoSelectorBox.style.borderColor = 'var(--success)';
            }
        });
    }
});
</script>
