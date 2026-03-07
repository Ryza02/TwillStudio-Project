<?= $this->extend('admin/layout/base'); ?>

<?= $this->section('title'); ?>Manajemen Blog<?= $this->endSection(); ?>

<?= $this->section('styles'); ?>
<link rel="stylesheet" href="<?= base_url('assets/css/admin/blogs.css'); ?>">
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>

<div class="page-header">
    <div>
        <h2 class="page-title">Manajemen Blog & Berita</h2>
        <p class="page-subtitle">Kelola semua artikel. Pilih satu untuk dijadikan Master/Headline.</p>
    </div>
    <a href="<?= base_url('admin/blog/create'); ?>" class="btn btn-primary">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
        </svg>
        Tulis Berita Baru
    </a>
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
                <h3 style="margin: 0 0 8px 0; color: var(--onyx); font-size: 20px; font-weight: 700;">Hapus Artikel?</h3>
                <p style="margin: 0; color: var(--text-secondary); font-size: 14px;">Tindakan ini tidak dapat dibatalkan.</p>
            </div>
            
            <div class="info-box">
                <p class="info-label">Artikel yang akan dihapus:</p>
                <p id="deleteBlogTitle" class="info-value"></p>
            </div>
            
            <div style="display: flex; gap: 12px;">
                <button id="cancelDelete" class="btn btn-secondary" style="flex: 1;">Batal</button>
                <button id="confirmDelete" class="btn" style="flex: 1; background: var(--error); color: #ffffff;">
                    <span id="deleteBtnText">Ya, Hapus</span>
                    <span id="deleteBtnLoading" style="display: none;">Menghapus...</span>
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Blogs Table -->
<div class="table-container">
    <table class="table">
        <thead>
            <tr>
                <th style="width: 120px;">MASTER</th>
                <th>TITLE</th>
                <th style="width: 150px;">DATE</th>
                <th style="width: 120px; text-align: right;">ACTIONS</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($blogs)): ?>
                <?php foreach ($blogs as $blog): ?>
                    <tr>
                        <td>
                            <div style="display: flex; align-items: center; gap: 12px;">
                                <input type="radio" 
                                       name="master_blog" 
                                       class="table-radio toggle-master-blog" 
                                       data-id="<?= $blog['id']; ?>" 
                                       <?= (isset($blog['is_featured']) && $blog['is_featured'] == 1) ? 'checked' : ''; ?> 
                                       title="Jadikan Master">
                                <?php if (!empty($blog['image_url']) && is_file(FCPATH . $blog['image_url'])): ?>
                                    <div class="table-image">
                                        <img src="<?= base_url(esc($blog['image_url'])); ?>" alt="<?= esc($blog['title']); ?>">
                                    </div>
                                <?php else: ?>
                                    <div class="table-image-placeholder">
                                        <?= strtoupper(substr($blog['title'], 0, 1)); ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </td>
                        <td>
                            <h4 class="table-title"><?= esc($blog['title']); ?></h4>
                            <p class="table-meta">/blog/<?= esc($blog['slug']); ?></p>
                        </td>
                        <td>
                            <span class="table-date"><?= date('d M Y', strtotime($blog['created_at'])); ?></span>
                        </td>
                        <td>
                            <div class="table-actions">
                                <a href="<?= base_url('admin/blog/edit/' . $blog['id']); ?>" class="table-action-btn" title="Edit">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                </a>
                                <button type="button" 
                                        class="table-action-btn delete btn-delete-blog" 
                                        data-id="<?= $blog['id']; ?>" 
                                        data-title="<?= esc($blog['title']); ?>"
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
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                                </svg>
                            </div>
                            <h4 class="empty-state-title">Belum Ada Artikel</h4>
                            <p class="empty-state-desc">Mulai tulis artikel blog pertama Anda</p>
                            <a href="<?= base_url('admin/blog/create'); ?>" class="btn btn-primary">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                                Tulis Artikel
                            </a>
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
    const deleteBlogTitle = document.getElementById('deleteBlogTitle');
    const deleteBtnText = document.getElementById('deleteBtnText');
    const deleteBtnLoading = document.getElementById('deleteBtnLoading');

    let deleteBlogId = null;

    document.querySelectorAll('.btn-delete-blog').forEach(btn => {
        btn.addEventListener('click', function() {
            deleteBlogId = this.getAttribute('data-id');
            const blogTitle = this.getAttribute('data-title');
            
            deleteBlogTitle.textContent = blogTitle;
            openModal('deleteModal');
        });
    });

    function closeDeleteModal() {
        closeModal('deleteModal');
        deleteBlogId = null;
        if (deleteBtnText) deleteBtnText.style.display = 'inline';
        if (deleteBtnLoading) deleteBtnLoading.style.display = 'none';
        if (confirmDeleteBtn) confirmDeleteBtn.disabled = false;
    }

    if (cancelDeleteBtn) {
        cancelDeleteBtn.addEventListener('click', closeDeleteModal);
    }

    if (confirmDeleteBtn) {
        confirmDeleteBtn.addEventListener('click', function() {
            if (!deleteBlogId) return;
            
            if (deleteBtnText) deleteBtnText.style.display = 'none';
            if (deleteBtnLoading) deleteBtnLoading.style.display = 'inline';
            confirmDeleteBtn.disabled = true;
            
            const deleteUrl = '<?= base_url('admin/blog/delete/') ?>' + deleteBlogId;
            
            fetch(deleteUrl, {
                method: 'GET',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => {
                if (response.ok) {
                    const row = document.querySelector(`.btn-delete-blog[data-id="${deleteBlogId}"]`).closest('tr');
                    if (row) {
                        row.style.transition = 'all 0.3s ease';
                        row.style.opacity = '0';
                        row.style.transform = 'translateX(-20px)';
                        setTimeout(() => row.remove(), 300);
                    }
                    
                    closeDeleteModal();
                    showPopup('success', 'Berhasil', 'Artikel berhasil dihapus.');
                    
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
                showPopup('error', 'Gagal', 'Gagal menghapus artikel. Silakan coba lagi.');
                console.error('Delete error:', error);
            });
        });
    }

    document.querySelectorAll('.toggle-master-blog').forEach(radio => {
        radio.addEventListener('change', function() {
            const blogId = this.getAttribute('data-id');
            const parentRow = this.closest('tr');
            
            this.style.opacity = '0.5';
            this.disabled = true;
            
            fetch('<?= base_url("admin/blog/toggle-featured/") ?>' + blogId, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                    '<?= csrf_header() ?>': '<?= csrf_hash() ?>'
                }
            })
            .then(response => response.json())
            .then(data => {
                this.style.opacity = '1';
                this.disabled = false;
                
                if (data.status === 'success') {
                    showPopup('success', 'Berhasil', 'Master blog berhasil diubah.');
                } else {
                    showPopup('error', 'Gagal', data.message || 'Terjadi kesalahan.');
                    this.checked = false;
                }
            })
            .catch(error => {
                this.style.opacity = '1';
                this.disabled = false;
                this.checked = false;
                showPopup('error', 'Error', 'Terjadi kesalahan koneksi.');
                console.error('Error:', error);
            });
        });
    });

    <?php if (session()->getFlashdata('success')): ?>
        showPopup('success', 'Berhasil', '<?= esc(session()->getFlashdata('success')); ?>');
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')): ?>
        showPopup('error', 'Error', '<?= esc(session()->getFlashdata('error')); ?>');
    <?php endif; ?>
</script>
<?= $this->endSection(); ?>