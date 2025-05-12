import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';
import vue from "@vitejs/plugin-vue";

export default defineConfig({
    server: {
        host: '0.0.0.0',
        hmr: {
            host: 'localhost',
            protocol: 'ws'
        },
    },
    plugins: [
        laravel({
            input: ['resources/js/app.js'],
            refresh: true,
        }),
        tailwindcss(),
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        })
    ],
    resolve: {
        alias: {
            '@': '/resources/js',
            '~': '/resources/scss',
        },
    },
});
