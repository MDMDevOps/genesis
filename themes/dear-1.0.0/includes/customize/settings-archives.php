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

add_action( 'customize_register', 'dear_register_customizer_archives' );
/**
 * Register custom sections for the Dear theme.
 *
 * @since  1.0.0
 * @access public
 * @param  object $wp_customize the customizer object.
 * @return void
 */
function dear_register_customizer_archives( $wp_customize ) {
	$options = array();
	$section = 'genesis_archives';

	$options['archive_grid'] = array(
		'id'       => 'archive_grid',
		'label'    => __( 'Archive Grid Display:', 'dear' ),
		'section'  => $section,
		'type'     => 'select',
		'default'  => 'full',
		'priority' => 0,
		'choices'  => array(
			'full'       => __( 'Full Width', 'dear' ),
			'one_half'   => __( 'One Half', 'dear' ),
			'one_third'  => __( 'One Third', 'dear' ),
			'one_fourth' => __( 'One Fourth', 'dear' ),
			'one_sixth'  => __( 'One Sixth', 'dear' ),
		),
	);

	$options['archive_show_title'] = array(
		'id'       => 'archive_show_title',
		'label'    => __( 'Display The Title?', 'dear' ),
		'section'  => $section,
		'type'     => 'checkbox',
		'default'  => 1,
		'priority' => 5,
	);

	$options['archive_show_info'] = array(
		'id'       => 'archive_show_info',
		'label'    => __( 'Display The Entry Info?', 'dear' ),
		'section'  => $section,
		'type'     => 'checkbox',
		'default'  => 1,
		'priority' => 6,
	);

	$options['archive_show_content'] = array(
		'id'       => 'archive_show_content',
		'label'    => __( 'Display The Content?', 'dear' ),
		'section'  => $section,
		'type'     => 'checkbox',
		'default'  => 1,
		'priority' => 7,
	);

	$options['archive_show_meta'] = array(
		'id'       => 'archive_show_meta',
		'label'    => __( 'Display The Entry Meta?', 'dear' ),
		'section'  => $section,
		'type'     => 'checkbox',
		'default'  => 1,
		'priority' => 8,
	);

	$options['archive_image_placement'] = array(
		'id'      => 'archive_image_placement',
		'label'   => __( 'Featured Image Placement:', 'dear' ),
		'section' => $section,
		'type'    => 'select',
		'default' => 'after_title',
		'priority' => 10,
		'choices' => array(
			'after_title'   => __( 'After Title', 'dear' ),
			'before_title'  => __( 'Before Title', 'dear' ),
			'after_content' => __( 'After Content', 'dear' ),
		),
	);

	Customizer_Library::Instance()->add_options( $options );
}
