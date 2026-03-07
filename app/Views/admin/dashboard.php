<?= $this->extend('admin/layout/base'); ?>

<?= $this->section('title'); ?>Dashboard<?= $this->endSection(); ?>

<?= $this->section('page_title'); ?>Dashboard Overview<?= $this->endSection(); ?>

<?= $this->section('styles'); ?>
<link rel="stylesheet" href="<?= base_url('assets/css/admin/dashboard.css'); ?>">
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>

<div class="dashboard-header">
    <h2 class="dashboard-title">Dashboard Overview</h2>
    <p class="dashboard-subtitle">Pantau aktivitas dan ringkasan data portfolio Anda hari ini.</p>
</div>

<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success">
        <span class="alert-icon">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
        </span>
        <span><?= esc(session()->getFlashdata('success')); ?></span>
    </div>
<?php endif; ?>

<?php if (session()->getFlashdata('error')): ?>
    <div class="alert alert-error">
        <span class="alert-icon">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
        </span>
        <span><?= esc(session()->getFlashdata('error')); ?></span>
    </div>
<?php endif; ?>

<div class="dashboard-grid">
    
    <div class="stat-card">
        <div class="stat-icon projects">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
            </svg>
        </div>
        <div class="stat-info">
            <h4 class="stat-label">Total Projects</h4>
            <p class="stat-value"><?= isset($total_projects) ? esc($total_projects) : '0'; ?></p>
        </div>
    </div>
    
    <div class="stat-card">
        <div class="stat-icon blogs">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
            </svg>
        </div>
        <div class="stat-info">
            <h4 class="stat-label">Total Blog</h4>
            <p class="stat-value"><?= isset($total_blogs) ? esc($total_blogs) : '0'; ?></p>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon categories">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
            </svg>
        </div>
        <div class="stat-info">
            <h4 class="stat-label">Total Categories</h4>
            <p class="stat-value"><?= isset($total_categories) ? esc($total_categories) : '0'; ?></p>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon gallery">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
            </svg>
        </div>
        <div class="stat-info">
            <h4 class="stat-label">Total Gallery</h4>
            <p class="stat-value"><?= isset($total_gallery) ? esc($total_gallery) : '0'; ?></p>
        </div>
    </div>

</div>

<div class="quick-actions">
    <a href="<?= base_url('admin/project/create'); ?>" class="quick-action-card">
        <div class="quick-action-icon">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
            </svg>
        </div>
        <h4 class="quick-action-title">New Project</h4>
        <p class="quick-action-desc">Tambah project baru</p>
    </a>

    <a href="<?= base_url('admin/blog/create'); ?>" class="quick-action-card">
        <div class="quick-action-icon">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
            </svg>
        </div>
        <h4 class="quick-action-title">New Blog</h4>
        <p class="quick-action-desc">Tulis artikel baru</p>
    </a>

    <a href="<?= base_url('admin/categories'); ?>" class="quick-action-card">
        <div class="quick-action-icon">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
            </svg>
        </div>
        <h4 class="quick-action-title">Categories</h4>
        <p class="quick-action-desc">Kelola kategori</p>
    </a>

    <a href="<?= base_url('admin/gallery'); ?>" class="quick-action-card">
        <div class="quick-action-icon">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
            </svg>
        </div>
        <h4 class="quick-action-title">Gallery</h4>
        <p class="quick-action-desc">Upload foto project</p>
    </a>
</div>

<div class="dashboard-section">
    <div class="section-header">
        <h3 class="section-title">Recent Blog Posts</h3>
        <a href="<?= base_url('admin/blogs'); ?>" class="section-action">View All →</a>
    </div>

    <div class="recent-table">
        <?php if (isset($recent_blogs) && !empty($recent_blogs)): ?>
            <table class="table">
                <thead>
                    <tr>
                        <th style="width: 100px;">IMAGE</th>
                        <th>TITLE</th>
                        <th style="width: 150px;">DATE</th>
                        <th style="width: 120px;">STATUS</th>
                        <th style="width: 100px; text-align: right;">ACTIONS</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach (array_slice($recent_blogs, 0, 3) as $blog): ?>
                        <tr>
                            <td>
                                <?php if (!empty($blog['image_url']) && is_file(FCPATH . $blog['image_url'])): ?>
                                    <div class="table-image">
                                        <img src="<?= base_url(esc($blog['image_url'])); ?>" alt="<?= esc($blog['title']); ?>">
                                    </div>
                                <?php else: ?>
                                    <div class="table-image-placeholder">
                                        <?= strtoupper(substr($blog['title'], 0, 1)); ?>
                                    </div>
                                <?php endif; ?>
                            </td>
                            <td>
                                <h4 class="table-title"><?= esc($blog['title']); ?></h4>
                                <p class="table-meta">/blog/<?= esc($blog['slug']); ?></p>
                            </td>
                            <td>
                                <span class="table-date"><?= date('d M Y', strtotime($blog['created_at'])); ?></span>
                            </td>
                            <td>
                                <span class="status-badge <?= $blog['is_featured'] == 1 ? 'published' : 'draft'; ?>">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                    </svg>
                                    <?= $blog['is_featured'] == 1 ? 'Master' : 'upload'; ?>
                                </span>
                            </td>
                            <td>
                                <div class="table-actions">
                                    <a href="<?= base_url('admin/blog/edit/' . $blog['id']); ?>" class="table-action-btn" title="Edit">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                    </a>
                                    <a href="<?= base_url('admin/blog/delete/' . $blog['id']); ?>" class="table-action-btn delete" title="Delete" onclick="return confirm('Yakin ingin menghapus?');">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <div class="empty-state">
                <div class="empty-state-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                    </svg>
                </div>
                <h4 class="empty-state-title">Belum Ada Blog</h4>
                <p class="empty-state-desc">Mulai tulis artikel pertama Anda</p>
                <a href="<?= base_url('admin/blog/create'); ?>" class="btn btn-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                    </svg>
                    Tulis Blog
                </a>
            </div>
        <?php endif; ?>
    </div>
</div>

<?= $this->endSection(); ?>