<?php
/**
 * Template Name: Recipe Index
 *
 * @package    Dear\Templates
 * @subpackage Genesis
 * @author     Robert Neu
 * @copyright  Copyright (c) 2015, Shay Bocks
 * @license    GPL-2.0+
 * @link       http://www.shaybocks.com/dear/
 * @since      1.0.0
 */

add_action( 'genesis_before_loop', 'dear_maybe_add_recipe_index' );
/**
 * Add widget support for recipes page.
 *
 * If no widgets active, display the default page content.
 *
 * @since  1.0.0
 * @access public
 * @return void
 */
function dear_maybe_add_recipe_index() {
	if ( is_active_sidebar( 'recipe-index' ) ) {
		remove_action( 'genesis_loop', 'genesis_do_loop' );
		add_action( 'genesis_loop', 'dear_recipe_index_loop' );
	}
}

/**
 * Display the recipe index sidebar.
 *
 * @since  1.0.0
 * @access public
 * @return void
 */
function dear_recipe_index_loop() {
	genesis_widget_area( 'recipe-index', array(
		'before' => '<div class="widget-area recipe-index">',
		'after'  => '</div> <!-- end .recipe-index -->',
	) );
}

genesis();
