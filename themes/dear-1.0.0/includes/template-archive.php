<?php
/**
 * Archive template modifications.
 *
 * @package    Dear\Functions\Template
 * @subpackage Genesis
 * @author     Robert Neu
 * @copyright  Copyright (c) 2015, Shay Bocks
 * @license    GPL-2.0+
 * @link       http://www.shaybocks.com/dear/
 * @since      1.0.0
 */

defined( 'ABSPATH' ) || exit;

add_action( 'genesis_before_loop',  'dear_blog_page_maybe_add_grid',     99 );
add_action( 'genesis_after_loop',   'dear_blog_page_maybe_remove_grid',   5 );
add_action( 'genesis_before_entry', 'dear_archive_maybe_add_grid',       10 );
add_action( 'genesis_before_entry', 'dear_archive_maybe_remove_title',   10 );
add_action( 'genesis_before_entry', 'dear_archive_maybe_remove_info',    10 );
add_action( 'genesis_before_entry', 'dear_archive_maybe_remove_content', 10 );
add_action( 'genesis_before_entry', 'dear_archive_maybe_remove_meta',    10 );
add_action( 'genesis_before_entry', 'dear_archive_maybe_move_image',     10 );

/**
 * Add the archive grid filter to the main loop.
 *
 * @since  1.0.0
 * @uses   genesis_is_blog_template()
 * @uses   dear_grid_exists()
 * @return bool true if the filter has been added, false otherwise.
 */
function dear_blog_page_maybe_add_grid() {
	if ( ! genesis_is_blog_template() ) {
		return false;
	}

	if ( $grid = dear_grid_exists( get_theme_mod( 'archive_grid', 'full' ) ) ) {
		return add_filter( 'post_class', "dear_grid_{$grid}" );
	}

	return false;
}

/**
 * Remove the archive grid filter to ensure other loops are unaffected.
 *
 * @since  1.0.0
 * @uses   genesis_is_blog_template()
 * @uses   dear_grid_exists()
 * @return bool true if the filter has been removed, false otherwise.
 */
function dear_blog_page_maybe_remove_grid() {
	if ( ! genesis_is_blog_template() ) {
		return false;
	}

	if ( $grid = dear_grid_exists( get_theme_mod( 'archive_grid', 'full' ) ) ) {
		return remove_filter( 'post_class', "dear_grid_{$grid}" );
	}

	return false;
}

/**
 * Add the archive grid filter to the main loop.
 *
 * @since  1.0.0
 * @uses   dear_is_blog_archive()
 * @uses   dear_grid_exists()
 * @return bool true if the filter has been added, false otherwise.
 */
function dear_archive_maybe_add_grid() {
	if ( ! dear_is_blog_archive() ) {
		return false;
	}

	if ( $grid = dear_grid_exists( get_theme_mod( 'archive_grid', 'full' ) ) ) {
		return add_filter( 'post_class', "dear_grid_{$grid}_main" );
	}

	return false;
}

/**
 * Remove the entry title if the user has disabled it via the customizer.
 *
 * @since  1.0.0
 * @uses   dear_is_blog_archive()
 * @return void
 */
function dear_archive_maybe_remove_title() {
	if ( dear_is_blog_archive() && ! get_theme_mod( 'archive_show_title', true ) ) {
		remove_action( 'genesis_entry_header', 'genesis_do_post_title' );
	}
}

/**
 * Remove the entry info if the user has disabled it via the customizer.
 *
 * @since  1.0.0
 * @uses   dear_is_blog_archive()
 * @return void
 */
function dear_archive_maybe_remove_info() {
	if ( dear_is_blog_archive() && ! get_theme_mod( 'archive_show_info', true ) ) {
		remove_action( 'genesis_entry_header', 'genesis_post_info', 12 );
	}
}

/**
 * Remove the entry content if the user has disabled it via the customizer.
 *
 * @since  1.0.0
 * @uses   dear_is_blog_archive()
 * @return void
 */
function dear_archive_maybe_remove_content() {
	if ( dear_is_blog_archive() && ! get_theme_mod( 'archive_show_content', true ) ) {
		remove_action( 'genesis_entry_content', 'genesis_do_post_content' );
	}
}

/**
 * Remove the entry meta if the user has disabled it via the customizer.
 *
 * @since  1.0.0
 * @uses   dear_is_blog_archive()
 * @return void
 */
function dear_archive_maybe_remove_meta() {
	if ( dear_is_blog_archive() && ! get_theme_mod( 'archive_show_meta', true ) ) {
		remove_action( 'genesis_entry_footer', 'genesis_post_meta' );
	}
}

/**
 * Move the post image if the user has changed the placement via the customizer.
 *
 * @since  1.0.0
 * @uses   dear_is_blog_archive()
 * @return void
 */
function dear_archive_maybe_move_image() {
	if ( ! dear_is_blog_archive() ) {
		return;
	}
	$placement = get_theme_mod( 'archive_image_placement', 'after_title' );
	if ( 'after_title' !== $placement ) {
		remove_action( 'genesis_entry_content', 'genesis_do_post_image', 8 );
	}
	if ( 'before_title' === $placement ) {
		add_action( 'genesis_entry_header', 'genesis_do_post_image', 5 );
	}
	if ( 'after_content' === $placement ) {
		add_action( 'genesis_entry_footer', 'genesis_do_post_image', 0 );
	}
}
