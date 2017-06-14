<?php
/** Start the engine */
include_once( get_template_directory() . '/lib/init.php' );

/** Child theme (do not remove) */
define( 'CHILD_THEME_NAME', __( 'Pretty Young Thing Theme', 'pretty' ) );
define( 'CHILD_THEME_URL', 'http://my.studiopress.com/themes/pretty' );

$content_width = apply_filters( 'content_width', 640, 470, 920 );

/** Add support for custom background */
add_theme_support( 'custom-background' );

/** Add support for custom color options */
add_theme_support( 'genesis-style-selector', array( 
	'pretty-pink' 	=> __( 'Pretty Pink', 'pretty' ), 
	'pretty-yellow' => __( 'Pretty Yellow', 'pretty' ) 
) );

/** Add new image sizes */
add_image_size( 'feature', 640, 300, TRUE );
add_image_size( 'grid-thumbnail', 100, 100, TRUE );


/** Add support for custom header */
add_theme_support( 'genesis-custom-header', array( 
	'width'		=> 960, 
	'height'	=> 240 
) );

// Remove the header right widget area
unregister_sidebar( 'header-right' );

/** Reposition the Primary Navigation */
remove_action( 'genesis_after_header', 'genesis_do_nav' );
add_action( 'genesis_before_header', 'genesis_do_nav' );

/** Customize the post info function */
add_filter( 'genesis_post_info', 'pretty_post_info_filter' );
function pretty_post_info_filter( $post_info ) {
	if ( ! is_page() ) {
		$post_info = '[post_date] [post_comments] [post_edit]';
		return $post_info;
	}
}

/** Add after post ad widget area on single post */
add_action( 'genesis_after_post_content', 'pretty_after_post_ad' );
function pretty_after_post_ad() {
	if ( is_single() ) {
		echo '<div class="after-post">';
		dynamic_sidebar( 'after-post-ad' );
		echo '</div>';
	}
}

/** Add support for 3-column footer widgets */
add_theme_support( 'genesis-footer-widgets', 3 );

/** Modify back to top text */
add_filter( 'genesis_footer_backtotop_text', 'pretty_backtotop_text' );
function pretty_backtotop_text($backtotop) {
    $backtotop = '[footer_backtotop text=""]';
    return $backtotop;
}

/** Customize the footer top section */
add_action( 'genesis_after_footer', 'pretty_footer_top' ); 
function pretty_footer_top() {
	?>
	<div class="footer-top">
		<p><a href="#wrap"><?php _e( 'To the Top', 'pretty' ); ?></a></p>
	</div>
	<?php
}

/** Register widget areas */
genesis_register_sidebar( array(
	'id'				=> 'after-post-ad',
	'name'			=> __( 'After Post Ad', 'pretty' ),
	'description'	=> __( 'This is the section after a post for an ad.', 'pretty' ),
) );