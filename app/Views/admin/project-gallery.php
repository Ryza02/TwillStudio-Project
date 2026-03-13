<?= $this->extend('admin/layout/base'); ?>

<?= $this->section('title'); ?><?= lang('Sidemin.manageGallery'); ?> - <?= esc($project['title_id'] ?? $project['title']); ?><?= $this->endSection(); ?>

<?= $this->section('styles'); ?>
<link rel="stylesheet" href="<?= base_url('assets/css/admin/gallery.css'); ?>">
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
<style>
    .gallery-item { cursor: grab; }
    .gallery-item:active { cursor: grabbing; }
    .sortable-ghost { opacity: 0.4; border: 2px dashed var(--primary); }
    .reorder-handle {
        position: absolute;
        top: 10px;
        left: 10px;
        background: rgba(0,0,0,0.5);
        color: white;
        padding: 5px;
        border-radius: 4px;
        z-index: 10;
        pointer-events: none;
    }
</style>
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>

<div class="page-header">
    <div>
        <h2 class="page-title"><?= lang('Sidemin.galleryTitle'); ?>: <?= esc($project['title_id'] ?? $project['title']); ?></h2>
        <p class="page-subtitle"><?= lang('Sidemin.gallerySubtitle'); ?></p>
    </div>
    <a href="<?= base_url('admin/gallery'); ?>" class="btn btn-secondary">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
        </svg>
        <?= lang('Sidemin.back'); ?>
    </a>
</div>

<div class="upload-section">
    <h3 class="form-section-title">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="width: 20px; height: 20px; display: inline; vertical-align: middle; margin-right: 8px;">
            <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
        </svg>
        <?= lang('Sidemin.uploadNewPhoto'); ?>
    </h3>

    <form action="<?= base_url('admin/gallery/upload/' . $project['id']); ?>" method="POST" enctype="multipart/form-data" id="galleryForm">
        <?= csrf_field(); ?>
        <div class="upload-area" id="uploadArea">
            <input type="file" id="images" name="images[]" multiple accept="image/*" required>
            <div id="upload-placeholder">
                <div class="upload-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                </div>
                <div class="upload-text">
                    <strong><?= lang('Sidemin.clickOrDragImage'); ?></strong>
                    <p class="upload-hint"><?= lang('Sidemin.uploadHintMulti'); ?></p>
                </div>
            </div>
            <div id="preview-container" class="upload-preview"></div>
        </div>
        <div style="margin-top: 20px; text-align: right;">
            <button type="submit" class="btn btn-primary">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                </svg>
                <?= lang('Sidemin.uploadPhotoBtn'); ?>
            </button>
        </div>
    </form>
</div>

<h3 class="form-section-title">
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="width: 20px; height: 20px; display: inline; vertical-align: middle; margin-right: 8px;">
        <path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
    </svg>
    <?= lang('Sidemin.savedPhotos'); ?> (<?= count($galleries); ?>) - <small><?= lang('Sidemin.dragToReorder'); ?></small>
</h3>

<div class="gallery-grid" id="sortable-gallery">
    <?php if (!empty($galleries)): ?>
        <?php foreach ($galleries as $img): ?>
            <div class="gallery-item" data-id="<?= $img['id']; ?>">
                <div class="reorder-handle">
                    <svg style="width:16px;height:16px" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8h16M4 16h16" />
                    </svg>
                </div>
                <img src="<?= base_url(esc($img['image_url'])); ?>" alt="Gallery" loading="lazy">
                <div class="gallery-item-overlay">
                    <button type="button" class="gallery-action-btn btn-delete-gallery" data-id="<?= $img['id']; ?>" title="<?= lang('Sidemin.delete'); ?>">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                    </button>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="empty-state" style="grid-column: 1 / -1;">
            <div class="empty-state-icon">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
            </div>
            <h4 class="empty-state-title"><?= lang('Sidemin.noPhotosYet'); ?></h4>
            <p class="empty-state-desc"><?= lang('Sidemin.uploadPhotosDesc'); ?></p>
        </div>
    <?php endif; ?>
</div>

<div id="deleteModal" class="custom-modal">
    <div class="custom-modal-dialog" style="max-width: 420px;">
        <div class="custom-modal-content" style="padding: 32px;">
            <div style="text-align: center; margin-bottom: 24px;">
                <div class="warning-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                </div>
                <h3 style="margin: 0 0 8px 0; color: var(--onyx); font-size: 20px; font-weight: 700;"><?= lang('Sidemin.deletePhotoConfirm'); ?></h3>
                <p style="margin: 0; color: var(--text-secondary); font-size: 14px;"><?= lang('Sidemin.cannotBeUndone'); ?></p>
            </div>
            <div style="display: flex; gap: 12px;">
                <button id="cancelDelete" class="btn btn-secondary" style="flex: 1;"><?= lang('Sidemin.cancel'); ?></button>
                <button id="confirmDelete" class="btn" style="flex: 1; background: var(--error); color: #ffffff;">
                    <span id="deleteBtnText"><?= lang('Sidemin.yesDelete'); ?></span>
                    <span id="deleteBtnLoading" style="display: none;"><?= lang('Sidemin.deleting'); ?></span>
                </button>
            </div>
        </div>
    </div>
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
        const popupHTML = `<div class="popup-message ${type}"><span class="popup-icon">${icons[type]}</span><div class="popup-content"><p class="popup-title">${title}</p><p class="popup-message-text">${message}</p></div><button class="popup-close" onclick="this.parentElement.remove()"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" /></svg></button></div>`;
        popup.insertAdjacentHTML('beforeend', popupHTML);
        setTimeout(() => {
            const firstPopup = popup.querySelector('.popup-message');
            if (firstPopup) {
                firstPopup.style.animation = 'slideInRight 0.4s ease reverse';
                setTimeout(() => firstPopup.remove(), 400);
            }
        }, 5000);
    }

    function openModal(modalId) {
        const modal = document.getElementById(modalId);
        if (modal) {
            modal.classList.add('show');
            modal.style.display = 'flex';
            document.body.style.overflow = 'hidden';
        }
    }

    function closeModal(modalId) {
        const modal = document.getElementById(modalId);
        if (modal) {
            modal.classList.remove('show');
            setTimeout(() => modal.style.display = 'none', 300);
            document.body.style.overflow = '';
        }
    }

    document.querySelectorAll('.custom-modal').forEach(modal => {
        modal.addEventListener('click', function(e) { if (e.target === this) closeModal(this.id); });
    });

    const el = document.getElementById('sortable-gallery');
    if (el) {
        Sortable.create(el, {
            animation: 150,
            ghostClass: 'sortable-ghost',
            onEnd: function() {
                const items = el.querySelectorAll('.gallery-item');
                const order = Array.from(items).map(item => item.getAttribute('data-id'));
                
                fetch('<?= base_url('admin/gallery/reorder'); ?>', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest',
                        '<?= csrf_header() ?>': '<?= csrf_hash() ?>'
                    },
                    body: JSON.stringify({ order: order })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status) showPopup('success', '<?= lang('Sidemin.success'); ?>', '<?= lang('Sidemin.orderUpdated'); ?>');
                })
                .catch(err => showPopup('error', 'Error', 'Failed to update order'));
            }
        });
    }

    const imageInput = document.getElementById('images');
    const uploadArea = document.getElementById('uploadArea');
    const uploadPlaceholder = document.getElementById('upload-placeholder');
    const previewContainer = document.getElementById('preview-container');

    imageInput.addEventListener('change', function(event) {
        const files = event.target.files;
        if (files && files.length > 0) {
            previewContainer.innerHTML = '';
            previewContainer.classList.add('show');
            uploadPlaceholder.style.display = 'none';
            uploadArea.style.borderColor = 'var(--onyx)';
            uploadArea.style.background = '#ffffff';
            uploadArea.style.borderStyle = 'solid';
            let validCount = 0;
            let invalidCount = 0;
            Array.from(files).forEach((file) => {
                if (!file.type.startsWith('image/') || file.size > 10 * 1024 * 1024) {
                    invalidCount++;
                    return;
                }
                validCount++;
                const reader = new FileReader();
                reader.onload = function(e) {
                    const preview = document.createElement('div');
                    preview.className = 'gallery-preview-item';
                    preview.innerHTML = `<img src="${e.target.result}" alt="Preview"><span class="file-name">${file.name}</span><span class="file-size">${(file.size / 1024 / 1024).toFixed(2)} MB</span>`;
                    previewContainer.appendChild(preview);
                };
                reader.readAsDataURL(file);
            });
            if (invalidCount > 0) showPopup('warning', '<?= lang('Sidemin.warning'); ?>', `${invalidCount} <?= lang('Sidemin.invalidFilesDesc'); ?>`);
            if (validCount > 0) showPopup('success', '<?= lang('Sidemin.validFile'); ?>', `${validCount} <?= lang('Sidemin.imagesReadyToUpload'); ?>`);
        }
    });

    uploadArea.addEventListener('dragover', (e) => { e.preventDefault(); uploadArea.style.background = 'var(--bg-hover)'; });
    uploadArea.addEventListener('dragleave', (e) => { e.preventDefault(); if (!imageInput.value) uploadArea.style.background = 'var(--bg-input)'; });
    uploadArea.addEventListener('drop', (e) => {
        e.preventDefault();
        const files = e.dataTransfer.files;
        if (files && files.length > 0) { imageInput.files = files; imageInput.dispatchEvent(new Event('change')); }
    });

    document.getElementById('galleryForm').addEventListener('submit', function(e) {
        const files = imageInput.files;
        if (!files || files.length === 0) { e.preventDefault(); showPopup('error', '<?= lang('Sidemin.validationFailed'); ?>', '<?= lang('Admin.selectMinOneImage'); ?>'); return false; }
        showPopup('warning', '<?= lang('Sidemin.processing'); ?>', `<?= lang('Sidemin.uploading'); ?>...`);
    });

    let deleteGalleryId = null;
    document.querySelectorAll('.btn-delete-gallery').forEach(btn => {
        btn.addEventListener('click', function() {
            deleteGalleryId = this.getAttribute('data-id');
            openModal('deleteModal');
        });
    });

    document.getElementById('confirmDelete').addEventListener('click', function() {
        if (!deleteGalleryId) return;
        this.disabled = true;
        document.getElementById('deleteBtnText').style.display = 'none';
        document.getElementById('deleteBtnLoading').style.display = 'inline';
        fetch('<?= base_url('admin/gallery/delete/') ?>' + deleteGalleryId, { method: 'GET', headers: { 'X-Requested-With': 'XMLHttpRequest' } })
        .then(response => {
            if (response.ok) {
                const item = document.querySelector(`.gallery-item[data-id="${deleteGalleryId}"]`);
                if (item) {
                    item.style.opacity = '0';
                    setTimeout(() => item.remove(), 300);
                }
                closeModal('deleteModal');
                showPopup('success', '<?= lang('Sidemin.success'); ?>', '<?= lang('Sidemin.photoDeleted'); ?>');
            }
        })
        .catch(() => showPopup('error', 'Gagal', 'Error'));
    });

    <?php if (session()->getFlashdata('success')): ?> showPopup('success', '<?= lang('Sidemin.success'); ?>', '<?= esc(session()->getFlashdata('success')); ?>'); <?php endif; ?>
</script>
<?= $this->endSection(); ?>