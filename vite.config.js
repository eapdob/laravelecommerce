import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import path from 'path'
import copy from 'rollup-plugin-copy'

export default defineConfig({
    resolve: {
        alias: {
            '@img': path.resolve('./resources/img'),
            '@svg': path.resolve('./resources/svg'),
            '~bootstrap': path.resolve(__dirname, 'node_modules/bootstrap'),
            '~fortawesome': path.resolve(__dirname, 'node_modules/@fortawesome')
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
        })
    ],
});
