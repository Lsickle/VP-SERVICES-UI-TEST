import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/js/global.js', // Agregamos el archivo global js para que vite compile nuestro archivo con los scripts necesarios
            ],
            refresh: true,
        }),
    ],
});
