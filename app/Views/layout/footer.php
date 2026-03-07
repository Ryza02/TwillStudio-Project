<style>
     :root {
        --primary: #111827;
        --secondary: #4b5563;
        --accent: #C5A059; /* Emas/Accent */
        --lighter: #ffffff;
        --off-white: #f9fafb;
        --border: #e5e7eb;
    }
    .footer {
        background: linear-gradient(135deg, #0f172a 0%, #4b5563 100%);
        color: #f8fafc;
        padding: 100px 0 30px 0;
        font-family: 'TT Norms Pro', -apple-system, sans-serif;
        border-top: 3px solid #C5A059;
    }

    .footer-container {
        max-width: 1280px;
        margin: 0 auto;
        padding: 0 20px;
    }

    .footer-content {
        display: grid;
        grid-template-columns: 1.5fr 1fr 1fr 1.2fr;
        gap: 40px;
        margin-bottom: 60px;
    }

    .footer-brand .footer-logo {
        height: 45px;
        margin-bottom: 20px;
        filter: brightness(0) invert(1);
    }

    .footer-tagline {
        color: #94a3b8;
        line-height: 1.8;
        font-size: 0.9rem;
        max-width: 350px;
        margin-bottom: 25px;
    }

    .footer-social {
        display: flex;
        gap: 12px;
    }

    .footer-social a {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.1);
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
        border: 1px solid rgba(255, 255, 255, 0.1);
    }

    .footer-social a:hover {
        background: #C5A059;
        border-color: #C5A059;
        transform: translateY(-3px);
    }

    .footer-social svg {
        width: 18px;
        height: 18px;
        fill: #ffffff;
    }

    .footer-section h4 {
        color: #ffffff;
        font-family: 'Playfair Display', serif;
        font-size: 1.1rem;
        margin-bottom: 25px;
        letter-spacing: 1px;
        position: relative;
        padding-bottom: 10px;
    }

    .footer-section h4::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 40px;
        height: 2px;
        background: #C5A059;
    }

    .footer-section ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .footer-section ul li {
        margin-bottom: 12px;
    }

    .footer-section ul li a {
        color: #94a3b8;
        text-decoration: none;
        transition: all 0.3s ease;
        font-size: 0.9rem;
        display: inline-block;
    }

    .footer-section ul li a:hover {
        color: #C5A059;
        transform: translateX(5px);
    }

    .footer-contact-item {
        display: flex;
        align-items: flex-start;
        gap: 12px;
        margin-bottom: 15px;
        color: #94a3b8;
        font-size: 0.9rem;
    }

    .footer-contact-item svg {
        width: 18px;
        height: 18px;
        fill: #C5A059;
        flex-shrink: 0;
        margin-top: 2px;
    }

    .footer-contact-item a {
        color: #94a3b8;
        text-decoration: none;
        transition: color 0.3s ease;
    }

    .footer-contact-item a:hover {
        color: #C5A059;
    }

    .footer-newsletter p {
        color: #94a3b8;
        font-size: 0.9rem;
        margin-bottom: 15px;
        line-height: 1.6;
    }

    .newsletter-form {
        display: flex;
        gap: 10px;
    }

    .newsletter-form input {
        flex: 1;
        padding: 12px 15px;
        border: 1px solid rgba(255, 255, 255, 0.2);
        background: rgba(255, 255, 255, 0.05);
        color: #ffffff;
        border-radius: 50px;
        font-size: 0.9rem;
        outline: none;
        transition: all 0.3s ease;
    }

    .newsletter-form input::placeholder {
        color: #64748b;
    }

    .newsletter-form input:focus {
        border-color: #C5A059;
        background: rgba(255, 255, 255, 0.1);
    }

    .newsletter-form button {
        padding: 12px 25px;
        background: #C5A059;
        color: #ffffff;
        border: none;
        border-radius: 50px;
        font-weight: 600;
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 1px;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .newsletter-form button:hover {
        background: #dfc185;
        transform: translateY(-2px);
    }

    .footer-bottom {
        border-top: 1px solid rgba(255, 255, 255, 0.1);
        padding-top: 30px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 20px;
    }

    .footer-copyright {
        color: #64748b;
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .footer-copyright span {
        color: #C5A059;
    }

    .footer-legal {
        display: flex;
        gap: 25px;
    }

    .footer-legal a {
        color: #64748b;
        text-decoration: none;
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 1px;
        transition: color 0.3s ease;
    }

    .footer-legal a:hover {
        color: #C5A059;
    }

    @media (max-width: 992px) {
        .footer-content {
            grid-template-columns: 1fr 1fr;
            gap: 40px;
        }
    }

    @media (max-width: 768px) {
        .footer {
            padding: 60px 0 30px 0;
        }

        .footer-content {
            grid-template-columns: 1fr;
            gap: 40px;
        }

        .footer-bottom {
            flex-direction: column;
            text-align: center;
            gap: 20px;
        }

        .footer-legal {
            flex-wrap: wrap;
            justify-content: center;
        }

        .newsletter-form {
            flex-direction: column;
        }

        .newsletter-form button {
            width: 100%;
        }
    }
</style>

<footer class="footer">
    <div class="footer-container">
        <div class="footer-content">
            <div class="footer-brand">
                <img src="<?= base_url('assets/images/twll LOGO.png'); ?>" alt="TWILL Studio" class="footer-logo">
                <p class="footer-tagline">Interwoven Precision & Elegance in Architecture and Design. Kami merajut visi Anda menjadi mahakarya ruang fungsional dengan presisi dan keanggunan.</p>
                
                <div class="footer-social">
                    <a href="https://instagram.com/twill_architecture" target="_blank" aria-label="Instagram">
                        <svg viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                    </a>
                    <a href="https://facebook.com/twill.architecture" target="_blank" aria-label="Facebook">
                        <svg viewBox="0 0 24 24"><path d="M9.813 15.904L9 18.75l-.813-2.846a4.5 4.5 0 00-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 003.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 003.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 00-3.09 3.09zM18.259 8.715C18.249 5.286 15.319 2.47 11.93 2.5c-3.237.028-5.951 2.544-6.191 5.654a6.125 6.125 0 002.46 5.533l-.296 1.755 1.791-.466a6.123 6.123 0 005.298-.222c2.937-1.353 4.827-4.221 4.767-7.539z"/></svg>
                    </a>
                    <a href="https://linkedin.com/company/twill-architecture" target="_blank" aria-label="LinkedIn">
                        <svg viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                    </a>
                    <a href="https://wa.me/628123456789" target="_blank" aria-label="WhatsApp">
                        <svg viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                    </a>
                </div>
            </div>
            
            <div class="footer-section">
                <h4>Quick Links</h4>
                <ul>
                    <li><a href="<?= base_url('/'); ?>">Beranda</a></li>
                    <li><a href="<?= base_url('about'); ?>">Tentang Kami</a></li>
                    <li><a href="<?= base_url('projects'); ?>">Portfolio</a></li>
                    <li><a href="<?= base_url('blog'); ?>">Blog</a></li>
                    <li><a href="<?= base_url('contact'); ?>">Kontak</a></li>
                </ul>
            </div>
            
            <div class="footer-section">
                <h4>Contact Info</h4>
                <div class="footer-contact-item">
                    <svg viewBox="0 0 24 24"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/></svg>
                    <span>Jl. Arsitektur No. 123, Jakarta Selatan, DKI Jakarta 12345</span>
                </div>
                <div class="footer-contact-item">
                    <svg viewBox="0 0 24 24"><path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/></svg>
                    <a href="mailto:info@twill.com">info@twill.com</a>
                </div>
                <div class="footer-contact-item">
                    <svg viewBox="0 0 24 24"><path d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z"/></svg>
                    <a href="https://wa.me/628123456789">+62 812 3456 7890</a>
                </div>
                <div class="footer-contact-item">
                    <svg viewBox="0 0 24 24"><path d="M11.99 2C6.47 2 2 6.48 2 12s4.47 10 9.99 10C17.52 22 22 17.52 22 12S17.52 2 11.99 2zM12 20c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8zm.5-13H11v6l5.25 3.15.75-1.23-4.5-2.67z"/></svg>
                    <span>Senin - Jumat: 09:00 - 18:00 WIB</span>
                </div>
            </div>

            <div class="footer-section footer-newsletter">
                <h4>Newsletter</h4>
                <p>Dapatkan update terbaru tentang project dan insight arsitektur.</p>
                <form class="newsletter-form" action="#" method="POST">
                    <input type="email" name="email" placeholder="Email Anda" required>
                    <button type="submit">Subscribe</button>
                </form>
            </div>
        </div>
        
        <div class="footer-bottom">
            <p class="footer-copyright">&copy; <?= date('Y'); ?> <span>TWILL STUDIO</span>. ALL RIGHTS RESERVED.</p>
            <div class="footer-legal">
                <a href="<?= base_url('privacy-policy'); ?>">Privacy Policy</a>
                <a href="<?= base_url('terms-of-service'); ?>">Terms of Service</a>
            </div>
        </div>
    </div>
</footer>