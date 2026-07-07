<?php
/**
 * Tinymce settings
 */
if ( ! defined( 'ABSPATH' ) ) exit;
/**
 * Add style formats menu option to tinymce
 *
 * @param array $buttons - tinymce top row buttons.
 * @return array $buttons - tinymce top row buttons modified.
 */
function tinymce_buttons_1( $buttons ) {
  $inserted = [ 'styleselect' ];
  array_splice( $buttons, 1, 0, $inserted );
  return $buttons;
}
// Register our callback to the appropriate filter
add_filter( 'mce_buttons', 'tinymce_buttons_1', 10, 1 );
/**
 * Add style formats to tinymce
 *
 * @param array $init_array - array of tinymce settings.
 * @return array $init_array - array of modified tinymce settings.
 */
function custom_tinymce_formats( $init_array ) {
  // Define the style_formats
    $style_formats = [
        [
            'title'    => 'Page Title',
            'selector' => 'h1,h2,h3,h4,h5,h6,p,div,li',
            'classes'  => 'inner-banner-heading',
        ],
        [
            'title'    => 'Hero Heading',
            'selector' => 'h1,h2,h3,h4,h5,h6,p,div,li',
            'classes'  => 'hero-heading',
        ],
        [
            'title'    => 'Inner Banner Label',
            'selector' => 'h1,h2,h3,h4,h5,h6,p,div,li,span',
            'classes'  => 'inner-banner-label',
        ],
        [
            'title'    => 'Split Section Heading',
            'selector' => 'h1,h2,h3,h4,h5,h6,p,div,li',
            'classes'  => 'split-title',
        ],
        [
            'title'    => 'Section Heading',
            'selector' => 'h1,h2,h3,h4,h5,h6,p,div,li',
            'classes'  => 'section-title',
        ],
        [
            'title'    => 'Content Title',
            'selector' => 'h1,h2,h3,h4,h5,h6,p,div,li',
            'classes'  => 'content-section-title-font',
        ],
        [
            'title'    => 'Content Body',
            'selector' => 'h1,h2,h3,h4,h5,h6,p,div,li',
            'classes'  => 'content-section-content-font',
        ],
        [
            'title'    => 'Single Content Heading',
            'selector' => 'h1,h2,h3,h4,h5,h6,p,div,li',
            'classes'  => 'single-content-heading',
        ],
        [
            'title'    => 'Single Content Body',
            'selector' => 'h1,h2,h3,h4,h5,h6,p,div,li',
            'classes'  => 'single-content-text',
        ],
        [
            'title'    => 'Highlight',
            'selector' => 'h1,h2,h3,h4,h5,h6,p,div,li,span',
            'classes'  => 'highlight',
            'inline'   => 'span',
        ],
        [
            'title'    => 'Bold Text',
            'selector' => 'h1,h2,h3,h4,h5,h6,p,div,li,span,strong',
            'classes'  => 'bold-text',
            'inline'   => 'span',
        ],
        [
            'title'    => 'Checkmark List',
            'selector' => 'h1,h2,h3,h4,h5,h6,p,div,li,ul',
            'classes'  => 'checkmark-list',
        ],
        [
            'title'    => 'Outline Button',
            'selector' => 'a,button,div',
            'classes'  => 'btn-outline',
        ],
        [
            'title'    => 'Full Mobile Outline Button',
            'selector' => 'a,button,div',
            'classes'  => 'btn-outline btn-outline-full-mobile',
        ],
    ];

  // Insert the array, JSON ENCODED, into 'style_formats'
  $init_array['style_formats'] = wp_json_encode( $style_formats );
  return $init_array;
}
// Attach callback to 'tiny_mce_before_init'
add_filter( 'tiny_mce_before_init', 'custom_tinymce_formats', 10, 1 );


function load_custom_editor_styles($init) {
    $css = get_stylesheet_directory_uri() . '/assets/css/editor-styles.css';
    $init['content_css'] = isset($init['content_css'])
        ? $init['content_css'] . ',' . $css
        : $css;
    return $init;
}
add_filter('tiny_mce_before_init', 'load_custom_editor_styles');