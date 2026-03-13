<!DOCTYPE html>
<html lang="<?= session()->get('lang') ?? 'en' ?>">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $this->renderSection('title'); ?> - TWILL Admin</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="<?= base_url('assets/css/admin/layout.css'); ?>">

    <style>
        .mobile-toggle {
            display: none;
            background: none;
            border: none;
            cursor: pointer;
            margin-right: 15px;
            color: #111827;
        }

        .sidebar-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            z-index: 998;
        }

        .header-left {
            display: flex;
            align-items: center;
        }

        .admin-lang-switcher {
            display: flex;
            align-items: center;
            padding: 10px 15px;
            margin: 5px 15px 15px 15px;
            background: rgba(0, 0, 0, 0.03);
            border-radius: 8px;
            gap: 10px;
        }

        .admin-lang-icon {
            color: #6b7280;
            width: 20px;
            height: 20px;
        }

        .admin-lang-options {
            display: flex;
            gap: 5px;
            flex: 1;
        }

        .admin-lang-btn {
            font-size: 12px;
            font-weight: 600;
            color: #6b7280;
            text-decoration: none;
            padding: 4px 8px;
            border-radius: 4px;
            transition: all 0.2s;
            cursor: pointer; /* Pastikan cursor pointer */
        }

        .admin-lang-btn:hover {
            background: rgba(0, 0, 0, 0.05);
            color: #111827;
        }

        .admin-lang-btn.active {
            background: #111827;
            color: #ffffff;
        }

        @media (max-width: 768px) {
            .mobile-toggle {
                display: block;
            }

            .admin-sidebar {
                transform: translateX(-100%);
                transition: transform 0.3s ease-in-out;
                position: fixed;
                z-index: 999;
                height: 100vh;
                left: 0;
            }

            .admin-sidebar.active {
                transform: translateX(0);
            }

            .sidebar-overlay.active {
                display: block;
            }

            .admin-main {
                margin-left: 0 !important;
                width: 100%;
                padding-top: 10px;
            }
        }
    </style>

    <?= $this->renderSection('styles'); ?>
</head>

<body>
    <div class="admin-container">

        <div id="sidebar-overlay" class="sidebar-overlay"></div>

        <aside class="admin-sidebar" id="admin-sidebar">
            <div class="sidebar-header">
                <div class="sidebar-logo">
                    <img src="<?= base_url('assets/images/twll LOGO.png'); ?>" alt="TWILL">
                </div>
                <div>
                    <div class="sidebar-title">TWILL ADMIN</div>
                </div>
            </div>

            <nav class="sidebar-menu">
                <?php $uri = service('uri')->getSegment(2); ?>

                <div class="sidebar-menu-section"><?= lang('Sidemin.main_menu') ?></div>

                <a href="<?= base_url('admin/dashboard'); ?>" class="sidebar-menu-item <?= ($uri == 'dashboard' || $uri == '') ? 'active' : '' ?>">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    <span><?= lang('Sidemin.dashboard') ?></span>
                </a>

                <a href="<?= base_url('admin/projects'); ?>" class="sidebar-menu-item <?= ($uri == 'projects' || $uri == 'project') ? 'active' : '' ?>">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                    </svg>
                    <span><?= lang('Sidemin.projects') ?></span>
                </a>

                <a href="<?= base_url('admin/categories'); ?>" class="sidebar-menu-item <?= ($uri == 'categories' || $uri == 'category') ? 'active' : '' ?>">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                    </svg>
                    <span><?= lang('Sidemin.category') ?></span>
                </a>

                <a href="<?= base_url('admin/blogs'); ?>" class="sidebar-menu-item <?= ($uri == 'blogs' || $uri == 'blog') ? 'active' : '' ?>">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                    </svg>
                    <span><?= lang('Sidemin.blog') ?></span>
                </a>

                <a href="<?= base_url('admin/gallery'); ?>" class="sidebar-menu-item <?= ($uri == 'gallery') ? 'active' : '' ?>">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    <span><?= lang('Sidemin.gallery') ?></span>
                </a>

                <a href="<?= base_url('admin/about'); ?>" class="sidebar-menu-item <?= ($uri == 'about') ? 'active' : '' ?>">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span><?= lang('Sidemin.about_us') ?></span>
                </a>

                <a href="<?= base_url('admin/logout'); ?>" class="sidebar-logout">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                    </svg>
                    <span><?= lang('Sidemin.logout') ?></span>
                </a>
            </nav>

            <div class="sidebar-footer">
                <div class="admin-lang-switcher">
                    <svg xmlns="http://www.w3.org/2000/svg" class="admin-lang-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 016.412 9m6.088 9h7M11 21l5-10 5 10M12.751 5C11.783 10.77 8.07 15.61 3 18.129" />
                    </svg>
                    <?php $currentLang = session()->get('lang') ?? 'id'; ?>
                    <div class="admin-lang-options">
                        <a href="<?= base_url('lang/switch/en'); ?>" class="admin-lang-btn lang-switch-link <?= $currentLang === 'en' ? 'active' : '' ?>">EN</a>
                        <a href="<?= base_url('lang/switch/id'); ?>" class="admin-lang-btn lang-switch-link <?= $currentLang === 'id' ? 'active' : '' ?>">ID</a>
                        <a href="<?= base_url('lang/switch/it'); ?>" class="admin-lang-btn lang-switch-link <?= $currentLang === 'it' ? 'active' : '' ?>">IT</a>
                    </div>
                </div>
                <div class="sidebar-user">
                    <div class="sidebar-user-avatar">
                        <?= strtoupper(substr(session()->get('username') ?? 'A', 0, 1)); ?>
                    </div>
                    <div class="sidebar-user-info">
                        <div class="sidebar-user-name"><?= esc(session()->get('username') ?? 'Admin'); ?></div>
                        <div class="sidebar-user-role"><?= lang('Sidemin.administrator') ?></div>
                    </div>
                </div>
            </div>
        </aside>

        <main class="admin-main">
            <header class="admin-header">
                <div class="header-left">
                    <button id="mobile-toggle" class="mobile-toggle">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" width="28" height="28">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                    <h1 class="admin-header-title"><?= $this->renderSection('page_title'); ?></h1>
                </div>
            </header>

            <div class="admin-content">
                <?= $this->renderSection('content'); ?>
            </div>
        </main>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // --- Logika Sidebar Mobile ---
            const toggleBtn = document.getElementById('mobile-toggle');
            const sidebar = document.getElementById('admin-sidebar');
            const overlay = document.getElementById('sidebar-overlay');

            if (toggleBtn) {
                toggleBtn.addEventListener('click', function() {
                    sidebar.classList.toggle('active');
                    overlay.classList.toggle('active');
                });
            }

            if (overlay) {
                overlay.addEventListener('click', function() {
                    sidebar.classList.remove('active');
                    overlay.classList.remove('active');
                });
            }

            // --- Logika Switch Bahasa (Mencegah Redirect) ---
            const langLinks = document.querySelectorAll('.lang-switch-link');
            
            langLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    // Mencegah browser pindah halaman secara langsung
                    e.preventDefault(); 
                    
                    const url = this.getAttribute('href');
                    
                    // Tembak URL switch language di background
                    fetch(url)
                        .then(response => {
                            // Setelah berhasil diset di session, reload halaman yang SEDANG aktif saat ini
                            window.location.reload(); 
                        })
                        .catch(error => {
                            console.error('Error switching language:', error);
                        });
                });
            });
        });
    </script>

    <?= $this->renderSection('scripts'); ?>
</body>

</html>