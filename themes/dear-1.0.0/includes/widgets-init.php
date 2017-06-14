<?php
/**
 * Load theme widgets.
 *
 * @package    Dear\Functions\Widgets
 * @subpackage Genesis
 * @author     Robert Neu
 * @copyright  Copyright (c) 2015, Shay Bocks
 * @license    GPL-2.0+
 * @link       http://www.shaybocks.com/dear/
 * @since      1.0.0
 */

defined( 'ABSPATH' ) || exit;

add_action( 'widgets_init', 'dear_register_sidebars', 5 );
add_action( 'widgets_init', 'dear_register_widgets', 10 );

/**
 * Register all custom sidebars.
 *
 * @since  1.0.0
 * @access public
 * @return void
 */
function dear_register_sidebars() {
	genesis_register_sidebar( array(
		'id'          => 'before-header',
		'name'        => __( 'Before Header', 'dear' ),
		'description' => __( 'This is the section before the header.', 'dear' ),
	) );
	genesis_register_sidebar( array(
		'id'          => 'home-top',
		'name'        => __( 'Home Top', 'dear' ),
		'description' => __( 'This is the home top section.', 'dear' ),
	) );
	genesis_register_sidebar( array(
		'id'          => 'home-middle',
		'name'        => __( 'Home Middle', 'dear' ),
		'description' => __( 'This is the home middle section.', 'dear' ),
	) );
	genesis_register_sidebar( array(
		'id'          => 'home-bottom',
		'name'        => __( 'Home Bottom', 'dear' ),
		'description' => __( 'This is the home bottom section.', 'dear' ),
	) );
	genesis_register_sidebar( array(
		'id'          => 'recipe-index',
		'name'        => __( 'Recipe Index', 'dear' ),
		'description' => __( 'This is the recipe index section.', 'dear' ),
	) );
}

/**
 * Unregister the default Genesis Featured Posts widget and register all of
 * our custom Dear widgets.
 *
 * @since  1.0.0
 * @access public
 * @return void
 */
function dear_register_widgets() {
	if ( ! class_exists( 'Dear_Featured_Posts', false ) ) {
		dear_require_once( 'widgets/class-dear-featured-posts.php' );
	}

	unregister_widget( 'Genesis_Featured_Post' );
	register_widget( 'Dear_Featured_Posts' );
}
