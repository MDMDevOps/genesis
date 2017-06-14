<?php
//* Start the engine
include_once( get_template_directory() . '/lib/init.php' );

//* Create additional color style options
add_theme_support( 'genesis-style-selector', array( 'scribble-blue' => 'Blue', 'scribble-green' => 'Green', 'scribble-lavender' => 'Lavender', 'scribble-pink' => 'Pink', 'scribble-red' => 'Red', 'scribble-teal' => 'Teal' ) );

//* Child theme (do not remove)
define( 'CHILD_THEME_NAME', 'Scribble Theme' );
define( 'CHILD_THEME_URL', 'http://my.studiopress.com/themes/scribble' );
define( 'CHILD_THEME_VERSION', '1.0.2' );

//* Enqueue Scripts
add_action( 'wp_enqueue_scripts', 'mp_enqueue_scripts' );
function mp_enqueue_scripts() {
	wp_enqueue_script( 'scrollTo', get_stylesheet_directory_uri() . '/js/jquery.scrollTo.min.js', array( 'jquery' ), '1.4.5-beta', true );
	wp_enqueue_script( 'localScroll', get_stylesheet_directory_uri() . '/js/jquery.localScroll.min.js', array( 'scrollTo' ), '1.2.8b', true );
	wp_enqueue_script( 'scroll', get_stylesheet_directory_uri() . '/js/scroll.js', array( 'localScroll' ), '', true );
}

$content_width = apply_filters( 'content_width', 580, 0, 910 );

//* Add new image sizes
add_image_size( 'home-blog', 280, 120, TRUE );
add_image_size( 'home-photos', 120, 120, TRUE );

//* Unregister 3-column site layouts
genesis_unregister_layout( 'content-sidebar-sidebar' );
genesis_unregister_layout( 'sidebar-sidebar-content' );
genesis_unregister_layout( 'sidebar-content-sidebar' );

//* Add support for custom background
add_theme_support( 'custom-background', array(
	'default-image' => get_stylesheet_directory_uri() . '/images/bg.png',
	'default-color' => 'eee',
) );

//* Add support for custom header
add_theme_support( 'custom-header', array( 
	'default-text-color'     => 'ffffff',
	'header-selector' 		=> '#header .wrap',
	'height'				=> 100,
	'width'					=> 960,	
) );

//* Add custom body class for header-text
add_filter( 'body_class', 'scribble_header_text_body_class' );
function scribble_header_text_body_class( $classes ) {

	if ( display_header_text() && get_header_image() ) 
		$classes[] = 'header-image-text';
	
	return $classes;

}

//* Add support for 3-column footer widgets
add_theme_support( 'genesis-footer-widgets', 3 );

//* Register widget areas
genesis_register_sidebar( array(
	'id'			=> 'welcome',
	'name'			=> __( 'Welcome', 'scribble' ),
	'description'	=> __( 'This is the welcome section.', 'scribble' ),
) );
genesis_register_sidebar( array(
	'id'			=> 'about',
	'name'			=> __( 'About', 'scribble' ),
	'description'	=> __( 'This is the about section.', 'scribble' ),
) );
genesis_register_sidebar( array(
	'id'			=> 'blog',
	'name'			=> __( 'Blog', 'scribble' ),
	'description'	=> __( 'This is the blog section.', 'scribble' ),
) );
genesis_register_sidebar( array(
	'id'			=> 'photos',
	'name'			=> __( 'Photos', 'scribble' ),
	'description'	=> __( 'This is the photos section.', 'scribble' ),
) );
genesis_register_sidebar( array(
	'id'			=> 'services',
	'name'			=> __( 'Services', 'scribble' ),
	'description'	=> __( 'This is the services section.', 'scribble' ),
) );
genesis_register_sidebar( array(
	'id'			=> 'contact',
	'name'			=> __( 'Contact', 'scribble' ),
	'description'	=> __( 'This is the contact section.', 'scribble' ),
) );