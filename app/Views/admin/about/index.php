<?= $this->extend('admin/layout/base'); ?>

<?= $this->section('title'); ?><?= lang('Sidemin.about_management'); ?><?= $this->endSection(); ?>

<?= $this->section('styles'); ?>
<link rel="stylesheet" href="<?= base_url('assets/css/admin/about.css'); ?>">
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>

<div class="page-header">
    <div>
        <h2 class="page-title"><?= lang('Sidemin.about_management'); ?></h2>
        <p class="page-subtitle"><?= lang('Sidemin.about_subtitle'); ?></p>
    </div>
</div>

<div class="card">
    <div class="card-header-flex">
        <h3 class="card-title"><?= lang('Sidemin.hero_title'); ?></h3>
        <button type="button" class="btn-translate" id="btn_translate_all" onclick="autoTranslateAll('hero')">
            ✨ <?= lang('Sidemin.auto_translate'); ?>
        </button>
    </div>
    <form action="<?= base_url('admin/about/updateHero'); ?>" method="post">
        <div class="form-grid">
            <div class="form-group">
                <div class="label-wrapper"><label class="form-label"><?= lang('Sidemin.table_title'); ?> (Indonesia)</label></div>
                <input type="text" id="hero_title_id" name="title_id" class="form-control" value="<?= esc($hero['title_id'] ?? ''); ?>" required>
            </div>
            <div class="form-group">
                <div class="label-wrapper"><label class="form-label"><?= lang('Sidemin.table_title'); ?> (English)</label></div>
                <input type="text" id="hero_title_en" name="title_en" class="form-control" value="<?= esc($hero['title_en'] ?? ''); ?>">
            </div>
            <div class="form-group">
                <div class="label-wrapper"><label class="form-label"><?= lang('Sidemin.table_title'); ?> (Italiano)</label></div>
                <input type="text" id="hero_title_it" name="title_it" class="form-control" value="<?= esc($hero['title_it'] ?? ''); ?>">
            </div>
        </div>

        <div class="form-grid">
            <div class="form-group">
                <div class="label-wrapper"><label class="form-label"><?= lang('Sidemin.table_desc'); ?> (Indonesia)</label></div>
                <textarea id="hero_desc_id" name="desc_id" class="form-control" rows="3" required><?= esc($hero['desc_id'] ?? ''); ?></textarea>
            </div>
            <div class="form-group">
                <div class="label-wrapper"><label class="form-label"><?= lang('Sidemin.table_desc'); ?> (English)</label></div>
                <textarea id="hero_desc_en" name="desc_en" class="form-control" rows="3"><?= esc($hero['desc_en'] ?? ''); ?></textarea>
            </div>
            <div class="form-group">
                <div class="label-wrapper"><label class="form-label"><?= lang('Sidemin.table_desc'); ?> (Italiano)</label></div>
                <textarea id="hero_desc_it" name="desc_it" class="form-control" rows="3"><?= esc($hero['desc_it'] ?? ''); ?></textarea>
            </div>
        </div>
        <button type="submit" class="btn btn-primary"><?= lang('Sidemin.save_hero'); ?></button>
    </form>
</div>

<div class="page-header" style="margin-top: 40px;">
    <div>
        <h3 class="card-title" style="border: none; padding: 0; margin: 0;"><?= lang('Sidemin.item_list'); ?></h3>
        <p class="page-subtitle" style="margin-top: 8px;"><?= lang('Sidemin.order_subtitle'); ?></p>
    </div>
    <a href="<?= base_url('admin/about/createItem'); ?>" class="btn btn-primary">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
        </svg>
        <?= lang('Sidemin.add_item'); ?>
    </a>
</div>

<form action="<?= base_url('admin/about/updateOrder'); ?>" method="post">
    <div class="table-container">
        <table class="table">
            <thead>
                <tr>
                    <th style="width: 100px; text-align: center;"><?= lang('Sidemin.table_order'); ?></th>
                    <th style="width: 100px;"><?= lang('Sidemin.table_image'); ?></th>
                    <th><?= lang('Sidemin.table_detail'); ?></th>
                    <th style="width: 120px; text-align: right;"><?= lang('Sidemin.table_actions'); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($items)): ?>
                    <?php 
                    // Ambil locale yang sedang aktif di sistem (default id)
                    $locale = service('request')->getLocale(); 
                    ?>
                    <?php foreach ($items as $item): ?>
                        <?php
                            // Logic fallback bahasa: 
                            // Jika bahasa yg dipilih (misal 'en') ada isinya, pakai itu. Kalau kosong, pakai bahasa Indonesia ('id')
                            $displayTitle = !empty($item['title_' . $locale]) ? $item['title_' . $locale] : $item['title_id'];
                            $displayDesc = !empty($item['desc_' . $locale]) ? $item['desc_' . $locale] : $item['desc_id'];
                        ?>
                        <tr>
                            <td style="text-align: center;">
                                <input type="number" name="order[<?= $item['id']; ?>]" value="<?= esc($item['sort_order']); ?>" class="order-input">
                            </td>
                            <td>
                                <div class="table-image">
                                    <img src="<?= base_url(esc($item['image_url'])); ?>" alt="img">
                                </div>
                            </td>
                            <td>
                                <h4 class="table-title"><?= esc($displayTitle); ?></h4>
                                <p class="table-desc"><?= esc($displayDesc); ?></p>
                            </td>
                            <td>
                                <div class="table-actions">
                                    <a href="<?= base_url('admin/about/editItem/' . $item['id']); ?>" class="table-action-btn" title="Edit">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                    </a>
                                    <button type="button" class="table-action-btn delete btn-delete-item" data-id="<?= $item['id']; ?>" data-title="<?= esc($displayTitle); ?>" title="Delete">
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
                                <h4 style="margin-bottom: 8px;"><?= lang('Sidemin.no_data'); ?></h4>
                                <p style="color: var(--text-muted); font-size: 14px; margin-bottom: 16px;"><?= lang('Sidemin.no_data_desc'); ?></p>
                                <a href="<?= base_url('admin/about/createItem'); ?>" class="btn btn-primary"><?= lang('Sidemin.add_item'); ?></a>
                            </div>
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <?php if (!empty($items)): ?>
    <div style="margin-top: 16px; display: flex; justify-content: flex-start;">
        <button type="submit" class="btn btn-success"><?= lang('Sidemin.save_order'); ?></button>
    </div>
    <?php endif; ?>
</form>

<div id="deleteModal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.5); z-index: 9999; align-items: center; justify-content: center;">
    <div style="background: #ffffff; border-radius: 16px; padding: 32px; max-width: 420px; width: 90%; box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);">
        <div style="text-align: center; margin-bottom: 24px;">
            <div style="width: 64px; height: 64px; background: #fee2e2; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 16px;">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="width: 32px; height: 32px; color: #dc2626;">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                </svg>
            </div>
            <h3 style="margin: 0 0 8px 0; color: #111827; font-size: 20px; font-weight: 700;"><?= lang('Sidemin.delete_item'); ?></h3>
            <p style="margin: 0; color: #64748b; font-size: 14px;"><?= lang('Sidemin.delete_confirm'); ?></p>
        </div>
        
        <div style="background: #f8fafc; padding: 16px; border-radius: 12px; margin-bottom: 24px; border: 1px solid #e2e8f0;">
            <p style="margin: 0 0 8px 0; font-size: 13px; color: #64748b; text-transform: uppercase; font-weight: 600;"><?= lang('Sidemin.delete_item_label'); ?></p>
            <p id="deleteItemTitle" style="margin: 0; font-size: 16px; color: #111827; font-weight: 600;"></p>
        </div>
        
        <div style="display: flex; gap: 12px;">
            <button id="cancelDelete" style="flex: 1; padding: 12px 20px; border: 1px solid #e2e8f0; background: #ffffff; color: #475569; border-radius: 10px; font-weight: 600; cursor: pointer; transition: all 0.3s;"><?= lang('Sidemin.cancel'); ?></button>
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
                firstPopup.style.animation = 'slideInRight 0.4s ease reverse forwards';
                setTimeout(() => firstPopup.remove(), 400);
            }
        }, 5000);
    }

    async function autoTranslateAll(prefix) {
        const titleIdElem = document.getElementById(prefix + '_title_id');
        const descIdElem = document.getElementById(prefix + '_desc_id');
        
        const titleId = titleIdElem ? titleIdElem.value.trim() : '';
        const descId = descIdElem ? descIdElem.value.trim() : '';
        
        if (!titleId && !descId) {
            showPopup('warning', '<?= lang('Sidemin.warning'); ?>', '<?= lang('Sidemin.warning_fill_id'); ?>');
            return;
        }

        const btn = document.getElementById('btn_translate_all');
        const originalBtnText = btn.innerHTML;
        btn.innerHTML = '⏳ <?= lang('Sidemin.translating'); ?>';
        btn.disabled = true;

        try {
            if(titleId) {
                const resEnTitle = await fetch(`https://translate.googleapis.com/translate_a/single?client=gtx&sl=id&tl=en&dt=t&q=${encodeURIComponent(titleId)}`);
                const dataEnTitle = await resEnTitle.json();
                document.getElementById(prefix + '_title_en').value = dataEnTitle[0].map(x => x[0]).join('');

                const resItTitle = await fetch(`https://translate.googleapis.com/translate_a/single?client=gtx&sl=id&tl=it&dt=t&q=${encodeURIComponent(titleId)}`);
                const dataItTitle = await resItTitle.json();
                document.getElementById(prefix + '_title_it').value = dataItTitle[0].map(x => x[0]).join('');
            }

            if(descId) {
                const resEnDesc = await fetch(`https://translate.googleapis.com/translate_a/single?client=gtx&sl=id&tl=en&dt=t&q=${encodeURIComponent(descId)}`);
                const dataEnDesc = await resEnDesc.json();
                document.getElementById(prefix + '_desc_en').value = dataEnDesc[0].map(x => x[0]).join('');

                const resItDesc = await fetch(`https://translate.googleapis.com/translate_a/single?client=gtx&sl=id&tl=it&dt=t&q=${encodeURIComponent(descId)}`);
                const dataItDesc = await resItDesc.json();
                document.getElementById(prefix + '_desc_it').value = dataItDesc[0].map(x => x[0]).join('');
            }

            showPopup('success', '<?= lang('Sidemin.success'); ?>', '<?= lang('Sidemin.success_translated'); ?>');
        } catch (error) {
            showPopup('error', '<?= lang('Sidemin.error'); ?>', '<?= lang('Sidemin.error_translation'); ?>');
        } finally {
            btn.innerHTML = originalBtnText;
            btn.disabled = false;
        }
    }

    const deleteModal = document.getElementById('deleteModal');
    const cancelDeleteBtn = document.getElementById('cancelDelete');
    const confirmDeleteBtn = document.getElementById('confirmDelete');
    const deleteItemTitle = document.getElementById('deleteItemTitle');
    const deleteBtnText = document.getElementById('deleteBtnText');
    const deleteBtnLoading = document.getElementById('deleteBtnLoading');
    let deleteItemId = null;

    document.querySelectorAll('.btn-delete-item').forEach(btn => {
        btn.addEventListener('click', function() {
            deleteItemId = this.getAttribute('data-id');
            deleteItemTitle.textContent = this.getAttribute('data-title');
            deleteModal.style.display = 'flex';
        });
    });

    function closeDeleteModal() {
        deleteModal.style.display = 'none';
        deleteItemId = null;
        deleteBtnText.style.display = 'inline';
        deleteBtnLoading.style.display = 'none';
        confirmDeleteBtn.disabled = false;
    }

    cancelDeleteBtn.addEventListener('click', closeDeleteModal);
    deleteModal.addEventListener('click', e => { if (e.target === deleteModal) closeDeleteModal(); });

    confirmDeleteBtn.addEventListener('click', function() {
        if (!deleteItemId) return;
        deleteBtnText.style.display = 'none';
        deleteBtnLoading.style.display = 'inline';
        confirmDeleteBtn.disabled = true;

        fetch('<?= base_url('admin/about/deleteItem/') ?>' + deleteItemId, {
            method: 'GET',
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                const row = document.querySelector(`.btn-delete-item[data-id="${deleteItemId}"]`).closest('tr');
                if (row) {
                    row.style.transition = 'all 0.3s ease';
                    row.style.opacity = '0';
                    row.style.transform = 'translateX(-20px)';
                    setTimeout(() => row.remove(), 300);
                }
                closeDeleteModal();
                showPopup('success', '<?= lang('Sidemin.success'); ?>', '<?= lang('Sidemin.success_deleted'); ?>');
                
                const remainingRows = document.querySelectorAll('.table tbody tr');
                if (remainingRows.length <= 1) setTimeout(() => location.reload(), 1000);
            }
        })
        .catch(error => {
            closeDeleteModal();
            showPopup('error', '<?= lang('Sidemin.error'); ?>', '<?= lang('Sidemin.error_deleted'); ?>');
        });
    });

    <?php if (session()->getFlashdata('success')): ?>
        showPopup('success', '<?= lang('Sidemin.success'); ?>', '<?= esc(session()->getFlashdata('success')); ?>');
    <?php endif; ?>
    <?php if (session()->getFlashdata('error')): ?>
        showPopup('error', '<?= lang('Sidemin.error'); ?>', '<?= esc(session()->getFlashdata('error')); ?>');
    <?php endif; ?>
</script>
<?= $this->endSection(); ?>