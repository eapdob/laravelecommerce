import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import path from 'path'
import copy from 'rollup-plugin-copy'
import vue from '@vitejs/plugin-vue2'
import commonjs from 'vite-plugin-commonjs'
// import requireSupport from 'vite-plugin-require-support';

export default defineConfig({
    resolve: {
        alias: {
            '@img': path.resolve('./resources/img'),
            '@svg': path.resolve('./resources/svg'),
            '~bootstrap': path.resolve(__dirname, 'node_modules/bootstrap'),
            '~fortawesome': path.resolve(__dirname, 'node_modules/@fortawesome'),
            '@vuecustomcomponents': path.resolve(__dirname, './resources/assets/js/components'),
        },
    },
    plugins: [
        laravel({
            input: [
                'resources/sass/app.scss',
                'resources/js/app.js',
            ],
            refresh: true,
        }),
        copy({
            targets: [
                { src: 'resources/img/*', dest: 'public/img' },
                { src: 'resources/svg/*', dest: 'public/svg' }
            ],
            verbose: true
        }),
        vue(),
        commonjs()
        // requireSupport({
        //     filters: /.ts$|.js$|.tsx$|.vue$/
        // })
    ]
});
