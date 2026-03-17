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
            <div class="icon-box"><i data-lucide="message-circle"></i></div>
            <div class="contact-text">
                <h3><?= (string) lang('Contact.wa_title') ?></h3>
                <p><?= (string) lang('Contact.wa_desc') ?></p>
                <a href="https://wa.me/6282211222890" target="_blank">+62 822-1122-2890</a>
            </div>
        </div>

        <div class="contact-item">
            <div class="icon-box"><i data-lucide="mail"></i></div>
            <div class="contact-text">
                <h3><?= (string) lang('Contact.email_title') ?></h3>
                <p><?= (string) lang('Contact.email_desc') ?></p>
                <a href="mailto:twillarchitettura@gmail.com">twillarchitettura@gmail.com</a>
            </div>
        </div>

        <div class="contact-item">
            <div class="icon-box"><i data-lucide="instagram"></i></div>
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

        <div class="inquiry-container">
            <div class="section-label"><?= (string) lang('Contact.form_heading') ?></div>
            
            <?php if (session()->getFlashdata('success')) : ?>
                <div class="alert alert-success animate__animated animate__fadeIn">
                    <i data-lucide="check-circle" size="18" style="vertical-align: middle; margin-right: 8px;"></i>
                    <?= session()->getFlashdata('success') ?>
                </div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('error')) : ?>
                <div class="alert alert-danger animate__animated animate__fadeIn">
                    <i data-lucide="alert-circle" size="18" style="vertical-align: middle; margin-right: 8px;"></i>
                    <?= session()->getFlashdata('error') ?>
                </div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('errors')) : ?>
                <div class="alert alert-danger animate__animated animate__fadeIn">
                    <ul style="margin: 0; padding-left: 20px;">
                        <?php foreach (session()->getFlashdata('errors') as $err) : ?>
                            <li><?= $err ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <form id="designInquiryForm" action="<?= base_url('contact/send_inquiry') ?>" method="POST" class="modern-form">
                <?= csrf_field() ?>
                
                <div class="form-grid">
                    <div class="form-group">
                        <div class="input-wrapper">
                            <i data-lucide="user" class="input-icon"></i>
                            <input type="text" id="name" name="name" class="form-control" placeholder="<?= (string) lang('Contact.label_name') ?>" value="<?= old('name') ?>" required>
                            <span class="input-focus-line"></span>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <div class="input-wrapper">
                            <i data-lucide="mail" class="input-icon"></i>
                            <input type="email" id="email" name="email" class="form-control" placeholder="<?= (string) lang('Contact.label_email') ?>" value="<?= old('email') ?>" required>
                            <span class="input-focus-line"></span>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <div class="input-wrapper">
                            <i data-lucide="phone" class="input-icon"></i>
                            <input type="tel" id="whatsapp" name="whatsapp" class="form-control" placeholder="<?= (string) lang('Contact.label_wa') ?>" value="<?= old('whatsapp') ?>" required>
                            <span class="input-focus-line"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="input-wrapper">
                            <i data-lucide="map-pin" class="input-icon"></i>
                            <input type="text" id="location" name="location" class="form-control" placeholder="<?= (string) lang('Contact.label_location') ?>" value="<?= old('location') ?>" required>
                            <span class="input-focus-line"></span>
                        </div>
                    </div>
                </div>
                
                <div class="form-group">
                    <div class="input-wrapper textarea-wrapper">
                        <i data-lucide="file-text" class="input-icon"></i>
                        <textarea id="project_info" name="project_info" class="form-control" placeholder="<?= (string) lang('Contact.placeholder_project') ?>" required><?= old('project_info') ?></textarea>
                        <span class="input-focus-line"></span>
                    </div>
                    <label for="project_info" class="form-label"><?= (string) lang('Contact.form_project_info') ?></label>
                </div>

                <div class="form-footer">
                    <div class="form-buttons">
                        <button type="button" id="btn-wa" class="btn btn-wa">
                            <i data-lucide="message-circle" size="18"></i>
                            <span><?= (string) lang('Contact.wa_send') ?></span>
                        </button>
                        <button type="submit" id="btn-send" class="btn btn-send">
                            <i data-lucide="send" size="18"></i>
                            <span><?= (string) lang('Contact.btn_send') ?></span>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="map-panel-container animate__animated animate__fadeInRight">
        <div class="map-panel">
            <div class="map-wrapper">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3961.272108784381!2d107.4789543!3d-6.8579067!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68e2b8f87b8f0f%3A0x6b1912532f7a0808!2sJl.%20Cihaliwung%20No.106b%2C%20Kertamulya%2C%20Kec.%20Padalarang%2C%20Kabupaten%20Bandung%20Barat%2C%20Jawa%20Barat%2040553!5e0!3m2!1sen!2sid!4v1700000000000!5m2!1sen!2sid"
                    width="100%"
                    height="100%"
                    style="border:0;"
                    allowfullscreen=""
                    loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>
        </div>

        <div class="hours-card">
            <h4><?= (string) lang('Contact.opening_hrs') ?></h4>
            <p><strong><?= (string) lang('Contact.studio_address') ?></strong><br>
                Jl. Cihaliwung No.106b Kertamulya RT.01/RW.10<br>
                Kertamulya, Padalarang,<br>
                Bandung Barat, Jawa Barat.</p>
            <hr style="border: 0; border-top: 1px solid rgba(255, 255, 255, 0.51); margin: 15px 0;">
            <p><?= (string) lang('Contact.mon_fri') ?><br>
                <?= (string) lang('Contact.saturday') ?></p>
        </div>
    </div>

</div>

<script>
    lucide.createIcons();

    // Form input animation
    document.querySelectorAll('.form-control').forEach(input => {
        input.addEventListener('focus', function() {
            this.parentElement.classList.add('focused');
        });
        input.addEventListener('blur', function() {
            this.parentElement.classList.remove('focused');
        });
    });

    document.getElementById('btn-wa').addEventListener('click', function() {
        const name = document.getElementById('name').value;
        const email = document.getElementById('email').value;
        const waNumber = document.getElementById('whatsapp').value;
        const location = document.getElementById('location').value;
        const projectInfo = document.getElementById('project_info').value;

        if(!name || !projectInfo) {
            alert('Mohon lengkapi field Nama dan Project Information terlebih dahulu.');
            return;
        }

        const adminWa = '6282211222890'; 
        
        const textMessage = `Halo Twill Architetture, saya ingin menyampaikan Design.%0A%0A*Nama:* ${name}%0A*Email:* ${email}%0A*No WA:* ${waNumber}%0A*Lokasi:* ${location}%0A%0A*Keterangan Project:*%0A${projectInfo}`;

        const waLink = `https://wa.me/${adminWa}?text=${textMessage}`;
        window.open(waLink, '_blank');
    });

    // Form submission animation
    document.getElementById('designInquiryForm').addEventListener('submit', function(e) {
        const submitBtn = document.getElementById('btn-send');
        submitBtn.classList.add('loading');
        submitBtn.innerHTML = '<i data-lucide="loader" class="spin-icon" size="18"></i><span>Sending...</span>';
        lucide.createIcons();
    });
</script>

<?= $this->endSection(); ?>