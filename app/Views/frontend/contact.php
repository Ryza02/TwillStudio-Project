<?= $this->extend('layout/base'); ?>

<?= $this->section('title'); ?><?= lang('Contact.title') ?> - Twill Studio<?= $this->endSection(); ?>

<?= $this->section('content'); ?>

<script src="https://unpkg.com/lucide@latest"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=TT+Norms+Pro:wght@300;400;500;600;700&display=swap');

    :root {
        --primary: #111827;
        --accent: #C5A059;
        --text-light: #6B7280;
        --bg-white: #ffffff;
        --bg-soft: #F9FAFB;
        --border: #E5E7EB;
    }

    body { 
        font-family: 'TT Norms Pro', sans-serif; 
        background-color: var(--bg-white); 
        color: var(--primary);
        overflow-x: hidden;
    }

    /* =========================================
       1. HERO SECTION (Konsisten dengan Konsep)
       ========================================= */
    .page-hero {
        background: linear-gradient(135deg, #2c3e50 0%, #4a5560 100%);
        padding: 180px 20px 100px 20px;
        margin-top: -100px;
        text-align: center;
        color: #ffffff;
        position: relative;
    }

    .page-hero::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 40%;
        background: linear-gradient(to top, var(--bg-white) 0%, transparent 100%);
        pointer-events: none;
    }

    .page-hero h1 {
        font-family: 'Playfair Display', serif;
        font-size: clamp(2.5rem, 6vw, 4.5rem);
        font-weight: 700;
        letter-spacing: -1px;
        margin-bottom: 15px;
        z-index: 2;
        position: relative;
    }

    .hero-accent-line {
        width: 50px; height: 1px;
        background-color: var(--accent);
        margin: 0 auto 25px auto;
        z-index: 2;
        position: relative;
    }

    .page-hero p {
        color: rgba(255,255,255,0.8);
        font-size: 0.95rem;
        letter-spacing: 3px;
        text-transform: uppercase;
        z-index: 2;
        position: relative;
    }

    /* =========================================
       2. CONTACT CONTENT - MINIMALIST SPLIT
       ========================================= */
    .contact-container {
        max-width: 1200px;
        margin: -40px auto 120px auto;
        padding: 0 30px;
        display: grid;
        grid-template-columns: 1fr 1.2fr;
        gap: 80px;
        position: relative;
        z-index: 10;
    }

    /* KIRI: Informasi Kontak */
    .contact-info-panel {
        padding-top: 20px;
    }

    .section-label {
        color: var(--accent);
        font-weight: 700;
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 2px;
        margin-bottom: 40px;
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .section-label::after {
        content: '';
        flex: 1;
        height: 1px;
        background: var(--border);
    }

    .contact-item {
        margin-bottom: 45px;
        display: flex;
        gap: 20px;
        transition: transform 0.3s ease;
    }

    .contact-item:hover { transform: translateX(5px); }

    .icon-box {
        width: 48px;
        height: 48px;
        background: var(--bg-soft);
        border: 1px solid var(--border);
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--accent);
        flex-shrink: 0;
        transition: all 0.3s ease;
    }

    .contact-item:hover .icon-box {
        background: var(--primary);
        color: var(--accent);
        border-color: var(--primary);
    }

    .contact-text h3 {
        font-family: 'Playfair Display', serif;
        font-size: 1.25rem;
        margin-bottom: 8px;
        font-weight: 600;
    }

    .contact-text p, .contact-text a {
        color: var(--text-light);
        font-size: 0.95rem;
        text-decoration: none;
        line-height: 1.6;
        transition: color 0.3s;
    }

    .contact-text a:hover { color: var(--accent); }

    /* KANAN: Map & Office */
    .map-panel {
        background: var(--bg-white);
        border: 1px solid var(--border);
        padding: 15px;
        box-shadow: 0 20px 50px rgba(0,0,0,0.03);
    }

    .map-wrapper {
        width: 100%;
        height: 100%;
        min-height: 500px;
        background: #f0f0f0;
        overflow: hidden;
    }

    .map-wrapper iframe {
        width: 100%;
        height: 100%;
        border: 0;
        filter: grayscale(1) contrast(1.2) opacity(0.8);
        transition: filter 0.5s ease;
    }

    .map-wrapper:hover iframe { filter: grayscale(0) opacity(1); }

    /* Office Hours Overlay (Floating Card) */
    .hours-card {
        margin-top: -80px;
        margin-left: -40px;
        background: var(--primary);
        color: #fff;
        padding: 30px;
        max-width: 280px;
        position: relative;
        z-index: 11;
        box-shadow: 0 10px 30px rgba(0,0,0,0.15);
    }

    .hours-card h4 {
        font-family: 'Playfair Display', serif;
        color: var(--accent);
        margin-bottom: 15px;
        font-size: 1.1rem;
    }

    .hours-card p {
        font-size: 0.85rem;
        opacity: 0.7;
        margin-bottom: 0;
        line-height: 1.7;
    }

    /* Social Bar */
    .social-bar {
        display: flex;
        gap: 20px;
        margin-top: 30px;
    }

    .social-link {
        color: var(--primary);
        transition: color 0.3s;
    }

    .social-link:hover { color: var(--accent); }

    @media (max-width: 992px) {
        .contact-container { grid-template-columns: 1fr; gap: 60px; }
        .hours-card { margin-left: 0; margin-top: 20px; max-width: 100%; }
        .map-wrapper { min-height: 350px; }
    }
</style>

<section class="page-hero">
    <div class="animate__animated animate__fadeIn">
        <p><?= lang('Contact.subtitle') ?></p>
        <h1><?= lang('Contact.title') ?></h1>
        <div class="hero-accent-line"></div>
    </div>
</section>

<div class="contact-container">
    
    <div class="contact-info-panel animate__animated animate__fadeInLeft">
        <div class="section-label"><?= lang('Contact.inquiries') ?></div>

        <div class="contact-item">
            <div class="icon-box">
                <i data-lucide="message-circle"></i>
            </div>
            <div class="contact-text">
                <h3>WhatsApp</h3>
                <p>Chat with our team for instant response.</p>
                <a href="https://wa.me/628123456789" target="_blank">+62 812 3456 789</a>
            </div>
        </div>

        <div class="contact-item">
            <div class="icon-box">
                <i data-lucide="mail"></i>
            </div>
            <div class="contact-text">
                <h3>Email</h3>
                <p>Send us your project brief or proposal.</p>
                <a href="mailto:info@twillstudio.com">info@twillstudio.com</a>
            </div>
        </div>

        <div class="contact-item">
            <div class="icon-box">
                <i data-lucide="instagram"></i>
            </div>
            <div class="contact-text">
                <h3>Instagram</h3>
                <p>Follow our daily updates and inspirations.</p>
                <a href="https://instagram.com/twillstudio" target="_blank">@twillstudio</a>
            </div>
        </div>

        <div class="social-bar">
            <a href="#" class="social-link"><i data-lucide="linkedin" size="20"></i></a>
            <a href="#" class="social-link"><i data-lucide="facebook" size="20"></i></a>
            <a href="#" class="social-link"><i data-lucide="youtube" size="20"></i></a>
        </div>
    </div>

    <div class="map-panel-container animate__animated animate__fadeInRight">
        <div class="map-panel">
            <div class="map-wrapper">
                <iframe 
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15846.33649491636!2d107.4912953!3d-6.8197178!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68e46950e30e7d%3A0x6b44910249c12297!2sKertamulya%2C%20Padalarang%2C%20West%20Bandung%20Regency%2C%20West%20Java!5e0!3m2!1sen!2sid!4v1710000000000!5m2!1sen!2sid" 
                    allowfullscreen="" 
                    loading="lazy">
                </iframe>
            </div>
        </div>

        <div class="hours-card">
            <h4><?= lang('Contact.opening_hrs') ?></h4>
            <p><strong>Studio Address:</strong><br>
            Kertamulya, Padalarang,<br>Bandung Barat, Jawa Barat.</p>
            <hr style="border: 0; border-top: 1px solid rgba(255,255,255,0.1); margin: 15px 0;">
            <p>Mon — Fri: 09:00 — 18:00<br>
            Saturday: By Appointment</p>
        </div>
    </div>

</div>

<div style="background: var(--bg-soft); padding: 100px 20px; text-align: center; border-top: 1px solid var(--border);">
    <div class="animate__animated animate__fadeInUp">
        <h2 style="font-family: 'Playfair Display', serif; font-size: 2rem; margin-bottom: 25px;">Ready to create something great?</h2>
        <a href="https://wa.me/628123456789" style="background: var(--primary); color: var(--accent); padding: 18px 40px; text-decoration: none; font-weight: 700; font-size: 0.8rem; letter-spacing: 2px; text-transform: uppercase; transition: 0.3s;">
            Book a Consultation
        </a>
    </div>
</div>

<script>
    // Initialize Lucide Icons
    lucide.createIcons();
</script>

<?= $this->endSection(); ?>