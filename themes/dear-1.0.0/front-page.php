<?php
/**
 * Home Page Template
 *
 * @package    Dear\Templates
 * @subpackage Genesis
 * @author     Robert Neu
 * @copyright  Copyright (c) 2015, Shay Bocks
 * @license    GPL-2.0+
 * @link       http://www.shaybocks.com/dear/
 * @since      1.0.0
 */

add_action( 'genesis_before_loop', 'dear_maybe_add_home_loop' );
add_action( 'genesis_before_content_sidebar_wrap', 'dear_home_top' );

/**
 * Add widget support for home page.
 * If no widgets active, display the default loop.
 *
 * @since  1.0.0
 * @access public
 * @return void
 */
function dear_maybe_add_home_loop() {
	if ( is_active_sidebar( 'home-middle' ) || is_active_sidebar( 'home-bottom' ) ) {
		remove_action( 'genesis_loop', 'genesis_do_loop' );
		add_action( 'genesis_loop', 'dear_home_loop' );
	}
}

/**
 * Display the Home Top widgeted section.
 *
 * @since  1.0.0
 * @access public
 * @return void
 */
function dear_home_top() {
	genesis_widget_area( 'home-top', array(
		'before' => '<div class="home-top">',
		'after'  => '</div> <!-- end .home-top -->',
	) );
}

/**
 * Display the Home Middle & Home Bottom widgeted sections.
 *
 * @since  1.0.0
 * @access public
 * @return void
 */
function dear_home_loop() {
	genesis_widget_area( 'home-middle', array(
		'before' => '<div class="widget-area home-middle">',
		'after'  => '</div> <!-- end .home-middle -->',
	) );
	genesis_widget_area( 'home-bottom', array(
		'before' => '<div class="widget-area home-bottom">',
		'after'  => '</div> <!-- end .home-bottom -->',
	) );
}

genesis();
