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

mix.react('resources/js/app.js', 'public/js')
   .sass('resources/sass/app.scss', 'public/css')
   .sass('resources/sass/main.scss', 'public/css');
   
   mix.webpackConfig({
   module: {
      rules: [
          {
              test: /\.js$/, //using regex to tell babel exactly what files to transcompile
              exclude: /node_modules/, // files to be ignored
              use: {
                  loader: 'babel-loader' // specify the loader
              } 
          }
      ]
  }
});