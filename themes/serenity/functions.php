<?php
//* Start the engine
include_once( get_template_directory() . '/lib/init.php' );

//* Child theme (do not remove)
define( 'CHILD_THEME_NAME', __( 'Serenity Theme', 'serenity' ) );
define( 'CHILD_THEME_URL', 'http://my.studiopress.com/themes/serenity/' );
define( 'CHILD_THEME_VERSION', '1.0.3' );

//* Add new image sizes
add_image_size('Rectangular', 280, 125, TRUE);
add_image_size('Square', 90, 90, TRUE);
add_image_size('Slider', 900, 300, TRUE);

//* Add the slider on the homepage above the content area
add_action('genesis_after_header', 'serenity_include_slider'); 
function serenity_include_slider() {
    if(is_front_page())
    dynamic_sidebar( 'slider' );
}

//* Add support for custom header
add_theme_support( 'custom-header', array(
	'header_image'    => '',
	'header-selector' => '#title-area a',
	'header-text'     => false,
	'height'          => 80,
	'width'           => 435,
) );

//* Add two sidebars to the main sidebar area
add_action('genesis_after_sidebar_widget_area', 'serenity_include_bottom_sidebars'); 
function serenity_include_bottom_sidebars() {
    require(CHILD_DIR.'/sidebar-bottom.php');
}

//* Add Google AdSense after single post
add_action('genesis_after_post_content', 'serenity_include_adsense', 9); 
function serenity_include_adsense() {

	if ( is_singular( 'post' ) )
		genesis_widget_area( 'adsense', array(
			'before' => '<div class="adsense" class="widget-area">',
			'after'  => '</div>',
		) );

}

//* Add support for 3-column footer widgets
add_theme_support( 'genesis-footer-widgets', 3 );

//* Relocate Footer Widgets
remove_action( 'genesis_before_footer', 'genesis_footer_widget_areas' );
add_action( 'genesis_after_footer', 'genesis_footer_widget_areas' );

//* Force layout on homepage
add_filter('genesis_meta', 'serenity_home_layout');
function serenity_home_layout() {

	if ( is_home() )
		add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_content_sidebar' );
		
}  

//* Customize excerpt
add_filter('get_the_excerpt', 'trim_excerpt');
function trim_excerpt($text) {
    return str_replace(' [...]', '... <a href="' . get_permalink() . '"> [Continue Reading]</a>', $text);
};

//* Register widget areas
genesis_register_sidebar(array(
	'name'=>'Slider',
	'id' => 'slider',
	'description' => 'This is the slider section on the homepage',
	'before_title'=>'<h4 class="widgettitle">','after_title'=>'</h4>'
));
genesis_register_sidebar(array(
	'name'=>'Sidebar Bottom Left',
	'id' => 'sidebar-bottom-left',
	'description' => 'This is the bottom left column in the sidebar.',
	'before_title'=>'<h4 class="widgettitle">','after_title'=>'</h4>'
));
genesis_register_sidebar(array(
	'name'=>'Sidebar Bottom Right',
	'id' => 'sidebar-bottom-right',
	'description' => 'This is the bottom right column in the sidebar.',
	'before_title'=>'<h4 class="widgettitle">','after_title'=>'</h4>'
));
genesis_register_sidebar(array(
	'name'=>'Featured Top Left',
	'id' => 'featured-top-left',
	'description' => 'This is the featured top left column of the homepage.',
	'before_title'=>'<h4 class="widgettitle">','after_title'=>'</h4>'
));
genesis_register_sidebar(array(
	'name'=>'Featured Top Right',
	'id' => 'featured-top-right',
	'description' => 'This is the featured top right column of the homepage.',
	'before_title'=>'<h4 class="widgettitle">','after_title'=>'</h4>'
));
genesis_register_sidebar(array(
	'name'=>'Featured Bottom',
	'id' => 'featured-bottom',
	'description' => 'This is the featured bottom section of the homepage.',
	'before_title'=>'<h4 class="widgettitle">','after_title'=>'</h4>'
));
genesis_register_sidebar(array(
	'name'=>'Adsense',
	'id' => 'adsense',
	'description' => 'This is the Adsense ad section after posts.',
	'before_title'=>'<h4 class="widgettitle">','after_title'=>'</h4>'
));