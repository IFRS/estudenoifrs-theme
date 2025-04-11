import { readFileSync }   from 'fs';
import { deleteAsync }    from 'del';
import gulp               from 'gulp';
import parseArgs          from 'minimist';
import babel              from 'gulp-babel';
import browserSync        from 'browser-sync';
import csso               from 'gulp-csso';
import * as dartSass      from 'sass-embedded';
import gulpSass           from 'gulp-sass';
import autoprefixer       from 'autoprefixer';
import path               from 'path';
import pluginError        from 'plugin-error';
import postCSS            from 'gulp-postcss';
import sourcemaps         from 'gulp-sourcemaps';
import uglify             from 'gulp-uglify';
import webpack            from 'webpack';
import NodePolyfillPlugin from 'node-polyfill-webpack-plugin';
import BundleAnalyzer     from 'webpack-bundle-analyzer';

browserSync.create();

const { name } = JSON.parse(readFileSync('./package.json'));
const { src, dest, series, parallel, watch } = gulp;
const sassCompiler = gulpSass(dartSass);
const argv = parseArgs(process.argv.slice(2));

const IS_PRODUCTION = argv.production || argv.prod;

const BROWSERSYNC_URL = argv.URL || argv.url || 'localhost';

let webpack_plugins = [];
webpack_plugins.push(new NodePolyfillPlugin());
if (argv.bundleanalyzer) webpack_plugins.push(new BundleAnalyzer.BundleAnalyzerPlugin());

async function clean() {
  return await deleteAsync(['css/', 'js/', 'lightgallery/', 'dist/']);
};

function sass() {
  const postCSS_plugins = [
    autoprefixer,
  ];

  const sass_options = {
    loadPaths: ['sass', 'node_modules'],
    style: 'expanded',
    quietDeps: true,
    silenceDeprecations: ['legacy-js-api', 'import']
  };

  return src('sass/*.scss')
  .pipe(sourcemaps.init())
  .pipe(sassCompiler(sass_options).on('error', sassCompiler.logError))
  .pipe(postCSS(postCSS_plugins))
  .pipe(sourcemaps.write('./'))
  .pipe(dest('css/'))
  .pipe(browserSync.stream());
};

function css() {
  return src('css/*.css')
  .pipe(csso())
  .pipe(dest('css/'))
  .pipe(browserSync.stream());
};

function bundle(done) {
  webpack({
    mode: IS_PRODUCTION ? 'production' : 'development',
    devtool: IS_PRODUCTION ? 'source-map' : 'eval-source-map',
    entry: {
      'ingresso': './src/ingresso.js',
      'oportunidades': './src/oportunidades.js',
      'curso': './src/curso.js',
    },
    output: {
      path: path.resolve(path.dirname(''), 'js'),
      filename: '[name].js',
    },
    plugins: [...webpack_plugins],
    optimization: {
      minimize: false,
      splitChunks: {
        cacheGroups: {
          vendors: false,
          commons: {
            name: "commons",
            chunks: "all",
            minChunks: 2,
          },
        },
      },
    },
  }, function(err, stats) {
    if (err) throw new pluginError('webpack', err.toString({ colors: true }));

    if (stats.hasErrors()) throw new pluginError('webpack', stats.toString({ colors: true }));

    browserSync.reload();

    done();
  });
};

function js() {
  return src('js/*.js')
  .pipe(babel({
    presets: [
      [
        "@babel/env",
        { "modules": false }
      ]
    ]
  }))
  .pipe(uglify())
  .pipe(dest('js/'))
  .pipe(browserSync.stream());
};

function lightgallery(done) {
  [
    {
      src: 'node_modules/lightgallery/fonts/*',
      dest: 'lightgallery/fonts/',
    },
    {
      src: 'node_modules/lightgallery/images/*',
      dest: 'lightgallery/images/',
    },
  ].map(function(file) {
    return src(file.src)
    .pipe(dest(file.dest));
  });

  done();
};

function dist() {
  return src([
    '**',
    '!.**',
    '!css/*.map',
    '!dist{,/**}',
    '!js/*.map',
    '!node_modules{,/**}',
    '!sass{,/**}',
    '!src{,/**}',
    '!gulpfile*.js',
    '!package*.json',
  ], { encoding: false })
  .pipe(dest('dist/' + name), { encoding: false });
};

function serve() {
  browserSync.init({
    ui: argv.ui,
    ghostMode: false,
    online: false,
    open: false,
    notify: false,
    host: BROWSERSYNC_URL,
    proxy: BROWSERSYNC_URL,
  });

  watch('sass/**/*.scss', sass);

  watch('src/**/*.js', bundle);

  watch('**/*.php').on('change', browserSync.reload);
};

const styles = series(sass, css);

const scripts = series(bundle, js);

const build = IS_PRODUCTION ? series(clean, parallel(styles, scripts, lightgallery), dist) : series(clean, parallel(sass, bundle, lightgallery));

export { clean, sass, bundle, styles, scripts, build };

export default series(build, serve);
