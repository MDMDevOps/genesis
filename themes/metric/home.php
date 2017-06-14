<?php 

add_action( 'genesis_meta', 'metric_home_genesis_meta' );
/**
 * Add widget support for homepage. If no widgets active, display the default loop.
 *
 */
function metric_home_genesis_meta() {

	if ( is_active_sidebar( 'home-top-left' ) || is_active_sidebar( 'home-top-right' ) || is_active_sidebar( 'home-bottom' ) || is_active_sidebar( 'home-middle-1' ) || is_active_sidebar( 'home-middle-2' ) || is_active_sidebar( 'home-middle-3' ) ) {
	
		remove_action( 'genesis_loop', 'genesis_do_loop' );
		add_action( 'genesis_loop', 'metric_home_loop_helper' );
		add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );
		remove_action( 'genesis_before_loop', 'genesis_do_breadcrumbs' );
		add_filter( 'body_class', 'add_body_class' );

	}
	
}

function metric_home_loop_helper() {

	if ( is_active_sidebar( 'home-top-left' ) || is_active_sidebar( 'home-top-right' ) ) {

		echo '<div id="home-top-bg"><div id="home-top">';

		genesis_widget_area( 'home-top-left', array(
			'before' => '<div class="home-top-left">',
		) );	
		
		genesis_widget_area( 'home-top-right', array(
			'before' => '<div class="home-top-right">',
		) );
		
		echo '</div><!-- end #home-top --></div><!-- end #home-top-bg -->';
	
	}
	
	if ( is_active_sidebar( 'home-middle-1' ) || is_active_sidebar( 'home-middle-2' ) || is_active_sidebar( 'home-middle-3' ) ) {
	
		echo '<div id="home-middle-bg"><div id="home-middle">';

		genesis_widget_area( 'home-middle-1', array(
			'before' => '<div class="home-middle-1">',
		) );

		genesis_widget_area( 'home-middle-2', array(
			'before' => '<div class="home-middle-2">',
		) );
		
		genesis_widget_area( 'home-middle-3', array(
			'before' => '<div class="home-middle-3">',
		) );
		
		echo '</div><!-- end #home-middle --></div><!-- end #home-middle-bg -->';
		
	}

}

function add_body_class( $classes ) {

	$classes[] = 'metric';
	return $classes;
	
}

genesis();
