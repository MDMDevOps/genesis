<?php
/** Start the engine */
include_once( get_template_directory() . '/lib/init.php' );

/** Child theme (do not remove) */
define( 'CHILD_THEME_NAME', 'Corporate Theme' );
define( 'CHILD_THEME_URL', 'http://my.studiopress.com/themes/corporate' );
define( 'CHILD_THEME_VERSION', '2.0' );

$content_width = apply_filters( 'content_width', 620, 450, 930 );

/** Add new image sizes */
add_image_size( 'featured', 500, 240, TRUE );
add_image_size( 'home-middle', 275, 100, TRUE );

/** Add suport for custom background */
add_custom_background();

/** Add support for custom header */
add_theme_support( 'genesis-custom-header', array( 
	'width'	=> 960, 
	'height'	=> 130 
) );

/** Change breadcrumb location */
remove_action( 'genesis_before_loop', 'genesis_do_breadcrumbs' );
add_action( 'genesis_after_header', 'genesis_do_breadcrumbs' );

/** Add support for 3-column footer widgets */
add_theme_support( 'genesis-footer-widgets', 3 );

/** Register widget areas */
genesis_register_sidebar( array(
	'id'			=> 'featured',
	'name'			=> __( 'Featured', 'corporate' ),
	'description'	=> __( 'This is the featured section.', 'corporate' ),
) );
genesis_register_sidebar( array(
	'id'			=> 'home-middle-1',
	'name'			=> __( 'Home Middle #1', 'corporate' ),
	'description'	=> __( 'This is the home middle #1 section.', 'corporate' ),
) );
genesis_register_sidebar( array(
	'id'			=> 'home-middle-2',
	'name'			=> __( 'Home Middle #2', 'corporate' ),
	'description'	=> __( 'This is the home middle #2 section.', 'corporate' ),
) );
genesis_register_sidebar( array(
	'id'			=> 'home-middle-3',
	'name'			=> __( 'Home Middle #3', 'corporate' ),
	'description'	=> __( 'This is the home middle #3 section.', 'corporate' ),
) );