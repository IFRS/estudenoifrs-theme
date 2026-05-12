import { defineConfig, normalizePath } from 'vite'
import { viteStaticCopy } from 'vite-plugin-static-copy'
import { resolve } from 'path'
import { glob } from 'tinyglobby'

/** Registers theme/** files with Rollup's watcher so `vite build --watch` re-copies them on change. */
function watchThemePlugin() {
  return {
    name: 'watch-theme',
    async buildStart() {
      const files = await glob('theme/**/*', { cwd: resolve(__dirname), absolute: true, onlyFiles: true })
      for (const file of files) {
        this.addWatchFile(file)
      }
    },
  }
}

export default defineConfig(({ mode }) => ({
  base: './', // Generate relative asset URLs so WordPress theme URI prefix from enqueue is preserved.
  css: {
    devSourcemap: true,
    preprocessorOptions: {
      scss: {
        sourceMap: true,
        quietDeps: true,
        silenceDeprecations: ['legacy-js-api', 'import'],
      },
    },
  },
  build: {
    sourcemap: mode === 'development' ? 'inline' : false,
    assetsDir: 'assets',
    manifest: true,
    outDir: normalizePath(resolve(__dirname, 'build')),
    rollupOptions: {
      input: {
        estudeScript: normalizePath(resolve(__dirname, 'src/estude.js')),
        cursoScript: normalizePath(resolve(__dirname, 'src/curso.js')),
        oportunidadesScript: normalizePath(resolve(__dirname, 'src/oportunidades.js')),
        estudeStyle: normalizePath(resolve(__dirname, 'sass/estude.scss')),
        editorStyle: normalizePath(resolve(__dirname, 'sass/estude-editor.scss')),
        fontsStyle: normalizePath(resolve(__dirname, 'sass/fonts.scss')),
        vendorStyle: normalizePath(resolve(__dirname, 'sass/vendor.scss')),
      },
    },
  },
  plugins: [
    watchThemePlugin(),
    viteStaticCopy({
      structured: true,
      targets: [
        {
          src: 'theme/**/*',
          dest: '.',
          rename: { stripBase: 1 },
        },
        {
          src: 'node_modules/lightgallery/fonts/**/*',
          dest: 'assets',
          rename: { stripBase: 1 },
        },
        {
          src: 'node_modules/lightgallery/images/**/*',
          dest: 'assets',
          rename: { stripBase: 1 },
        }
      ],
      watch: {
        reloadPageOnChange: true,
      },
    }),
  ],
}))
