import { defineConfig } from 'vite'
import laravel from 'laravel-vite-plugin'

export default defineConfig({
    plugins: [
        {
            name: 'blade',
            handleHotUpdate({ file, server }) {
                if (file.endsWith('.blade.php')) {
                    server.ws.send({
                        type: 'full-reload',
                        path: "*",
                    })
                }
            },
        },
        laravel({
            input: ['resources/js/app.js'],
            refresh: true,
        })
    ],
});
