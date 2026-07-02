<?php
if ( ! class_exists( 'acf' ) ) {
    return false;
}

function register_acf_fields() {
    foreach ( glob( get_template_directory() . '/blocks/*/' ) as $path ) {
        require_once( $path . 'init.php' );
    }
}
add_action( 'init', 'register_acf_fields' );

// Register custom block category
add_filter( 'block_categories_all', function( $categories ) {
    array_unshift( $categories, [
        'slug'  => 'deante-blocks',
        'title' => 'Deante Blocks',
        'icon'  => null,
    ]);
    return $categories;
});