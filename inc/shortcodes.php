<?php


/**
 * twig_shortcode function.
 *
 * @param array $atts
 * @param mixed $content
 * @throws Some_Exception_Class description of exception
 * @return string
 */

function twig_shortcode($atts, $content = null) {

    // global $post;
    // global $wp_query;
    // Prepare Timber context
    $context = Timber::context();
    $context['state'] = $context;
    $context['attributes'] = $atts;

    // Compile the content as a Twig template
    $compiled_content = Timber::compile_string($content, $context);

    return $compiled_content;

}

add_shortcode('twig', 'twig_shortcode');


/**
 * Twig shortcode for querying and displaying posts using Timber and Twig templates.
 *
 * @param array $atts Shortcode attributes.
 * @param string|null $content The content inside the shortcode.
 * @return string The compiled content as a Twig template.
 */
function twig_query_shortcode($atts, $content = null) {
// Ensure Timber is available
if (!class_exists('Timber')) {
return 'Timber not found';
}

// Default attributes
$atts = shortcode_atts([
'type' => 'post', // Default post type
'count' => 1      // Default number of posts
], $atts);

// Prepare Timber context
$context = Timber::context();
$context['state'] = $context;
$context['attributes'] = $atts;

// Perform the query using attributes
$args = [
'post_type' => $atts['type'],
'posts_per_page' => intval($atts['count'])
];

// Query the posts
$context['query'] = Timber::get_posts($args);

// Compile the content as a Twig template
$compiled_content = Timber::compile_string($content, $context);

return $compiled_content;
}

add_shortcode('twig_query', 'twig_query_shortcode');