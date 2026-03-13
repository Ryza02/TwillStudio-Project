<?= $this->extend('admin/layout/base'); ?>

<?= $this->section('title'); ?><?= lang('Sidemin.edit_item'); ?><?= $this->endSection(); ?>

<?= $this->section('styles'); ?>
<link rel="stylesheet" href="<?= base_url('assets/css/admin/about.css'); ?>">
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<div class="page-header">
    <div>
        <h2 class="page-title"><?= lang('Sidemin.edit_item'); ?></h2>
        <p class="page-subtitle"><?= lang('Sidemin.edit_item_desc'); ?></p>
    </div>
</div>

<div class="card">
    <div class="card-header-flex" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <h3 class="card-title" style="margin: 0;"><?= lang('Sidemin.table_detail'); ?></h3>
        <button type="button" class="btn-translate" id="btn_translate_all" onclick="autoTranslateAll('item')">
            ✨ <?= lang('Sidemin.auto_translate'); ?>
        </button>
    </div>

    <form action="<?= base_url('admin/about/updateItem/'.$item['id']); ?>" method="post" enctype="multipart/form-data">
        <div class="form-group" style="margin-bottom: 24px;">
            <div class="label-wrapper"><label class="form-label"><?= lang('Sidemin.current_image'); ?></label></div>
            <img src="<?= base_url($item['image_url']); ?>" alt="Current" style="width: 150px; height: 150px; object-fit: cover; border-radius: 8px; margin-bottom: 12px; display: block; border: 1px solid #e2e8f0;">
            
            <div class="label-wrapper" style="margin-top: 16px;"><label class="form-label"><?= lang('Sidemin.change_image'); ?></label></div>
            <input type="file" name="image" class="form-control" accept="image/*" onchange="previewImage(this, 'edit_image_preview')">
            
            <div class="image-preview-wrapper" id="edit_image_preview_wrapper" style="display: none; margin-top: 10px;">
                <img id="edit_image_preview" src="" alt="Preview Baru" style="max-width: 200px; border-radius: 8px; border: 1px solid #e2e8f0;">
            </div>
        </div>

        <div class="form-grid">
            <div class="form-group">
                <div class="label-wrapper"><label class="form-label"><?= lang('Sidemin.table_title'); ?> (Indonesia)</label></div>
                <input type="text" id="item_title_id" name="title_id" class="form-control" value="<?= esc($item['title_id']); ?>" required>
            </div>
            <div class="form-group">
                <div class="label-wrapper"><label class="form-label"><?= lang('Sidemin.table_title'); ?> (English)</label></div>
                <input type="text" id="item_title_en" name="title_en" class="form-control" value="<?= esc($item['title_en']); ?>">
            </div>
            <div class="form-group">
                <div class="label-wrapper"><label class="form-label"><?= lang('Sidemin.table_title'); ?> (Italiano)</label></div>
                <input type="text" id="item_title_it" name="title_it" class="form-control" value="<?= esc($item['title_it']); ?>">
            </div>
        </div>

        <div class="form-grid">
            <div class="form-group">
                <div class="label-wrapper"><label class="form-label"><?= lang('Sidemin.table_desc'); ?> (Indonesia)</label></div>
                <textarea id="item_desc_id" name="desc_id" class="form-control" rows="5" required><?= esc($item['desc_id']); ?></textarea>
            </div>
            <div class="form-group">
                <div class="label-wrapper"><label class="form-label"><?= lang('Sidemin.table_desc'); ?> (English)</label></div>
                <textarea id="item_desc_en" name="desc_en" class="form-control" rows="5"><?= esc($item['desc_en']); ?></textarea>
            </div>
            <div class="form-group">
                <div class="label-wrapper"><label class="form-label"><?= lang('Sidemin.table_desc'); ?> (Italiano)</label></div>
                <textarea id="item_desc_it" name="desc_it" class="form-control" rows="5"><?= esc($item['desc_it']); ?></textarea>
            </div>
        </div>

        <div style="margin-top: 24px; display: flex; gap: 12px;">
            <button type="submit" class="btn btn-primary"><?= lang('Sidemin.update_item'); ?></button>
            <a href="<?= base_url('admin/about'); ?>" class="btn btn-secondary"><?= lang('Sidemin.cancel'); ?></a>
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
                firstPopup.style.animation = 'slideInRight 0.4s ease reverse forwards';
                setTimeout(() => firstPopup.remove(), 400);
            }
        }, 5000);
    }

    function previewImage(input, imgId) {
        const wrapper = document.getElementById(imgId + '_wrapper');
        const preview = document.getElementById(imgId);
        
        if (input.files && input.files[0]) {
            const file = input.files[0];
            const maxSize = 10 * 1024 * 1024;

            if (file.size > maxSize) {
                showPopup('error', '<?= lang('Sidemin.error'); ?>', 'Maksimal upload gambar adalah 10MB.');
                input.value = '';
                wrapper.style.display = 'none';
                return;
            }

            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                wrapper.style.display = 'block';
            }
            reader.readAsDataURL(file);
        } else {
            wrapper.style.display = 'none';
        }
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
</script>
<?= $this->endSection(); ?>