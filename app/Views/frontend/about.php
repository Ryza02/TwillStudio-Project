<?= $this->extend('layout/base'); ?>

<?php 
$lang = session()->get('lang') ?? 'en'; 
$heroTitle = !empty($hero['title_'.$lang]) ? $hero['title_'.$lang] : $hero['title_id'];
$heroDesc = !empty($hero['desc_'.$lang]) ? $hero['desc_'.$lang] : $hero['desc_id'];
?>

<?= $this->section('title'); ?> <?= esc($heroTitle); ?> <?= $this->endSection(); ?>

<?= $this->section('content'); ?>

<link rel="stylesheet" href="<?= base_url('assets/css/frontend/about.css'); ?>">
<script src="https://unpkg.com/imagesloaded@4/imagesloaded.pkgd.min.js"></script>

<div data-scroll>
    <section class="page-hero">
        <h1><?= esc($heroTitle); ?></h1>
        <div class="hero-accent-line"></div>
        <p><?= esc($heroDesc); ?></p>
        
        <svg style="width: 40px; height: 60px; margin-top: 40px;" viewBox="0 0 60 80">
            <path d="M0 0 L30 22 L60 0" fill="none" stroke="var(--accent)" stroke-width="2" style="animation: down 2s infinite -1s; opacity:0;"></path>
            <path d="M0 20 L30 42 L60 20" fill="none" stroke="var(--accent)" stroke-width="2" style="animation: down 2s infinite -0.5s; opacity:0;"></path>
            <path d="M0 40 L30 62 L60 40" fill="none" stroke="var(--accent)" stroke-width="2" style="animation: down 2s infinite 0s; opacity:0;"></path>
        </svg>
    </section>

    <main id="smooth-wrapper">
        <div class="page page--layout-2">
            <div class="content content--alternate">

                <?php if(!empty($items)): ?>
                    <?php foreach($items as $item): 
                        $itemTitle = !empty($item['title_'.$lang]) ? $item['title_'.$lang] : $item['title_id'];
                        $itemDesc  = !empty($item['desc_'.$lang]) ? $item['desc_'.$lang] : $item['desc_id'];
                        $imgUrl = filter_var($item['image_url'], FILTER_VALIDATE_URL) ? $item['image_url'] : base_url($item['image_url']);
                    ?>
                        <div class="content__item">
                            <div class="content__item-img-container">
                                <div class="content__item-imgwrap">
                                    <div class="content__item-img" style="background-image: url('<?= esc($imgUrl); ?>');"></div>
                                </div>
                                <h2 class="content__item-title"><?= esc($itemTitle); ?></h2>
                            </div>
                            <p class="content__item-description">
                                <?= esc($itemDesc); ?>
                            </p>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p style="text-align: center;">Belum ada konten About.</p>
                <?php endif; ?>

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