<?= $this->extend('layout/base'); ?>

<?php
$lang = session()->get('lang') ?? 'en';

// Tambahkan (string) agar Intelephense tidak mengira ini array
$p_title = (string) esc(!empty($project['title_'.$lang]) ? $project['title_'.$lang] : ($project['title_id'] ?? $project['title'] ?? ''));
$p_subtitle = (string) esc(!empty($project['subtitle_'.$lang]) ? $project['subtitle_'.$lang] : ($project['subtitle_id'] ?? $project['subtitle'] ?? ''));
$p_desc1 = (string) esc(!empty($project['description_1_'.$lang]) ? $project['description_1_'.$lang] : ($project['description_1_id'] ?? $project['description_1'] ?? ''));
$p_desc2 = (string) esc(!empty($project['description_2_'.$lang]) ? $project['description_2_'.$lang] : ($project['description_2_id'] ?? $project['description_2'] ?? ''));
$p_image = (string) esc($project['image_url'] ?? '');
?>

<?= $this->section('title'); ?><?= $p_title; ?> - Twill Studio<?= $this->endSection(); ?>

<?= $this->section('content'); ?>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css" />
<link rel="stylesheet" href="<?= base_url('assets/css/frontend/project-detail.css'); ?>">

<div class="project-hero" style="background-image: url('<?= base_url($p_image); ?>');">
    <h1 class="animate__animated animate__fadeInUp"><?= $p_title; ?></h1>

    <div class="hero-breadcrumb animate__animated animate__fadeIn">
        <a href="<?= site_url('projects'); ?>"><?= (string) lang('Projects.hero_title') ?: 'Projects'; ?></a> &nbsp;/&nbsp; Detail &nbsp;/&nbsp; <?= $p_title; ?>
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
    Fancybox.bind('[data-fancybox="gallery"]', {
        Hash: false, 
        Toolbar: {
            display: {
                left: ["infobar"],
                middle: ["zoomIn", "zoomOut", "toggle1to1"],
                right: ["slideshow", "download", "thumbs", "close"],
            },
        },
        Images: { zoom: true },
        Carousel: { transition: "slide" }
    });

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