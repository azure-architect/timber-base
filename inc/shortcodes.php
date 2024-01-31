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


/**
 * Shortcode to display methods of a specified class.
 *
 * Usage:
 * Place the shortcode [show_methods class="YourClassName"] in a post or page,
 * replacing "YourClassName" with the actual name of the class whose methods you want to inspect.
 * This shortcode will output a list of all public methods available in the specified class.
 */
function show_class_methods($atts) {
    $attributes = shortcode_atts(['class' => ''], $atts);
    $class_name = $attributes['class'];

    if (class_exists($class_name)) {
        $reflection = new ReflectionClass($class_name);
        $methods = $reflection->getMethods();
        $output = "<ul>";

        foreach ($methods as $method) {
            $output .= "<li>" . $method->getName() . "</li>";
        }

        $output .= "</ul>";
        return $output;
    } else {
        return "Class '{$class_name}' not found or not available.";
    }
}
add_shortcode('show_methods', 'show_class_methods');

/**
 * Inspects a method using a shortcode and returns the reflection of the method.
 *
 * @param array $atts The attributes passed to the shortcode.
 * @throws ReflectionException if the method does not exist.
 * @return string The reflection of the method wrapped in <pre> tags.
 */

/**
 * You can use this shortcode in posts or pages like this:
 * [inspect_method class="YourClassName" method="yourMethodName"].
 * Replace YourClassName and yourMethodName with
 * the actual class and method names you want to inspect.
 */
function inspect_method_shortcode($atts) {
    $attributes = shortcode_atts([
        'class' => '',
        'method' => '',
    ], $atts);

    if (class_exists($attributes['class'])) {
        try {
            $reflection = new ReflectionMethod($attributes['class'], $attributes['method']);
            ob_start();
            var_dump($reflection);
            $output = ob_get_clean();
            return '<pre>' . htmlspecialchars($output) . '</pre>';
        } catch (ReflectionException $e) {
            return 'Error: ' . htmlspecialchars($e->getMessage());
        }
    } else {
        return 'Class not found.';
    }
}
add_shortcode('inspect_method', 'inspect_method_shortcode');
