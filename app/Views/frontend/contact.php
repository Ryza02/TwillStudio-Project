<?= $this->extend('layout/base'); ?>

<?= $this->section('title'); ?><?= (string) lang('Contact.title') ?><?= $this->endSection(); ?>

<?= $this->section('content'); ?>

<script src="https://unpkg.com/lucide@latest"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
<link rel="stylesheet" href="<?= base_url('assets/css/frontend/contact.css'); ?>">

<section class="page-hero">
    <div class="animate__animated animate__fadeIn">
        <p><?= (string) lang('Contact.subtitle') ?></p>
        <h1><?= (string) lang('Contact.title') ?></h1>
        <div class="hero-accent-line"></div>
    </div>
</section>

<div class="contact-container">

    <div class="contact-info-panel animate__animated animate__fadeInLeft">
        <div class="section-label"><?= (string) lang('Contact.inquiries') ?></div>

        <div class="contact-item">
            <div class="icon-box">
                <i data-lucide="message-circle"></i>
            </div>
            <div class="contact-text">
                <h3><?= (string) lang('Contact.wa_title') ?></h3>
                <p><?= (string) lang('Contact.wa_desc') ?></p>
                <a href="https://wa.me/6282211222890" target="_blank">+62 822-1122-2890</a>
            </div>
        </div>

        <div class="contact-item">
            <div class="icon-box">
                <i data-lucide="mail"></i>
            </div>
            <div class="contact-text">
                <h3><?= (string) lang('Contact.email_title') ?></h3>
                <p><?= (string) lang('Contact.email_desc') ?></p>
                <a href="mailto:twillarchitettura@gmail.com">twillarchitettura@gmail.com</a>
            </div>
        </div>

        <div class="contact-item">
            <div class="icon-box">
                <i data-lucide="instagram"></i>
            </div>
            <div class="contact-text">
                <h3><?= (string) lang('Contact.ig_title') ?></h3>
                <p><?= (string) lang('Contact.ig_desc') ?></p>
                <a href="https://www.instagram.com/studiotwill?igsh=MXdkdHJsNm9waW40eA==" target="_blank">@studiotwill</a>
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
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3961.265249503468!2d107.4839843!3d-6.8587593!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68e367809cbba3%3A0xc3f837ff22197607!2sPadalarang%2C%20West%20Bandung%20Regency%2C%20West%20Java!5e0!3m2!1sen!2sid!4v1700000000000!5m2!1sen!2sid" 
                    allowfullscreen="" 
                    loading="lazy" 
                    referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>
        </div>

        <div class="hours-card">
            <h4><?= (string) lang('Contact.opening_hrs') ?></h4>
            <p><strong><?= (string) lang('Contact.studio_address') ?></strong><br>
                Kertamulya, Padalarang,<br>Bandung Barat, Jawa Barat.</p>
            <hr style="border: 0; border-top: 1px solid rgba(255,255,255,0.1); margin: 15px 0;">
            <p><?= (string) lang('Contact.mon_fri') ?><br>
                <?= (string) lang('Contact.saturday') ?></p>
        </div>
    </div>

</div>

<script>
    lucide.createIcons();
</script>

<?= $this->endSection(); ?>