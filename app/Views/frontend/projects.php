<?= $this->extend('layout/base'); ?>

<?php
// 1. Ambil session bahasa (default 'en' agar sinkron dengan Navbar dan About)
$currentLang = session()->get('lang') ?? 'en';
?>

<?= $this->section('title'); ?><?= lang('Projects.hero_title') ?><?= $this->endSection(); ?>

<?= $this->section('content'); ?>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=TT+Norms+Pro:wght@300;400;500;600;700&display=swap');

    @font-face {
        font-family: "TT Norms";
        src: url('../fonts/tt-norms-regular.otf') format('opentype');
        font-weight: normal;
        font-style: normal;
        font-display: swap;
    }

    .portfolio-wrapper {
        font-family: 'TT Norms', serif;
        background-color: #fcfcfc;
        color: #111827;
    }

    .page-hero {
        width: 100%;
        height: 55vh;
        min-height: 450px;
        background: linear-gradient(135deg, #6b7280 0%, #4a5560 100%);
        position: relative;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        text-align: center;
        padding: 20px 20px 0 20px;
        color: #e5e7eb
    }

    .page-hero::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 30%;
        background: linear-gradient(to top, #fcfcfc 0%, transparent 100%);
        pointer-events: none;
    }

    .page-hero h1 {
        font-family: 'TT Norms', serif;
        font-size: clamp(2.5rem, 5vw, 4rem);
        font-weight: 700;
        letter-spacing: 2px;
        margin: 0 0 10px 0;
        z-index: 2;
    }

    .hero-accent-line {
        width: 60px;
        height: 2px;
        background-color: #C5A059;
        margin: 15px auto 25px auto;
        z-index: 2;
    }

    .page-hero p {
        color: #e5e7eb;
        font-size: 1.1rem;
        margin: 0;
        letter-spacing: 2px;
        text-transform: uppercase;
        z-index: 2;
    }

    .filter-container-wrapper {
        width: 100%;
        position: relative;
        margin-bottom: 60px;
    }

    .portfolio-filter {
        display: flex;
        flex-wrap: nowrap;
        gap: 12px;
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
        padding-bottom: 10px;
        scrollbar-width: none;
        -ms-overflow-style: none;
    }

    .portfolio-filter::-webkit-scrollbar {
        display: none;
    }

    .filter-btn {
        flex-shrink: 0;
        white-space: nowrap;
        background: #ffffff;
        border: 1px solid #e5e7eb;
        color: #6b7280;
        padding: 10px 28px;
        font-size: 0.85rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1.5px;
        border-radius: 50px;
        cursor: pointer;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .filter-btn.active {
        background: #C5A059;
        border-color: #C5A059;
        color: #ffffff;
        box-shadow: 0 8px 15px rgba(197, 160, 89, 0.3);
        transform: translateY(-2px);
    }

    @media (min-width: 769px) {
        .portfolio-filter {
            justify-content: center;
        }

        .portfolio-filter.banyak-item {
            justify-content: flex-start;
        }
    }


    @media (max-width: 768px) {
        .portfolio-filter {
            justify-content: flex-start;
            padding-left: 5px;
            padding-right: 20px;
        }
    }

    .projects-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 40px;
    }

    .project-card {
        background: #ffffff;
        border: 1px solid #f3f4f6;
        border-radius: 12px;
        overflow: hidden;
        transition: all 0.5s ease;
        font-family: 'TT Norms';
    }

    .project-card.hide {
        display: none !important;
    }

    .project-image-wrapper {
        width: 100%;
        aspect-ratio: 4 / 3;
        overflow: hidden;
    }

    .project-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.8s ease;
    }

    .project-card:hover .project-image {
        transform: scale(1.08);
    }

    .project-info {
        padding: 30px 20px;
        text-align: center;
    }

    .badge-category {
        font-size: 0.75rem;
        color: #C5A059;
        text-transform: uppercase;
        margin-bottom: 12px;
        display: block;
        font-weight: 700;
    }
</style>

<div class="portfolio-wrapper">
    <section class="page-hero">
        <h1><?= lang('Projects.hero_title') ?></h1>
        <div class="hero-accent-line"></div>
        <p><?= lang('Projects.hero_desc') ?></p>
    </section>

    <section class="projects-section" style="padding: 80px 0;">
        <div class="container" style="max-width: 1280px; margin: 0 auto; padding: 0 20px;">

            <div class="filter-container-wrapper">
                <?php
                $catCount = isset($categories) ? count($categories) : 0;
                $scrollClass = $catCount > 7 ? 'banyak-item' : '';
                ?>
                <div class="portfolio-filter <?= $scrollClass ?>">
                    <button class="filter-btn active" data-filter="all"><?= lang('Projects.filter_all') ?></button>
                    <?php if (isset($categories)): ?>
                        <?php foreach ($categories as $cat): ?>
                            <button class="filter-btn" data-filter="<?= esc($cat['name']); ?>"><?= esc($cat['name']); ?></button>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>

            <div class="projects-grid">
                <?php if (empty($projects)): ?>
                    <div style="grid-column: 1/-1; text-align:center; padding: 50px 0;">
                        <?= lang('Projects.no_projects') ?>
                    </div>
                <?php endif; ?>

                <?php foreach ($projects as $project):
                    // 2. Logika Judul Berdasarkan Bahasa
                    $projectTitle = !empty($project['title_' . $currentLang]) ? $project['title_' . $currentLang] : $project['title_id'];
                ?>
                    <div class="project-card" data-category="<?= esc($project['category']); ?>">
                        <a href="<?= base_url('project/' . $project['id']); ?>" style="text-decoration: none; color: inherit;">
                            <div class="project-image-wrapper">
                                <img src="<?= base_url($project['image_url']); ?>" alt="<?= esc($projectTitle); ?>" class="project-image">
                            </div>
                            <div class="project-info">
                                <span class="badge-category"><?= esc($project['category']); ?></span>
                                <h3 class="project-title" style="font-family:'TT Norms'; font-size:1.5rem; margin-bottom:10px;">
                                    <?= esc($projectTitle); ?>
                                </h3>
                                <p class="project-meta" style="color:#6b7280; font-size:0.85rem;">
                                    <?= esc($project['location']); ?> &bull; <?= esc($project['year']); ?>
                                </p>
                            </div>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const filterBtns = document.querySelectorAll('.filter-btn');
        const projects = document.querySelectorAll('.project-card');

        filterBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                filterBtns.forEach(b => b.classList.remove('active'));
                this.classList.add('active');

                let filterValue = this.getAttribute('data-filter').toLowerCase().trim();

                projects.forEach(project => {
                    let cat = project.getAttribute('data-category').toLowerCase().trim();
                    if (filterValue === 'all' || cat === filterValue) {
                        project.classList.remove('hide');
                        setTimeout(() => {
                            project.style.opacity = '1';
                        }, 10);
                    } else {
                        project.style.opacity = '0';
                        setTimeout(() => {
                            project.classList.add('hide');
                        }, 400);
                    }
                });
            });
        });
    });
</script>

<?= $this->endSection(); ?>