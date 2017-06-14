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
 * Build color rules into an associative array to use when building CSS output.
 *
 * @since  1.0.0
 * @access public
 * @param  array $rules a list of rules to associate with color options.
 * @param  mixed $mod a WordPress theme mod or option.
 * @return array $built_rules a list of rules and their color options.
 */
function dear_get_color_rules( $rules, $mod ) {
	$built_rules = array();
	foreach ( (array) $rules as $rule ) {
		$built_rules[ $rule ] = $mod;
	}
	return $built_rules;
}

/**
 * Build our color styles into an associative array which can be passed to
 * the Customizer Library style builder to actually build the style output.
 *
 * @since  1.0.0
 * @access public
 * @param  array $selectors a list of selectors to associate with style rules.
 * @param  array $rules a list of rules to associate with style selectors.
 * @param  mixed $mod a WordPress theme mod or option.
 * @return array styles a list of CSS selectors and their associated rules.
 */
function dear_build_color_styles( $selectors, $rules, $mod ) {
	return array(
		'selectors'    => array( rtrim( implode( ', ', $selectors ) ) ),
		'declarations' => dear_get_color_rules( $rules, $mod ),
	);
}

/**
 * Add an individual color setting to the group of customizer-generated styles
 * to be output on the front-end.
 *
 * @since  1.0.0
 * @access public
 * @param  mixed $mod a WordPress theme mod or option.
 * @param  array $data An array of information about a given color setting.
 * @return void
 */
function dear_add_color( $mod, $data ) {
	if ( ! strcasecmp( $mod, $data['default'] ) ) {
		return;
	}

	Customizer_Library_Styles()->add( dear_build_color_styles(
		$data['selectors'],
		$data['rules'],
		$mod
	) );

	if ( isset( $data['alt_selectors'] ) ) {
		Customizer_Library_Styles()->add( dear_build_color_styles(
			$data['alt_selectors'],
			$data['alt_rules'],
			$mod
		) );
	}
}

/**
 * An array of the color settings used in Dear.
 *
 * @since  1.0.0
 * @access public
 * @return array $colors a list of theme color options and associated data.
 */
function dear_get_colors() {
	$colors = array(
		'header_bg_color' => array(
			'default'   => '#f5f5f5',
			'label'     => __( 'Header Background Color', 'dear' ),
			'section'   => 'general',
			'rules'     => array( 'background' ),
			'selectors' => array(
				'.dear .site-header',
			),
		),
		'title_color' => array(
			'default'   => '#302a2c',
			'label'     => __( 'Title Color', 'dear' ),
			'section'   => 'general',
			'rules'     => array( 'color' ),
			'selectors' => array(
				'.entry-title',
				'.entry-title a',
				'.widgettitle',
				'.recipe-index .widgettitle',
				'.footer-widgets .widgettitle',
				'.site-title a',
				'.site-title a:hover',
				'.site-title a:focus',
				'.dear .simmer-embedded-recipe .simmer-recipe-title a',
			),
		),
		'text_color' => array(
			'default'   => '#302a2c',
			'label'     => __( 'Text Color', 'dear' ),
			'section'   => 'general',
			'rules'     => array( 'color' ),
			'selectors' => array(
				'body',
				'.entry-meta a:not(.button)',
				'.sidebar a:not(.button)',
				'.site-description',
				'.site-footer a:not(.button)',
			),
		),
		'secondary_text_color' => array(
			'default'   => '#302a2c',
			'label'     => __( 'Secondary Text Color', 'dear' ),
			'section'   => 'general',
			'rules'     => array( 'color' ),
			'selectors' => array(
				'.entry-meta',
				'.entry-meta a',
				'.site-footer',
				'.dear .simmer-recipe-details',
			),
		),
		'link_color' => array(
			'default'   => '#44d5af',
			'label'     => __( 'Link Color', 'dear' ),
			'section'   => 'general',
			'rules'     => array( 'color' ),
			'selectors' => array(
				'a',
				'.site-footer a:not(.button)',
				'.pagination-next:after',
				'.pagination-previous:before',
			),
		),
		'link_hover_color' => array(
			'default'   => '#302a2c',
			'label'     => __( 'Link Hover Color', 'dear' ),
			'section'   => 'general',
			'rules'     => array( 'color' ),
			'selectors' => dear_add_hover_states( array(
				'a',
				'site-footer a',
			) ),
		),
		'menu_bg_color' => array(
			'default'   => '#ffffff',
			'label'     => __( 'Menu Background Color', 'dear' ),
			'section'   => 'menus',
			'rules'     => array( 'background' ),
			'selectors' => array(
				'.nav-primary',
				'.nav-secondary .wrap',
			),
		),
		'menu_link_color' => array(
			'default'   => '#302a2c',
			'label'     => __( 'Menu Link Color', 'dear' ),
			'section'   => 'menus',
			'rules'     => array( 'color' ),
			'selectors' => array(
				'.genesis-nav-menu > li > a',
			),
		),
		'menu_link_hover_color' => array(
			'default'   => '#000000',
			'label'     => __( 'Menu Link Hover Color', 'dear' ),
			'section'   => 'menus',
			'rules'     => array( 'color' ),
			'selectors' => array(
				'.genesis-nav-menu > li > a:hover',
				'.genesis-nav-menu > li > a:focus',
				'.genesis-nav-menu > .current-menu-item > a',
			),
		),
		'button_color' => array(
			'default'   => '#302a2c',
			'label'     => __( 'Button Color', 'dear' ),
			'section'   => 'buttons',
			'rules'     => array( 'background' ),
			'selectors' => dear_get_button_selectors(),
		),
		'button_hover_color' => array(
			'default'   => '#ffffff',
			'label'     => __( 'Button Hover Color', 'dear' ),
			'section'   => 'buttons',
			'rules'     => array( 'background' ),
			'selectors' => dear_add_hover_states( dear_get_button_selectors() ),
		),
		'button_border_color' => array(
			'default'   => '#302a2c',
			'label'     => __( 'Button Border Color', 'dear' ),
			'section'   => 'buttons',
			'rules'     => array( 'border-color' ),
			'selectors' => dear_get_button_selectors(),
		),
		'button_border_hover_color' => array(
			'default'   => '#302a2c',
			'label'     => __( 'Button Border Hover Color', 'dear' ),
			'section'   => 'buttons',
			'rules'     => array( 'border-color' ),
			'selectors' => dear_add_hover_states( dear_get_button_selectors() ),
		),
		'button_text_color' => array(
			'default'   => '#ffffff',
			'label'     => __( 'Button Text Color', 'dear' ),
			'section'   => 'buttons',
			'rules'     => array( 'color' ),
			'selectors' => dear_get_button_selectors(),
		),
		'button_text_hover_color' => array(
			'default'   => '#302a2c',
			'label'     => __( 'Button Hover Text Color', 'dear' ),
			'section'   => 'buttons',
			'rules'     => array( 'color' ),
			'selectors' => dear_add_hover_states( dear_get_button_selectors() ),
		),
	);

	return (array) apply_filters( 'dear_get_colors', $colors );
}
