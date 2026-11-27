import Alpine from 'alpinejs';

// Alpine hanya untuk menu mobile. Efek scroll diatur di bawah tanpa Alpine.
window.Alpine = Alpine;
Alpine.start();

/*
 * Reveal section sekali saat masuk viewport (docs/DESIGN.md bagian 8).
 * Tanpa IntersectionObserver, semua konten langsung terlihat.
 */
const revealItems = document.querySelectorAll('[data-reveal]');

if (revealItems.length > 0) {
    if (!('IntersectionObserver' in window)) {
        revealItems.forEach((item) => item.classList.add('is-visible'));
    } else {
        const observer = new IntersectionObserver(
            (entries) => {
                entries.forEach((entry) => {
                    if (!entry.isIntersecting) {
                        return;
                    }

                    entry.target.classList.add('is-visible');
                    observer.unobserve(entry.target);
                });
            },
            {
                rootMargin: '0px 0px -8% 0px',
                threshold: 0.1,
            },
        );

        revealItems.forEach((item) => {
            // Kalau pengunjung sudah menggulir melewati bagian ini sebelum JS siap,
            // langsung tampilkan supaya konten tidak tertinggal tersembunyi.
            if (item.getBoundingClientRect().bottom < 0) {
                item.classList.add('is-visible');

                return;
            }

            observer.observe(item);
        });
    }
}

/*
 * State scroll untuk header sticky dan tombol WhatsApp (docs/DESIGN.md bagian 8).
 * Satu listener pasif + requestAnimationFrame, bukan listener Alpine per event.
 */
const root = document.documentElement;
let scrollFrame = null;

const syncScrollState = () => {
    scrollFrame = null;

    const offset = window.scrollY;
    root.dataset.scrolled = offset > 12 ? 'true' : 'false';
    root.dataset.scrolledPast = offset > 400 ? 'true' : 'false';
};

const requestScrollSync = () => {
    if (scrollFrame !== null) {
        return;
    }

    scrollFrame = window.requestAnimationFrame(syncScrollState);
};

syncScrollState();
window.addEventListener('scroll', requestScrollSync, { passive: true });

/*
 * Sembunyikan tombol WhatsApp mengambang saat CTA atau footer terlihat:
 * keduanya sudah punya tombol/kontak sendiri, jadi tombol tidak menutupi aksi.
 */
const waHideTargets = document.querySelectorAll('[data-wa-hide]');

if (waHideTargets.length > 0 && 'IntersectionObserver' in window) {
    const visibleTargets = new Set();

    const waObserver = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    visibleTargets.add(entry.target);
                } else {
                    visibleTargets.delete(entry.target);
                }
            });

            root.dataset.waHidden = visibleTargets.size > 0 ? 'true' : 'false';
        },
        {
            rootMargin: '0px 0px -12% 0px',
            threshold: 0,
        },
    );

    waHideTargets.forEach((target) => waObserver.observe(target));
}
