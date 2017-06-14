<?php
/**
 * Register Customizer settings.
 *
 * @package    Dear\Functions\Customizer
 * @subpackage Genesis
 * @author     Robert Neu
 * @copyright  Copyright (c) 2015, Shay Bocks
 * @license    GPL-2.0+
 * @link       http://www.shaybocks.com/dear/
 * @since      1.0.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * Build font rules into an associative array to use when building CSS output.
 *
 * @since  1.0.0
 * @access public
 * @param  string $type the type of font setting for the rule we're building.
 * @param  mixed  $mod a WordPress theme mod or option.
 * @return array $output a CSS font rule and declaration.
 */
function dear_get_font_declarations( $type, $mod ) {
	$output = array();

	switch ( $type ) {
		case 'family':
			$output = array(
				'font-family' => customizer_library_get_font_stack( $mod ),
			);
		break;
		case 'size':
			$output = array(
				'font-size' => "{$mod}px",
			);
		break;
		default:
			$output = array(
				"font-{$type}" => $mod,
			);
		break;
	}

	return $output;
}


/**
 * Build our font styles into an associative array which can be passed to
 * the Customizer Library style builder to actually build the style output.
 *
 * @since  1.0.0
 * @access public
 * @param  string $type the type of font setting for the rule we're building.
 * @param  array  $selectors a list of selectors to associate with style rules.
 * @param  mixed  $mod a WordPress theme mod or option.
 * @return array styles a list of CSS selectors and their associated rules.
 */
function dear_build_font_styles( $type, $selectors, $mod ) {
	return array(
		'selectors'    => array( rtrim( implode( ', ', $selectors ) ) ),
		'declarations' => dear_get_font_declarations( $type, $mod ),
	);
}

/**
 * Add an individual font setting to the group of customizer-generated styles
 * to be output on the front-end.
 *
 * @since  1.0.0
 * @access public
 * @param  string $type the type of font setting for the rule we're building.
 * @param  mixed  $mod a WordPress theme mod or option.
 * @param  array  $data An array of information about a given font setting.
 * @return void
 */
function dear_add_font( $type, $mod, $data ) {
	if ( $mod === $data[ "default_{$type}" ] ) {
		return;
	}

	Customizer_Library_Styles()->add( dear_build_font_styles(
		$type,
		$data['selectors'],
		$mod
	) );
}

/**
 * An array of the font settings used in Dear.
 *
 * @since  1.0.0
 * @access public
 * @return array $fonts
 */
function dear_get_fonts() {
	$fonts = array(
		'body_font' => array(
			'default_family' => 'Libre Baskerville',
			'default_weight' => 400,
			'default_size'   => 12,
			'min_size'       => 11,
			'max_size'       => 21,
			'default_style'  => 'disabled',
			'label'          => __( 'Body Font', 'dear' ),
			'selectors'      => array( 'body' ),
		),
		'accent_font' => array(
			'default_family' => 'Lato',
			'default_weight' => 300,
			'default_size'   => 'disabled',
			'default_style'  => 'italic',
			'label'          => __( 'Accent Font', 'dear' ),
			'selectors'      => array(
				'input',
				'select',
				'textarea',
				'.wp-caption-text',
				'.site-description',
				'.entry-meta',
			),
		),
		'accent_font_meta' => array(
			'default_family' => 'disabled',
			'default_weight' => 'disabled',
			'default_size'   => 11,
			'min_size'       => 10,
			'max_size'       => 18,
			'default_style'  => 'disabled',
			'label'          => __( 'Accent Font', 'dear' ),
			'selectors'      => array(
				'.wp-caption-text',
				'.site-description',
				'.entry-meta',
			),
		),
		'heading_font' => array(
			'default_family' => 'Lato',
			'default_weight' => 600,
			'default_size'   => 'disabled',
			'default_style'  => 'normal',
			'label'          => __( 'Heading Font', 'dear' ),
			'selectors'      => array(
				'h1',
				'h2',
				'h3',
				'h4',
				'h5',
				'h6',
				'.site-title',
				'.entry-title',
				'.entry-title a',
				'.widgettitle',
				'.site-footer',
			),
		),
		'h1_font' => array(
			'default_family' => 'disabled',
			'default_weight' => 'disabled',
			'default_size'   => 22,
			'min_size'       => 18,
			'max_size'       => 38,
			'default_style'  => 'disabled',
			'label'          => __( 'H1 Font', 'dear' ),
			'selectors'      => array( 'h1' ),
		),
		'h2_font' => array(
			'default_family' => 'disabled',
			'default_weight' => 'disabled',
			'default_size'   => 20,
			'min_size'       => 16,
			'max_size'       => 34,
			'default_style'  => 'disabled',
			'label'          => __( 'H2 Font', 'dear' ),
			'selectors'      => array( 'h2' ),
		),
		'h3_font' => array(
			'default_family' => 'disabled',
			'default_weight' => 'disabled',
			'default_size'   => 18,
			'min_size'       => 14,
			'max_size'       => 30,
			'default_style'  => 'disabled',
			'label'          => __( 'H3 Font', 'dear' ),
			'selectors'      => array( 'h3' ),
		),
		'h4_font' => array(
			'default_family' => 'disabled',
			'default_weight' => 'disabled',
			'default_size'   => 16,
			'min_size'       => 12,
			'max_size'       => 28,
			'default_style'  => 'disabled',
			'label'          => __( 'H4 Font', 'dear' ),
			'selectors'      => array( 'h4' ),
		),
		'entry_title_font' => array(
			'default_family' => 'disabled',
			'default_weight' => 'disabled',
			'default_size'   => 18,
			'min_size'       => 14,
			'max_size'       => 34,
			'default_style'  => 'disabled',
			'label'          => __( 'Entry Title Font', 'dear' ),
			'selectors'      => array(
				'.entry-title',
				'.entry-title a',
			),
		),
		'widgettitle_font' => array(
			'default_family' => 'disabled',
			'default_weight' => 'disabled',
			'default_size'   => 10,
			'min_size'       => 10,
			'max_size'       => 16,
			'default_style'  => 'disabled',
			'label'          => __( 'Widget Title Font', 'dear' ),
			'selectors'      => array(
				'.sidebar .widgettitle',
				'.footer-widgets .widgettitle',
			),
		),
		'menu_font' => array(
			'default_family' => 'Lato',
			'default_weight' => 400,
			'default_size'   => 10,
			'min_size'       => 10,
			'max_size'       => 16,
			'default_style'  => 'disabled',
			'label'          => __( 'Menu Font', 'dear' ),
			'selectors'      => array( '.genesis-nav-menu .menu-item' ),
		),
		'button_font' => array(
			'default_family' => 'Lato',
			'default_weight' => 300,
			'default_size'   => 'disabled',
			'default_style'  => 'normal',
			'label'          => __( 'Button Font', 'dear' ),
			'selectors'      => dear_get_button_selectors(),
		),
	);

	return (array) apply_filters( 'dear_get_fonts', $fonts );
}
