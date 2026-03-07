<?= $this->extend('layout/base'); ?>

<?= $this->section('title'); ?><?= lang('About.hero_title') ?> - Twill Studio<?= $this->endSection(); ?>

<?= $this->section('content'); ?>

<script src="https://unpkg.com/imagesloaded@4/imagesloaded.pkgd.min.js"></script>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500&family=TT+Norms+Pro:wght@300;400;500;600;700&display=swap');

    :root {
        --primary: #111827;
        --secondary: #4b5563;
        --accent: #C5A059; /* Emas/Accent */
        --lighter: #ffffff;
        --off-white: #f9fafb;
        --border: #e5e7eb;
    }

    body { 
        font-family: 'TT Norms Pro', sans-serif;
        background-color: var(--off-white);
        margin: 0;
        -webkit-font-smoothing: antialiased;
    }

    body.loading {
        overflow: hidden;
    }

    /* =========================================
       HERO SECTION (Diperbaiki efek pudar ke bawah)
       ========================================= */
    .page-hero {
        margin-top: -100px;  
        width: 100%;
        height: 55vh; 
        min-height: 450px;
        background: linear-gradient(135deg, #2c3e50 0%, #4a5560 100%);
        position: relative;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        text-align: center;
        padding: 80px 20px 0 20px;
    }

    .page-hero::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 30%;
        background: linear-gradient(to top, var(--off-white) 0%, transparent 100%);
        pointer-events: none;
    }

    .page-hero h1 {
        font-family: 'Playfair Display', serif;
        font-size: clamp(2.5rem, 5vw, 4rem);
        font-weight: 700;
        letter-spacing: 2px;
        margin: 0 0 10px 0;
        z-index: 2;
        color:#e5e7eb;
    }

    .hero-accent-line {
        width: 60px;
        height: 2px;
        background-color: var(--accent);
        margin: 15px auto 25px auto;
        z-index: 2;
    }

    .page-hero p {
        color: #e5e7eb;
        font-size: 1.1rem;
        letter-spacing: 2px;
        text-transform: uppercase;
        max-width: 600px;
        margin: 0 auto;
        z-index: 2;
    }

    #smooth-wrapper {
        width: 100%;
        overflow: hidden;
    }

    .page {
        padding: 5vw;
        max-width: 1100px;
        margin: 0 auto;
    }

    .content {
        margin: 10vh 0 20vh;
    }

    /* Flexbox Layout - Stabil */
    .content__item {
        display: flex;
        flex-direction: row;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 25vh;
        width: 100%;
    }

    .content__item:nth-child(even) {
        flex-direction: row-reverse;
    }

    .content__item-img-container {
        position: relative;
        width: 45%; 
        flex-shrink: 0;
    }

    .content__item-imgwrap {
        position: relative;
        width: 100%;
        padding-bottom: 120%; 
        overflow: hidden;
        box-shadow: 0 15px 35px rgba(0,0,0,0.15);
        will-change: transform;
    }

    .content__item-img {
        --overflow: 40px;
        height: calc(100% + (2 * var(--overflow)));
        top: calc(-1 * var(--overflow));
        width: 100%;
        position: absolute;
        background-size: cover;
        background-position: center;
        will-change: transform;
        filter: grayscale(20%);
        transition: filter 0.5s ease;
    }

    .content__item-imgwrap:hover .content__item-img {
        filter: grayscale(0%);
    }

    .content__item-title {
        position: absolute;
        bottom: -3%; 
        left: -18%;  
        font-family: 'Playfair Display', serif;
        font-style: italic;
        font-weight: 500;
        font-size: clamp(2rem, 3.5vw, 3.2rem);
        color: var(--accent);
        margin: 0;
        z-index: 10;
        line-height: 1;
        text-shadow: 2px 2px 10px rgba(255, 255, 255, 0.9);
        pointer-events: none;
    }

    .content__item:nth-child(even) .content__item-title {
        left: auto;
        right: -18%;
    }

    .content__item-description {
        width: 45%; 
        margin: 0;
        color: var(--secondary);
        line-height: 1.8;
        font-size: 1.1rem;
        padding-top: 1rem;
    }

    @media screen and (max-width: 768px) {
        .content__item, 
        .content__item:nth-child(even) {
            flex-direction: column; 
            gap: 2rem;
        }
        
        .content__item-img-container {
            width: 80%; 
            margin: 0 auto;
        }

        .content__item-title {
            left: -5% !important; 
            right: auto !important;
            bottom: -5%;
            font-size: 2.5rem;
        }

        .content__item-description {
            width: 90%;
            text-align: center;
        }
    }
</style>

<div data-scroll>
    <section class="page-hero">
        <h1><?= lang('About.hero_title') ?></h1>
        <div class="hero-accent-line"></div>
        <p><?= lang('About.hero_desc') ?></p>
        
        <svg style="width: 40px; height: 60px; margin-top: 40px;" viewBox="0 0 60 80">
            <path d="M0 0 L30 22 L60 0" fill="none" stroke="var(--accent)" stroke-width="2" style="animation: down 2s infinite -1s; opacity:0;"></path>
            <path d="M0 20 L30 42 L60 20" fill="none" stroke="var(--accent)" stroke-width="2" style="animation: down 2s infinite -0.5s; opacity:0;"></path>
            <path d="M0 40 L30 62 L60 40" fill="none" stroke="var(--accent)" stroke-width="2" style="animation: down 2s infinite 0s; opacity:0;"></path>
        </svg>
        <style>@keyframes down { 0%{opacity:0} 25%{opacity:1} 75%{opacity:0} 100%{opacity:0} }</style>
    </section>

    <main id="smooth-wrapper">
        <div class="page page--layout-2">
            <div class="content content--alternate">

                <div class="content__item">
                    <div class="content__item-img-container">
                        <div class="content__item-imgwrap">
                            <div class="content__item-img" style="background-image: url('<?= base_url('assets/images/about.jpg'); ?>');"></div>
                        </div>
                        <h2 class="content__item-title"><?= lang('About.item1_title') ?></h2>
                    </div>
                    <p class="content__item-description">
                        <?= lang('About.item1_desc') ?>
                    </p>
                </div>

                <div class="content__item">
                    <div class="content__item-img-container">
                        <div class="content__item-imgwrap">
                            <div class="content__item-img" style="background-image: url('https://images.unsplash.com/photo-1600585154340-be6161a56a0c?auto=format&fit=crop&w=800&q=80');"></div>
                        </div>
                        <h2 class="content__item-title"><?= lang('About.item2_title') ?></h2>
                    </div>
                    <p class="content__item-description">
                        <?= lang('About.item2_desc') ?>
                    </p>
                </div>

                <div class="content__item">
                    <div class="content__item-img-container">
                        <div class="content__item-imgwrap">
                            <div class="content__item-img" style="background-image: url('https://images.unsplash.com/photo-1618221195710-dd6b41faaea6?auto=format&fit=crop&w=800&q=80');"></div>
                        </div>
                        <h2 class="content__item-title"><?= lang('About.item3_title') ?></h2>
                    </div>
                    <p class="content__item-description">
                        <?= lang('About.item3_desc') ?>
                    </p>
                </div>

                <div class="content__item">
                    <div class="content__item-img-container">
                        <div class="content__item-imgwrap">
                            <div class="content__item-img" style="background-image: url('<?= base_url('assets/images/founder.jpg'); ?>');"></div>
                        </div>
                        <h2 class="content__item-title"><?= lang('About.item4_title') ?></h2>
                    </div>
                    <p class="content__item-description">
                        <?= lang('About.item4_desc') ?>
                    </p>
                </div>

                <div class="content__item">
                    <div class="content__item-img-container">
                        <div class="content__item-imgwrap">
                            <div class="content__item-img" style="background-image: url('<?= base_url('assets/images/cofounder.jpg'); ?>');"></div>
                        </div>
                        <h2 class="content__item-title"><?= lang('About.item5_title') ?></h2>
                    </div>
                    <p class="content__item-description">
                        <?= lang('About.item5_desc') ?>
                    </p>
                </div>

            </div>
        </div>
    </main>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const MathUtils = {
            map: (x, a, b, c, d) => ((x - a) * (d - c)) / (b - a) + c,
            lerp: (a, b, n) => (1 - n) * a + n * b,
            getRandomFloat: (min, max) => (Math.random() * (max - min) + min).toFixed(2)
        };

        let winsize;
        const calcWinsize = () => (winsize = { width: window.innerWidth, height: window.innerHeight });
        calcWinsize();
        window.addEventListener("resize", calcWinsize);

        let docScroll;
        const getPageYScroll = () => (docScroll = window.pageYOffset || document.documentElement.scrollTop);
        window.addEventListener("scroll", getPageYScroll);
        getPageYScroll();

        class Item {
            constructor(el) {
                this.DOM = { el: el };
                this.DOM.image = this.DOM.el.querySelector(".content__item-img");
                this.DOM.imageWrapper = this.DOM.image.parentNode;
                
                this.DOM.el.style.perspective = "1000px";
                this.DOM.imageWrapper.style.transformOrigin = "50% 100%";
                this.ry = MathUtils.getRandomFloat(-0.2, 0.2);
                this.rz = MathUtils.getRandomFloat(-0.2, 0.2);
                
                this.renderedStyles = {
                    innerTranslationY: {
                        previous: 0, current: 0, ease: 0.1,
                        setValue: () => {
                            const toValue = parseInt(getComputedStyle(this.DOM.image).getPropertyValue("--overflow"), 10);
                            const fromValue = -1 * toValue;
                            return Math.max(Math.min(MathUtils.map(this.props.top - docScroll, winsize.height, -1 * this.props.height, fromValue, toValue), toValue), fromValue);
                        }
                    },
                    itemRotation: {
                        previous: 0, current: 0, ease: 0.1,
                        toValue: Number(MathUtils.getRandomFloat(-12, -4)), 
                        setValue: () => {
                            const toValue = this.renderedStyles.itemRotation.toValue;
                            const fromValue = toValue * -1;
                            const val = MathUtils.map(this.props.top - docScroll, winsize.height * 1.5, -1 * this.props.height, fromValue, toValue);
                            return Math.min(Math.max(val, toValue), fromValue);
                        }
                    }
                };
                
                this.getSize();
                this.update();
                this.observer = new IntersectionObserver((entries) => {
                    entries.forEach((entry) => (this.isVisible = entry.intersectionRatio > 0));
                });
                this.observer.observe(this.DOM.el);
                this.initEvents();
            }
            update() {
                for (const key in this.renderedStyles) {
                    this.renderedStyles[key].current = this.renderedStyles[key].previous = this.renderedStyles[key].setValue();
                }
                this.layout();
            }
            getSize() {
                const rect = this.DOM.el.getBoundingClientRect();
                this.props = { height: rect.height, top: docScroll + rect.top };
            }
            initEvents() {
                window.addEventListener("resize", () => this.resize());
            }
            resize() {
                this.getSize();
                this.update();
            }
            render() {
                for (const key in this.renderedStyles) {
                    this.renderedStyles[key].current = this.renderedStyles[key].setValue();
                    this.renderedStyles[key].previous = MathUtils.lerp(this.renderedStyles[key].previous, this.renderedStyles[key].current, this.renderedStyles[key].ease);
                }
                this.layout();
            }
            layout() {
                this.DOM.image.style.transform = `translate3d(0,${this.renderedStyles.innerTranslationY.previous}px,0)`;
                this.DOM.imageWrapper.style.transform = `rotate3d(1,${this.ry},${this.rz},${this.renderedStyles.itemRotation.previous}deg)`;
            }
        }

        const items = [];
        [...document.querySelectorAll(".content__item")].forEach((item) => items.push(new Item(item)));

        const render = () => {
            for (const item of items) {
                if (item.isVisible) {
                    if (item.insideViewport) { item.render(); } 
                    else { item.insideViewport = true; item.update(); }
                } else { item.insideViewport = false; }
            }
            requestAnimationFrame(render);
        };
        
        imagesLoaded(document.querySelectorAll('.content__item-img'), { background: true }, () => {
            document.body.classList.remove('loading');
            requestAnimationFrame(render);
        });
    });
</script>

<?= $this->endSection(); ?>