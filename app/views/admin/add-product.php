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
            <form action="<?php echo BASE_URL; ?>/admin/product/add/submit" method="POST" enctype="multipart/form-data">
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
                        <label style="display:block; margin-bottom: 8px;">Ürün Görseli <span style="color: var(--error);">*</span></label>
                        
                        <!-- Drag and Drop Dropzone -->
                        <div id="image-dropzone" style="border: 2px dashed var(--primary); padding: 20px; text-align: center; cursor: pointer; background-color: var(--bg-light); border-radius: 4px; transition: var(--transition);">
                            <i class="fa-solid fa-cloud-arrow-up" style="font-size: 24px; color: var(--primary); margin-bottom: 8px;"></i>
                            <p id="dropzone-text" style="font-size: 11px; color: var(--text-muted); font-weight: 500;">Görselleri sürükleyip bırakın veya tıklayın</p>
                            <input type="file" id="image" name="image[]" accept="image/*" multiple style="display: none;">
                        </div>
                        
                        <!-- Fallback URL field -->
                        <div style="margin-top: 10px;">
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

<!-- Drag & Drop JS Logic -->
<script>
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
