import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin'; // Cambia 'require' a 'import'

export default defineConfig({ // Cambia 'module.exports =' a 'export default'
    plugins: [
        laravel({
            input: [
                'resources/css/app.css', // Asegúrate de que tus archivos de entrada estén aquí
                'resources/js/app.js',
            ],
            refresh: true,
        }),
    ],
});

