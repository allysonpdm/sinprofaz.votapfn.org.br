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
    build: {
        terserOptions: {
            compress: {
                keep_fnames: true,
            },
            mangle: {
                keep_fnames: true,
            },

        },
        rollupOptions: {
            external: ['datatables.net-dt/css/jquery.dataTables.css']
        }
    },
    resolve: {
        alias: {
            vue: 'vue/dist/vue.esm-bundler.js',
        },
    },
});
