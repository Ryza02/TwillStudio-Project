<?= $this->extend('layout/base'); ?>

<?= $this->section('title'); ?><?= (string) lang('Home.title_up') ?><?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<div class="home-wrapper">

    <section class="hero-carousel">
        <div class="carousel-wrapper">
            <div class="carousel-slide active" style="background-image: url('<?= base_url('assets/images/h1.jpg'); ?>');">
                <div class="carousel-overlay"></div>
            </div>
            <div class="carousel-slide" style="background-image: url('<?= base_url('assets/images/h2.jpg'); ?>');">
                <div class="carousel-overlay"></div>
            </div>
            <div class="carousel-slide" style="background-image: url('<?= base_url('assets/images/h3.jpg'); ?>');">
                <div class="carousel-overlay"></div>
            </div>
            <div class="carousel-slide" style="background-image: url('<?= base_url('assets/images/h4.jpg'); ?>');">
                <div class="carousel-overlay"></div>
            </div>
            <div class="carousel-slide" style="background-image: url('<?= base_url('assets/images/h5.jpg'); ?>');">
                <div class="carousel-overlay"></div>
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

    <section class="projects-section" id="projects-section" style="transition: background-color 1.2s ease-in-out;">
        <div class="spacer"></div>        
        <div class="arch-container">
            <div style="text-align: center;">
                <h2 class="section-title-dark"><?= lang('Home.projects_title'); ?></h2>
            </div>
            
            <?php $currentLang = session()->get('lang') ?? 'en'; ?>
            
            <div class="arch">
                <div class="arch__left">
                    <?php 
                    $displayProjects = array_slice($projects, 0, 4);
                    $bgColors = ['#B1c7dd','#E2e5e8', '#B1c7dd', '#e2e5e8']; 

                    foreach ($displayProjects as $index => $project): 
                        $bgColor = isset($bgColors[$index]) ? $bgColors[$index] : 'var(--off-white)';
                        
                        $title = $project['title_id']; 
                        if ($currentLang === 'en' && !empty($project['title_en'])) {
                            $title = $project['title_en'];
                        } elseif ($currentLang === 'it' && !empty($project['title_it'])) {
                            $title = $project['title_it'];
                        }
                        
                        $location = $project['location'];
                        $year = $project['year'];
                        
                        // Logika Description untuk EN, ID, dan IT
                        $description = $project['description_1_id'] ?? lang('Home.projects_desc_default'); // Fallback default
                        if ($currentLang === 'en' && !empty($project['description_1_en'])) {
                            $description = $project['description_1_en'];
                        } elseif ($currentLang === 'it' && !empty($project['description_1_it'])) {
                            $description = $project['description_1_it'];
                        }
                    ?>
                        <div class="arch__info" data-bg="<?= $bgColor; ?>">
                            <h2><?= esc($title); ?></h2>
                            <p class="meta"><?= esc($location); ?> &bull; <?= esc($year); ?></p>
                            <p class="desc"><?= esc($description); ?></p>
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
                        
                        // Logika Alt Text Gambar untuk 3 Bahasa
                        $altText = $project['title_id'];
                        if ($currentLang === 'en' && !empty($project['title_en'])) {
                            $altText = $project['title_en'];
                        } elseif ($currentLang === 'it' && !empty($project['title_it'])) {
                            $altText = $project['title_it'];
                        }
                    ?>
                        <div class="img-wrapper" style="z-index: <?= $zIndex; ?>;">
                            <img src="<?= base_url($project['image_url']); ?>" alt="<?= esc($altText); ?>">
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="spacer"></div>
            
            <div style="display: flex; justify-content: center; align-items: center; width: 100%; padding: 0px 0; position: relative; z-index: 10;">
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

    mm.add("all", () => {
        const images = gsap.utils.toArray(".img-wrapper");
        const infos = gsap.utils.toArray(".arch__info");
        const sectionBg = document.getElementById("projects-section");

        let tl = gsap.timeline({
            scrollTrigger: {
                trigger: ".arch",
                start: "top top", 
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
</script>
<?= $this->endSection(); ?>