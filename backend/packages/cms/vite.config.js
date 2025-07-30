import { defineConfig } from 'vite';
import { resolve } from 'path';

import vue from '@vitejs/plugin-vue';
import laravel from 'laravel-vite-plugin';
import dotenv from 'dotenv';
import tailwindcss from '@tailwindcss/vite';

dotenv.config({ path: resolve('/docker/.env') });

export default defineConfig({
  server: {
    host: '0.0.0.0',
    port: 5173,
  },
  build: {
    outDir: `../../html/${process.env.PROJECT}/public/build`,
    manifest: true,
    emptyOutDir: true,
  },
  plugins: [
    laravel({
      input: ['resources/css/cms.css', 'resources/js/cms.js'],
      publicDirectory: `../../html/${process.env.PROJECT}/public`,
      refresh: true
    }),
    tailwindcss(),
    vue()
  ],
});
