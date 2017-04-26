const path = require('path');
const { mix } = require('laravel-mix');
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
const buildDir = process.env.BUILD_DIR;
const publicPath = `./public/${buildDir}/`;
const srcPath = `./resources/${buildDir}/`;

mix.setPublicPath(publicPath)
    .setResourceRoot(`/${buildDir}/`)
    .js(`${srcPath}/js/admin/app.js`, 'js/admin.app.js')
    .sass(`${srcPath}/sass/admin/admin.scss`, 'css/admin.app.css')
    .extract(['vue', 'vue-router', 'vuex'])
    .webpackConfig({
        output: {
            publicPath: `./${buildDir}/`,
            chunkFilename: 'js/[name].[chunkhash].js',
        },
        resolve: {
            alias: {
                env: path.resolve(__dirname, `${srcPath}/js/.env.js`),
                package: path.resolve(__dirname, './package.json'),
                assets: path.resolve(__dirname, `${srcPath}/assets`),
                lib: path.resolve(__dirname, `${srcPath}/js/lib`),
                env: path.resolve(__dirname, `${srcPath}/js/.env.js`),
                'admin-pages': path.resolve(__dirname, `${srcPath}/js/admin/pages`),
                'admin-api': path.resolve(__dirname, `${srcPath}/js/admin/api`),
            }
        }
    });
// if (mix.config.inProduction) {
mix.version()
    // } else {
    //     mix.sourceMaps()
    // }
