// public/assets/js/admin/about.js

// --- 1. Fungsi Popup Notifikasi ---
function showPopup(type, title, message) {
    const popup = document.getElementById('validationPopup');
    if (!popup) return;

    const icons = {
        success: '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>',
        error: '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>',
        warning: '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" /></svg>'
    };

    const popupHTML = `
        <div class="popup-message ${type}">
            <span class="popup-icon">${icons[type]}</span>
            <div class="popup-content">
                <p class="popup-title">${title}</p>
                <p class="popup-message-text">${message}</p>
            </div>
            <button class="popup-close" onclick="this.parentElement.remove()">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" /></svg>
            </button>
        </div>
    `;
    popup.insertAdjacentHTML('beforeend', popupHTML);
    setTimeout(() => {
        const firstPopup = popup.querySelector('.popup-message');
        if (firstPopup) {
            firstPopup.style.animation = 'slideInRight 0.4s ease reverse forwards';
            setTimeout(() => firstPopup.remove(), 400);
        }
    }, 5000);
}

// --- 2. Fungsi Auto Translate 3 Bahasa ---
async function autoTranslateAll(prefix) {
    const titleIdElem = document.getElementById(prefix + '_title_id');
    const descIdElem = document.getElementById(prefix + '_desc_id');
    
    const titleId = titleIdElem ? titleIdElem.value.trim() : '';
    const descId = descIdElem ? descIdElem.value.trim() : '';
    
    if (!titleId && !descId) {
        showPopup('warning', 'Peringatan', 'Isi teks bahasa Indonesia (Judul / Deskripsi) terlebih dahulu.');
        return;
    }

    const btn = document.getElementById('btn_translate_all');
    if (!btn) return;
    
    const originalBtnText = btn.innerHTML;
    btn.innerHTML = '⏳ Menerjemahkan...';
    btn.disabled = true;

    try {
        if(titleId) {
            const resEnTitle = await fetch(`https://translate.googleapis.com/translate_a/single?client=gtx&sl=id&tl=en&dt=t&q=${encodeURIComponent(titleId)}`);
            const dataEnTitle = await resEnTitle.json();
            document.getElementById(prefix + '_title_en').value = dataEnTitle[0].map(x => x[0]).join('');

            const resItTitle = await fetch(`https://translate.googleapis.com/translate_a/single?client=gtx&sl=id&tl=it&dt=t&q=${encodeURIComponent(titleId)}`);
            const dataItTitle = await resItTitle.json();
            document.getElementById(prefix + '_title_it').value = dataItTitle[0].map(x => x[0]).join('');
        }

        if(descId) {
            const resEnDesc = await fetch(`https://translate.googleapis.com/translate_a/single?client=gtx&sl=id&tl=en&dt=t&q=${encodeURIComponent(descId)}`);
            const dataEnDesc = await resEnDesc.json();
            document.getElementById(prefix + '_desc_en').value = dataEnDesc[0].map(x => x[0]).join('');

            const resItDesc = await fetch(`https://translate.googleapis.com/translate_a/single?client=gtx&sl=id&tl=it&dt=t&q=${encodeURIComponent(descId)}`);
            const dataItDesc = await resItDesc.json();
            document.getElementById(prefix + '_desc_it').value = dataItDesc[0].map(x => x[0]).join('');
        }

        showPopup('success', 'Berhasil', 'Semua kolom teks berhasil diterjemahkan.');
    } catch (error) {
        showPopup('error', 'Gagal', 'Terjadi kesalahan koneksi saat menerjemahkan.');
    } finally {
        btn.innerHTML = originalBtnText;
        btn.disabled = false;
    }
}

// --- 3. Fungsi Preview Gambar ---
function previewImage(input, imgId) {
    const wrapper = document.getElementById(imgId + '_wrapper');
    const preview = document.getElementById(imgId);
    
    if (input.files && input.files[0]) {
        const file = input.files[0];
        const maxSize = 10 * 1024 * 1024; // 10MB

        if (file.size > maxSize) {
            showPopup('error', 'Ukuran Terlalu Besar', 'Maksimal upload gambar adalah 10MB.');
            input.value = '';
            wrapper.style.display = 'none';
            return;
        }

        const reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
            wrapper.style.display = 'block';
        }
        reader.readAsDataURL(file);
    } else {
        wrapper.style.display = 'none';
    }
}