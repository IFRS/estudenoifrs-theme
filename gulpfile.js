const { src, pipe, dest, series, parallel, watch } = require('gulp');
const { name }             = require('./package.json');
const argv                 = require('minimist')(process.argv.slice(2));
const babel                = require('gulp-babel');
const browserSync          = require('browser-sync').create();
const csso                 = require('gulp-csso');
const del                  = require('del');
const gulp_sass            = require('gulp-sass')(require('sass'));
const path                 = require('path');
const PluginError          = require('plugin-error');
const postcss              = require('gulp-postcss');
const sourcemaps           = require('gulp-sourcemaps');
const uglify               = require('gulp-uglify');
const webpack              = require('webpack');
const NodePolyfillPlugin   = require("node-polyfill-webpack-plugin");
const BundleAnalyzerPlugin = require('webpack-bundle-analyzer').BundleAnalyzerPlugin;

const IS_PRODUCTION = argv.production || argv.prod;

const BROWSERSYNC_URL = argv.URL || argv.url || 'localhost';

let webpack_plugins = [];
webpack_plugins.push(new NodePolyfillPlugin());
if (argv.bundleanalyzer) webpack_plugins.push(new BundleAnalyzerPlugin());

function clean() {
  return del(['css/', 'js/', 'lightgallery/', 'dist/']);
};

function sass() {
  const postCSS_plugins = [
    require('autoprefixer'),
  ];

  const sass_options = {
    includePaths: ['sass', 'node_modules'],
    outputStyle: 'expanded',
  };

  return src('sass/*.scss')
  .pipe(sourcemaps.init())
  .pipe(gulp_sass.sync(sass_options).on('error', gulp_sass.logError))
  .pipe(postcss(postCSS_plugins))
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
    },
    output: {
      path: path.resolve(__dirname, 'js'),
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
    if (err) throw new PluginError('webpack', err.toString({ colors: true }));

    if (stats.hasErrors()) throw new PluginError('webpack', stats.toString({ colors: true }));

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
    '!dist{,/**}',
    '!node_modules{,/**}',
    '!sass{,/**}',
    '!src{,/**}',
    '!.**',
    '!gulpfile.js',
    '!package-lock.json',
    '!package.json',
  ])
  .pipe(dest('dist/' + name));
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

exports.clean = clean;
exports.sass = sass;
exports.bundle = bundle;

const styles = series(sass, css);
exports.styles = styles;

const scripts = series(bundle, js);
exports.scripts = scripts;

const build = IS_PRODUCTION ? series(clean, parallel(styles, scripts, lightgallery), dist) : series(clean, parallel(sass, bundle, lightgallery));
exports.build = build;

exports.default = series(build, serve);
