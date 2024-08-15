import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',

                'resources/js/app.js',
                'resources/js/index/app.js',
                'resources/js/lib/aos.js',
                'resources/js/scenarios/windows.js',
                'resources/js/scenarios/scenario.js',
            ],
            refresh: true,
        }),
    ],
});
