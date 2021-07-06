const argv         = require('minimist')(process.argv.slice(2));
const babel        = require('gulp-babel');
const browserSync  = require('browser-sync').create();
const csso         = require('gulp-csso');
const del          = require('del');
const gulp         = require('gulp');
const path         = require('path');
const PluginError  = require('plugin-error');
const postcss      = require('gulp-postcss');
const sass         = require('gulp-sass')(require('sass'));
const sourcemaps   = require('gulp-sourcemaps');
const uglify       = require('gulp-uglify');
const webpack      = require('webpack');
const NodePolyfillPlugin = require("node-polyfill-webpack-plugin")
const BundleAnalyzerPlugin = require('webpack-bundle-analyzer').BundleAnalyzerPlugin;
;

gulp.task('clean', function() {
    return del(['css/', 'js/', 'vendor/', 'dist/']);
});

gulp.task('sass', function() {
    let postCSS_plugins = [
        require('postcss-flexibility'),
        require('pixrem'),
        require('autoprefixer'),
    ];

    let sass_options = {
        includePaths: ['sass', 'node_modules'],
        outputStyle: 'expanded'
    };

    return gulp.src('sass/*.scss')
    .pipe(sourcemaps.init())
    .pipe(sass.sync(sass_options).on('error', sass.logError))
    .pipe(postcss(postCSS_plugins))
    .pipe(sourcemaps.write('./'))
    .pipe(gulp.dest('css/'))
    .pipe(browserSync.stream());
});

gulp.task('styles', gulp.series('sass', function css() {
    return gulp.src('css/*.css')
    .pipe(csso())
    .pipe(gulp.dest('css/'))
    .pipe(browserSync.stream());
}));

let webpack_plugins = [];
webpack_plugins.push(new NodePolyfillPlugin());
argv.bundleanalyzer ? webpack_plugins.push(new BundleAnalyzerPlugin()) : null;

gulp.task('webpack', function(done) {
    webpack({
        mode: argv.production ? 'production' : 'development',
        devtool: 'source-map',
        entry: {
            ie: './src/ie.js',
            ingresso: './src/ingresso.js',
            oportunidades: './src/oportunidades.js',
        },
        output: {
            path: path.resolve(__dirname, 'js'),
            filename: '[name].js'
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
                    }
                }
            }
        },
    }, function(err, stats) {
        if (err) throw new PluginError('webpack', {
            message: err.toString({
                colors: true
            })
        });
        if (stats.hasErrors()) throw new PluginError('webpack', {
            message: stats.toString({
                colors: true
            })
        });
        browserSync.reload();
        done();
    });
});

gulp.task('scripts', gulp.series('webpack', function js() {
    return gulp.src('js/*.js')
    .pipe(babel({
        presets: [
            [
                "@babel/env",
                { "modules": false }
            ]
        ]
    }))
    .pipe(uglify())
    .pipe(gulp.dest('js/'))
    .pipe(browserSync.stream());
}));

gulp.task('vendor', function(done) {
    [
        {
            src: 'node_modules/lightgallery/fonts/*',
            dest: 'vendor/fonts/',
        },
        {
            src: 'node_modules/lightgallery/images/*',
            dest: 'vendor/images/',
        },
    ].map(function(file) {
        return gulp.src(file.src)
        .pipe(gulp.dest(file.dest));
    });
    done();
});

gulp.task('dist', function() {
    return gulp.src([
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
    .pipe(gulp.dest('dist/'));
});

if (argv.production) {
    gulp.task('build', gulp.series('clean', gulp.parallel('styles', 'scripts', 'vendor'), 'dist'));
} else {
    gulp.task('build', gulp.series('clean', gulp.parallel('sass', 'webpack', 'vendor')));
}

gulp.task('default', gulp.series('build', function watch() {
    browserSync.init({
        ghostMode: false,
        notify: false,
        online: false,
        open: false,
        proxy: argv.URL || argv.url || 'localhost',
    });

    gulp.watch('sass/**/*.scss', gulp.series('sass'));

    gulp.watch('src/**/*.js', gulp.series('webpack'));

    gulp.watch('**/*.php').on('change', browserSync.reload);
}));
