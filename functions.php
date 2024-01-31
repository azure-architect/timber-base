<?php
/**
 * Timber starter-theme
 * https://github.com/timber/starter-theme
 */

// Load Composer dependencies.
require_once __DIR__ . '/vendor/autoload.php';

require_once __DIR__ . '/src/StarterSite.php';

require_once __DIR__ . '/inc/shortcodes.php';

Timber\Timber::init();

// Sets the directories (inside your theme) to find .twig files.
Timber::$dirname = [ 'templates', 'views' ];

new StarterSite();

/**
 * Enqueue the main CSS and JavaScript files for the theme.
 *
 * @throws N/A
 * @return N/A
 */

function timber_enqueue_scripts() {
    // Get the theme's version to append to enqueued files for cache busting
    $theme_version = wp_get_theme()->get('Version');

    $alpinejs = 'https://unpkg.com/alpinejs';

    // Enqueue Main CSS
    // Assuming the compiled CSS file is at 'dist/css/main.css'
    wp_enqueue_style('timber-main-css', get_template_directory_uri() . '/dist/css/main.css', array(), $theme_version);

    // Enqueue JavaScript File
    // Assuming the compiled JS file is at 'dist/js/prod.js'
    wp_enqueue_script('timber-main-js', get_template_directory_uri() . '/dist/js/prod.js', array(), $theme_version, true);
//    wp_enqueue_script('timber-alpine-js', $alpinejs, array(), $theme_version, true);
}

add_action('wp_enqueue_scripts', 'timber_enqueue_scripts');

/**
 * Register menus for the theme.
 *
 * @return void
 */

function timber_base_register_menus() {
    register_nav_menus([
        'main_menu' => __('Main Menu', 'locallyknown'),
    ]);
}
add_action('init', 'timber_base_register_menus');
