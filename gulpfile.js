var elixir = require('laravel-elixir');


elixir(function(mix){

    
    mix.styles([
        "font-awesome.min.css",
        "bootstrap.min.css",
        "app.css",
        "metisMenu.min.css",
        "sb-admin-2.css"
    ],"public/css/all.css");

    mix.scripts([
        "jquery.min.js",
        "bootstrap.js",
        "app.js",
        "metisMenu.min.js",
        "sb-admin-2.js"
    ],"public/js/all.js");
});