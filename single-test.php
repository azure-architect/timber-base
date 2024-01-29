<?php

$context = Timber::context();

$args = [
    'post_type' => 'test', // Replace 'test' with your CPT slug
    'posts_per_page' => -1 // Retrieves all posts; adjust as needed
];

// Fetching the posts
$posts_query = Timber::get_posts($args);

// Ensure that we have an array of posts
$posts = $posts_query instanceof Timber\PostQuery ? $posts_query->get_posts() : $posts_query;

// Process each post to get custom fields
$processed_posts = array_map(function ($post) {
    // Retrieve all custom fields for the post
    $custom_fields = get_post_meta($post->ID);

    // Process each custom field
    $processed_fields = [];
    foreach ($custom_fields as $key => $value) {
        // Assuming you want the first value of each custom field
        $processed_fields[$key] = maybe_unserialize($value[0]);
    }

    // Return the post with its custom fields
    return [
        'title' => $post->title(),
        'content' => $post->content(),
        'fields' => $processed_fields
    ];
}, $posts);

// Add processed posts with custom fields to context
$context['processed_tests'] = $processed_posts;

// Render the Twig template with context
Timber::render('test/index.twig', $context);
