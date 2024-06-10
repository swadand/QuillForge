import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/common/header.php',
                'resources/common/footer.php',
            ],
            refresh: true,
        }),
    ],
    assetsInclude: ["**/*.php"]
});
