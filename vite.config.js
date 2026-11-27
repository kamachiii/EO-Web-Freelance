import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
        tailwindcss(),
    ],
    server: {
        // Port tetap supaya tidak bertabrakan dengan dev server proyek lain;
        // Laravel membaca alamat server dari public/hot.
        port: 5174,
        strictPort: false,
        watch: {
            ignored: ['**/storage/framework/views/**'],
        },
    },
});
