<?php

function deante_enqueue_scripts() {
    wp_enqueue_style('deante-style', get_stylesheet_uri(), array(), null, 'all');
    wp_enqueue_style('deante-global', get_template_directory_uri() . '/assets/css/global.css', array(), null, 'all');
    wp_enqueue_style('deante-main', get_template_directory_uri() . '/assets/css/main.css', array(), null, 'all');
    wp_enqueue_style('deante-footer', get_template_directory_uri() . '/assets/css/footer.css', array(), null, 'all');
    

}
add_action('wp_enqueue_scripts', 'deante_enqueue_scripts');

