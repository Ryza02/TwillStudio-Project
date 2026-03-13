<?= $this->extend('layout/base'); ?>

<?php
$lang = session()->get('lang') ?? 'en';

$title   = '';
$desc1   = '';
$desc2   = '';
$image   = 'uploads/blogs/default.jpg';
$createdAt = date('Y-m-d H:i:s');

if (is_array($blog) || is_object($blog)) {
    $blogArray = (array) $blog;

    // Sinkronisasi bahasa yang lebih singkat (sama seperti di Project)
    $title = !empty($blogArray['title_'.$lang]) ? $blogArray['title_'.$lang] : ($blogArray['title_id'] ?? $blogArray['title'] ?? '');
    $desc1 = !empty($blogArray['description_1_'.$lang]) ? $blogArray['description_1_'.$lang] : ($blogArray['description_1_id'] ?? $blogArray['description_1'] ?? '');
    $desc2 = !empty($blogArray['description_2_'.$lang]) ? $blogArray['description_2_'.$lang] : ($blogArray['description_2_id'] ?? $blogArray['description_2'] ?? '');

    if (!empty($blogArray['image_url'])) {
        $image = $blogArray['image_url'];
    }

    if (!empty($blogArray['created_at'])) {
        $createdAt = $blogArray['created_at'];
    }
}
?>

<?= $this->section('title'); ?><?= (string) esc($title) ?> - TWILL Studio<?= $this->endSection(); ?>

<?= $this->section('content'); ?>

<link rel="stylesheet" href="<?= base_url('assets/css/frontend/blog-detail.css'); ?>">

<div class="article-hero" style="background-image: url('<?= base_url((string) esc($image)) ?>');">
    <div class="article-hero-overlay"></div>
    <div class="article-hero-content">
        <h1 class="article-hero-title animate__animated animate__fadeInUp"><?= (string) esc($title) ?></h1>

        <div class="article-meta animate__animated animate__fadeIn">
            <span>By TWILL Studio</span>
            <span class="meta-divider">|</span>
            <span>
                <?php
                $date = strtotime((string) $createdAt);
                echo date('d F Y', $date);
                ?>
            </span>
        </div>
    </div>
</div>

<div class="article-container">
    <div class="article-body-wrapper">

        <?php if (!empty($desc1)): ?>
            <div class="article-desc-1 animate__animated animate__fadeInUp">
                <?= nl2br((string) esc($desc1)) ?>
            </div>
        <?php endif; ?>

        <?php if (!empty($image) && $image !== 'uploads/blogs/default.jpg'): ?>
            <div class="article-main-image animate__animated animate__fadeIn">
                <img src="<?= base_url((string) esc($image)) ?>"
                     alt="<?= (string) esc($title) ?>"
                     onerror="this.src='<?= base_url('uploads/blogs/default.jpg') ?>'">
            </div>
        <?php endif; ?>

        <?php if (!empty($desc2)): ?>
            <div class="article-desc-2">
                <?= nl2br((string) esc($desc2)) ?>
            </div>
        <?php endif; ?>

        <div class="article-footer">
            <a href="<?= base_url('blog') ?>" class="back-btn">
                &larr; <?= $lang === 'en' ? 'Back to Blog List' : 'Kembali ke Daftar Blog' ?>
            </a>
            <div class="share-container">
                <?= (string) lang('Blog.share') ?: 'Share' ?>:
                <a href="#" class="share-btn">FB</a>
                <a href="#" class="share-btn">X</a>
                <a href="#" class="share-btn">WA</a>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>
<script>
    // Hanya sisakan script fungsional
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