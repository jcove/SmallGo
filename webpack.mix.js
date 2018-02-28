/*jshint esversion: 6 */
let mix = require('laravel-mix');

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
    module: {
        rules: [
            {
                test: /\.js$/,
                //exclude: /(node_modules|bower_components)/,
                use: {
                    loader: 'babel-loader',
                    options: {
                        presets: ['env']
                    }
                }
            }
        ]
    }

});
mix.js('resources/assets/js/app.js', 'public/js')
    .js('resources/assets/js/m.js','public/js')
    .js('resources/assets/js/flex.js','public/js')
    .less('resources/assets/less/app.less', 'public/css')
    .less('resources/assets/less/mobile.less', 'public/css')
    .version();

