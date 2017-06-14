<?php
//* Start the engine
include_once( get_template_directory() . '/lib/init.php' );

//* Set Localization (do not remove)
load_child_theme_textdomain( 'metric', apply_filters( 'child_theme_textdomain', get_stylesheet_directory() . '/languages', 'metric' ) );

//* Add new image sizes
add_image_size( 'Slideshow', 500, 260, TRUE );
add_image_size( 'Mini', 90, 90, TRUE );

//* Add support for custom header
add_theme_support( 'custom-header', array( 
	'width' => 340, 
	'height' => 120,
	'header-selector'	=> '#header #title-area',
	'header-text'		=> false,
) );

//* Customizes go to top text
add_filter( 'genesis_footer_backtotop_text', 'footer_backtotop_filter' );
function footer_backtotop_filter( $backtotop ) {

    $backtotop = '[footer_backtotop text="' . __( 'Top of Page', 'metric' ) . '"]';
    return $backtotop;
    
}

//* Add support for 4 footer widgets
add_theme_support( 'genesis-footer-widgets', 4 );

//* Register widget areas
genesis_register_sidebar( array(
	'id'          => 'home-top-left',
	'name'        => __( 'Home Top Left', 'metric' ),
	'description' => __( 'This is the top left section of the homepage.', 'metric' ),
) );
genesis_register_sidebar( array(
	'id'          => 'home-top-right',
	'name'        => __( 'Home Top Right', 'metric' ),
	'description' => __( 'This is the top right section of the homepage.', 'metric' ),
) );
genesis_register_sidebar( array(
	'id'          => 'home-middle-1',
	'name'        => __( 'Home Middle #1', 'metric' ),
	'description' => __( 'This is the first column of the middle section of the homepage.', 'metric' ),
) );
genesis_register_sidebar( array(
	'id'          => 'home-middle-2',
	'name'        => __( 'Home Middle #2', 'metric' ),
	'description' => __( 'This is the second column of the middle section of the homepage.', 'metric' ),
) );
genesis_register_sidebar( array(
	'id'          => 'home-middle-3',
	'name'        => __( 'Home Middle #3', 'metric' ),
	'description' => __( 'This is the third column of the middle section of the homepage.', 'metric' ),
) );
