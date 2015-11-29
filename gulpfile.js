var elixir = require('laravel-elixir');

require('laravel-elixir-clear');

var assets = {
  css: './public/assets/css',
  fonts: './public/assets/fonts',
  img: './public/assets/img',
  js: './public/assets/js'
};

var fonts = {
  hack: './bower_components/hack/fonts',
  sourceSansPro: './bower_components/source-sans-pro/fonts'
}

var packages = {
  bootstrap: './bower_components/bootstrap/dist/js',
  jquery: './bower_components/jquery/dist'
};

elixir(function(mix) {
  mix
    .clear([assets.css, assets.js, assets.fonts])
    .copy(fonts.hack + '/**', assets.fonts)
    .copy(fonts.sourceSansPro + '/**', assets.fonts)
    .sass('app.scss', assets.css)
    .styles([
      assets.css + '/app.css'
    ], assets.css + '/app.css')
    .scripts([
      packages.jquery + '/jquery.js',
      packages.bootstrap + '/bootstrap.js'
    ], assets.js + '/app.js')
});
