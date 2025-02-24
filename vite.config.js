import { defineConfig, loadEnv } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig(({mode}) => {
    const env = loadEnv(mode, process.cwd(), '');

    return {
        plugins: [
            laravel({
                input: ['resources/css/app.css', 'resources/js/app.js'],
                refresh: true,
            }),
        ],
        server: {
            host: true,
            cors: true,
            hmr: {
                host: env.DUSK_DRIVER_URL ? 'app' : 'localhost',
                protocol: 'ws',
            },
            protocol: 'http',
            origin: env.DUSK_DRIVER_URL ? 'http://app:5173' : 'http://localhost:5173',
            port: 5173,
            watch: {
                usePolling: true,
            },
        },
    }
});
