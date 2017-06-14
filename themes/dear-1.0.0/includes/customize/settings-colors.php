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

add_action( 'customize_register', 'dear_remove_customizer_defaults' );
add_action( 'customize_register', 'dear_register_customizer_colors' );

/**
 * Remove unwanted default customizer sections for the Dear theme.
 *
 * @since  1.0.0
 * @access public
 * @param  object $wp_customize the customizer object.
 * @return void
 */
function dear_remove_customizer_defaults( $wp_customize ) {
	$wp_customize->remove_section( 'colors' );
}

/**
 * Register custom sections for the Dear theme.
 *
 * @since  1.0.0
 * @access public
 * @param  object $wp_customize the customizer object.
 * @return void
 */
function dear_register_customizer_colors( $wp_customize ) {
	if ( apply_filters( 'dear_disable_colors', false ) ) {
		return;
	}

	$options = array();
	$counter = 10;
	$panel = 'colors';

	$wp_customize->add_panel(
		$panel,
		array(
			'title'       => __( 'Colors', 'dear' ),
			'description' => __( 'You can customize your theme colors by changing any of the options within this panel.', 'dear' ),
			'capability'  => 'edit_theme_options',
			'priority'    => 70,
		)
	);

	$wp_customize->add_section(
		"{$panel}_general",
		array(
			'title'       => __( 'General', 'dear' ),
			'description' => __( 'Customize your general theme colors by changing the options below.', 'dear' ),
			'capability'  => 'edit_theme_options',
			'panel'       => $panel,
			'priority'    => 10,
		)
	);

	$wp_customize->add_section(
		"{$panel}_menus",
		array(
			'title'       => __( 'Menus', 'dear' ),
			'description' => __( 'Customize your menu colors by changing the options below.', 'dear' ),
			'capability'  => 'edit_theme_options',
			'panel'       => $panel,
			'priority'    => 12,
		)
	);

	$wp_customize->add_section(
		"{$panel}_buttons",
		array(
			'title'       => __( 'Buttons', 'dear' ),
			'description' => __( 'Customize your button colors by changing the options below.', 'dear' ),
			'capability'  => 'edit_theme_options',
			'panel'       => $panel,
			'priority'    => 14,
		)
	);

	foreach ( dear_get_colors() as $color => $setting ) {

		$options[ $color ] = array(
			'id'       => $color,
			'label'    => $setting['label'],
			'section'  => "{$panel}_{$setting['section']}",
			'type'     => 'color',
			'default'  => $setting['default'],
			'priority' => $counter++,
		);
	}

	Customizer_Library::Instance()->add_options( $options );
}
