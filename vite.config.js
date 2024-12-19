import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/select2/dist/css/select2.min.css',
                'resources/select2/dist/js/select2.min.js',
            ],
            refresh: true,
        }),
    ],
});
