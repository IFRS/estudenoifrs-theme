import { defineConfig, normalizePath } from 'vite'
// import { analyzer } from 'vite-bundle-analyzer'
import { viteStaticCopy } from 'vite-plugin-static-copy'
import { dirname, resolve } from 'path'
import { fileURLToPath } from 'url'
import { glob } from 'tinyglobby'

const _root = dirname(fileURLToPath(import.meta.url))

/** Registers theme/** files with Rollup's watcher so `vite build --watch` re-copies them on change. */
function watchThemePlugin() {
  return {
    name: 'watch-theme',
    async buildStart() {
      const files = await glob('theme/**/*', { cwd: resolve(_root), absolute: true, onlyFiles: true })
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
    outDir: normalizePath(resolve(_root, 'build')),
    rollupOptions: {
      input: {
        estudeScript: normalizePath(resolve(_root, 'src/estude.js')),
        cursoScript: normalizePath(resolve(_root, 'src/curso.js')),
        cursosScript: normalizePath(resolve(_root, 'src/cursos.js')),
        oportunidadesScript: normalizePath(resolve(_root, 'src/oportunidades.js')),
        estudeStyle: normalizePath(resolve(_root, 'sass/estude.scss')),
        editorStyle: normalizePath(resolve(_root, 'sass/estude-editor.scss')),
        fontsStyle: normalizePath(resolve(_root, 'sass/fonts.scss')),
        vendorStyle: normalizePath(resolve(_root, 'sass/vendor.scss')),
      },
    },
  },
  plugins: [
    // analyzer(),
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
