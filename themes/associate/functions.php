<?php
/** Start the engine */
include_once( get_template_directory() . '/lib/init.php' );

/** Create additional color style options */
add_theme_support( 'genesis-style-selector', array( 'associate-gray' => 'Gray', 'associate-green' => 'Green', 'associate-red' => 'Red' ) );

/** Child theme (do not remove) */
define( 'CHILD_THEME_NAME', 'Associate Theme' );
define( 'CHILD_THEME_URL', 'http://my.studiopress.com/themes/associate' );

$content_width = apply_filters( 'content_width', 580, 0, 910 );

/** Unregister 3-column site layouts */
genesis_unregister_layout( 'content-sidebar-sidebar' );
genesis_unregister_layout( 'sidebar-sidebar-content' );
genesis_unregister_layout( 'sidebar-content-sidebar' );

/** Add new featured image sizes */
add_image_size( 'home-bottom', 150, 130, TRUE );
add_image_size( 'home-middle', 287, 120, TRUE );

/** Add suport for custom background */
add_theme_support( 'custom-background' );

/** Add support for custom header */
add_theme_support( 'custom-header', array(
	'default-image'    => '',
	'default-text-color'     => 'ffffff',
	'width'		=> 960, 
	'height'	=> 120 
) );

/** Add support for structural wraps */
add_theme_support( 'genesis-structural-wraps', array( 'header', 'nav', 'subnav', 'inner', 'footer-widgets', 'footer' ) );

/** Add support for 3-column footer widgets */
add_theme_support( 'genesis-footer-widgets', 3 );

/** Register widget areas */
genesis_register_sidebar( array(
	'id'			=> 'featured',
	'name'			=> __( 'Featured', 'associate' ),
	'description'	=> __( 'This is the featured section.', 'associate' ),
) );
genesis_register_sidebar( array(
	'id'			=> 'home-middle-1',
	'name'			=> __( 'Home Middle #1', 'associate' ),
	'description'	=> __( 'This is the first column of the home middle section.', 'associate' ),
) );
genesis_register_sidebar( array(
	'id'			=> 'home-middle-2',
	'name'			=> __( 'Home Middle #2', 'associate' ),
	'description'	=> __( 'This is the second column of the home middle section.', 'associate' ),
) );
genesis_register_sidebar( array(
	'id'			=> 'home-middle-3',
	'name'			=> __( 'Home Middle #3', 'associate' ),
	'description'	=> __( 'This is the third column of the home middle section.', 'associate' ),
) );
genesis_register_sidebar( array(
	'id'			=> 'home-bottom-1',
	'name'			=> __( 'Home Bottom #1', 'associate' ),
	'description'	=> __( 'This is the first column of the home bottom section.', 'associate' ),
) );
genesis_register_sidebar( array(
	'id'			=> 'home-bottom-2',
	'name'			=> __( 'Home Bottom #2', 'associate' ),
	'description'	=> __( 'This is the second column of the home bottom section.', 'associate' ),
) );