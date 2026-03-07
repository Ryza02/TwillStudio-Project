<?= $this->extend('layout/base'); ?>

<?php
$locale = service('request')->getLocale();

$p_title = (string) esc(
    $locale === 'en'
        ? ($project['title_en'] ?? $project['title_id'] ?? $project['title'] ?? '')
        : ($project['title_id'] ?? $project['title_en'] ?? $project['title'] ?? '')
);

$p_subtitle = (string) esc(
    $locale === 'en'
        ? ($project['subtitle_en'] ?? $project['subtitle'] ?? '')
        : ($project['subtitle'] ?? $project['subtitle_en'] ?? '')
);

$p_desc1 = (string) esc(
    $locale === 'en'
        ? ($project['description_1_en'] ?? $project['description_1_id'] ?? $project['description_1'] ?? '')
        : ($project['description_1_id'] ?? $project['description_1_en'] ?? $project['description_1'] ?? '')
);

$p_desc2 = (string) esc(
    $locale === 'en'
        ? ($project['description_2_en'] ?? $project['description_2_id'] ?? $project['description_2'] ?? '')
        : ($project['description_2_id'] ?? $project['description_2_en'] ?? $project['description_2'] ?? '')
);

$p_image = (string) esc($project['image_url'] ?? '');
?>

<?= $this->section('title'); ?><?= $p_title; ?> - Twill Studio<?= $this->endSection(); ?>

<?= $this->section('content'); ?>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css" />

<style>
    body, html, main, .main-wrapper, #app { 
        padding-top: 0 !important; 
        margin-top: 0 !important; 
    }

    /* Navbar styling */
    header, .navbar, .nav-header, #header {
        position: fixed !important; 
        top: 0 !important;
        left: 0 !important;
        width: 100% !important;
        background: transparent !important;
        box-shadow: none !important;
        border: none !important;
        z-index: 9999 !important;
        transition: all 0.4s ease-in-out !important;
    }

    /* State saat scroll ke bawah */
    .nav-scrolled {
        backdrop-filter: blur(10px);
        background-color: rgba(0,0,0,0.5) !important;
        padding: 5px 0 !important;
        box-shadow: 0 4px 15px rgba(0,0,0,0.3) !important;
    }

    .navbar-brand, .nav-link, .nav-item a {
        color: #ffffff !important;
        text-shadow: 0 1px 3px rgba(0, 0, 0, 0.5);
    }

    /* Memastikan Popup Fancybox selalu di posisi teratas, menutupi header */
    .fancybox__container {
        z-index: 99999 !important;
    }

    /* Hero Section */
    .project-hero {
        position: relative;
        width: 100%;
        height: 100vh;
        background-image: url('<?= base_url($p_image); ?>');
        background-size: cover;
        background-position: center;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .project-hero::before {
        content: '';
        position: absolute;
        inset: 0;
        background: rgba(0, 0, 0, 0.4);
        z-index: 1;
    }

    .project-hero h1 {
        position: relative;
        z-index: 2;
        color: #ffffff;
        font-size: clamp(2.5rem, 8vw, 4.5rem);
        font-weight: 400;
        letter-spacing: 2px;
        text-transform: capitalize;
        text-align: center;
        padding: 0 20px;
    }

    .hero-breadcrumb {
        position: absolute;
        bottom: 40px;
        left: 5%;
        z-index: 2;
        color: rgba(255, 255, 255, 0.7);
        font-size: 0.85rem;
        letter-spacing: 1.5px;
        text-transform: uppercase;
    }

    .hero-breadcrumb a {
        color: #ffffff;
        text-decoration: none;
        transition: color 0.3s ease;
    }

    .hero-breadcrumb a:hover { color: #cccccc; }

    /* Content Layout */
    .project-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 80px 20px;
    }

    .desc-text {
        text-align: left;
        max-width: 800px;
        margin: 0 auto 60px auto;
        color: #666;
        line-height: 1.8;
    }

    .desc-text h2 {
        font-style: italic;
        color: #333;
        margin-bottom: 30px;
        font-size: 1.5rem;
        text-align: center;
    }

    /* =========================================
       TATA LETAK GRID & PORTRAIT OPTIMALIZATION
       ========================================= */
    .gal-full { 
        width: 100%; 
        margin-bottom: 30px; 
    }
    
    .gal-grid { 
        display: grid; 
        grid-template-columns: 1fr 1fr; 
        gap: 30px; 
        margin-bottom: 30px; 
        align-items: start; 
    }
    
    .gal-full a, .gal-grid a { 
        display: block; 
        overflow: hidden; 
        border-radius: 4px; 
        background-color: #f4f4f4;
    }

    .gallery-img {
        width: 100%;
        height: auto; 
        display: block;
        object-fit: cover; 
        transition: transform 0.5s ease;
        cursor: pointer;
    }

    .gal-full a:hover .gallery-img, .gal-grid a:hover .gallery-img { 
        transform: scale(1.03); 
    }

    @media (max-width: 768px) {
        .gal-grid { grid-template-columns: 1fr; gap: 15px; }
        .project-hero { height: 70vh; }
        .hero-breadcrumb { bottom: 20px; left: 20px; font-size: 0.75rem; }
    }
</style>

<div class="project-hero">
    <h1 class="animate__animated animate__fadeInUp"><?= $p_title; ?></h1>

    <div class="hero-breadcrumb animate__animated animate__fadeIn">
        <a href="<?= site_url('projects'); ?>">Projects</a> &nbsp;/&nbsp; Detail &nbsp;/&nbsp; <?= $p_title; ?>
    </div>
</div>

<div class="project-container">
    <div class="desc-text animate__animated animate__fadeInUp">
        <?php if ($p_subtitle !== ''): ?>
            <h2>"<?= $p_subtitle; ?>"</h2>
        <?php endif; ?>

        <?php if ($p_desc1 !== ''): ?>
            <p><?= nl2br($p_desc1); ?></p>
        <?php endif; ?>
    </div>

    <div class="gallery-wrapper">
        <?php if (!empty($galleries)):
            $galeri_array = json_decode(json_encode($galleries), true);
            $chunks = array_chunk($galeri_array, 3);
            foreach ($chunks as $index => $chunk):
        ?>
                <?php if (isset($chunk[0])): ?>
                    <div class="gal-full">
                        <a href="<?= base_url((string)$chunk[0]['image_url']); ?>" data-fancybox="gallery" data-type="image" data-caption="<?= $p_title; ?>">
                            <img src="<?= base_url((string)$chunk[0]['image_url']); ?>" class="gallery-img" alt="Gallery" loading="lazy">
                        </a>
                    </div>
                <?php endif; ?>

                <?php if (isset($chunk[1]) || isset($chunk[2])): ?>
                    <div class="gal-grid">
                        <?php if (isset($chunk[1])): ?>
                            <a href="<?= base_url((string)$chunk[1]['image_url']); ?>" data-fancybox="gallery" data-type="image" data-caption="<?= $p_title; ?>">
                                <img src="<?= base_url((string)$chunk[1]['image_url']); ?>" class="gallery-img" alt="Gallery" loading="lazy">
                            </a>
                        <?php endif; ?>
                        <?php if (isset($chunk[2])): ?>
                            <a href="<?= base_url((string)$chunk[2]['image_url']); ?>" data-fancybox="gallery" data-type="image" data-caption="<?= $p_title; ?>">
                                <img src="<?= base_url((string)$chunk[2]['image_url']); ?>" class="gallery-img" alt="Gallery" loading="lazy">
                            </a>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>

                <?php if ($index === 0 && $p_desc2 !== ''): ?>
                    <div class="desc-text" style="text-align: left; margin: 60px 0;">
                        <p><?= nl2br($p_desc2); ?></p>
                    </div>
                <?php endif; ?>

            <?php endforeach;
        else: ?>
            <p style="text-align:center; color:#999; padding: 40px 0;">There are no gallery photos for this project yet.</p>
        <?php endif; ?>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>
<script>
    // Optimasi Konfigurasi Fancybox
    Fancybox.bind('[data-fancybox="gallery"]', {
        Hash: false, // Mematikan update URL hashtag (Sering bikin lag saat load gambar)
        Toolbar: {
            display: {
                left: ["infobar"],
                middle: ["zoomIn", "zoomOut", "toggle1to1"],
                right: ["slideshow", "download", "thumbs", "close"],
            },
        },
        Images: {
            zoom: true,
        },
        Carousel: {
            transition: "slide",
        }
    });

    // Script Sticky Navbar
    window.addEventListener('scroll', function() {
        const nav = document.querySelector('header') || document.querySelector('.navbar') || document.querySelector('.nav-header');
        if (nav) {
            if (window.scrollY > 50) {
                nav.classList.add('nav-scrolled');
            } else {
                nav.classList.remove('nav-scrolled');
            }
        }
    });
</script>

<?= $this->endSection(); ?>