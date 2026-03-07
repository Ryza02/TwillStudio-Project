<?= $this->extend('layout/base'); ?>

<?= $this->section('title'); ?><?= lang('Blog.hero_title') ?> - Twill Studio<?= $this->endSection(); ?>

<?= $this->section('content'); ?>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400;1,700&family=TT+Norms+Pro:wght@300;400;500;600;700&display=swap');

    body, html, main, .main-wrapper, #app { 
        padding-top: 0 !important; 
        margin-top: 0 !important; 
        font-family: 'TT Norms Pro', -apple-system, sans-serif;
        background-color: #f9f9f9; 
        color: #111827;
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

    /* HERO SECTION */
    .blog-hero {
        width: 100%; height: 55vh; min-height: 450px;
        background: linear-gradient(135deg, #2c3e50 0%, #4a5560 100%);
        position: relative; display: flex; flex-direction: column;
        align-items: center; justify-content: center; text-align: center;
        padding: 80px 20px 0 20px;
    }

    .blog-hero::after {
        content: ''; position: absolute; bottom: 0; left: 0; width: 100%; height: 40%;
        background: linear-gradient(to top, #f9f9f9 0%, transparent 100%); pointer-events: none;
    }

    .blog-hero h1 {
        color: #ffffff; font-family: 'Playfair Display', serif; font-size: clamp(2.5rem, 6vw, 4.5rem);
        font-weight: 700; letter-spacing: 2px; z-index: 2;
    }

    .hero-accent-line { width: 80px; height: 1px; background-color: #C5A059; margin: 15px auto 25px auto; z-index: 2; }

    .blog-hero p {
        color: #e5e7eb; font-size: clamp(1rem, 2vw, 1.15rem); letter-spacing: 3px;
        text-transform: uppercase; z-index: 2;
    }

    .news-container { max-width: 1280px; margin: -60px auto 100px auto; padding: 0 30px; position: relative; z-index: 5; }
    .news-grid-main { display: grid; grid-template-columns: 2fr 1fr; gap: 40px; }

    .master-wrapper {
        display: grid; grid-template-columns: 1fr 1.2fr; gap: 40px; background: #ffffff;
        border: 1px solid #C5A059; padding: 40px; transition: all 0.4s ease;
    }
    .master-wrapper:hover { box-shadow: 0 15px 35px rgba(197, 160, 89, 0.15); transform: translateY(-5px); }

    .category-label {
        color: #C5A059; font-weight: 700; font-size: 0.8rem; text-transform: uppercase;
        letter-spacing: 2px; margin-bottom: 20px; display: inline-flex; align-items: center; gap: 10px;
    }
    .category-label::before { content: ''; width: 20px; height: 1px; background-color: #C5A059; }

    .master-title { font-family: 'Playfair Display', serif; font-size: clamp(1.8rem, 3vw, 2.5rem); line-height: 1.2; margin-bottom: 20px; }
    .master-title a { color: #111827; text-decoration: none; }
    .master-title a:hover { color: #C5A059; }

    .master-excerpt { font-size: 1.05rem; color: #4b5563; line-height: 1.7; margin-bottom: 30px; }

    .read-more-link {
        font-size: 0.9rem; color: #111827; font-weight: 700; text-transform: uppercase;
        text-decoration: none; border-bottom: 1px solid #C5A059; padding-bottom: 5px;
    }

    .master-image-box { aspect-ratio: 4 / 5; overflow: hidden; background: #eaeaea; }
    .master-image-box img { width: 100%; height: 100%; object-fit: cover; transition: 0.8s ease; }
    .master-wrapper:hover .master-image-box img { transform: scale(1.05); }

    .sidebar-wrapper { background: #ffffff; border: 1px solid #C5A059; padding: 30px; }
    .sidebar-heading { font-family: 'Playfair Display', serif; font-size: 1.5rem; font-weight: 700; margin-bottom: 20px; border-bottom: 1px solid rgba(197, 160, 89, 0.4); padding-bottom: 15px; }
    .sidebar-item { display: flex; align-items: center; gap: 15px; padding: 15px 0; border-bottom: 1px dashed rgba(197, 160, 89, 0.4); text-decoration: none; color: inherit; }
    .sidebar-title { font-family: 'Playfair Display', serif; font-size: 1.05rem; font-weight: 600; margin: 0 0 5px 0; }
    .sidebar-image-box { width: 70px; height: 70px; flex-shrink: 0; overflow: hidden; border: 1px solid rgba(197, 160, 89, 0.3); }
    .sidebar-image-box img { width: 100%; height: 100%; object-fit: cover; }

    .more-articles-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 30px; margin-top: 40px; }
    .grid-card { background: #ffffff; border: 1px solid rgba(197, 160, 89, 0.5); padding: 20px; text-decoration: none; color: inherit; transition: 0.4s; }
    .grid-card:hover { transform: translateY(-5px); border-color: #C5A059; }
    .grid-card-image { width: 100%; aspect-ratio: 16/10; overflow: hidden; margin-bottom: 15px; }
    .grid-card-image img { width: 100%; height: 100%; object-fit: cover; }

    @media (max-width: 992px) { .news-grid-main { grid-template-columns: 1fr; } }
    @media (max-width: 768px) { .master-wrapper { grid-template-columns: 1fr; } .master-image-box { order: -1; aspect-ratio: 16/9; } }
</style>

<div class="blog-hero">
    <h1><?= lang('Blog.hero_title') ?></h1>
    <div class="hero-accent-line"></div>
    <p><?= lang('Blog.hero_desc') ?></p>
</div>

<div class="news-container">
    <?php 
    // ============================================
    // LOGIKA MASTER BLOG (Dari Controller)
    // ============================================
    $hasContent = !empty($featured_blog) || !empty($blogs);
    
    if ($hasContent): 
        // Siapkan data master blog
        $master_blog = $featured_blog;
        
        // Jika tidak ada featured, ambil yang pertama dari blogs
        if (empty($master_blog) && !empty($blogs)) {
            $master_blog = array_shift($blogs);
        }
        
        // Logika bahasa untuk master
        if ($master_blog):
            $m_title = ($lang === 'en' && !empty($master_blog['title_en'])) 
                ? $master_blog['title_en'] 
                : $master_blog['title'];
            $m_desc  = ($lang === 'en' && !empty($master_blog['description_1_en'])) 
                ? $master_blog['description_1_en'] 
                : $master_blog['description_1'];
        ?>

            <div class="news-grid-main">
                <div class="master-column">
                    <div class="master-wrapper animate__animated animate__fadeInUp">
                        <div class="master-text">
                            <span class="category-label"><?= lang('Blog.label_highlight') ?></span>
                            <h2 class="master-title">
                                <a href="<?= base_url('blog/' . esc($master_blog['slug'])) ?>"><?= esc($m_title) ?></a>
                            </h2>
                            <div class="master-excerpt">
                                <?= esc(mb_strimwidth(strip_tags((string)$m_desc), 0, 160, '...')) ?>
                            </div>
                            <a href="<?= base_url('blog/' . esc($master_blog['slug'])) ?>" class="read-more-link">
                                <?= lang('Blog.read_full') ?> &rarr;
                            </a>
                        </div>
                        <a href="<?= base_url('blog/' . esc($master_blog['slug'])) ?>" class="master-image-box">
                            <img src="<?= base_url(esc(!empty($master_blog['image_url']) ? $master_blog['image_url'] : 'uploads/blogs/default.jpg')) ?>" 
                                 alt="<?= esc($m_title) ?>"
                                 onerror="this.src='<?= base_url('uploads/blogs/default.jpg') ?>'">
                        </a>
                    </div>
                </div>

                <div class="sidebar-column">
                    <div class="sidebar-wrapper">
                        <div class="sidebar-heading"><?= lang('Blog.sidebar_title') ?></div>
                        <?php 
                        $sidebar_blogs = array_slice($blogs, 0, 4);
                        foreach ($sidebar_blogs as $blog): 
                            $s_title = ($lang === 'en' && !empty($blog['title_en'])) 
                                ? $blog['title_en'] 
                                : $blog['title'];
                        ?>
                            <a href="<?= base_url('blog/' . esc($blog['slug'])) ?>" class="sidebar-item">
                                <div style="flex:1">
                                    <h3 class="sidebar-title"><?= esc($s_title) ?></h3>
                                    <small style="color: #64748b; font-size: 0.75rem;"><?= date('d M Y', strtotime($blog['created_at'])) ?></small>
                                </div>
                                <div class="sidebar-image-box">
                                    <img src="<?= base_url(esc(!empty($blog['image_url']) ? $blog['image_url'] : 'uploads/blogs/default.jpg')) ?>" 
                                         alt="<?= esc($s_title) ?>"
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
                        $g_title = ($lang === 'en' && !empty($blog['title_en'])) 
                            ? $blog['title_en'] 
                            : $blog['title'];
                    ?>
                        <a href="<?= base_url('blog/' . esc($blog['slug'])) ?>" class="grid-card">
                            <div class="grid-card-image">
                                <img src="<?= base_url(esc(!empty($blog['image_url']) ? $blog['image_url'] : 'uploads/blogs/default.jpg')) ?>" 
                                     alt="<?= esc($g_title) ?>"
                                     onerror="this.src='<?= base_url('uploads/blogs/default.jpg') ?>'">
                            </div>
                            <h4 class="sidebar-title" style="font-size: 1.1rem; margin-bottom: 10px;"><?= esc($g_title) ?></h4>
                            <small style="color: #64748b;"><?= date('d M Y', strtotime($blog['created_at'])) ?></small>
                        </a>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

        <?php else: ?>
            <div style="text-align: center; padding: 100px 0; background: white; border: 1px solid #ddd; border-radius: 8px;">
                <h2 style="font-family: 'Playfair Display', serif; color: #111827;"><?= lang('Blog.no_posts') ?? 'Belum Ada Artikel' ?></h2>
                <p style="color: #64748b; margin-top: 10px;">Stay tuned for our latest updates.</p>
            </div>
        <?php endif; ?>
        
    <?php else: ?>
        <div style="text-align: center; padding: 100px 0; background: white; border: 1px solid #ddd; border-radius: 8px;">
            <h2 style="font-family: 'Playfair Display', serif; color: #111827;"><?= lang('Blog.no_posts') ?? 'Belum Ada Artikel' ?></h2>
            <p style="color: #64748b; margin-top: 10px;">Stay tuned for our latest updates.</p>
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