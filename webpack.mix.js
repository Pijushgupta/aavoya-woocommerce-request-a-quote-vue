let mix = require('laravel-mix');

mix.js("assets/src/main.js", "assets/dist")
	.vue()
  .postCss("assets/src/main.css", "assets/dist", [
    require("tailwindcss"),
  ]);