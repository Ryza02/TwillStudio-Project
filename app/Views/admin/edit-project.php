<?= $this->extend('admin/layout/base'); ?>

<?= $this->section('title'); ?>Edit Project<?= $this->endSection(); ?>

<?= $this->section('styles'); ?>
<link rel="stylesheet" href="<?= base_url('assets/css/admin/projects.css'); ?>">
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>

<div class="form-wrapper">
    <div class="form-header">
        <h2>Edit Project</h2>
        <p>Perbarui informasi project <strong><?= esc($project['title_id'] ?? $project['title_en'] ?? 'Project'); ?></strong>.</p>
    </div>

    <form method="POST" action="<?= base_url('admin/project/edit/' . esc($project['id'])); ?>" enctype="multipart/form-data" id="projectForm">
        <?= csrf_field(); ?>

        <!-- Language Sections -->
        <div class="form-section">
            <!-- Indonesia -->
            <div class="form-panel">
                <div class="form-panel-header">
                    <h3 class="form-panel-title">🇮🇩 Bahasa Indonesia</h3>
                    <button type="button" class="form-panel-btn secondary" id="btn-to-id">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="width: 14px; height: 14px; display: inline; vertical-align: middle;">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Translate
                    </button>
                </div>

                <div class="form-group">
                    <label class="form-label">Judul Project <span class="required">*</span></label>
                    <input type="text" id="title_id" name="title_id" class="form-input" value="<?= old('title_id', $project['title_id'] ?? ''); ?>" required>
                </div>

                <div class="form-group">
                    <label class="form-label">Judul Opsional / Filosofi</label>
                    <input type="text" id="subtitle_id" name="subtitle_id" class="form-input" value="<?= old('subtitle_id', $project['subtitle_id'] ?? ''); ?>">
                </div>

                <div class="form-group">
                    <label class="form-label">Deskripsi Utama <span class="required">*</span></label>
                    <textarea id="description_1_id" name="description_1_id" class="form-textarea" rows="4" required><?= old('description_1_id', $project['description_1_id'] ?? ''); ?></textarea>
                </div>

                <div class="form-group">
                    <label class="form-label">Pendekatan Desain</label>
                    <textarea id="description_2_id" name="description_2_id" class="form-textarea" rows="4"><?= old('description_2_id', $project['description_2_id'] ?? ''); ?></textarea>
                </div>
            </div>

            <!-- English -->
            <div class="form-panel">
                <div class="form-panel-header">
                    <h3 class="form-panel-title">🇬🇧 English</h3>
                    <button type="button" class="form-panel-btn primary" id="btn-to-en">
                        Translate
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="width: 14px; height: 14px; display: inline; vertical-align: middle;">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </button>
                </div>

                <div class="form-group">
                    <label class="form-label">Project Title <span class="required">*</span></label>
                    <input type="text" id="title_en" name="title_en" class="form-input" value="<?= old('title_en', $project['title_en'] ?? ''); ?>" required>
                </div>

                <div class="form-group">
                    <label class="form-label">Optional Title / Philosophy</label>
                    <input type="text" id="subtitle_en" name="subtitle_en" class="form-input" value="<?= old('subtitle_en', $project['subtitle_en'] ?? ''); ?>">
                </div>

                <div class="form-group">
                    <label class="form-label">Main Description <span class="required">*</span></label>
                    <textarea id="description_1_en" name="description_1_en" class="form-textarea" rows="4" required><?= old('description_1_en', $project['description_1_en'] ?? ''); ?></textarea>
                </div>

                <div class="form-group">
                    <label class="form-label">Design Approach</label>
                    <textarea id="description_2_en" name="description_2_en" class="form-textarea" rows="4"><?= old('description_2_en', $project['description_2_en'] ?? ''); ?></textarea>
                </div>
            </div>
        </div>

        <!-- Global Data -->
        <h3 style="margin: 32px 0 20px 0; font-size: 16px; font-weight: 700; color: var(--onyx);">Data Global Project</h3>

        <div class="form-row">
            <div class="form-group">
                <label class="form-label">Lokasi <span class="required">*</span></label>
                <input type="text" id="location" name="location" class="form-input" value="<?= old('location', $project['location'] ?? ''); ?>" required>
            </div>
            <div class="form-group">
                <label class="form-label">Tahun Selesai <span class="required">*</span></label>
                <input type="number" id="year" name="year" class="form-input" value="<?= old('year', $project['year'] ?? date('Y')); ?>" min="2000" max="2099" required>
            </div>
        </div>

        <div class="form-group">
            <label class="form-label">Kategori <span class="required">*</span></label>
            <select id="category" name="category" class="form-select" required>
                <option value="">-- Pilih Kategori --</option>
                <?php foreach ($categories as $cat): ?>
                    <option value="<?= $cat['name']; ?>" <?= (old('category', $project['category'] ?? '') == $cat['name']) ? 'selected' : '' ?>>
                        <?= $cat['name']; ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <!-- Current Image -->
        <div class="form-group">
            <label class="form-label">Gambar Saat Ini</label>
            <?php if (!empty($project['image_url']) && is_file(FCPATH . $project['image_url'])): ?>
                <div class="current-image-preview">
                    <img src="<?= base_url(esc($project['image_url'])); ?>" alt="Current Image">
                    <p class="file-upload-hint">Gambar saat ini akan diganti jika Anda upload gambar baru.</p>
                </div>
            <?php else: ?>
                <div class="current-image-preview" style="background: var(--bg-hover); padding: 20px; border-radius: var(--radius-md); text-align: center;">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="width: 40px; height: 40px; color: var(--text-muted); margin: 0 auto 10px;">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    <p style="color: var(--text-muted); margin: 0;">Belum ada gambar</p>
                </div>
            <?php endif; ?>
        </div>

        <!-- Upload New Image -->
        <div class="form-group">
            <label class="form-label">Ganti Gambar (Opsional)</label>
            <div class="file-upload-wrapper">
                <input type="file" id="image_url" name="image_url" class="file-upload-input" accept="image/*">
                <label for="image_url" class="file-upload-label" id="fileUploadLabel">
                    <div class="file-upload-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <span class="file-upload-text">Klik untuk upload gambar baru</span>
                </label>
                <p class="file-upload-hint">Max 10MB. Format: JPG, JPEG, PNG, WEBP, GIF, SVG, BMP, dan semua format gambar</p>
            </div>
        </div>

        <div class="form-actions">
            <a href="<?= base_url('admin/projects'); ?>" class="btn btn-secondary">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
                Batal
            </a>
            <button type="submit" class="btn btn-primary">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                </svg>
                Perbarui Project
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
    // VALIDATION POPUP
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
    // FILE UPLOAD VALIDATION - 10MB, All Image Types
    // ============================================
    document.getElementById('image_url').addEventListener('change', function() {
        const fileLabel = document.getElementById('fileUploadLabel');
        const fileText = fileLabel.querySelector('.file-upload-text');
        
        if (this.files && this.files[0]) {
            const file = this.files[0];
            
            // ✅ VALIDASI UKURAN FILE - MAX 10MB
            const maxSize = 10 * 1024 * 1024; // 10MB in bytes
            if (file.size > maxSize) {
                showPopup('error', 'File Terlalu Besar', 
                    'Ukuran file maksimal 10MB. File Anda: ' + (file.size / 1024 / 1024).toFixed(2) + 'MB');
                this.value = '';
                fileText.textContent = 'Klik untuk upload gambar baru';
                fileLabel.classList.remove('has-file');
                return;
            }
            
            // ✅ VALIDASI TIPE FILE - SEMUA JENIS GAMBAR
            if (!file.type.startsWith('image/')) {
                showPopup('error', 'Bukan File Gambar', 
                    'File yang diunggah harus berupa gambar. Format yang diterima: JPG, JPEG, PNG, WEBP, GIF, SVG, BMP, dan format gambar lainnya.');
                this.value = '';
                fileText.textContent = 'Klik untuk upload gambar baru';
                fileLabel.classList.remove('has-file');
                return;
            }
            
            // File valid
            fileText.textContent = '✓ ' + file.name + ' (' + (file.size / 1024 / 1024).toFixed(2) + ' MB)';
            fileLabel.classList.add('has-file');
            showPopup('success', 'File Valid', 'Gambar siap diunggah: ' + file.name);
        } else {
            fileText.textContent = 'Klik untuk upload gambar baru';
            fileLabel.classList.remove('has-file');
        }
    });

    // ============================================
    // FORM VALIDATION
    // ============================================
    document.getElementById('projectForm').addEventListener('submit', function(e) {
        const titleId = document.getElementById('title_id').value.trim();
        const titleEn = document.getElementById('title_en').value.trim();
        const desc1Id = document.getElementById('description_1_id').value.trim();
        const desc1En = document.getElementById('description_1_en').value.trim();
        const location = document.getElementById('location').value.trim();
        const year = document.getElementById('year').value;
        const category = document.getElementById('category').value;

        // Validate required fields
        if (!titleId || !titleEn) {
            e.preventDefault();
            showPopup('error', 'Validasi Gagal', 'Judul project (ID & EN) wajib diisi.');
            return false;
        }

        if (!desc1Id || !desc1En) {
            e.preventDefault();
            showPopup('error', 'Validasi Gagal', 'Deskripsi utama (ID & EN) wajib diisi.');
            return false;
        }

        if (!location) {
            e.preventDefault();
            showPopup('error', 'Validasi Gagal', 'Lokasi project wajib diisi.');
            return false;
        }

        if (!year || year < 2000 || year > 2099) {
            e.preventDefault();
            showPopup('error', 'Validasi Gagal', 'Tahun harus antara 2000-2099.');
            return false;
        }

        if (!category) {
            e.preventDefault();
            showPopup('error', 'Validasi Gagal', 'Kategori project wajib dipilih.');
            return false;
        }

        // Check if image is being uploaded, validate if so
        const imageInput = document.getElementById('image_url');
        if (imageInput.files && imageInput.files[0]) {
            const file = imageInput.files[0];
            const maxSize = 10 * 1024 * 1024;
            
            if (file.size > maxSize) {
                e.preventDefault();
                showPopup('error', 'Validasi Gagal', 'Ukuran gambar maksimal 10MB.');
                return false;
            }
            
            if (!file.type.startsWith('image/')) {
                e.preventDefault();
                showPopup('error', 'Validasi Gagal', 'File harus berupa gambar.');
                return false;
            }
        }

        // Show processing message
        showPopup('warning', 'Memproses', 'Data sedang diperbarui...');
    });

    // ============================================
    // AUTO TRANSLATE
    // ============================================
    async function translateText(text, sourceLang, targetLang) {
        if (!text.trim()) return '';
        
        const url = `https://translate.googleapis.com/translate_a/single?client=gtx&sl=${sourceLang}&tl=${targetLang}&dt=t&q=${encodeURIComponent(text)}`;
        
        try {
            const response = await fetch(url);
            const data = await response.json();
            
            if (data && data[0]) {
                let translated = '';
                data[0].forEach(item => {
                    if (item[0]) translated += item[0];
                });
                return translated;
            }
            return '';
        } catch (error) {
            showPopup('error', 'Translate Gagal', 'Gagal menerjemahkan. Cek koneksi internet.');
            return '';
        }
    }

    const fields = ['title', 'subtitle', 'description_1', 'description_2'];

    // ID to EN
    document.getElementById('btn-to-en').addEventListener('click', async function() {
        const btn = this;
        const originalText = btn.innerHTML;
        btn.disabled = true;
        btn.innerHTML = 'Processing...';
        
        for (let field of fields) {
            const valID = document.getElementById(field + '_id').value;
            if (valID) {
                const translated = await translateText(valID, 'id', 'en');
                if (translated) {
                    document.getElementById(field + '_en').value = translated;
                }
            }
        }
        
        btn.disabled = false;
        btn.innerHTML = originalText;
        showPopup('success', 'Berhasil', 'Terjemahan selesai!');
    });

    // EN to ID
    document.getElementById('btn-to-id').addEventListener('click', async function() {
        const btn = this;
        const originalText = btn.innerHTML;
        btn.disabled = true;
        btn.innerHTML = 'Processing...';
        
        for (let field of fields) {
            const valEN = document.getElementById(field + '_en').value;
            if (valEN) {
                const translated = await translateText(valEN, 'en', 'id');
                if (translated) {
                    document.getElementById(field + '_id').value = translated;
                }
            }
        }
        
        btn.disabled = false;
        btn.innerHTML = originalText;
        showPopup('success', 'Berhasil', 'Terjemahan selesai!');
    });

    // ============================================
    // SHOW FLASHDATA
    // ============================================
    <?php if (session()->getFlashdata('success')): ?>
        showPopup('success', 'Berhasil', '<?= esc(session()->getFlashdata('success')); ?>');
    <?php endif; ?>

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