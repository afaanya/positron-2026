import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import { bunny } from 'laravel-vite-plugin/fonts';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/css/app-layout.css',
                'resources/js/app.js',
                'resources/css/mentor-portal.css',
                'resources/js/mentor-portal.js',
                'resources/css/login.css',
                'resources/css/poin-penilaian.css',
                'resources/js/poin-penilaian.js',
                'resources/css/about.css',
                'resources/js/about.js',
                'resources/css/timeline.css',
                'resources/js/timeline.js',
                'resources/css/homepage.css',
                'resources/css/kartu-kendali.css',
                'resources/css/profil-mahasiswa.css',
                'resources/css/rangkaian.css',
                'resources/js/rangkaian.js',
                'resources/css/filosofi.css',
                'resources/js/filosofi.js',
                'resources/css/biodata-mahasiswa.css',
            ],
            refresh: true,
            fonts: [
                bunny('Instrument Sans', {
                    weights: [400, 500, 600],
                }),
            ],
        }),
        tailwindcss(),
    ],
    server: {
        host: '127.0.0.1',
        watch: {
            ignored: [
                '**/storage/framework/views/**',
                '**/storage/framework/sessions/**',
                '**/storage/framework/cache/**',
                '**/storage/logs/**',
                '**/bootstrap/cache/**',
            ],
        },
    },
});
