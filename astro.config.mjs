// @ts-check
import { defineConfig } from 'astro/config';
import sitemap from '@astrojs/sitemap';
import { readdir, readFile, rm } from 'node:fs/promises';
import { fileURLToPath } from 'node:url';
import { join } from 'node:path';

// Astro copies every source image into dist/_astro even when only the resized
// versions are used. Drop the unreferenced originals so the FTP upload stays small.
/** @type {import("astro").AstroIntegration} */
const pruneOriginals = {
  name: 'prune-unused-originals',
  hooks: {
    'astro:build:done': async ({ dir, logger }) => {
      const root = fileURLToPath(dir);
      const assets = join(root, '_astro');
      const files = await readdir(assets);
      const texts = [];
      for (const f of await readdir(root)) if (f.endsWith('.html')) texts.push(await readFile(join(root, f), 'utf8'));
      for (const f of files) if (/\.(css|js)$/.test(f)) texts.push(await readFile(join(assets, f), 'utf8'));
      const haystack = texts.join('\n');
      let removed = 0;
      for (const f of files) {
        if (/\.(jpe?g|png)$/i.test(f) && !haystack.includes(f)) {
          await rm(join(assets, f));
          removed++;
        }
      }
      logger.info(`${removed} imágenes originales sin uso eliminadas de dist/_astro`);
    },
  },
};

// Static build: `npm run build` writes dist/, which is what gets uploaded by FTP.
// build.format 'file' emits /bargas.html; public/.htaccess serves it at /bargas.
export default defineConfig({
  site: 'https://www.kaikhome.com',
  trailingSlash: 'never',
  // Inline the (small) stylesheets so nothing blocks the first paint.
  build: { format: 'file', inlineStylesheets: 'always' },
  integrations: [
    sitemap({
      filter: (page) => !page.includes('404'),
      lastmod: new Date(),
      changefreq: 'weekly',
      serialize: (item) => ({ ...item, priority: item.url === 'https://www.kaikhome.com/' ? 1 : 0.8 }),
    }),
    pruneOriginals,
  ],
});
