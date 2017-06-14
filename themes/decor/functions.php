<?php
//* Start the engine
include_once( get_template_directory() . '/lib/init.php' );

//* Child theme (do not remove)
define( 'CHILD_THEME_NAME', 'Decor Theme' );
define( 'CHILD_THEME_URL', 'http://my.studiopress.com/themes/decor' );
define( 'CHILD_THEME_VERSION', '1.0.1' );

//* Create additional color style options
add_theme_support( 'genesis-style-selector', array( 'decor-amethyst' => 'Amethyst', 'decor-copper' => 'Copper', 'decor-silver' => 'Silver' ) );

//* Add viewport meta tag for mobile browsers
add_theme_support( 'genesis-responsive-viewport' );

//* Enqueue Great Vibes Google font
add_action( 'wp_enqueue_scripts', 'decor_google_fonts' );
function decor_google_fonts() {

	wp_enqueue_style( 'google-fonts', '//fonts.googleapis.com/css?family=Great+Vibes', array(), CHILD_THEME_VERSION );
	
}

//* Add new image sizes
add_image_size( 'post-image', 730, 285, TRUE );

//* Add support for custom background
add_theme_support( 'custom-background', array(
	'default-image' => get_stylesheet_directory_uri() . '/images/bg.gif',
	'default-color' => 'fff',
) );

//* Add support for custom header
add_theme_support( 'custom-header', array(
	'width'           => 400,
	'height'          => 130,
	'header-selector' => '#title-area a',
	'header-text'     => false
) );

//* Add support for 3-column footer widgets
add_theme_support( 'genesis-footer-widgets', 3 );

//* Reposition the primary navigation menu
remove_action( 'genesis_after_header', 'genesis_do_nav' );
add_action( 'genesis_before', 'genesis_do_nav' );

//* Unregister secondary navigation menu
add_theme_support( 'genesis-menus', array( 'primary' => __( 'Primary Navigation Menu', 'genesis' ) ) );

//* Add post/page wraps
add_action( 'genesis_before_post_title', 'decor_start_post_wrap' );
add_action( 'genesis_after_post_content', 'decor_end_post_wrap' );

function decor_start_post_wrap() {
	?>
	<div class="wrap">
	<div class="left-corner"></div>
	<div class="right-corner"></div>
	<?php
}

function decor_end_post_wrap() {
	?>
	</div>
	<?php
}

//* Remove default post image
remove_action( 'genesis_post_content', 'genesis_do_post_image' );

//* Add post image above post title
add_action( 'genesis_before_post_title', 'decor_post_image' );
function decor_post_image() {

	if ( is_page() || ! genesis_get_option( 'content_archive_thumbnail' ) )
		return;

	if ( $image = genesis_get_image( array( 'format' => 'url', 'size' => genesis_get_option( 'image_size' ) ) ) ) {
		printf( '<a href="%s" rel="bookmark" class="post-photo"><span class="post-date">%s</span><img src="%s" alt="%s" /></a>', get_permalink(), do_shortcode( '<em>[post_date format="j"]</em>[post_date format="F Y"]' ), $image, the_title_attribute( 'echo=0' ) );
	}

}

//* Customize the post info function
add_filter( 'genesis_post_info', 'post_info_filter' );
function post_info_filter( $post_info ) {
	if ( !is_page() ) {
			$post_info = __( 'posted by', 'decor' ) . ' [post_author_posts_link] [post_comments] [post_edit]';
			return $post_info;
	}
}

//* Customize 'Read More' text
add_filter( 'the_content_more_link', 'decor_read_more_link' );
function decor_read_more_link() {
	return '<a class="more-link" href="' . get_permalink() . '" rel="nofollow">' . __( 'Continue reading' ) . '</a>';
}

//* Modify the content limit read more link
add_action( 'genesis_before_loop', 'decor_more' );
function decor_more() {

	add_filter( 'get_the_content_more_link', 'decor_read_more_link' );
	
}

add_action( 'genesis_after_loop', 'decor_remove_more' );
function decor_remove_more() {

	remove_filter( 'get_the_content_more_link', 'decor_read_more_link' );
	
}

//* Modify comment author says text
add_filter('comment_author_says_text', 'decor_comment_author_says_text');
function decor_comment_author_says_text() {
    return '';
}