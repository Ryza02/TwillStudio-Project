<?= $this->extend('admin/layout/base'); ?>

<?= $this->section('title'); ?>Edit Artikel<?= $this->endSection(); ?>

<?= $this->section('styles'); ?>
<link rel="stylesheet" href="<?= base_url('assets/css/admin/blogs.css'); ?>">
<style>
    /* Tambahan styling agar layout header form rapi */
    .section-header-flex {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
        padding-bottom: 10px;
        border-bottom: 1px solid var(--border);
    }
    .section-header-flex .form-section-title {
        margin: 0;
        border: none;
        padding: 0;
    }
    .btn-translate {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background-color: var(--bg-hover);
        color: var(--onyx);
        border: 1px solid var(--border);
        padding: 8px 16px;
        border-radius: var(--radius-md);
        font-size: 14px;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.2s ease;
    }
    .btn-translate:hover:not(:disabled) {
        background-color: var(--border);
    }
    .btn-translate:disabled {
        opacity: 0.7;
        cursor: not-allowed;
    }
</style>
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>

<div class="form-wrapper">
    <div class="form-header">
        <h2>Edit Artikel Blog</h2>
        <p>Perbarui isi atau judul berita: <strong><?= esc($blog['title']); ?></strong></p>
    </div>

    <form method="POST" action="<?= base_url('admin/blog/edit/' . esc($blog['id'])); ?>" enctype="multipart/form-data" id="blogForm">
        <?= csrf_field(); ?>

        <div class="form-section">
            <h3 class="form-section-title">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="width: 20px; height: 20px; display: inline; vertical-align: middle; margin-right: 8px;">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                Gambar Sampul
            </h3>

            <?php if (!empty($blog['image_url']) && is_file(FCPATH . $blog['image_url'])): ?>
                <div style="margin-bottom: 20px;">
                    <img src="<?= base_url(esc($blog['image_url'])); ?>" alt="Current Cover" style="max-width: 300px; border-radius: var(--radius-md); box-shadow: var(--shadow-md);">
                    <p class="form-hint">Gambar saat ini akan diganti jika Anda upload gambar baru.</p>
                </div>
            <?php endif; ?>

            <div class="upload-area" id="uploadArea">
                <input type="file" id="image_url" name="image_url" accept="image/*">
                
                <div id="upload-placeholder">
                    <div class="upload-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <div class="upload-text">
                        <strong>Klik untuk Upload Gambar Baru</strong>
                        <p class="upload-hint">
                            Kosongkan jika tidak ingin mengganti gambar | Max 10MB
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

        <div class="form-section">
            <div class="section-header-flex">
                <h3 class="form-section-title">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="width: 20px; height: 20px; display: inline; vertical-align: middle; margin-right: 8px;">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 21v-8a2 2 0 012-2h14a2 2 0 012 2v8M3 13l4-4 4 4M3 5l4-4 4 4M13 21v-8a2 2 0 012-2h4a2 2 0 012 2v8M13 13l4-4 4 4M13 5l4-4 4 4" />
                    </svg>
                    Versi Bahasa Indonesia
                </h3>
                <button type="button" id="btnTranslate" class="btn-translate">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="width: 16px; height: 16px;">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                    </svg>
                    Auto Translate
                </button>
            </div>

            <div class="form-group">
                <label class="form-label">Judul Artikel <span class="required">*</span></label>
                <input type="text" id="title" name="title" class="form-input" value="<?= old('title', $blog['title']); ?>" placeholder="Masukkan judul artikel" required>
            </div>

            <div class="form-group">
                <label class="form-label">Deskripsi 1 / Headline <span class="required">*</span></label>
                <textarea id="description_1" name="description_1" class="form-textarea" rows="4" placeholder="Paragraf pembuka yang menarik" required><?= old('description_1', $blog['description_1']); ?></textarea>
            </div>

            <div class="form-group">
                <label class="form-label">Isi Konten Detail</label>
                <textarea id="description_2" name="description_2" class="form-textarea" rows="12" placeholder="Penjelasan lebih panjang tentang artikel"><?= old('description_2', $blog['description_2']); ?></textarea>
            </div>
        </div>

        <div class="form-section">
            <h3 class="form-section-title">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="width: 20px; height: 20px; display: inline; vertical-align: middle; margin-right: 8px;">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 016.412 9m6.088 9h7M11 21l5-10 5 10M12.751 5C11.783 10.77 8.07 15.61 3 18.129" />
                </svg>
                English Version
            </h3>

            <div class="form-group">
                <label class="form-label">Article Title</label>
                <input type="text" id="title_en" name="title_en" class="form-input" value="<?= old('title_en', $blog['title_en'] ?? ''); ?>" placeholder="Enter article title">
            </div>

            <div class="form-group">
                <label class="form-label">Description 1 / Headline</label>
                <textarea id="description_1_en" name="description_1_en" class="form-textarea" rows="4" placeholder="Opening paragraph"><?= old('description_1_en', $blog['description_1_en'] ?? ''); ?></textarea>
            </div>

            <div class="form-group">
                <label class="form-label">Detailed Content</label>
                <textarea id="description_2_en" name="description_2_en" class="form-textarea" rows="12" placeholder="Detailed article content"><?= old('description_2_en', $blog['description_2_en'] ?? ''); ?></textarea>
            </div>
        </div>

        <div class="form-section">
            <h3 class="form-section-title">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="width: 20px; height: 20px; display: inline; vertical-align: middle; margin-right: 8px;">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9" />
                </svg>
                Versione Italiana
            </h3>

            <div class="form-group">
                <label class="form-label">Titolo dell'articolo</label>
                <input type="text" id="title_it" name="title_it" class="form-input" value="<?= old('title_it', $blog['title_it'] ?? ''); ?>" placeholder="Inserisci il titolo dell'articolo">
            </div>

            <div class="form-group">
                <label class="form-label">Descrizione 1 / Titolo Principale</label>
                <textarea id="description_1_it" name="description_1_it" class="form-textarea" rows="4" placeholder="Paragrafo di apertura"><?= old('description_1_it', $blog['description_1_it'] ?? ''); ?></textarea>
            </div>

            <div class="form-group">
                <label class="form-label">Contenuto Dettagliato</label>
                <textarea id="description_2_it" name="description_2_it" class="form-textarea" rows="12" placeholder="Contenuto dettagliato dell'articolo"><?= old('description_2_it', $blog['description_2_it'] ?? ''); ?></textarea>
            </div>
        </div>

        <div class="form-group">
            <div class="checkbox-group">
                <label>
                    <input type="checkbox" name="is_featured" value="1" <?= old('is_featured', $blog['is_featured'] ?? 0) == 1 ? 'checked' : ''; ?>>
                    Jadikan sebagai Master Headline
                </label>
            </div>
        </div>

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
                Perbarui Berita
            </button>
        </div>
    </form>
</div>

<div id="validationPopup" class="validation-popup"></div>

<?= $this->endSection(); ?>

<?= $this->section('scripts'); ?>
<script>
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

    const imageInput = document.getElementById('image_url');
    const uploadArea = document.getElementById('uploadArea');
    const uploadPlaceholder = document.getElementById('upload-placeholder');
    const previewContainer = document.getElementById('preview-container');
    const imagePreview = document.getElementById('image-preview');
    const fileNameSpan = document.getElementById('file-name');

    imageInput.addEventListener('change', function(event) {
        const file = event.target.files[0];
        
        if (file) {
            if (!file.type.startsWith('image/')) {
                showPopup('error', 'File Tidak Valid', 'File harus berupa gambar.');
                this.value = '';
                return;
            }
            
            const maxSize = 10 * 1024 * 1024;
            if (file.size > maxSize) {
                showPopup('error', 'File Terlalu Besar', 'Ukuran file maksimal 10MB. File Anda: ' + (file.size / 1024 / 1024).toFixed(2) + 'MB');
                this.value = '';
                return;
            }
            
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
        }
    });

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

    // Handle Form Submission Validation
    document.getElementById('blogForm').addEventListener('submit', function(e) {
        const title = document.getElementById('title').value.trim();
        const desc1 = document.getElementById('description_1').value.trim();

        if (!title || title.length < 5) {
            e.preventDefault();
            showPopup('error', 'Validasi Gagal', 'Judul artikel minimal 5 karakter.');
            document.getElementById('title').focus();
            return;
        }

        if (!desc1 || desc1.length < 10) {
            e.preventDefault();
            showPopup('error', 'Validasi Gagal', 'Deskripsi utama minimal 10 karakter.');
            document.getElementById('description_1').focus();
            return;
        }

        showPopup('warning', 'Memproses', 'Data sedang disimpan...');
    });

    // Helper Translate API
    async function fetchTranslation(text, targetLang) {
        if (!text || !text.trim()) return '';
        try {
            const res = await fetch(`https://api.mymemory.translated.net/get?q=${encodeURIComponent(text)}&langpair=id|${targetLang}`);
            const data = await res.json();
            return (data.responseData && data.responseData.translatedText) ? data.responseData.translatedText : text;
        } catch (error) {
            console.error('Translate Error:', error);
            return text;
        }
    }

    // Auto Translate Button Click
    document.getElementById('btnTranslate').addEventListener('click', async function() {
        const btn = this;
        const title = document.getElementById('title').value;
        const desc1 = document.getElementById('description_1').value;
        const desc2 = document.getElementById('description_2').value;

        if (!title && !desc1 && !desc2) {
            showPopup('warning', 'Peringatan', 'Harap isi minimal satu kolom Bahasa Indonesia sebelum menerjemahkan.');
            return;
        }

        const originalContent = btn.innerHTML;
        btn.disabled = true;
        btn.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="width: 16px; height: 16px; animation: spin 1s linear infinite;"><path stroke-linecap="round" stroke-linejoin="round" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" /></svg> Menerjemahkan...';
        
        try {
            // Translate English
            if (title) document.getElementById('title_en').value = await fetchTranslation(title, 'en');
            if (desc1) document.getElementById('description_1_en').value = await fetchTranslation(desc1, 'en');
            if (desc2) document.getElementById('description_2_en').value = await fetchTranslation(desc2, 'en');

            // Translate Italian
            if (title) document.getElementById('title_it').value = await fetchTranslation(title, 'it');
            if (desc1) document.getElementById('description_1_it').value = await fetchTranslation(desc1, 'it');
            if (desc2) document.getElementById('description_2_it').value = await fetchTranslation(desc2, 'it');

            showPopup('success', 'Berhasil', 'Semua kolom berhasil diterjemahkan!');
        } catch (error) {
            showPopup('error', 'Error', 'Terjadi kesalahan saat menghubungi API terjemahan.');
        } finally {
            btn.disabled = false;
            btn.innerHTML = originalContent;
        }
    });

    // Animasi Loading Spinner
    const style = document.createElement('style');
    style.textContent = `
        @keyframes spin {
            to { transform: rotate(360deg); }
        }
    `;
    document.head.appendChild(style);

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