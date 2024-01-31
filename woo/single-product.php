<?php
/**
 * The Template for displaying all single products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 */



// Load Timber
$context = Timber::context();

// WooCommerce content
$context['post'] = Timber::get_post();

// WooCommerce product
$product = wc_get_product( $context['post']->ID );
$context['product'] = $product;

// Load scripts and styles for the product page
function enqueue_product_page_scripts() {
    // Example: wp_enqueue_style( 'your-tailwindcss-style-handle', get_template_directory_uri() . '/path/to/your/tailwindcss/styles.css' );
}
add_action( 'wp_enqueue_scripts', 'enqueue_product_page_scripts' );

// Render Twig template
Timber::render( 'single-product.twig', $context );
