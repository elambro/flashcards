const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.webpackConfig({
    resolve: {
        // Add some directory aliases to make including vue files much easier
        alias: {
            '@public'  : path.resolve(__dirname, 'public'),
            '@nm'      : path.resolve(__dirname, 'node_modules'),
            '@assets'  : path.resolve(__dirname, 'resources/assets'),
            '@sass'    : path.resolve(__dirname, 'resources/assets/sass'),

            '~services': path.resolve(__dirname, 'resources', 'assets', 'js', 'services'),
            '~c'       : path.resolve(__dirname, 'resources/assets/js/components'),
            '~classes' : path.resolve(__dirname, 'resources/assets/js/classes'),
            '~store'   : path.resolve(__dirname, 'resources/assets/js/store'),
            '~models'  : path.resolve(__dirname, 'resources/assets/js/models'),
            '~utils'   : path.resolve(__dirname, 'resources/assets/js/utils'),
            '~api'     : path.resolve(__dirname, 'resources/assets/js/api'),
            '~tests'   : path.resolve(__dirname, 'resources/assets/js/tests'),
        }
    },
    // target: 'node',
    // node: {
    //     fs: 'empty',
    //     net: 'empty',
    //     tls: 'empty',
    // },
    // node: {
    //    fs: "empty",
    //     browser: { fs: false, child_process: false },
    // },
});

/*
 |--------------------------------------------------------------------------
 | Disable Notifications
 |--------------------------------------------------------------------------
 */

mix.disableSuccessNotifications();

/*
 |--------------------------------------------------------------------------
 | BrowserSync and Hot Reload
 |--------------------------------------------------------------------------
 | 
 | Setup options for hot reloading. If this doesn't work correctly,
 | Try https://laravel-mix.com/docs/4.1/livereload
 | See https://laravel-mix.com/docs/4.1/browsersync
 |
 */

const domain = process.env.MIX_URL || 'flashcards.local';
mix.browserSync({
    open: 'external',
    host: domain,
    proxy: domain,
    injectChanges: true,
    files: [ 'resources/views/**', 'public/**', '!public/**.map', '!public/build/**']
});

// const domain = process.env.MIX_URL || 'flashcards.local';
// mix.browserSync(domain).options({
//     hmrOptions: {
//         host: domain,
//         port: 8080
//     }
// });

mix
    .sourceMaps()
    .js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css');

if (mix.inProduction()) {
    mix.version();
} else {
    // Speed things up
    mix.options({processCssUrls: false});
}
