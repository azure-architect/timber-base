<?php
/**
 * WooCommerce Product Archive Template
 *
 * This template is used to display the product archive page.
 *
 * @package timber-base |  | © 2020 - 2022 locally Known
 *
 */

$context = Timber::context();
$context['posts'] = Timber::get_posts();
$context['products'] = new Timber\PostQuery();

Timber::render('archive-product.twig', $context);
