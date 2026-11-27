import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js', 'resources/css/filament/admin/theme.css'],
            refresh: true,
        }),
        tailwindcss(),
    ],
    server: {
        port: 5174,
        cors: true,
        origin: 'https://mrglobal-events.kamachiii.web.id',
        hmr: {
            host: 'mrglobal-events.kamachiii.web.id',
            protocol: 'wss',
            clientPort: 443,
        },
        strictPort: false,
        watch: {
            ignored: ['**/storage/framework/views/**'],
        },
    },
});
