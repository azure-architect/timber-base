<?php
if ( ! class_exists('Timber') ) {
    echo 'Timber not activated. Make sure you activate the plugin in <a href="/wp-admin/plugins.php#timber">the admin panel</a>';
    return;
}

// Get the current post ID
$post_id = get_the_ID();

// Fetch the FAQ data from ACF
$faq_data = get_field('faq_list', $post_id);

// Prepare the context
$context = Timber::get_context();
$context['post'] = Post($args);
$context['faq_json'] = json_encode($faq_data);

// Render the Twig template
Timber::render('your-template.twig', $context);
