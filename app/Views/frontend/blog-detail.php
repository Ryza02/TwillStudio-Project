<?= $this->extend('layout/base'); ?>

<?php

$title   = '';
$desc1   = '';
$desc2   = '';
$image   = 'uploads/blogs/default.jpg';

if (is_array($blog) || is_object($blog)) {
    $blogArray = (array) $blog;

    if ($lang === 'en' && !empty($blogArray['title_en'])) {
        $title = (string) $blogArray['title_en'];
    } elseif (!empty($blogArray['title'])) {
        $title = (string) $blogArray['title'];
    }

    if ($lang === 'en' && !empty($blogArray['description_1_en'])) {
        $desc1 = (string) $blogArray['description_1_en'];
    } elseif (!empty($blogArray['description_1'])) {
        $desc1 = (string) $blogArray['description_1'];
    }

    if ($lang === 'en' && !empty($blogArray['description_2_en'])) {
        $desc2 = (string) $blogArray['description_2_en'];
    } elseif (!empty($blogArray['description_2'])) {
        $desc2 = (string) $blogArray['description_2'];
    }

    if (!empty($blogArray['image_url'])) {
        $image = (string) $blogArray['image_url'];
    }

    $createdAt = !empty($blogArray['created_at']) ? (string) $blogArray['created_at'] : date('Y-m-d H:i:s');
}
?>

<?= $this->section('title'); ?><?= esc($title) ?> - TWILL Studio<?= $this->endSection(); ?>

<?= $this->section('content'); ?>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400;1,700&family=TT+Norms+Pro:wght@300;400;500;600;700&display=swap');

    body,
    html,
    main,
    .main-wrapper,
    #app {
        padding-top: 0 !important;
        margin-top: 0 !important;
        font-family: 'TT Norms Pro', -apple-system, sans-serif;
    }

    header,
    .navbar,
    .nav-header,
    #header {
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

    .nav-scrolled {
        backdrop-filter: blur(10px);
        padding: 5px 0 !important;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3) !important;
    }

    .navbar-brand,
    .nav-link,
    .nav-item a {
        color: #ffffff !important;
        text-shadow: 0 1px 3px rgba(0, 0, 0, 0.5);
    }

    .article-hero {
        width: 100%;
        height: 65vh;
        min-height: 450px;
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        padding: 0 20px;
    }

    .article-hero-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(to bottom, rgba(44, 62, 80, 0.7) 0%, rgba(26, 32, 44, 0.95) 100%);
        z-index: 1;
    }

    .article-hero-content {
        position: relative;
        z-index: 2;
        max-width: 900px;
        margin-top: 60px;
    }

    .article-category {
        color: #C5A059;
        font-family: 'TT Norms Pro', sans-serif;
        font-weight: 700;
        font-size: 0.9rem;
        text-transform: uppercase;
        letter-spacing: 3px;
        margin-bottom: 20px;
        display: inline-block;
        border-bottom: 1px solid #C5A059;
        padding-bottom: 5px;
    }

    .article-hero-title {
        color: #ffffff;
        font-family: 'Playfair Display', serif;
        font-size: clamp(2.5rem, 5vw, 4rem);
        line-height: 1.2;
        font-weight: 700;
        margin-bottom: 25px;
        text-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
    }

    .article-meta {
        color: #cbd5e1;
        font-size: 0.95rem;
        letter-spacing: 1px;
        font-family: 'TT Norms Pro', sans-serif;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 15px;
    }

    .meta-divider {
        color: #C5A059;
    }

    .article-container {
        max-width: 1100px;
        margin: -80px auto 100px auto;
        position: relative;
        z-index: 5;
        background: #ffffff;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.08);
        display: flex;
        flex-direction: column;
    }

    .article-body-wrapper {
        display: flex;
        flex-direction: column;
    }

    .article-desc-1 {
        padding: 60px 80px 40px 80px;
        font-family: 'Playfair Display', serif;
        font-size: 1.6rem;
        line-height: 1.6;
        color: #1f2937;
        font-weight: 600;
        text-align: center;
    }

    .article-main-image {
        padding: 0 80px 40px 80px;
        text-align: center;
    }

    .article-main-image img {
        width: 100%;
        max-height: 600px;
        object-fit: cover;
        border-radius: 4px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    }

    .article-desc-2 {
        padding: 20px 80px 60px 80px;
        font-size: 1.15rem;
        line-height: 1.8;
        color: #4b5563;
        border-top: 1px solid rgba(197, 160, 89, 0.2);
        margin-top: 20px;
    }

    .article-desc-2 p {
        margin-bottom: 25px;
    }

    .article-footer {
        padding: 30px 80px;
        background: #f8fafc;
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-top: 1px solid rgba(197, 160, 89, 0.3);
    }

    .back-btn {
        color: #111827;
        text-decoration: none;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
        font-size: 0.85rem;
        transition: color 0.3s;
    }

    .back-btn:hover {
        color: #C5A059;
    }

    @media (max-width: 768px) {
        .article-container {
            margin: -40px 15px 50px 15px;
        }

        .article-desc-1 {
            padding: 40px 30px;
            font-size: 1.3rem;
        }

        .article-main-image {
            padding: 0 20px 30px 20px;
        }

        .article-desc-2 {
            padding: 40px 30px;
            font-size: 1.05rem;
        }

        .article-footer {
            padding: 30px;
            flex-direction: column;
            gap: 20px;
        }
    }
</style>

<div class="article-hero" style="background-image: url('<?= base_url(esc($image)) ?>');">
    <div class="article-hero-overlay"></div>
    <div class="article-hero-content">
        <h1 class="article-hero-title"><?= esc($title) ?></h1>

        <div class="article-meta">
            <span>Oleh TWILL Studio</span>
            <span class="meta-divider">|</span>
            <span>
                <?php
                $date = strtotime($createdAt);
                echo date('d F Y', $date);
                ?>
            </span>
        </div>
    </div>
</div>

<div class="article-container">
    <div class="article-body-wrapper">

        <div class="article-desc-1">
            <?= nl2br(esc($desc1)) ?>
        </div>

        <?php if (!empty($blog['image_url'])): ?>
            <div class="article-main-image">
                <img src="<?= base_url(esc($image)) ?>"
                    alt="<?= esc($title) ?>"
                    onerror="this.src='<?= base_url('uploads/blogs/default.jpg') ?>'">
            </div>
        <?php endif; ?>

        <?php if (!empty($desc2)): ?>
            <div class="article-desc-2">
                <?= nl2br(esc($desc2)) ?>
            </div>
        <?php endif; ?>

        <div class="article-footer">
            <a href="<?= base_url('blog') ?>" class="back-btn">
                &larr; <?= $lang === 'en' ? 'Back to blog List' : 'Kembali ke Daftar blog' ?>
            </a>
            <div style="font-size: 0.85rem; color: #64748b; text-transform: uppercase; letter-spacing: 1px;">
                <?= lang('Blog.share') ?? 'Bagikan' ?>:
                <a href="#" style="color: #111; text-decoration: none; margin-left: 10px; border: 1px solid #ddd; padding: 4px 10px; border-radius: 2px;">FB</a>
                <a href="#" style="color: #111; text-decoration: none; margin-left: 5px; border: 1px solid #ddd; padding: 4px 10px; border-radius: 2px;">X</a>
                <a href="#" style="color: #111; text-decoration: none; margin-left: 5px; border: 1px solid #ddd; padding: 4px 10px; border-radius: 2px;">WA</a>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>
<script>
    Fancybox.bind('[data-fancybox="gallery"]', {
        loop: true,
        Toolbar: {
            display: ["zoom", "slideShow", "fullscreen", "download", "close"],
        },
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