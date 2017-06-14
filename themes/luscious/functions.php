<?php
/** Start the engine */
include_once( get_template_directory() . '/lib/init.php' );

/** Child theme (do not remove) */
define( 'CHILD_THEME_NAME', 'Luscious Child Theme' );
define( 'CHILD_THEME_URL', 'http://my.studiopress.com/themes/luscious' );

/** Add new image sizes */
add_image_size( 'post-photo', 660, 250, true );

/** Add support for custom background */
add_theme_support( 'custom-background' );

/** Add support for custom header */
add_theme_support( 'genesis-custom-header', array( 
	'width'	=> 960, 
	'height'	=> 100 
) );

/** Reposition the secondary navigation */
remove_action( 'genesis_after_header', 'genesis_do_subnav' );
add_action( 'genesis_before_header', 'genesis_do_subnav' );

/** Remove default post image */
remove_action( 'genesis_post_content', 'genesis_do_post_image' );

/** Add custom post image above post title */
add_action( 'genesis_before_post_title', 'luscious_post_image', 8 );
function luscious_post_image() {

	if ( is_page() || ! genesis_get_option( 'content_archive_thumbnail' ) )
		return;
	
	if ( $image = genesis_get_image( array( 'format' => 'url', 'size' => genesis_get_option( 'image_size' ) ) ) ) {
		printf( '<a href="%s" rel="bookmark"><img class="post-photo" src="%s" alt="%s" /></a>', get_permalink(), $image, the_title_attribute( 'echo=0' ) );
	}

}

/** Add date block before post title */
add_action( 'genesis_before_post_title', 'custom_post_date' );
function custom_post_date() {

	if ( ! is_page() ) {
		echo '<div class="post-date">';
		echo do_shortcode( '[post_date format="M j, Y"]' );
		echo '</div><!-- end .post-date -->';
	}

}

/** Customize the post info function */
add_filter( 'genesis_post_info', 'post_info_filter' );
function post_info_filter( $post_info ) {

	if ( ! is_page() ) {
	    return 'By [post_author_posts_link] &middot; [post_comments] [post_edit]';
	}

	return $post_info;

}

/** Customize the post meta function */
add_filter('genesis_post_meta', 'post_meta_filter');
function post_meta_filter($post_meta) {

	if ( ! is_page() ) {
	    return '[post_categories before="Filed Under: "] &middot; [post_tags before="Tagged: "]';
	}

	return $post_meta;

}

/** Add support for 4-column footer widgets */
add_theme_support( 'genesis-footer-widgets', 4 );