<?= $this->extend('admin/layout/base'); ?>

<?= $this->section('title'); ?>Manajemen Galeri<?= $this->endSection(); ?>

<?= $this->section('styles'); ?>
<link rel="stylesheet" href="<?= base_url('assets/css/admin/gallery.css'); ?>">
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>

<?php
$lang = session()->get('lang') ?? session()->get('locale') ?? service('request')->getLocale();
$lang = strtolower(substr($lang, 0, 2));

$ui = [
    'id' => [
        'page_title' => 'Manajemen Galeri',
        'page_subtitle' => 'Pilih project untuk mengelola foto galeri detail.',
        'manage_btn' => 'Kelola Galeri',
        'no_image' => 'Tidak Ada Gambar',
        'no_project' => 'Belum Ada Project',
        'no_project_desc' => 'Silakan buat project baru terlebih dahulu',
        'add_btn' => 'Tambah Project'
    ],
    'en' => [
        'page_title' => 'Gallery Management',
        'page_subtitle' => 'Select a project to manage its gallery photos.',
        'manage_btn' => 'Manage Gallery',
        'no_image' => 'No Image',
        'no_project' => 'No Projects Yet',
        'no_project_desc' => 'Please create a new project first',
        'add_btn' => 'Add Project'
    ],
    'it' => [
        'page_title' => 'Gestione Galleria',
        'page_subtitle' => 'Seleziona un progetto per gestire le foto della galleria.',
        'manage_btn' => 'Gestisci Galleria',
        'no_image' => 'Nessuna Immagine',
        'no_project' => 'Nessun Progetto',
        'no_project_desc' => 'Crea prima un nuovo progetto per favore',
        'add_btn' => 'Aggiungi Progetto'
    ]
];

$t = $ui[$lang] ?? $ui['id'];
?>

<div class="page-header">
    <div>
        <h2 class="page-title"><?= esc($t['page_title']); ?></h2>
        <p class="page-subtitle"><?= esc($t['page_subtitle']); ?></p>
    </div>
</div>

<div class="projects-grid">
    <?php if (!empty($projects)): ?>
        <?php foreach ($projects as $proj): ?>
            <?php
            $displayTitle = $proj['title_id'] ?? ($proj['title'] ?? 'Tanpa Judul');

            if ($lang === 'en' && !empty($proj['title_en'])) {
                $displayTitle = $proj['title_en'];
            } elseif ($lang === 'it' && !empty($proj['title_it'])) {
                $displayTitle = $proj['title_it'];
            }
            ?>
            <div class="project-card">
                <div class="project-card-image">
                    <?php if (!empty($proj['image_url']) && is_file(FCPATH . $proj['image_url'])): ?>
                        <img src="<?= base_url(esc($proj['image_url'])); ?>" alt="<?= esc($displayTitle); ?>">
                    <?php else: ?>
                        <div class="no-image">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <span><?= esc($t['no_image']); ?></span>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="project-card-content">
                    <div>
                        <h3 class="project-card-title"><?= esc($displayTitle); ?></h3>
                        <p class="project-card-location">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="width: 14px; height: 14px; display: inline; vertical-align: middle; margin-right: 4px;">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <?= esc($proj['location']); ?>
                        </p>
                    </div>
                    <a href="<?= base_url('admin/gallery/' . $proj['id']); ?>" class="btn btn-primary" style="width: 100%; justify-content: center;">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        <?= esc($t['manage_btn']); ?>
                    </a>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="empty-state" style="grid-column: 1 / -1;">
            <div class="empty-state-icon">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                </svg>
            </div>
            <h4 class="empty-state-title"><?= esc($t['no_project']); ?></h4>
            <p class="empty-state-desc"><?= esc($t['no_project_desc']); ?></p>
            <a href="<?= base_url('admin/project/create'); ?>" class="btn btn-primary">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                </svg>
                <?= esc($t['add_btn']); ?>
            </a>
        </div>
    <?php endif; ?>
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

    <?php if (session()->getFlashdata('success')): ?>
        showPopup('success', 'Berhasil', '<?= esc(session()->getFlashdata('success')); ?>');
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')): ?>
        showPopup('error', 'Error', '<?= esc(session()->getFlashdata('error')); ?>');
    <?php endif; ?>
</script>
<?= $this->endSection(); ?>