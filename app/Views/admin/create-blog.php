<?= $this->extend('admin/layout/base'); ?>

<?= $this->section('title'); ?>Tulis Berita Baru<?= $this->endSection(); ?>

<?= $this->section('styles'); ?>
<link rel="stylesheet" href="<?= base_url('assets/css/admin/blogs.css'); ?>">
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>

<div class="form-wrapper">
    <div class="form-header">
        <h2>Tulis Artikel Blog</h2>
        <p>Bagikan berita terbaru, tips arsitektur, atau cerita di balik layar.</p>
    </div>

    <form method="POST" action="<?= base_url('admin/blog/create'); ?>" enctype="multipart/form-data" id="blogForm">
        <?= csrf_field(); ?>

        <!-- Cover Image Upload -->
        <div class="form-section">
            <h3 class="form-section-title">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="width: 5px; height: 5px; display: inline; vertical-align: middle; margin-right: 8px;">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                Gambar Sampul
            </h3>

            <div class="upload-area" id="uploadArea">
                <input type="file" id="image_url" name="image_url" accept="image/*" required>
                
                <div id="upload-placeholder">
                    <div class="upload-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <div class="upload-text">
                        <strong>Klik atau Seret Gambar ke Sini</strong>
                        <p class="upload-hint">
                            Format: JPG, PNG, GIF, SVG, WEBP, BMP | Max 10MB | Rasio: Landscape (16:9)
                        </p>
                    </div>
                </div>

                <div id="preview-container" class="upload-preview">
                    <img id="image-preview" src="" alt="Preview Gambar">
                    <span id="file-name" class="file-name"></span>
                    <span style="color: var(--text-muted); font-size: 12px; margin-top: 8px;">Klik untuk mengganti gambar</span>
                </div>
            </div>
        </div>

        <!-- Indonesian Version -->
        <div class="form-section">
            <h3 class="form-section-title">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="width: 20px; height: 20px; display: inline; vertical-align: middle; margin-right: 8px;">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 21v-8a2 2 0 012-2h14a2 2 0 012 2v8M3 13l4-4 4 4M3 5l4-4 4 4M13 21v-8a2 2 0 012-2h4a2 2 0 012 2v8M13 13l4-4 4 4M13 5l4-4 4 4" />
                </svg>
                Versi Bahasa Indonesia
            </h3>

            <div class="form-group">
                <label class="form-label">Judul Artikel <span class="required">*</span></label>
                <input type="text" id="title" name="title" class="form-input" value="<?= old('title'); ?>" placeholder="Masukkan judul artikel" required>
            </div>

            <div class="form-group">
                <label class="form-label">Deskripsi 1 / Headline <span class="required">*</span></label>
                <textarea id="description_1" name="description_1" class="form-textarea" rows="4" placeholder="Paragraf pembuka yang menarik" required><?= old('description_1'); ?></textarea>
                <p class="form-hint">Gunakan sebagai paragraf pembuka yang menarik perhatian pembaca.</p>
            </div>

            <div class="form-group">
                <label class="form-label">Isi Konten Detail</label>
                <textarea id="description_2" name="description_2" class="form-textarea" rows="12" placeholder="Penjelasan lebih panjang tentang artikel"><?= old('description_2'); ?></textarea>
                <p class="form-hint">Gunakan untuk penjelasan lebih panjang. Boleh dikosongkan.</p>
            </div>
        </div>

        <!-- English Version -->
        <div class="form-section">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                <h3 class="form-section-title" style="margin: 0; border: none;">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="width: 20px; height: 20px; display: inline; vertical-align: middle; margin-right: 8px;">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 016.412 9m6.088 9h7M11 21l5-10 5 10M12.751 5C11.783 10.77 8.07 15.61 3 18.129" />
                    </svg>
                    English Version
                </h3>
                <button type="button" id="btnTranslate" class="translate-btn">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="width: 16px; height: 16px;">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                    </svg>
                    Auto Translate
                </button>
            </div>

            <div class="form-group">
                <label class="form-label">Article Title</label>
                <input type="text" id="title_en" name="title_en" class="form-input" value="<?= old('title_en'); ?>" placeholder="Enter article title">
            </div>

            <div class="form-group">
                <label class="form-label">Description 1 / Headline</label>
                <textarea id="description_1_en" name="description_1_en" class="form-textarea" rows="4" placeholder="Opening paragraph"><?= old('description_1_en'); ?></textarea>
            </div>

            <div class="form-group">
                <label class="form-label">Detailed Content</label>
                <textarea id="description_2_en" name="description_2_en" class="form-textarea" rows="12" placeholder="Detailed article content"><?= old('description_2_en'); ?></textarea>
            </div>
        </div>

        <!-- Featured Checkbox -->
        <div class="form-group">
            <div class="checkbox-group">
                <label>
                    <input type="checkbox" name="is_featured" value="1" <?= old('is_featured') == 1 ? 'checked' : ''; ?>>
                    Jadikan sebagai Master Headline
                </label>
                <span class="hint">Jika dicentang, artikel ini akan menjadi gambar besar di halaman Jurnal.</span>
            </div>
        </div>

        <!-- Form Actions -->
        <div class="form-actions">
            <a href="<?= base_url('admin/blogs'); ?>" class="btn btn-secondary">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
                Batal
            </a>
            <button type="submit" class="btn btn-primary">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                </svg>
                Publikasikan Berita
            </button>
        </div>
    </form>
</div>

<!-- Validation Popup -->
<div id="validationPopup" class="validation-popup"></div>

<?= $this->endSection(); ?>

<?= $this->section('scripts'); ?>
<script>
    // ============================================
    // VALIDATION POPUP FUNCTION
    // ============================================
    function showPopup(type, title, message) {
        const popup = document.getElementById('validationPopup');
        const icons = {
            success: '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>',
            error: '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>',
            warning: '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" /></svg>'
        };

        const popupHTML = `
            <div class="popup-message ${type}">
                <span class="popup-icon">${icons[type]}</span>
                <div class="popup-content">
                    <p class="popup-title">${title}</p>
                    <p class="popup-message-text">${message}</p>
                </div>
                <button class="popup-close" onclick="this.parentElement.remove()">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        `;

        popup.insertAdjacentHTML('beforeend', popupHTML);

        setTimeout(() => {
            const firstPopup = popup.querySelector('.popup-message');
            if (firstPopup) {
                firstPopup.style.animation = 'slideInRight 0.4s ease reverse';
                setTimeout(() => firstPopup.remove(), 400);
            }
        }, 5000);
    }

    // ============================================
    // FILE UPLOAD WITH VALIDATION
    // ============================================
    const imageInput = document.getElementById('image_url');
    const uploadArea = document.getElementById('uploadArea');
    const uploadPlaceholder = document.getElementById('upload-placeholder');
    const previewContainer = document.getElementById('preview-container');
    const imagePreview = document.getElementById('image-preview');
    const fileNameSpan = document.getElementById('file-name');

    imageInput.addEventListener('change', function(event) {
        const file = event.target.files[0];
        
        if (file) {
            // Validate file type
            if (!file.type.startsWith('image/')) {
                showPopup('error', 'File Tidak Valid', 'File harus berupa gambar (JPG, PNG, GIF, SVG, WEBP, BMP).');
                this.value = '';
                return;
            }
            
            // Validate file size (10MB)
            const maxSize = 10 * 1024 * 1024;
            if (file.size > maxSize) {
                showPopup('error', 'File Terlalu Besar', 
                    'Ukuran file maksimal 10MB. File Anda: ' + (file.size / 1024 / 1024).toFixed(2) + 'MB');
                this.value = '';
                return;
            }
            
            // Show preview
            const reader = new FileReader();
            reader.onload = function(e) {
                imagePreview.src = e.target.result;
                uploadPlaceholder.style.display = 'none';
                previewContainer.classList.add('show');
                fileNameSpan.textContent = '✓ ' + file.name + ' (' + (file.size / 1024 / 1024).toFixed(2) + ' MB)';
                uploadArea.style.borderColor = 'var(--onyx)';
                uploadArea.style.background = '#ffffff';
                uploadArea.style.borderStyle = 'solid';
            };
            reader.readAsDataURL(file);
            
            showPopup('success', 'File Valid', 'Gambar siap diunggah: ' + file.name);
        }
    });

    // Drag and Drop
    uploadArea.addEventListener('dragover', (e) => {
        e.preventDefault();
        uploadArea.style.borderColor = 'var(--onyx)';
        uploadArea.style.background = 'var(--bg-hover)';
    });

    uploadArea.addEventListener('dragleave', (e) => {
        e.preventDefault();
        if (!imageInput.value) {
            uploadArea.style.borderColor = 'var(--border)';
            uploadArea.style.background = 'var(--bg-input)';
        }
    });

    uploadArea.addEventListener('drop', (e) => {
        e.preventDefault();
        const file = e.dataTransfer.files[0];
        if (file && file.type.startsWith('image/')) {
            imageInput.files = e.dataTransfer.files;
            imageInput.dispatchEvent(new Event('change'));
        } else {
            showPopup('error', 'File Tidak Valid', 'Harap drop file gambar.');
        }
    });

    // ============================================
    // FORM VALIDATION
    // ============================================
    document.getElementById('blogForm').addEventListener('submit', function(e) {
        const title = document.getElementById('title').value.trim();
        const titleEn = document.getElementById('title_en').value.trim();
        const desc1 = document.getElementById('description_1').value.trim();
        const desc1En = document.getElementById('description_1_en').value.trim();
        const image = imageInput.files[0];

        // Validate title
        if (!title || title.length < 5) {
            e.preventDefault();
            showPopup('error', 'Validasi Gagal', 'Judul artikel minimal 5 karakter.');
            document.getElementById('title').focus();
            return false;
        }

        if (title.length > 255) {
            e.preventDefault();
            showPopup('error', 'Validasi Gagal', 'Judul artikel maksimal 255 karakter.');
            document.getElementById('title').focus();
            return false;
        }

        // Validate description 1
        if (!desc1 || desc1.length < 10) {
            e.preventDefault();
            showPopup('error', 'Validasi Gagal', 'Deskripsi utama minimal 10 karakter.');
            document.getElementById('description_1').focus();
            return false;
        }

        // Validate image
        if (!image) {
            e.preventDefault();
            showPopup('error', 'Validasi Gagal', 'Gambar sampul wajib diunggah.');
            return false;
        }

        if (image.size > 10 * 1024 * 1024) {
            e.preventDefault();
            showPopup('error', 'Validasi Gagal', 'Ukuran gambar maksimal 10MB.');
            return false;
        }

        showPopup('warning', 'Memproses', 'Artikel sedang dipublikasikan...');
    });

    // ============================================
    // AUTO TRANSLATE
    // ============================================
    document.getElementById('btnTranslate').addEventListener('click', async function() {
        const btn = this;
        const originalContent = btn.innerHTML;
        
        const textData = {
            title: document.getElementById('title').value,
            description_1: document.getElementById('description_1').value,
            description_2: document.getElementById('description_2').value
        };

        if (!textData.title && !textData.description_1 && !textData.description_2) {
            showPopup('warning', 'Peringatan', 'Harap isi minimal satu kolom Bahasa Indonesia sebelum menerjemahkan.');
            return;
        }

        btn.disabled = true;
        btn.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="width: 16px; height: 16px; animation: spin 1s linear infinite;"><path stroke-linecap="round" stroke-linejoin="round" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" /></svg> Processing...';
        
        try {
            const response = await fetch('<?= base_url('admin/translate') ?>', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: JSON.stringify(textData)
            });

            const result = await response.json();

            if (result.success) {
                if (result.data.title) document.getElementById('title_en').value = result.data.title;
                if (result.data.description_1) document.getElementById('description_1_en').value = result.data.description_1;
                if (result.data.description_2) document.getElementById('description_2_en').value = result.data.description_2;
                showPopup('success', 'Berhasil', 'Terjemahan selesai!');
            } else {
                showPopup('error', 'Gagal', result.message || 'Gagal menerjemahkan.');
            }
        } catch (error) {
            showPopup('error', 'Error', 'Terjadi kesalahan jaringan saat menerjemahkan.');
            console.error('Error:', error);
        } finally {
            btn.disabled = false;
            btn.innerHTML = originalContent;
        }
    });

    // Add spin animation for loading icon
    const style = document.createElement('style');
    style.textContent = `
        @keyframes spin {
            to { transform: rotate(360deg); }
        }
    `;
    document.head.appendChild(style);

    // ============================================
    // SHOW FLASHDATA
    // ============================================
    <?php if (session()->getFlashdata('error')): ?>
        showPopup('error', 'Error', '<?= esc(session()->getFlashdata('error')); ?>');
    <?php endif; ?>

    <?php $errors = session()->getFlashdata('errors'); ?>
    <?php if (is_array($errors) && !empty($errors)): ?>
        <?php foreach ($errors as $err): ?>
            showPopup('error', 'Validasi Gagal', '<?= esc($err); ?>');
        <?php endforeach; ?>
    <?php endif; ?>
</script>
<?= $this->endSection(); ?>