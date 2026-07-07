<?php

function deante_enqueue_scripts()
{
    wp_enqueue_style('deante-style', get_stylesheet_uri(), array(), null, 'all');
    wp_enqueue_style('deante-splide-min-css', get_template_directory_uri() . '/assets/css/splide.min.css', array(), null, 'all');
    wp_enqueue_style('deante-editor-styles', get_template_directory_uri() . '/assets/css/editor-styles.css', array(), null, 'all');
    wp_enqueue_style('deante-main', get_template_directory_uri() . '/assets/css/main.css', array(), null, 'all');
    

    wp_enqueue_script('deante-splide-min-js', get_template_directory_uri() . '/assets/js/splide.min.js', array('jquery'), null, true);
    wp_enqueue_script('deante-splide_extension-auto-scroll-min-js', get_template_directory_uri() . '/assets/js/splide-extension-auto-scroll.min.js', array('jquery'), null, true);
    wp_enqueue_script('deante-slider', get_template_directory_uri() . '/assets/js/slider.js', array('jquery'), null, true);
    wp_enqueue_script('deante-sidebar', get_template_directory_uri() . '/assets/js/sidebar.js', array(), null, true);


    wp_enqueue_script(
        'case-studies',
        get_template_directory_uri() . '/blocks/casestudies-card/casestudies-card.js',
        [],
        filemtime(get_template_directory() . '/blocks/casestudies-card/casestudies-card.js'),
        true
    );

    wp_localize_script('case-studies', 'caseStudyAjax', [
        'ajax_url' => esc_url(admin_url('admin-ajax.php')),
        'nonce'    => wp_create_nonce('case_study_filter_nonce'),
    ]);
}
add_action('wp_enqueue_scripts', 'deante_enqueue_scripts');
