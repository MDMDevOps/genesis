<?php
/**
 * General template helper functions.
 *
 * @package    Dear\Functions\Helpers
 * @subpackage Genesis
 * @author     Robert Neu
 * @copyright  Copyright (c) 2015, Shay Bocks
 * @license    GPL-2.0+
 * @link       http://www.shaybocks.com/dear/
 * @since      1.0.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * Determine if we're viewing a "plural" page.
 *
 * Note that this is similar to, but not quite the same as `!is_singular()`,
 * which wouldn't account for the 404 page.
 *
 * @since  1.0.0
 * @access public
 * @return bool
 */
function dear_is_plural() {
	return is_home() || is_archive() || is_search() || genesis_is_blog_template();
}

/**
 * Determine if we're within a blog section archive.
 *
 * @since  1.0.0
 * @access public
 * @return bool true if we're on a blog archive page.
 */
function dear_is_blog_archive() {
	return dear_is_plural() && ! ( is_post_type_archive() || is_tax() );
}

/**
 * Helper function to determine if we're on a blog section of a Genesis site.
 *
 * @since  1.0.0
 * @access public
 * @return bool True if we're on any section of the blog.
 */
function dear_is_blog() {
	return dear_is_blog_archive() || is_singular( 'post' );
}
