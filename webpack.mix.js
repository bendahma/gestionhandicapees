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

<<<<<<< HEAD
mix.js(
   [
      'resources/js/bootstrap.bundle.min.js',
      'resources/js/jquery.dataTables.min.js',
      'resources/js/jquery.min.js',
      'resources/js/sb-admin-2.js',
   ],
   'public/js/site.js'
);

// mix.sass(
//       'resources/sass/app.scss', 
//       'public/css'
//    );

mix.styles(
      [
         'resources/css/all.min.css',
         'resources/css/app.css',
         'resources/css/dataTables.bootstrap4.min.css',
         'resources/css/fontawesome.min.css',
         'resources/css/regular.min.css',
         'resources/css/solid.min.css',
         'resources/css/style.css',
      ],
      'public/css/site.css'
);
=======
mix.js('resources/js/app.js','public/js')
    .sass('resources/sass/app.scss','public/css');
>>>>>>> ebcea4b0270816f32e0a24123fc7538b230a81b1
