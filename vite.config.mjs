import { defineConfig, normalizePath } from 'vite'
import { viteStaticCopy } from 'vite-plugin-static-copy'
import { resolve } from 'path'

export default defineConfig(({ mode }) => ({
  css: {
    devSourcemap: true,
    preprocessorOptions: {
      scss: {
        quietDeps: true,
        silenceDeprecations: ['legacy-js-api', 'import'],
      },
    },
  },
  build: {
    sourcemaps: mode === 'development',
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
    viteStaticCopy({
      structured: true,
      targets: [
        {
          src: 'theme/**/*',
          dest: '.',
          rename: { stripBase: 1 },
        },
      ],
    }),
  ],
}))
