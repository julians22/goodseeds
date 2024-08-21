import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import { postcss } from 'tailwindcss';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/sass/app.scss', 'resources/js/app.js', 'resources/sass/_variables.scss', 'resources/css/filament/admin/theme.css'],
            refresh: true,
        }),
    ],
    css: {
        preprocessorOptions: {
            scss: {
                quietDeps: true,
            }
        }
    }
});
