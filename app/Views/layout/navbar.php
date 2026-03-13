<?php
$uri = service('uri');
$currentPath = $uri->getPath();
?>

<link rel="stylesheet" href="<?= base_url('assets/css/navbar.css'); ?>">

<nav class="twill-navbar" id="twillMainNavbar">
    <div class="twill-navbar-container">
        <a href="<?= base_url('/'); ?>" class="twill-navbar-brand">
            <img src="<?= base_url('assets/images/twll LOGO.png'); ?>" alt="TWILL Studio" class="twill-navbar-logo">
        </a>
        
        <button class="twill-navbar-toggler" id="twillNavbarToggle" aria-label="Toggle navigation">
            <span class="twill-bar"></span>
            <span class="twill-bar"></span>
            <span class="twill-bar"></span>
        </button>
        
        <ul class="twill-navbar-nav" id="twillNavbarMenu">
            <li class="twill-nav-item">
                <a href="<?= base_url('/'); ?>" class="twill-nav-link <?= $currentPath === '' ? 'active' : '' ?>">
                    <?= lang('Navbar.home'); ?>
                </a>
            </li>
            <li class="twill-nav-item">
                <a href="<?= base_url('about'); ?>" class="twill-nav-link <?= $currentPath === 'about' ? 'active' : '' ?>">
                    <?= lang('Navbar.about'); ?>
                </a>
            </li>
            <li class="twill-nav-item">
                <a href="<?= base_url('projects'); ?>" class="twill-nav-link <?= $currentPath === 'projects' ? 'active' : '' ?>">
                    <?= lang('Navbar.portfolio'); ?>
                </a>
            </li>
            <li class="twill-nav-item">
                <a href="<?= base_url('blog'); ?>" class="twill-nav-link <?= $currentPath === 'blog' ? 'active' : '' ?>">
                    <?= lang('Navbar.blog'); ?>
                </a>
            </li>
            <li class="twill-nav-item">
                <a href="<?= base_url('contact'); ?>" class="twill-nav-link <?= $currentPath === 'contact' ? 'active' : '' ?>">
                    <?= lang('Navbar.contact'); ?>
                </a>
            </li>
            
            <?php if (session()->get('logged_in')): ?>
                <li class="twill-nav-item">
                    <a href="<?= base_url('admin/dashboard'); ?>" class="twill-nav-link twill-nav-link-admin">
                        Admin
                    </a>
                </li>
            <?php endif; ?>

            <li class="twill-nav-item twill-lang-switcher">
                <?php $currentLang = session()->get('lang') ?? 'en'; ?>
                <div class="twill-lang-wrapper">
                    <a href="<?= base_url('lang/switch/en'); ?>" class="twill-lang-option lang-switch-link <?= $currentLang === 'en' ? 'active' : '' ?>">EN</a>
                    <span class="twill-lang-separator">/</span>
                    <a href="<?= base_url('lang/switch/id'); ?>" class="twill-lang-option lang-switch-link <?= $currentLang === 'id' ? 'active' : '' ?>">ID</a>
                    <span class="twill-lang-separator">/</span>
                    <a href="<?= base_url('lang/switch/it'); ?>" class="twill-lang-option lang-switch-link <?= $currentLang === 'it' ? 'active' : '' ?>">IT</a>
                </div>
            </li>
        </ul>
    </div>
    
    <div class="twill-navbar-overlay" id="twillNavbarOverlay"></div>
</nav>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const navbar = document.getElementById('twillMainNavbar');
    const navbarToggle = document.getElementById('twillNavbarToggle');
    const navbarMenu = document.getElementById('twillNavbarMenu');
    const navbarOverlay = document.getElementById('twillNavbarOverlay');
    const navLinks = document.querySelectorAll('.twill-nav-link');

    window.addEventListener('scroll', function() {
        if (navbar) {
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        }
    });

    function toggleMenu() {
        if (navbarToggle) {
            navbarToggle.classList.toggle('active');
        }
        if (navbarMenu) {
            navbarMenu.classList.toggle('active');
        }
        if (navbarOverlay) {
            navbarOverlay.classList.toggle('active');
        }
        
        if (navbarMenu && navbarMenu.classList.contains('active')) {
            document.body.style.overflow = 'hidden';
        } else {
            document.body.style.overflow = '';
        }
    }

    if (navbarToggle) {
        navbarToggle.addEventListener('click', toggleMenu);
    }

    if (navbarOverlay) {
        navbarOverlay.addEventListener('click', toggleMenu);
    }

    navLinks.forEach(link => {
        link.addEventListener('click', () => {
            if (window.innerWidth <= 992) {
                toggleMenu();
            }
        });
    });

    const langLinks = document.querySelectorAll('.lang-switch-link');
    
    langLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault(); 
            
            const url = this.getAttribute('href');
            
            fetch(url)
                .then(response => {
                    window.location.reload(); 
                })
                .catch(error => {
                    console.error('Error switching language:', error);
                });
        });
    });
});
</script>