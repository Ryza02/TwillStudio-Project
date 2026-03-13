<?= $this->extend('admin/layout/base'); ?>

<?= $this->section('title'); ?><?= lang('Sidemin.manage_categories'); ?><?= $this->endSection(); ?>

<?= $this->section('styles'); ?>
<link rel="stylesheet" href="<?= base_url('assets/css/admin/categories.css'); ?>">
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>

<div class="page-header">
    <div>
        <h2 class="page-title"><?= lang('Sidemin.manage_categories'); ?></h2>
        <p class="page-subtitle"><?= lang('Sidemin.category_subtitle'); ?></p>
    </div>
    <button type="button" class="btn btn-primary" id="btnAddCategory">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
        </svg>
        <?= lang('Sidemin.add_category'); ?>
    </button>
</div>

<div id="addCategoryModal" class="custom-modal">
    <div class="custom-modal-dialog">
        <div class="custom-modal-content">
            <form action="<?= base_url('admin/categories/store'); ?>" method="POST" id="addCategoryForm">
                <?= csrf_field(); ?>
                <div class="modal-header">
                    <h5 class="modal-title"><?= lang('Sidemin.add_new_category'); ?></h5>
                    <button type="button" class="btn-close" data-modal-close="addCategoryModal"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="form-label"><?= lang('Sidemin.category_name_id'); ?> <span class="required">*</span></label>
                        <div style="display: flex; gap: 8px;">
                            <input type="text" name="name" id="create_name" class="form-input" required>
                            <button type="button" id="btnTranslateCreate" class="btn btn-secondary" style="white-space: nowrap;">
                                <?= lang('Sidemin.translate'); ?>
                            </button>
                        </div>
                    </div>
                    <div class="form-group" style="margin-top: 15px;">
                        <label class="form-label"><?= lang('Sidemin.category_name_en'); ?> <span class="required">*</span></label>
                        <input type="text" name="name_en" id="create_name_en" class="form-input" required>
                    </div>
                    <div class="form-group" style="margin-top: 15px;">
                        <label class="form-label"><?= lang('Sidemin.category_name_it'); ?> <span class="required">*</span></label>
                        <input type="text" name="name_it" id="create_name_it" class="form-input" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-modal-close="addCategoryModal"><?= lang('Sidemin.cancel'); ?></button>
                    <button type="submit" class="btn btn-primary"><?= lang('Sidemin.save_category'); ?></button>
                </div>
            </form>
        </div>
    </div>
</div>

<div id="editCategoryModal" class="custom-modal">
    <div class="custom-modal-dialog">
        <div class="custom-modal-content">
            <form action="<?= base_url('admin/categories/update'); ?>" method="POST" id="editCategoryForm">
                <?= csrf_field(); ?>
                <input type="hidden" name="id" id="edit_id">
                <div class="modal-header">
                    <h5 class="modal-title"><?= lang('Sidemin.edit_category'); ?></h5>
                    <button type="button" class="btn-close" data-modal-close="editCategoryModal"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="form-label"><?= lang('Sidemin.category_name_id'); ?> <span class="required">*</span></label>
                        <div style="display: flex; gap: 8px;">
                            <input type="text" name="name" id="edit_name" class="form-input" required>
                            <button type="button" id="btnTranslateEdit" class="btn btn-secondary" style="white-space: nowrap;">
                                <?= lang('Sidemin.translate'); ?>
                            </button>
                        </div>
                    </div>
                    <div class="form-group" style="margin-top: 15px;">
                        <label class="form-label"><?= lang('Sidemin.category_name_en'); ?> <span class="required">*</span></label>
                        <input type="text" name="name_en" id="edit_name_en" class="form-input" required>
                    </div>
                    <div class="form-group" style="margin-top: 15px;">
                        <label class="form-label"><?= lang('Sidemin.category_name_it'); ?> <span class="required">*</span></label>
                        <input type="text" name="name_it" id="edit_name_it" class="form-input" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-modal-close="editCategoryModal"><?= lang('Sidemin.cancel'); ?></button>
                    <button type="submit" class="btn btn-primary"><?= lang('Sidemin.update_category'); ?></button>
                </div>
            </form>
        </div>
    </div>
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
                <h3 style="margin: 0 0 8px 0; color: var(--onyx); font-size: 20px; font-weight: 700;"><?= lang('Sidemin.delete_category_confirm'); ?></h3>
                <p style="margin: 0; color: var(--text-secondary); font-size: 14px;"><?= lang('Sidemin.action_cannot_be_undone'); ?></p>
            </div>
            <div class="info-box">
                <p class="info-label"><?= lang('Sidemin.category_to_delete'); ?></p>
                <p id="deleteCategoryName" class="info-value"></p>
            </div>
            <div class="warning-box">
                <p><strong>⚠️ <?= lang('Sidemin.warning_label'); ?>:</strong> <?= lang('Sidemin.category_delete_warning'); ?></p>
            </div>
            <div style="display: flex; gap: 12px;">
                <button id="cancelDelete" class="btn btn-secondary" style="flex: 1;"><?= lang('Sidemin.cancel'); ?></button>
                <button id="confirmDelete" class="btn" style="flex: 1; background: var(--error); color: #ffffff;">
                    <span id="deleteBtnText"><?= lang('Sidemin.yes_delete'); ?></span>
                    <span id="deleteBtnLoading" style="display: none;"><?= lang('Sidemin.deleting'); ?></span>
                </button>
            </div>
        </div>
    </div>
</div>

<div class="table-container">
    <table class="table">
        <thead>
            <tr>
                <th style="width: 80px;"><?= lang('Sidemin.table_no'); ?></th>
                <th><?= lang('Sidemin.table_category_id'); ?></th>
                <th><?= lang('Sidemin.table_category_en'); ?></th>
                <th><?= lang('Sidemin.table_category_it'); ?></th>
                <th style="width: 150px; text-align: right;"><?= lang('Sidemin.table_actions'); ?></th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($categories)): ?>
                <?php $i = 1; foreach ($categories as $cat): ?>
                    <tr>
                        <td>
                            <span style="display: inline-flex; align-items: center; justify-content: center; width: 32px; height: 32px; background: var(--bg-hover); border-radius: var(--radius-sm); font-weight: 600; font-size: 13px; color: var(--text-secondary);">
                                <?= $i++; ?>
                            </span>
                        </td>
                        <td>
                            <h4 class="table-title" style="margin: 0;"><?= esc($cat['name'] ?? '-'); ?></h4>
                        </td>
                        <td>
                            <span class="status-badge draft">
                                <?= esc($cat['name_en'] ?? '-'); ?>
                            </span>
                        </td>
                        <td>
                            <span class="status-badge draft" style="background: #eef2ff; color: #4f46e5;">
                                <?= esc($cat['name_it'] ?? '-'); ?>
                            </span>
                        </td>
                        <td>
                            <div class="table-actions">
                                <button type="button" 
                                        class="table-action-btn btn-edit-category" 
                                        data-id="<?= $cat['id']; ?>" 
                                        data-name-id="<?= esc($cat['name'] ?? ''); ?>"
                                        data-name-en="<?= esc($cat['name_en'] ?? ''); ?>"
                                        data-name-it="<?= esc($cat['name_it'] ?? ''); ?>"
                                        title="<?= lang('Sidemin.edit_category'); ?>">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                </button>
                                <button type="button" 
                                        class="table-action-btn delete btn-delete-category" 
                                        data-id="<?= $cat['id']; ?>" 
                                        data-name="<?= esc($cat['name'] ?? ''); ?>"
                                        title="<?= lang('Sidemin.delete_category'); ?>">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5">
                        <div class="empty-state">
                            <div class="empty-state-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                                </svg>
                            </div>
                            <h4 class="empty-state-title"><?= lang('Sidemin.no_category_yet'); ?></h4>
                            <p class="empty-state-desc"><?= lang('Sidemin.start_adding_category'); ?></p>
                            <button type="button" class="btn btn-primary" id="btnAddCategoryEmpty">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                                </svg>
                                <?= lang('Sidemin.add_category'); ?>
                            </button>
                        </div>
                    </td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<div id="validationPopup" class="validation-popup"></div>

<?= $this->endSection(); ?>

<?= $this->section('scripts'); ?>
<script>
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
        setTimeout(() => {
            modal.style.display = 'none';
        }, 300);
        document.body.style.overflow = '';
    }
}

document.querySelectorAll('.custom-modal').forEach(modal => {
    modal.addEventListener('click', function(e) {
        if (e.target === this) {
            closeModal(this.id);
        }
    });
});

document.querySelectorAll('[data-modal-close]').forEach(btn => {
    btn.addEventListener('click', function() {
        const modalId = this.getAttribute('data-modal-close');
        closeModal(modalId);
    });
});

const btnAddCategory = document.getElementById('btnAddCategory');
if (btnAddCategory) {
    btnAddCategory.addEventListener('click', function() {
        openModal('addCategoryModal');
    });
}

const btnAddCategoryEmpty = document.getElementById('btnAddCategoryEmpty');
if (btnAddCategoryEmpty) {
    btnAddCategoryEmpty.addEventListener('click', function() {
        openModal('addCategoryModal');
    });
}

const addCategoryModal = document.getElementById('addCategoryModal');
if (addCategoryModal) {
    addCategoryModal.addEventListener('click', function(e) {
        if (e.target === this) {
            document.getElementById('addCategoryForm').reset();
        }
    });
}

const editButtons = document.querySelectorAll('.btn-edit-category');
const editCategoryModal = document.getElementById('editCategoryModal');
const editIdInput = document.getElementById('edit_id');
const editNameIdInput = document.getElementById('edit_name');
const editNameEnInput = document.getElementById('edit_name_en');
const editNameItInput = document.getElementById('edit_name_it');
const editCategoryForm = document.getElementById('editCategoryForm');

editButtons.forEach(btn => {
    btn.addEventListener('click', function() {
        const id = this.getAttribute('data-id');
        const nameId = this.getAttribute('data-name-id');
        const nameEn = this.getAttribute('data-name-en');
        const nameIt = this.getAttribute('data-name-it');
        
        if (editIdInput && editNameIdInput && editNameEnInput && editNameItInput) {
            editIdInput.value = id;
            editNameIdInput.value = nameId;
            editNameEnInput.value = nameEn;
            editNameItInput.value = nameIt;
        }
        
        openModal('editCategoryModal');
    });
});

if (editCategoryModal) {
    editCategoryModal.addEventListener('click', function(e) {
        if (e.target === this && editCategoryForm) {
            editCategoryForm.reset();
        }
    });
}

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

const deleteModal = document.getElementById('deleteModal');
const cancelDeleteBtn = document.getElementById('cancelDelete');
const confirmDeleteBtn = document.getElementById('confirmDelete');
const deleteCategoryName = document.getElementById('deleteCategoryName');
const deleteBtnText = document.getElementById('deleteBtnText');
const deleteBtnLoading = document.getElementById('deleteBtnLoading');

let deleteCategoryId = null;

const deleteButtons = document.querySelectorAll('.btn-delete-category');
deleteButtons.forEach(btn => {
    btn.addEventListener('click', function() {
        deleteCategoryId = this.getAttribute('data-id');
        const categoryName = this.getAttribute('data-name');
        
        if (deleteCategoryName) {
            deleteCategoryName.textContent = categoryName;
        }
        
        openModal('deleteModal');
    });
});

function closeDeleteModal() {
    closeModal('deleteModal');
    deleteCategoryId = null;
    if (deleteBtnText) deleteBtnText.style.display = 'inline';
    if (deleteBtnLoading) deleteBtnLoading.style.display = 'none';
    if (confirmDeleteBtn) confirmDeleteBtn.disabled = false;
}

if (cancelDeleteBtn) {
    cancelDeleteBtn.addEventListener('click', closeDeleteModal);
}

if (confirmDeleteBtn) {
    confirmDeleteBtn.addEventListener('click', function() {
        if (!deleteCategoryId) return;
        
        if (deleteBtnText) deleteBtnText.style.display = 'none';
        if (deleteBtnLoading) deleteBtnLoading.style.display = 'inline';
        confirmDeleteBtn.disabled = true;
        
        const deleteUrl = '<?= base_url('admin/categories/delete/') ?>' + deleteCategoryId;
        
        fetch(deleteUrl, {
            method: 'GET',
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => {
            if (response.ok) {
                const row = document.querySelector(`.btn-delete-category[data-id="${deleteCategoryId}"]`).closest('tr');
                if (row) {
                    row.style.transition = 'all 0.3s ease';
                    row.style.opacity = '0';
                    row.style.transform = 'translateX(-20px)';
                    setTimeout(() => row.remove(), 300);
                }
                
                closeDeleteModal();
                showPopup('success', '<?= lang('Sidemin.success') ?>', '<?= lang('Sidemin.category_deleted') ?>');
                
                const remainingRows = document.querySelectorAll('.table tbody tr:not(:last-child)');
                if (remainingRows.length === 0) {
                    setTimeout(() => location.reload(), 1000);
                }
            } else {
                throw new Error('Delete failed');
            }
        })
        .catch(error => {
            closeDeleteModal();
            showPopup('error', '<?= lang('Sidemin.failed') ?>', '<?= lang('Sidemin.failed_delete_category') ?>');
        });
    });
}

async function translateTextWithBtn(text, targetEnId, targetItId, btnId) {
    const targetEn = document.getElementById(targetEnId);
    const targetIt = document.getElementById(targetItId);
    const btn = document.getElementById(btnId);
    
    if (!text.trim()) {
        if (targetEn) targetEn.value = '';
        if (targetIt) targetIt.value = '';
        return;
    }

    const originalText = btn.innerHTML;
    btn.innerHTML = '<?= lang('Sidemin.processing') ?>...';
    btn.disabled = true;

    try {
        const [resEn, resIt] = await Promise.all([
            fetch(`https://api.mymemory.translated.net/get?q=${encodeURIComponent(text)}&langpair=id|en`),
            fetch(`https://api.mymemory.translated.net/get?q=${encodeURIComponent(text)}&langpair=id|it`)
        ]);

        const dataEn = await resEn.json();
        const dataIt = await resIt.json();
        
        if (targetEn) {
            targetEn.value = (dataEn.responseData && dataEn.responseData.translatedText) ? dataEn.responseData.translatedText : text;
        }
        if (targetIt) {
            targetIt.value = (dataIt.responseData && dataIt.responseData.translatedText) ? dataIt.responseData.translatedText : text;
        }
    } catch (error) {
        if (targetEn) targetEn.value = text;
        if (targetIt) targetIt.value = text;
    } finally {
        btn.innerHTML = originalText;
        btn.disabled = false;
    }
}

const btnTranslateCreate = document.getElementById('btnTranslateCreate');
if (btnTranslateCreate) {
    btnTranslateCreate.addEventListener('click', function() {
        const text = document.getElementById('create_name').value;
        translateTextWithBtn(text, 'create_name_en', 'create_name_it', 'btnTranslateCreate');
    });
}

const btnTranslateEdit = document.getElementById('btnTranslateEdit');
if (btnTranslateEdit) {
    btnTranslateEdit.addEventListener('click', function() {
        const text = document.getElementById('edit_name').value;
        translateTextWithBtn(text, 'edit_name_en', 'edit_name_it', 'btnTranslateEdit');
    });
}

<?php if (session()->getFlashdata('success')): ?>
    showPopup('success', '<?= lang('Sidemin.success') ?>', '<?= esc(session()->getFlashdata('success')); ?>');
<?php endif; ?>

<?php if (session()->getFlashdata('error')): ?>
    showPopup('error', '<?= lang('Sidemin.error') ?>', '<?= esc(session()->getFlashdata('error')); ?>');
<?php endif; ?>
</script>
<?= $this->endSection(); ?>