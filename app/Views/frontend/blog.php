<?= $this->extend('layout/base'); ?>

<?php
// Ambil sesi bahasa (default 'en')
$lang = session()->get('lang') ?? 'en';
?>

<?= $this->section('title'); ?> <?= (string) lang('Blog.title_up') ?> <?= $this->endSection(); ?>

<?= $this->section('content'); ?>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css" />
<link rel="stylesheet" href="<?= base_url('assets/css/frontend/blog.css'); ?>">

<div class="blog-hero">
    <h1><?= (string) lang('Blog.hero_title') ?></h1>
    <div class="hero-accent-line"></div>
    <p><?= (string) lang('Blog.hero_desc') ?></p>
</div>

<div class="news-container">
    <?php 
    $hasContent = !empty($featured_blog) || !empty($blogs);
    
    if ($hasContent): 
        $master_blog = $featured_blog;
        
        if (empty($master_blog) && !empty($blogs)) {
            $master_blog = array_shift($blogs);
        }
        
        if ($master_blog):
            // Sinkronisasi Bahasa dengan Fallback & Casting String
            $m_title = (string) esc(!empty($master_blog['title_'.$lang]) ? $master_blog['title_'.$lang] : ($master_blog['title_id'] ?? $master_blog['title'] ?? ''));
            $m_desc  = (string) esc(!empty($master_blog['description_1_'.$lang]) ? $master_blog['description_1_'.$lang] : ($master_blog['description_1_id'] ?? $master_blog['description_1'] ?? ''));
        ?>

            <div class="news-grid-main">
                <div class="master-column">
                    <div class="master-wrapper animate__animated animate__fadeInUp">
                        <div class="master-text">
                            <span class="category-label"><?= (string) lang('Blog.label_highlight') ?></span>
                            <h2 class="master-title">
                                <a href="<?= base_url('blog/' . esc($master_blog['slug'])) ?>"><?= $m_title ?></a>
                            </h2>
                            <div class="master-excerpt">
                                <?= mb_strimwidth(strip_tags($m_desc), 0, 160, '...') ?>
                            </div>
                            <a href="<?= base_url('blog/' . esc($master_blog['slug'])) ?>" class="read-more-link">
                                <?= (string) lang('Blog.read_full') ?> &rarr;
                            </a>
                        </div>
                        <a href="<?= base_url('blog/' . esc($master_blog['slug'])) ?>" class="master-image-box">
                            <img src="<?= base_url((string) esc(!empty($master_blog['image_url']) ? $master_blog['image_url'] : 'uploads/blogs/default.jpg')) ?>" 
                                 alt="<?= $m_title ?>"
                                 onerror="this.src='<?= base_url('uploads/blogs/default.jpg') ?>'">
                        </a>
                    </div>
                </div>

                <div class="sidebar-column">
                    <div class="sidebar-wrapper animate__animated animate__fadeInRight">
                        <div class="sidebar-heading"><?= (string) lang('Blog.sidebar_title') ?></div>
                        <?php 
                        $sidebar_blogs = array_slice($blogs, 0, 4);
                        foreach ($sidebar_blogs as $blog): 
                            // Sinkronisasi bahasa untuk sidebar
                            $s_title = (string) esc(!empty($blog['title_'.$lang]) ? $blog['title_'.$lang] : ($blog['title_id'] ?? $blog['title'] ?? ''));
                        ?>
                            <a href="<?= base_url('blog/' . esc($blog['slug'])) ?>" class="sidebar-item">
                                <div style="flex:1">
                                    <h3 class="sidebar-title"><?= $s_title ?></h3>
                                    <small style="color: #64748b; font-size: 0.75rem;"><?= date('d M Y', strtotime($blog['created_at'])) ?></small>
                                </div>
                                <div class="sidebar-image-box">
                                    <img src="<?= base_url((string) esc(!empty($blog['image_url']) ? $blog['image_url'] : 'uploads/blogs/default.jpg')) ?>" 
                                         alt="<?= $s_title ?>"
                                         onerror="this.src='<?= base_url('uploads/blogs/default.jpg') ?>'">
                                </div>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

            <?php if(count($blogs) > 4): ?>
                <div class="more-articles-grid">
                    <?php 
                    $bottom_blogs = array_slice($blogs, 4);
                    foreach ($bottom_blogs as $blog): 
                        // Sinkronisasi bahasa untuk grid
                        $g_title = (string) esc(!empty($blog['title_'.$lang]) ? $blog['title_'.$lang] : ($blog['title_id'] ?? $blog['title'] ?? ''));
                    ?>
                        <a href="<?= base_url('blog/' . esc($blog['slug'])) ?>" class="grid-card">
                            <div class="grid-card-image">
                                <img src="<?= base_url((string) esc(!empty($blog['image_url']) ? $blog['image_url'] : 'uploads/blogs/default.jpg')) ?>" 
                                     alt="<?= $g_title ?>"
                                     onerror="this.src='<?= base_url('uploads/blogs/default.jpg') ?>'">
                            </div>
                            <h4 class="sidebar-title" style="font-size: 1.1rem; margin-bottom: 10px;"><?= $g_title ?></h4>
                            <small style="color: #64748b;"><?= date('d M Y', strtotime($blog['created_at'])) ?></small>
                        </a>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

        <?php else: ?>
            <div class="empty-blog-state">
                <h2><?= (string) lang('Blog.no_posts') ?: 'Belum Ada Artikel' ?></h2>
                <p>Stay tuned for our latest updates.</p>
            </div>
        <?php endif; ?>
        
    <?php else: ?>
        <div class="empty-blog-state">
            <h2><?= (string) lang('Blog.no_posts') ?: 'Belum Ada Artikel' ?></h2>
            <p>Stay tuned for our latest updates.</p>
        </div>
    <?php endif; ?>
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