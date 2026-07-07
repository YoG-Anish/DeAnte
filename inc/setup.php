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
            'footer-menu-1' => __('Footer Menu 1'),
            'footer-menu-2' => __('Footer Menu 2'),
            'sidebar-menu' => __('Sidebar Menu'),
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


// AJAX handler
function ajax_filter_case_studies() {
    check_ajax_referer('case_study_filter_nonce', 'nonce');

    $filter = isset($_POST['filter']) ? sanitize_text_field($_POST['filter']) : 'all';
    $page   = isset($_POST['page']) ? absint($_POST['page']) : 1;

    $args = [
        'post_type'      => 'case-study',
        'posts_per_page' => 5,
        'paged'          => $page,
    ];

    if ($filter !== 'all') {
        $args['tax_query'] = [[
            'taxonomy' => 'services-category',
            'field'    => 'slug',
            'terms'    => $filter,
        ]];
    }

    $query = new WP_Query($args);
    $html  = '';

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            $html .= render_case_study_card(get_post());
        }
        wp_reset_postdata();
    } elseif ($page === 1) {
        $html = '<p class="no-results">No case studies found.</p>';
    }

    wp_send_json([
        'html'       => $html,
        'has_more'   => $page < $query->max_num_pages,
    ]);
}
add_action('wp_ajax_filter_case_studies', 'ajax_filter_case_studies');
add_action('wp_ajax_nopriv_filter_case_studies', 'ajax_filter_case_studies');
