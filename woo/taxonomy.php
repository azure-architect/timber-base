<?php
// taxonomy.php
// Ensure Timber is loaded


$context = Timber::context();

// Get the queried object and embed it in context, this could be a term object
$term = get_queried_object();
$context['term'] = $term;

// Optionally, adjust the query (for products under this term, for example)
$args = array(
    'post_type' => 'product',
    'tax_query' => array(
        array(
            'taxonomy' => $term->taxonomy,
            'field'    => 'term_id',
            'terms'    => $term->term_id,
        ),
    ),
);

$context['posts'] = new Timber\PostQuery($args);

// Render the Twig template with the context
Timber::render('taxonomy-' . $term->taxonomy . '.twig', $context);
