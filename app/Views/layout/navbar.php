<nav class="navbar" id="mainNavbar">
    <div class="navbar-container">
        <a href="<?= base_url('/'); ?>" class="navbar-brand">
            <img src="<?= base_url('assets/images/twll LOGO.png'); ?>" alt="TWILL Studio" class="brand-logo-img">
        </a>
        
        <button class="navbar-toggle" id="navbarToggle" aria-label="Menu">
            <span></span>
            <span></span>
            <span></span>
        </button>
        
        <ul class="navbar-menu" id="navbarMenu">
            <li><a href="<?= base_url('/'); ?>" class="nav-link"><?= lang('Navbar.home'); ?></a></li>
            <li><a href="<?= base_url('about'); ?>" class="nav-link"><?= lang('Navbar.about'); ?></a></li>
            <li><a href="<?= base_url('projects'); ?>" class="nav-link"><?= lang('Navbar.portfolio'); ?></a></li>
            <li><a href="<?= base_url('blog'); ?>" class="nav-link"><?= lang('Navbar.blog'); ?></a></li>
            <li><a href="<?= base_url('contact'); ?>" class="nav-link"><?= lang('Navbar.contact'); ?></a></li>
            
            <?php if (session()->get('logged_in')): ?>
                <li><a href="<?= base_url('admin/dashboard'); ?>" class="nav-link admin-link">Admin</a></li>
            <?php endif; ?>

            <li class="nav-item lang-switcher-container" style="margin-left: 15px;">
                <?php $currentLang = session()->get('lang') ?? config('App')->defaultLocale; ?>
                
                <div class="lang-toggle-wrapper">
                    <span class="lang-text <?= $currentLang === 'en' ? 'active-lang' : '' ?>">EN</span>
                    
                    <label class="lang-switch">
                        <input type="checkbox" id="langToggle" <?= $currentLang === 'id' ? 'checked' : '' ?>>
                        <span class="lang-slider round"></span>
                    </label>
                    
                    <span class="lang-text <?= $currentLang === 'id' ? 'active-lang' : '' ?>">ID</span>
                </div>
            </li>
        </ul>
    </div>
</nav>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const langToggle = document.getElementById('langToggle');
        
        if(langToggle) {
            langToggle.addEventListener('change', function() {
                // Jika dicentang arahkan ke ID, jika tidak arahkan ke EN
                if(this.checked) {
                    window.location.href = "<?= base_url('lang/switch/id'); ?>";
                } else {
                    window.location.href = "<?= base_url('lang/switch/en'); ?>";
                }
            });
        }
    });
    
    window.addEventListener('scroll', function() {
        const navbar = document.querySelector('.navbar');
        
        if (navbar) {
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        }
    });

    const navbarToggle = document.getElementById('navbarToggle');
    const navbarMenu = document.getElementById('navbarMenu');
    
    if (navbarToggle && navbarMenu) {
        navbarToggle.addEventListener('click', function() {
            navbarMenu.classList.toggle('active');
            this.classList.toggle('active');
        });
    }

    document.addEventListener("DOMContentLoaded", function() {
        const langToggle = document.getElementById('langToggle');
        
        if(langToggle) {
            langToggle.addEventListener('change', function() {
                if(this.checked) {
                    window.location.href = "<?= base_url('lang/switch/id'); ?>";
                } else {
                    window.location.href = "<?= base_url('lang/switch/en'); ?>";
                }
            });
        }
    });
</script>