import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';
import { globSync } from 'glob';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                ...globSync('resources/sass/**/*.scss'),
                ...globSync('resources/css/**/*.css'),
                ...globSync('resources/js/**/*.js'),
                ...globSync('resources/sass/*.scss'),
                ...globSync('resources/css/*.css'),
                ...globSync('resources/js/*.js')
            ],
            refresh: true,
        }),
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        }),
    ],
    resolve: {
        alias: {
            vue: 'vue/dist/vue.esm-bundler.js',
        },
    },
});
