document.addEventListener('DOMContentLoaded', () => {
    let currentSlide = 0;
    const slides = document.querySelectorAll('.carousel-slide');
    const dotsContainer = document.getElementById('carouselDots');
    const totalSlides = slides.length;

    if (!slides.length || !dotsContainer) return;

    function updateDots() {
        dotsContainer.innerHTML = '';
        for (let i = 0; i < totalSlides; i++) {
            const dot = document.createElement('button');
            dot.className = 'dot' + (i === currentSlide ? ' active' : '');
            
            // Memberikan warna emas pada dot yang sedang aktif
            if (i === currentSlide) {
                dot.style.background = '#C5A059'; // Architectural Gold
                dot.style.borderColor = '#C5A059';
            }
            
            dot.onclick = () => goToSlide(i);
            dotsContainer.appendChild(dot);
        }
    }

    /**
     * Menampilkan slide berdasarkan indeks
     * @param {number} n - Indeks slide
     */
    function showSlide(n) {
        // Hilangkan class active dari semua slide
        slides.forEach(slide => slide.classList.remove('active'));
        
        // Tambahkan ke slide yang dituju
        slides[n].classList.add('active');
        currentSlide = n;
        
        updateDots();
    }

    /**
     * Berpindah ke slide berikutnya
     */
    function nextSlide() {
        let next = (currentSlide + 1) % totalSlides;
        showSlide(next);
    }

    /**
     * Berpindah ke slide spesifik saat dot diklik
     */
    function goToSlide(n) {
        showSlide(n);
    }

    // Inisialisasi awal
    updateDots();

    // Jalankan auto-play setiap 6 detik agar pengunjung sempat membaca teks
    setInterval(nextSlide, 6000);
});