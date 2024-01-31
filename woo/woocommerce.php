<?php
/**
 * WooCommerce Template
 *
 * This template is used to display the main shop page.
 *
 * @package timber-base
 */

$context = Timber::context();
$context['posts'] = Timber::get_posts();
$context['products'] = new Timber\PostQuery();

Timber::render( 'woocommerce.twig', $context );
