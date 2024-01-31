<?php
// single-product.php
$context = Timber::context();
$context['post'] = Timber::get_post();
$context['product'] = wc_get_product($context['post']->ID);

Timber::render('views/woo/single-product.twig', $context);
