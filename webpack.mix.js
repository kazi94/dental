const mix = require("laravel-mix");

mix.disableNotifications();

mix.js("resources/js/app.js", "public/js");
mix.js("resources/js/admin_app.js", "public/js");
mix.js("resources/js/liste-patients.js", "public/js");
mix.js("resources/js/liste-prescriptions.js", "public/js");
mix.js("resources/js/liste-payments.js", "public/js");

mix.browserSync("localhost:8000");
