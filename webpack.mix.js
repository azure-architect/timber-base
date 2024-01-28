let mix = require('laravel-mix');
const glob = require('glob');

// Configure BrowserSync
mix.browserSync({
    proxy: 'http://timber.local',
    files: [
        'dist/**/*', // Watch compiled files for changes
        'views/**/*', // Watch views directory, if you have one
        'functions.php' // Watch your functions.php file
        // Add other directories to watch as needed
    ]
});

// Compile all JavaScript files into a single prod.js
mix.js(glob.sync('src/js/**/*.js'), 'dist/js/prod.js');

// Sass with Tailwind
mix.sass('src/scss/main.scss', 'css')
    .options({
        processCssUrls: false,
        postCss: [require('tailwindcss'), require('autoprefixer')],
    })
    .setPublicPath('dist');

// Source maps in development and versioning in production
if (!mix.inProduction()) {
    mix.sourceMaps();
} else {
    mix.version();
}
