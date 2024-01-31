<?php
// woocommerce.php

$context = Timber::context();

// Set up WooCommerce context
if (is_plugin_active('woocommerce/woocommerce.php')) {
    // WooCommerce plugin is active
    // You can now safely call the is_woocommerce() function
    if ( is_woocommerce() ) {
        $args = array(
            'post_type' => 'product',
        );
        $context['post'] = Timber::get_post();
        $context['products'] = Timber::get_posts($args);

        // Add any other WooCommerce-specific context variables as needed
    }
} else {die('WooCommerce is not active');};

Timber::render('woocommerce.twig', $context);

