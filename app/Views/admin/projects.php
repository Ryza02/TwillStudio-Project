<?= $this->extend('admin/layout/base'); ?>

<?= $this->section('title'); ?><?= lang('Sidemin.project_management'); ?><?= $this->endSection(); ?>

<?= $this->section('styles'); ?>
<link rel="stylesheet" href="<?= base_url('assets/css/admin/projects.css'); ?>">
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>

<?php
// Deteksi bahasa saat ini dari session/request
$lang = session()->get('lang') ?? session()->get('locale') ?? service('request')->getLocale();
$lang = strtolower(substr($lang, 0, 2));
?>

<div class="page-header">
    <div>
        <h2 class="page-title"><?= lang('Sidemin.project_management'); ?></h2>
        <p class="page-subtitle"><?= lang('Sidemin.project_subtitle'); ?></p>
    </div>
    <a href="<?= base_url('admin/project/create'); ?>" class="btn btn-primary">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
        </svg>
        <?= lang('Sidemin.add_project'); ?>
    </a>
</div>

<div class="table-container">
    <table class="table">
        <thead>
            <tr>
                <th style="width: 120px;"><?= lang('Sidemin.table_master'); ?></th>
                <th><?= lang('Sidemin.table_title'); ?></th>
                <th style="width: 200px;"><?= lang('Sidemin.table_category_year'); ?></th>
                <th style="width: 120px; text-align: right;"><?= lang('Sidemin.table_actions'); ?></th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($projects)): ?>
                <?php foreach ($projects as $project): ?>
                    <?php
                    // Logika Fallback Judul Multi-bahasa
                    $displayTitle = 'Tanpa Judul';

                    if ($lang === 'en' && !empty($project['title_en'])) {
                        $displayTitle = $project['title_en'];
                    } elseif ($lang === 'it' && !empty($project['title_it'])) {
                        $displayTitle = $project['title_it'];
                    } elseif ($lang === 'id' && !empty($project['title_id'])) {
                        $displayTitle = $project['title_id'];
                    } else {
                        // Jika bahasa yg dipilih kosong, cari bahasa lain yang tersedia (fallback)
                        if (!empty($project['title_id'])) {
                            $displayTitle = $project['title_id'];
                        } elseif (!empty($project['title_en'])) {
                            $displayTitle = $project['title_en'];
                        } elseif (!empty($project['title_it'])) {
                            $displayTitle = $project['title_it'];
                        } elseif (!empty($project['title'])) {
                            $displayTitle = $project['title'];
                        }
                    }
                    ?>
                    <tr>
                        <td>
                            <div style="display: flex; align-items: center; gap: 12px;">
                                <input type="checkbox" 
                                       class="table-checkbox toggle-master-project" 
                                       data-id="<?= $project['id']; ?>" 
                                       <?= (isset($project['is_featured']) && $project['is_featured'] == 1) ? 'checked' : ''; ?> 
                                       title="<?= lang('Sidemin.make_master'); ?>">
                                <?php if (!empty($project['image_url']) && is_file(FCPATH . $project['image_url'])): ?>
                                    <div class="table-image">
                                        <img src="<?= base_url(esc($project['image_url'])); ?>" alt="<?= esc($displayTitle); ?>">
                                    </div>
                                <?php else: ?>
                                    <div class="table-image-placeholder">
                                        <?= strtoupper(substr($displayTitle, 0, 1)); ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </td>
                        <td>
                            <h4 class="table-title"><?= esc($displayTitle); ?></h4>
                            <p class="table-location"><?= esc($project['location']); ?></p>
                        </td>
                        <td>
                            <span class="table-meta"><?= esc($project['category']); ?></span>
                            <br>
                            <small><?= esc($project['year']); ?></small>
                        </td>
                        <td>
                            <div class="table-actions">
                                <a href="<?= base_url('admin/project/edit/' . $project['id']); ?>" class="table-action-btn" title="Edit">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                </a>
                                <button type="button" 
                                        class="table-action-btn delete btn-delete-project" 
                                        data-id="<?= $project['id']; ?>" 
                                        data-title="<?= esc($displayTitle); ?>"
                                        title="Delete">
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
                    <td colspan="4">
                        <div class="empty-state">
                            <div class="empty-state-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                </svg>
                            </div>
                            <h4 class="empty-state-title"><?= lang('Sidemin.no_project_yet'); ?></h4>
                            <p class="empty-state-desc"><?= lang('Sidemin.start_adding_project'); ?></p>
                            <a href="<?= base_url('admin/project/create'); ?>" class="btn btn-primary">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                                </svg>
                                <?= lang('Sidemin.add_project'); ?>
                            </a>
                        </div>
                    </td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<div id="deleteModal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.5); z-index: 9999; align-items: center; justify-content: center;">
    <div style="background: #ffffff; border-radius: 16px; padding: 32px; max-width: 420px; width: 90%; box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);">
        <div style="text-align: center; margin-bottom: 24px;">
            <div style="width: 64px; height: 64px; background: #fee2e2; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 16px;">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="width: 32px; height: 32px; color: #dc2626;">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                </svg>
            </div>
            <h3 style="margin: 0 0 8px 0; color: #111827; font-size: 20px; font-weight: 700;"><?= lang('Sidemin.delete_project_confirm'); ?></h3>
            <p style="margin: 0; color: #64748b; font-size: 14px;"><?= lang('Sidemin.action_cannot_be_undone'); ?></p>
        </div>
        
        <div style="background: #f8fafc; padding: 16px; border-radius: 12px; margin-bottom: 24px; border: 1px solid #e2e8f0;">
            <p style="margin: 0 0 8px 0; font-size: 13px; color: #64748b; text-transform: uppercase; font-weight: 600;"><?= lang('Sidemin.project_to_delete'); ?></p>
            <p id="deleteProjectTitle" style="margin: 0; font-size: 16px; color: #111827; font-weight: 600;"></p>
        </div>
        
        <div style="display: flex; gap: 12px;">
            <button id="cancelDelete" style="flex: 1; padding: 12px 20px; border: 1px solid #e2e8f0; background: #ffffff; color: #475569; border-radius: 10px; font-weight: 600; cursor: pointer; transition: all 0.3s;">
                <?= lang('Sidemin.cancel'); ?>
            </button>
            <button id="confirmDelete" style="flex: 1; padding: 12px 20px; border: none; background: #dc2626; color: #ffffff; border-radius: 10px; font-weight: 600; cursor: pointer; transition: all 0.3s;">
                <span id="deleteBtnText"><?= lang('Sidemin.yes_delete'); ?></span>
                <span id="deleteBtnLoading" style="display: none;"><?= lang('Sidemin.deleting'); ?></span>
            </button>
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
    const deleteProjectTitle = document.getElementById('deleteProjectTitle');
    const deleteBtnText = document.getElementById('deleteBtnText');
    const deleteBtnLoading = document.getElementById('deleteBtnLoading');

    let deleteProjectId = null;

    document.querySelectorAll('.btn-delete-project').forEach(btn => {
        btn.addEventListener('click', function() {
            deleteProjectId = this.getAttribute('data-id');
            const projectTitle = this.getAttribute('data-title');
            
            deleteProjectTitle.textContent = projectTitle;
            deleteModal.style.display = 'flex';
        });
    });

    function closeDeleteModal() {
        deleteModal.style.display = 'none';
        deleteProjectId = null;
        deleteBtnText.style.display = 'inline';
        deleteBtnLoading.style.display = 'none';
        confirmDeleteBtn.disabled = false;
    }

    cancelDeleteBtn.addEventListener('click', closeDeleteModal);

    deleteModal.addEventListener('click', function(e) {
        if (e.target === deleteModal) {
            closeDeleteModal();
        }
    });

    confirmDeleteBtn.addEventListener('click', function() {
        if (!deleteProjectId) return;
        
        deleteBtnText.style.display = 'none';
        deleteBtnLoading.style.display = 'inline';
        confirmDeleteBtn.disabled = true;
        
        const deleteUrl = '<?= base_url('admin/project/delete/') ?>' + deleteProjectId;
        
        fetch(deleteUrl, {
            method: 'GET',
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => {
            if (response.ok) {
                const row = document.querySelector(`.btn-delete-project[data-id="${deleteProjectId}"]`).closest('tr');
                if (row) {
                    row.style.transition = 'all 0.3s ease';
                    row.style.opacity = '0';
                    row.style.transform = 'translateX(-20px)';
                    setTimeout(() => row.remove(), 300);
                }
                
                closeDeleteModal();
                showPopup('success', '<?= lang('Sidemin.success') ?>', '<?= lang('Sidemin.project_deleted') ?>');
                
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
            showPopup('error', '<?= lang('Sidemin.failed') ?>', '<?= lang('Sidemin.failed_delete_project') ?>');
            console.error('Delete error:', error);
        });
    });

    document.querySelectorAll('.toggle-master-project').forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            const projectId = this.getAttribute('data-id');
            const isChecked = this.checked ? 1 : 0;
            
            this.style.opacity = '0.5';
            this.disabled = true;
            
            fetch('<?= base_url("admin/project/toggle-featured/") ?>' + projectId, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                    '<?= csrf_header() ?>': '<?= csrf_hash() ?>'
                },
                body: JSON.stringify({ is_featured: isChecked })
            })
            .then(response => response.json())
            .then(data => {
                this.style.opacity = '1';
                this.disabled = false;
                
                if (data.status === 'success') {
                    showPopup('success', '<?= lang('Sidemin.success') ?>', '<?= lang('Sidemin.master_status_changed') ?>');
                } else {
                    showPopup('error', '<?= lang('Sidemin.failed') ?>', data.message || '<?= lang('Sidemin.error_occurred') ?>');
                    this.checked = !isChecked;
                }
            })
            .catch(error => {
                this.style.opacity = '1';
                this.disabled = false;
                this.checked = !isChecked;
                showPopup('error', '<?= lang('Sidemin.error') ?>', '<?= lang('Sidemin.connection_error') ?>');
                console.error('Error:', error);
            });
        });
    });

    <?php if (session()->getFlashdata('success')): ?>
        showPopup('success', '<?= lang('Sidemin.success') ?>', '<?= esc(session()->getFlashdata('success')); ?>');
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')): ?>
        showPopup('error', '<?= lang('Sidemin.error') ?>', '<?= esc(session()->getFlashdata('error')); ?>');
    <?php endif; ?>
</script>
<?= $this->endSection(); ?>