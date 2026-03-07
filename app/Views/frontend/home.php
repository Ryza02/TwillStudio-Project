<?= $this->extend('layout/base'); ?>

<?= $this->section('title'); ?>Twill Studio.<?= $this->endSection(); ?>

<?= $this->section('styles'); ?>
<style>
    @font-face {
        font-family: 'TT Norms';
        src: url('<?= base_url('assets/fonts/TTNorms-Regular.woff'); ?>') format('woff');
        font-weight: normal;
        font-style: normal;
    }

    :root {
        --gold: #C5A059;
        --gold-light: #dfc185;
        --onyx: #111827;
        --slate: #4b5563;
        --white: #ffffff;
        --off-white: #fafafa;
    }

    .home-wrapper {
        font-family: 'TT Norms', sans-serif;
        background-color: var(--off-white);
        color: var(--onyx);
    }

    .about-section {
        padding: 120px 0;
        background: var(--onyx);
        color: var(--white);
        overflow: hidden;
    }

    .about-flex {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 60px;
        flex-wrap: nowrap;
    }

    .about-text {
        flex: 1;
        max-width: 450px;
        text-align: left;
    }

    .about-visual {
        flex: 1.5;
        min-width: 550px;
    }

    .gold-label {
        color: var(--gold);
        font-size: 0.85rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 2px;
        display: block;
        margin-bottom: 15px;
    }

    .about-text h2 {
        font-size: 3rem;
        margin-bottom: 25px;
        line-height: 1.1;
        font-weight: 800;
        color: var(--white);
    }

    .about-text p {
        color: #d1d5db;
        line-height: 1.7;
        margin-bottom: 30px;
    }

    .btn-gold {
        display: inline-block;
        padding: 12px 30px;
        background: transparent;
        border: 1px solid var(--gold);
        color: var(--gold) !important;
        text-decoration: none;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1px;
        transition: all 0.3s ease;
        border-radius: 50px;
    }

    .btn-gold:hover {
        background: var(--gold);
        color: rgba(255, 255, 255, 0.9) !important;
    }

    .btn-gold-dark {
        display: inline-block;
        padding: 12px 30px;
        background: transparent;
        border: 1px solid var(--onyx);
        color: var(--onyx) !important;
        text-decoration: none;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1px;
        transition: all 0.3s ease;
        border-radius: 50px;
    }

    .btn-gold-dark:hover {
        background: var(--onyx);
        color: rgba(255, 255, 255, 0.9) !important;
    }

    .flipbook-wrapper {
        position: relative;
        padding-bottom: 65%;
        height: 0;
        overflow: hidden;
        border: 1px solid rgba(197, 160, 89, 0.4);
        box-shadow: -15px 15px 40px rgba(0, 0, 0, 0.6);
    }

    .flipbook-wrapper iframe {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        border: none;
    }

    .flipbook-hint {
        text-align: center;
        margin-top: 15px;
        color: var(--gold);
        font-size: 0.8rem;
        text-transform: uppercase;
        letter-spacing: 2px;
    }

    @media (max-width: 992px) {
        .about-flex {
            flex-direction: column;
            text-align: center;
        }

        .about-text {
            max-width: 100%;
            text-align: center;
        }

        .about-visual {
            min-width: 100%;
            width: 100%;
        }
    }

    .spacer {
        width: 100%;
        height: 10vh;
    }

    .arch-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px;
    }

    .section-title-dark {
        font-size: 2.5rem;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 3px;
        margin-bottom: 50px;
        position: relative;
        display: inline-block;
        color: var(--onyx);
        text-align: center;
    }

    .section-title-dark::after {
        content: "";
        position: absolute;
        bottom: -15px;
        left: 50%;
        transform: translateX(-50%);
        width: 60px;
        height: 2px;
        background: var(--gold);
    }

    .arch {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 60px;
        width: 100%;
    }

    .arch__left {
        width: 45%;
        display: flex;
        flex-direction: column;
    }

    .arch__info {
        height: 100vh;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: flex-start;
        text-align: left;
    }

    .arch__info h2 {
        font-size: 36px;
        font-weight: 800;
        margin-bottom: 10px;
        color: var(--onyx);
        line-height: 1.2;
    }

    .arch__info p.meta {
        font-size: 14px;
        color: var(--gold);
        text-transform: uppercase;
        font-weight: 600;
        letter-spacing: 1px;
        margin-bottom: 15px;
    }

    .arch__info p.desc {
        font-size: 16px;
        color: var(--slate);
        line-height: 1.8;
        margin-bottom: 30px;
    }

    .arch__right {
        width: 50%;
        height: 100vh;
        position: relative;
        display: flex;
        align-items: center;
    }

    .img-wrapper {
        position: absolute;
        width: 100%;
        height: 65vh;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.1);
    }

    .img-wrapper img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    @media (max-width: 992px) {
        .arch {
            flex-direction: column;
            gap: 30px;
        }

        .arch__left {
            width: 100%;
        }

        .arch__info {
            height: auto;
            padding: 40px 0;
        }

        .arch__right {
            width: 100%;
            height: auto;
            position: static;
        }

        .img-wrapper {
            position: static;
            height: 350px;
            margin-bottom: 20px;
            border-radius: 12px;
        }
    }

    .projects-section {
        background-color: var(--off-white);
        transition: background-color 0.8s ease-in-out;
    }
</style>
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<div class="home-wrapper">

    <section class="hero-carousel">
        <div class="carousel-wrapper">
            <div class="carousel-slide active" style="background-image: url('<?= base_url('assets/images/hero-1.jpg'); ?>');">
                <div class="carousel-overlay"></div>
                <div class="carousel-content text-center">
                    <h1 class="animate__animated animate__fadeInUp"><?= lang('Home.hero_1_title'); ?></h1>
                    <p class="animate__animated animate__fadeInUp" style="animation-delay: 0.2s"><?= lang('Home.hero_1_subtitle'); ?></p>
                </div>
            </div>

            <div class="carousel-slide" style="background-image: url('<?= base_url('assets/images/hero-2.jpg'); ?>');">
                <div class="carousel-overlay"></div>
                <div class="carousel-content text-center">
                    <h1 class="animate__animated animate__fadeInUp"><?= lang('Home.hero_2_title'); ?></h1>
                    <p class="animate__animated animate__fadeInUp" style="animation-delay: 0.2s"><?= lang('Home.hero_2_subtitle'); ?></p>
                </div>
            </div>

            <div class="carousel-slide" style="background-image: url('<?= base_url('assets/images/hero-3.jpg'); ?>');">
                <div class="carousel-overlay"></div>
                <div class="carousel-content text-center">
                    <h1 class="animate__animated animate__fadeInUp"><?= lang('Home.hero_3_title'); ?></h1>
                    <p class="animate__animated animate__fadeInUp" style="animation-delay: 0.2s"><?= lang('Home.hero_3_subtitle'); ?></p>
                </div>
            </div>
        </div>

        <div class="carousel-dots" id="carouselDots"></div>
    </section>

    <section class="about-section">
        <div class="container">
            <div class="about-flex">
                <div class="about-text">
                    <span class="gold-label"><?= lang('Home.about_label'); ?></span>
                    <h2><?= lang('Home.about_title'); ?></h2>
                    <p><?= lang('Home.about_desc'); ?></p>
                    <a href="<?= base_url('about'); ?>" class="btn-gold"><?= lang('Home.about_btn'); ?></a>
                </div>

                <div class="about-visual">
                    <div class="flipbook-wrapper">
                        <iframe src="https://heyzine.com/flip-book/39864c69b0.html" allowfullscreen="true" scrolling="no"></iframe>
                    </div>
                    <p class="flipbook-hint"><?= lang('Home.flipbook_hint'); ?></p>
                </div>
            </div>
        </div>
    </section>

    <section class="projects-section" id="projects-section" style="padding-bottom: 100px;">
        <div class="spacer"></div>        
        <div class="arch-container">
            <div style="text-align: center;">
                <h2 class="section-title-dark"><?= lang('Home.projects_title'); ?></h2>
            </div>
            
            <?php $currentLang = session()->get('lang') ?? 'id'; ?>
            
            <div class="arch">
                <div class="arch__left">
                    <?php 
                    $displayProjects = array_slice($projects, 0, 4);
                    $bgColors = ['#f4fce3', '#e6f7ff', '#fff0f3', '#fff4ed']; 

                    foreach ($displayProjects as $index => $project): 
                        $bgColor = isset($bgColors[$index]) ? $bgColors[$index] : 'var(--off-white)';
                        
                        $title = ($currentLang === 'en' && !empty($project['title_en'])) 
                            ? $project['title_en'] 
                            : $project['title_id'];
                        
                        $location = $project['location'];
                        $year = $project['year'];
                        
                        $description = ($currentLang === 'en' && !empty($project['description_1_en'])) 
                            ? $project['description_1_en'] 
                            : ($project['description_1_id'] ?? lang('Home.projects_desc_default'));
                    ?>
                        <div class="arch__info" data-bg="<?= $bgColor; ?>">
                            <h2><?= esc($title); ?></h2>
                            <p class="meta"><?= esc($location); ?> &bull; <?= esc($year); ?></p>
                            
                            <p class="desc">
                                <?= esc($description); ?>
                            </p>
                            
                            <a class="btn-gold-dark" href="<?= base_url('project/' . $project['id']); ?>">
                                <?= lang('Home.btn_view_detail'); ?>
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>

                <div class="arch__right">
                    <?php 
                    $totalProjects = count($displayProjects);
                    foreach ($displayProjects as $index => $project): 
                        $zIndex = $totalProjects - $index;
                        
                        $altText = ($currentLang === 'en' && !empty($project['title_en'])) 
                            ? $project['title_en'] 
                            : $project['title_id'];
                    ?>
                        <div class="img-wrapper" style="z-index: <?= $zIndex; ?>;">
                            <img src="<?= base_url($project['image_url']); ?>" alt="<?= esc($altText); ?>">
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="spacer"></div>
            
            <div style="text-align: center; padding-top: 50px;">
                <a href="<?= base_url('projects'); ?>" class="btn-gold-dark">
                    <?= lang('Home.btn_view_all'); ?>
                </a>
            </div>
        </div>
    </section>

</div> 
<?= $this->endSection(); ?>

<?= $this->section('js'); ?>
<script src="<?= base_url('assets/js/carousel.js'); ?>"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>

<script>
    gsap.registerPlugin(ScrollTrigger);

    let mm = gsap.matchMedia();

    mm.add("(min-width: 993px)", () => {
        const images = gsap.utils.toArray(".img-wrapper");
        const infos = gsap.utils.toArray(".arch__info");
        const sectionBg = document.getElementById("projects-section");

        let tl = gsap.timeline({
            scrollTrigger: {
                trigger: ".arch",
                start: "top 10%", 
                end: "bottom bottom", 
                pin: ".arch__right", 
                scrub: 1 
            }
        });

        images.forEach((img, i) => {
            if (images[i + 1]) {
                tl.to(img, {
                    clipPath: "inset(0% 0% 100% 0%)", 
                    ease: "none"
                });
            }
        });

        infos.forEach((info) => {
            const bgColor = info.getAttribute('data-bg');
            
            ScrollTrigger.create({
                trigger: info,
                start: "top 50%",
                end: "bottom 50%",
                onEnter: () => { sectionBg.style.backgroundColor = bgColor; },
                onEnterBack: () => { sectionBg.style.backgroundColor = bgColor; }
            });
        });
    });

    mm.add("(max-width: 992px)", () => {
        const images = gsap.utils.toArray(".img-wrapper img");
        const infos = gsap.utils.toArray(".arch__info");
        const sectionBg = document.getElementById("projects-section");

        images.forEach((img) => {
            gsap.to(img, {
                objectPosition: "50% 80%",
                ease: "none",
                scrollTrigger: {
                    trigger: img.parentElement,
                    start: "top bottom",
                    end: "bottom top",
                    scrub: true
                }
            });
        });

        infos.forEach((info) => {
            const bgColor = info.getAttribute('data-bg');
            
            ScrollTrigger.create({
                trigger: info,
                start: "top 60%", 
                end: "bottom 40%",
                onEnter: () => { sectionBg.style.backgroundColor = bgColor; },
                onEnterBack: () => { sectionBg.style.backgroundColor = bgColor; }
            });
        });
    }); 
</script>
<?= $this->endSection(); ?>