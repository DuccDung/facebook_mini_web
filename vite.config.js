import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    server: {
        proxy: {
            '/api': 'http://localhost:5000', // Đảm bảo API của bạn được proxy đúng
        },
    },
    plugins: [
        laravel({
            input: [
                'resources/css/pages/register.css',
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/js/pages/register.js',
                'resources/js/services/auth_service.js',
                'resources/js/utils/api.js'
            ],
            refresh: true,
        }),
    ],
});

