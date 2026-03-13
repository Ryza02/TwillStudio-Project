<?= $this->extend('admin/layout/base'); ?>

<?= $this->section('title'); ?><?= lang('Sidemin.add_project'); ?><?= $this->endSection(); ?>

<?= $this->section('styles'); ?>
<link rel="stylesheet" href="<?= base_url('assets/css/admin/projects.css'); ?>">
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>

<div class="form-wrapper">
    <div class="form-header">
        <h2><?= lang('Sidemin.add_new_project'); ?></h2>
        <p><?= lang('Sidemin.fill_form_project'); ?></p>
    </div>

    <form method="POST" action="<?= base_url('admin/project/create'); ?>" enctype="multipart/form-data" id="projectForm">
        <?= csrf_field(); ?>

        <div class="form-section">
            <div class="form-panel">
                <div class="form-panel-header">
                    <h3 class="form-panel-title">🇮🇩 Bahasa Indonesia</h3>
                    <button type="button" class="form-panel-btn secondary" id="btn-to-id">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="width: 14px; height: 14px; display: inline; vertical-align: middle;">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        <?= lang('Sidemin.translate_from_en'); ?>
                    </button>
                </div>

                <div class="form-group">
                    <label class="form-label">Judul Project <span class="required">*</span></label>
                    <input type="text" id="title_id" name="title_id" class="form-input" value="<?= old('title_id'); ?>" required>
                </div>

                <div class="form-group">
                    <label class="form-label">Judul Opsional / Filosofi</label>
                    <input type="text" id="subtitle_id" name="subtitle_id" class="form-input" value="<?= old('subtitle_id'); ?>">
                </div>

                <div class="form-group">
                    <label class="form-label">Deskripsi Utama <span class="required">*</span></label>
                    <textarea id="description_1_id" name="description_1_id" class="form-textarea" rows="4" required><?= old('description_1_id'); ?></textarea>
                </div>

                <div class="form-group">
                    <label class="form-label">Pendekatan Desain</label>
                    <textarea id="description_2_id" name="description_2_id" class="form-textarea" rows="4"><?= old('description_2_id'); ?></textarea>
                </div>
            </div>

            <div class="form-panel">
                <div class="form-panel-header">
                    <h3 class="form-panel-title">🇬🇧 English</h3>
                    <button type="button" class="form-panel-btn primary" id="btn-to-en">
                        <?= lang('Sidemin.translate_from_id'); ?>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="width: 14px; height: 14px; display: inline; vertical-align: middle;">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </button>
                </div>

                <div class="form-group">
                    <label class="form-label">Project Title <span class="required">*</span></label>
                    <input type="text" id="title_en" name="title_en" class="form-input" value="<?= old('title_en'); ?>" required>
                </div>

                <div class="form-group">
                    <label class="form-label">Optional Title / Philosophy</label>
                    <input type="text" id="subtitle_en" name="subtitle_en" class="form-input" value="<?= old('subtitle_en'); ?>">
                </div>

                <div class="form-group">
                    <label class="form-label">Main Description <span class="required">*</span></label>
                    <textarea id="description_1_en" name="description_1_en" class="form-textarea" rows="4" required><?= old('description_1_en'); ?></textarea>
                </div>

                <div class="form-group">
                    <label class="form-label">Design Approach</label>
                    <textarea id="description_2_en" name="description_2_en" class="form-textarea" rows="4"><?= old('description_2_en'); ?></textarea>
                </div>
            </div>

            <div class="form-panel">
                <div class="form-panel-header">
                    <h3 class="form-panel-title">🇮🇹 Italiano</h3>
                    <button type="button" class="form-panel-btn primary" id="btn-to-it" style="background-color: #10b981; border-color: #10b981;">
                        <?= lang('Sidemin.translate_from_id'); ?>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="width: 14px; height: 14px; display: inline; vertical-align: middle;">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </button>
                </div>

                <div class="form-group">
                    <label class="form-label">Titolo del Progetto <span class="required">*</span></label>
                    <input type="text" id="title_it" name="title_it" class="form-input" value="<?= old('title_it'); ?>" required>
                </div>

                <div class="form-group">
                    <label class="form-label">Titolo Opzionale / Filosofia</label>
                    <input type="text" id="subtitle_it" name="subtitle_it" class="form-input" value="<?= old('subtitle_it'); ?>">
                </div>

                <div class="form-group">
                    <label class="form-label">Descrizione Principale <span class="required">*</span></label>
                    <textarea id="description_1_it" name="description_1_it" class="form-textarea" rows="4" required><?= old('description_1_it'); ?></textarea>
                </div>

                <div class="form-group">
                    <label class="form-label">Approccio al Design</label>
                    <textarea id="description_2_it" name="description_2_it" class="form-textarea" rows="4"><?= old('description_2_it'); ?></textarea>
                </div>
            </div>
        </div>

        <h3 style="margin: 32px 0 20px 0; font-size: 16px; font-weight: 700; color: var(--onyx);"><?= lang('Sidemin.global_project_data'); ?></h3>

        <div class="form-row">
            <div class="form-group">
                <label class="form-label"><?= lang('Sidemin.location'); ?> <span class="required">*</span></label>
                <input type="text" id="location" name="location" class="form-input" value="<?= old('location'); ?>" required>
            </div>
            <div class="form-group">
                <label class="form-label"><?= lang('Sidemin.completion_year'); ?> <span class="required">*</span></label>
                <input type="number" id="year" name="year" class="form-input" value="<?= old('year', date('Y')); ?>" min="2000" max="2099" required>
            </div>
        </div>

        <div class="form-group">
            <label class="form-label"><?= lang('Sidemin.category'); ?> <span class="required">*</span></label>
            <select id="category" name="category" class="form-select" required>
                <option value=""><?= lang('Sidemin.select_category'); ?></option>
                <?php foreach ($categories as $cat): ?>
                    <option value="<?= $cat['name']; ?>" <?= (old('category') == $cat['name']) ? 'selected' : '' ?>>
                        <?= $cat['name']; ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label class="form-label"><?= lang('Sidemin.main_image'); ?> <span class="required">*</span></label>
            <div class="file-upload-wrapper">
                <input type="file" id="image_url" name="image_url" class="file-upload-input" accept="image/*" required>
                <label for="image_url" class="file-upload-label" id="fileUploadLabel">
                    <div class="file-upload-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <span class="file-upload-text"><?= lang('Sidemin.drag_drop_image'); ?></span>
                </label>
                <p class="file-upload-hint"><?= lang('Sidemin.max_image_size'); ?></p>
            </div>
        </div>

        <div class="form-actions">
            <a href="<?= base_url('admin/projects'); ?>" class="btn btn-secondary">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
                <?= lang('Sidemin.cancel'); ?>
            </a>
            <button type="submit" class="btn btn-primary">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                </svg>
                <?= lang('Sidemin.save_project'); ?>
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

    document.getElementById('image_url').addEventListener('change', function() {
        const fileLabel = document.getElementById('fileUploadLabel');
        const fileText = fileLabel.querySelector('.file-upload-text');
        
        if (this.files && this.files[0]) {
            const file = this.files[0];
            const maxSize = 10 * 1024 * 1024;
            
            if (file.size > maxSize) {
                showPopup('error', '<?= lang('Sidemin.file_too_large') ?>', '<?= lang('Sidemin.max_size_10mb') ?>');
                this.value = '';
                fileText.textContent = '<?= lang('Sidemin.drag_drop_image') ?>';
                fileLabel.classList.remove('has-file');
                return;
            }
            
            if (!file.type.startsWith('image/')) {
                showPopup('error', '<?= lang('Sidemin.not_image_file') ?>', '<?= lang('Sidemin.upload_valid_image') ?>');
                this.value = '';
                fileText.textContent = '<?= lang('Sidemin.drag_drop_image') ?>';
                fileLabel.classList.remove('has-file');
                return;
            }
            
            fileText.textContent = '✓ ' + file.name + ' (' + (file.size / 1024 / 1024).toFixed(2) + ' MB)';
            fileLabel.classList.add('has-file');
            showPopup('success', '<?= lang('Sidemin.file_valid') ?>', '<?= lang('Sidemin.image_ready') ?>');
        } else {
            fileText.textContent = '<?= lang('Sidemin.drag_drop_image') ?>';
            fileLabel.classList.remove('has-file');
        }
    });

    async function handleTranslate(btnId, fromLang, toLang) {
        const btn = document.getElementById(btnId);
        const originalHtml = btn.innerHTML;
        btn.disabled = true;
        btn.innerHTML = '<?= lang('Sidemin.processing') ?>';

        const payload = {
            title: document.getElementById('title_' + fromLang).value,
            subtitle: document.getElementById('subtitle_' + fromLang).value,
            description_1: document.getElementById('description_1_' + fromLang).value,
            description_2: document.getElementById('description_2_' + fromLang).value,
            target_lang: toLang
        };

        try {
            const response = await fetch('<?= base_url('admin/translate') ?>', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: JSON.stringify(payload)
            });
            const res = await response.json();
            
            if (res.success) {
                if(res.data.title !== undefined) document.getElementById('title_' + toLang).value = res.data.title;
                if(res.data.subtitle !== undefined) document.getElementById('subtitle_' + toLang).value = res.data.subtitle;
                if(res.data.description_1 !== undefined) document.getElementById('description_1_' + toLang).value = res.data.description_1;
                if(res.data.description_2 !== undefined) document.getElementById('description_2_' + toLang).value = res.data.description_2;
                showPopup('success', '<?= lang('Sidemin.success') ?>', '<?= lang('Sidemin.translation_done') ?> ' + toLang.toUpperCase() + '!');
            } else {
                showPopup('error', '<?= lang('Sidemin.translation_failed') ?>', res.message || '<?= lang('Sidemin.server_error') ?>');
            }
        } catch (error) {
            showPopup('error', '<?= lang('Sidemin.translation_failed') ?>', '<?= lang('Sidemin.server_unreachable') ?>');
        }

        btn.disabled = false;
        btn.innerHTML = originalHtml;
    }

    document.getElementById('btn-to-en').addEventListener('click', () => handleTranslate('btn-to-en', 'id', 'en'));
    document.getElementById('btn-to-it').addEventListener('click', () => handleTranslate('btn-to-it', 'id', 'it'));
    document.getElementById('btn-to-id').addEventListener('click', () => handleTranslate('btn-to-id', 'en', 'id'));

    document.getElementById('projectForm').addEventListener('submit', function(e) {
        const titleId = document.getElementById('title_id').value.trim();
        const titleEn = document.getElementById('title_en').value.trim();
        const titleIt = document.getElementById('title_it').value.trim();
        const desc1Id = document.getElementById('description_1_id').value.trim();
        const desc1En = document.getElementById('description_1_en').value.trim();
        const desc1It = document.getElementById('description_1_it').value.trim();
        const location = document.getElementById('location').value.trim();
        const year = document.getElementById('year').value;
        const category = document.getElementById('category').value;
        const image = document.getElementById('image_url').files[0];

        if (!titleId || !titleEn || !titleIt) {
            e.preventDefault();
            showPopup('error', '<?= lang('Sidemin.validation_failed') ?>', '<?= lang('Sidemin.titles_required') ?>');
            return false;
        }

        if (!desc1Id || !desc1En || !desc1It) {
            e.preventDefault();
            showPopup('error', '<?= lang('Sidemin.validation_failed') ?>', '<?= lang('Sidemin.descriptions_required') ?>');
            return false;
        }

        if (!location || !year || !category || !image) {
            e.preventDefault();
            showPopup('error', '<?= lang('Sidemin.validation_failed') ?>', '<?= lang('Sidemin.global_data_required') ?>');
            return false;
        }

        showPopup('warning', '<?= lang('Sidemin.processing') ?>', '<?= lang('Sidemin.data_being_saved') ?>');
    });

    <?php if (session()->getFlashdata('error')): ?>
        showPopup('error', '<?= lang('Sidemin.error') ?>', '<?= esc(session()->getFlashdata('error')); ?>');
    <?php endif; ?>

    <?php $errors = session()->getFlashdata('errors'); ?>
    <?php if (is_array($errors) && !empty($errors)): ?>
        <?php foreach ($errors as $err): ?>
            showPopup('error', '<?= lang('Sidemin.validation_failed') ?>', '<?= esc($err); ?>');
        <?php endforeach; ?>
    <?php endif; ?>
</script>
<?= $this->endSection(); ?>