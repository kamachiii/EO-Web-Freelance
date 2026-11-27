/** @type {import('tailwindcss').Config} */
export default {
    /*
     * Satu-satunya sumber token (docs/DESIGN.md bagian 4, 5, dan 6).
     * Dipakai lewat arahan @config di resources/css/app.css.
     */
    theme: {
        colors: {
            // Enam warna inti menggantikan palet bawaan Tailwind.
            navy: '#14305B',
            white: '#FFFFFF',
            mist: '#E9F0F9',
            forest: '#1E7A5C',
            signal: {
                DEFAULT: '#F5821F',
                hover: '#FF9A3D',
            },
            charcoal: '#1F2937',

            // Variasi state yang diizinkan: warna border dan garis pemisah.
            line: '#D3DEEC',
        },

        // Montserrat untuk judul (font-display), Inter untuk isi dan UI (font-sans).
        // Berkas font dimuat dari paket lokal di resources/css/app.css.
        fontFamily: {
            sans: ['Inter', 'Segoe UI', 'Arial', 'sans-serif'],
            display: ['Montserrat', 'Segoe UI', 'Arial', 'sans-serif'],
        },

        extend: {
            // Spasi huruf: judul besar diberi tracking negatif, teks UI kecil
            // tracking positif tipis (aturan craft tipografi).
            letterSpacing: {
                display: '-0.03em',
                heading: '-0.02em',
                ui: '0.01em',
                label: '0.16em',
            },

            transitionTimingFunction: {
                editorial: 'cubic-bezier(0.22, 1, 0.36, 1)',
            },

            // Skala tipografi (docs/DESIGN.md bagian 5): mobile, lalu desktop lewat prefiks lg:.
            fontSize: {
                // Skala editorial. clamp() membuat judul ikut lebar layar tanpa lompatan.
                display: ['clamp(2.5rem, 5.6vw, 4.5rem)', { lineHeight: '0.98' }],
                chapter: ['clamp(1.75rem, 3vw, 2.75rem)', { lineHeight: '1.05' }],
                quote: ['clamp(1.5rem, 2.6vw, 2.25rem)', { lineHeight: '1.3' }],
                figure: ['clamp(3rem, 6vw, 5rem)', { lineHeight: '0.9' }],
                lead: ['clamp(1.0625rem, 1.2vw, 1.25rem)', { lineHeight: '1.6' }],
                label: ['0.6875rem', { lineHeight: '1.4' }],

                hero: ['2.125rem', { lineHeight: '1.15' }], // H1 34 px
                'hero-lg': ['3.5rem', { lineHeight: '1.1' }], // H1 56 px
                section: ['1.625rem', { lineHeight: '1.25' }], // H2 26 px
                'section-lg': ['2rem', { lineHeight: '1.25' }], // H2 32 px
                card: ['1rem', { lineHeight: '1.3' }], // H3 16 px
                'card-lg': ['1.25rem', { lineHeight: '1.3' }], // H3 20 px
                body: ['0.9375rem', { lineHeight: '1.6' }], // isi 15 px
                'body-lg': ['1rem', { lineHeight: '1.6' }], // isi 16 px
                small: ['0.875rem', { lineHeight: '1.5' }], // kecil 14 px
                tiny: ['0.8125rem', { lineHeight: '1.5' }], // kecil 13 px
            },

            // Radius (docs/DESIGN.md bagian 6).
            borderRadius: {
                button: '10px',
                card: '14px',
                cta: '20px',
                hero: '18px',
            },

            // Wadah maksimum 1184 px (docs/DESIGN.md bagian 6).
            maxWidth: {
                shell: '1184px',
            },
        },
    },
};
