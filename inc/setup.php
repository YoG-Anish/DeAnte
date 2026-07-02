<?php

function deante_theme_setup() {
    add_theme_support( 'post-thumbnails' );
    // Add support for editor styles.
    add_theme_support( 'editor-styles' );
    // Enqueue editor styles.
    add_editor_style( 'assets/css/editor-styles.css' );
}
add_action( 'after_setup_theme', 'deante_theme_setup' );

function register_my_menus() {
    register_nav_menus(
        array(
            'header-menu' => __('Header Menu'),
            'footer-menu' => __('Footer Menu')
        )
    );
}
add_action('init', 'register_my_menus');


// Save ACF JSON to a custom directory
add_filter('acf/settings/save_json', function ($path) {
    // Update the path to your desired folder
    $path = get_stylesheet_directory() . '/acf-json';
    return $path;
});
// Load ACF JSON from a custom directory
add_filter('acf/settings/load_json', function ($paths) {
    // Remove the default path
    unset($paths[0]);
    // Update the path to your desired folder
    $paths[] = get_stylesheet_directory() . '/acf-json';
    return $paths;
});




// 1. Allow SVG through the WordPress upload mime types
function enable_svg_upload( $mimes ) {
    // SECURITY: Only allow administrators to upload SVGs
    if ( current_user_can( 'manage_options' ) ) {
        $mimes['svg']  = 'image/svg+xml';
        $mimes['svgz'] = 'image/svg+xml';
    }
    return $mimes;
}
add_filter( 'upload_mimes', 'enable_svg_upload' );