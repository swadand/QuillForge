import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/views/common/header.php',
                'resources/views/common/footer.php',
            ],
            refresh: true,
        }),
    ],
    assetsInclude: ["**/*.php"]
});
