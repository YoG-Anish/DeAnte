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
    'title' => 'Page Title',
    'selector' => 'h1,h2,h3,h4,h5,h6,p,div,li',
    'classes' => 'page-title-font-50',
  ],
  [
    'title' => 'Moderat 32',
    'selector' => 'h1,h2,h3,h4,h5,h6,p,div,li',
    'classes' => 'moderat-32',
  ],
	[
    'title' => 'Moderat 24',
    'selector' => 'h1,h2,h3,h4,h5,h6,p,div,li',
    'classes' => 'moderat-24',
  ],
  [
    'title' => 'Moderat 22',
    'selector' => 'h1,h2,h3,h4,h5,h6,p,div,li',
    'classes' => 'moderat-22',
  ],
  [
    'title' => 'Moderat 20',
    'selector' => 'h1,h2,h3,h4,h5,h6,p,div,li',
    'classes' => 'moderat-20',
  ],
  [
    'title' => 'Moderat 18',
    'selector' => 'h1,h2,h3,h4,h5,h6,p,div,li',
    'classes' => 'moderat-18',
  ],
  [
    'title' => 'Moderat 18 Semibold',
    'selector' => 'h1,h2,h3,h4,h5,h6,p,div,li',
    'classes' => 'moderat-18-600',
  ],
  [
			'title' => 'Moderat 13',
			'selector' => 'h1,h2,h3,h4,h5,h6,p,div,li',
			'classes' => 'moderat-13',
  ],
  [
    'title' => 'Moderat 12 Light',
    'selector' => 'h1,h2,h3,h4,h5,h6,p,div,li',
    'classes' => 'moderat-12-300',
  ],
  [
    'title' => 'Vacatio Forest Color',
    'selector' => 'h1,h2,h3,h4,h5,h6,p,div,a,strong,blockquote,li',
    'classes' => 'vacatio-forest-color',
    'inline'  => 'span',
  ],
  [
    'title' => 'Vacatio Lime Color',
    'selector' => 'h1,h2,h3,h4,h5,h6,p,div,a,strong,blockquote,li',
    'classes' => 'vacatio-lime-color',
    'inline'  => 'span',
  ],
  [
    'title' => 'White Color',
    'selector' => 'h1,h2,h3,h4,h5,h6,p,div,a,strong,blockquote,li',
    'classes' => 'white-color',
    'inline'  => 'span',
  ],
  [
    'title' => 'Black Color',
    'selector' => 'h1,h2,h3,h4,h5,h6,p,div,a,strong,blockquote,li',
    'classes' => 'black-color',
    'inline'  => 'span',
  ],
  [
    'title' => 'Nectr Black',
    'selector' => 'h1,h2,h3,h4,h5,h6,p,div,a,strong,blockquote,li',
    'classes' => 'nectr-black',
    'inline'  => 'span',
  ],
  [
    'title' => 'Bordered Button',
    'selector' => 'a,button',
    'classes' => 'button bordered',
  ],
  [
    'title' => 'Button Type 1',
    'selector' => 'a,button',
    'classes' => 'button button-type-1',
  ],
  [
    'title' => 'Button Type 2',
    'selector' => 'a,button',
    'classes' => 'button button-type-2',
  ],
  [
    'title' => 'Button Type 3',
    'selector' => 'a,button',
    'classes' => 'button button-type-3',
  ],
		[
    'title' => 'Button Download Icon',
    'selector' => 'a,button',
    'classes' => 'button download-icon',
  ],
  [
   'title' => 'Check List Type 1',
   'selector' => 'ul,ol',
   'classes' => 'check-list-type-1',
  ],
	[
   'title' => 'Check List Type 2',
   'selector' => 'ul,ol',
   'classes' => 'check-list-type-2',
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