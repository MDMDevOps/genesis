<?php
/**
 * Admin functions.
 *
 * @package    Dear\Admin\Functions
 * @subpackage Genesis
 * @author     Robert Neu
 * @copyright  Copyright (c) 2015, Shay Bocks
 * @license    GPL-2.0+
 * @link       http://www.shaybocks.com/dear/
 * @since      1.0.0
 */

defined( 'ABSPATH' ) || exit;

add_action( 'tgmpa_register',        'dear_register_required_plugins' );
add_action( 'admin_head-post.php',   'dear_remove_widgeted_editor' );
add_action( 'admin_enqueue_scripts', 'dear_load_admin_styles' );

/**
 * Register the required plugins for this theme.
 *
 * This function is hooked into tgmpa_init, which is fired within the
 * TGM_Plugin_Activation class constructor.
 *
 * @since  1.0.0
 * @access public
 * @uses   tgmpa()
 * @return void
 */
function dear_register_required_plugins() {
	$plugins = array(
		array(
			'name'      => 'Genesis eNews Extended',
			'slug'      => 'genesis-enews-extended',
			'required'  => false,
		),
		array(
			'name'      => 'Simple Social Icons',
			'slug'      => 'simple-social-icons',
			'required'  => false,
		),
		array(
			'name'      => 'Simmer',
			'slug'      => 'simmer',
			'required'  => false,
		),
		array(
			'name'      => 'Q2W3 Fixed Widget',
			'slug'      => 'q2w3-fixed-widget',
			'required'  => false,
		),
		array(
			'name'      => 'WP Featherlight',
			'slug'      => 'wp-featherlight',
			'required'  => false,
		),
	);
	$config = array(
		'id'           => 'dear',
		'default_path' => '',
		'menu'         => 'tgmpa-install-plugins',
		'has_notices'  => true,
		'dismissable'  => true,
		'dismiss_msg'  => '',
		'is_automatic' => true,
		'message'      => '',
		'strings'      => array(
			'page_title'                      => __( 'Install Required Plugins', 'dear' ),
			'menu_title'                      => __( 'Install Plugins', 'dear' ),
			'installing'                      => __( 'Installing Plugin: %s', 'dear' ), // %s = plugin name.
			'oops'                            => __( 'Something went wrong with the plugin API.', 'dear' ),
			'notice_can_install_required'     => _n_noop( 'Dear requires the following plugin: %1$s.', 'Dear requires the following plugins: %1$s.', 'dear' ), // %1$s = plugin name(s).
			'notice_can_install_recommended'  => _n_noop( 'Dear recommends the following plugin: %1$s.', 'Dear recommends the following plugins: %1$s.', 'dear' ), // %1$s = plugin name(s).
			'notice_cannot_install'           => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.', 'dear' ), // %1$s = plugin name(s).
			'notice_can_activate_required'    => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.', 'dear' ), // %1$s = plugin name(s).
			'notice_can_activate_recommended' => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.', 'dear' ), // %1$s = plugin name(s).
			'notice_cannot_activate'          => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.', 'dear' ), // %1$s = plugin name(s).
			'notice_ask_to_update'            => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.', 'dear' ), // %1$s = plugin name(s).
			'notice_cannot_update'            => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.', 'dear' ), // %1$s = plugin name(s).
			'install_link'                    => _n_noop( 'Install Plugin Now', 'Install Plugins Now', 'dear' ),
			'activate_link'                   => _n_noop( 'Activate Plugin Now', 'Activate Plugins now', 'dear' ),
			'return'                          => __( 'Return to Required Plugins Installer', 'dear' ),
			'plugin_activated'                => __( 'Plugin activated successfully.', 'dear' ),
			'complete'                        => __( 'All plugins installed and activated successfully. %s', 'dear' ), // %s = dashboard link.
			'nag_type'                        => 'updated', // Determines admin notice type - can only be 'updated', 'update-nag' or 'error'.
		),
	);

	tgmpa( $plugins, $config );
}

/**
 * Enqueue Genesis admin styles.
 *
 * @since  1.0.0
 * @access public
 * @uses   CHILD_THEME_VERSION
 * @return void
 */
function dear_load_admin_styles() {
	wp_enqueue_style(
		'dear-admin',
		dear_get_css_uri( 'admin.css' ),
		array(),
		CHILD_THEME_VERSION
	);
}

/**
 * Perform a check to see whether or not a widgeted page template is being used.
 *
 * @since  1.0.0
 * @access public
 * @param  array $templates a list of widgeted templates to check for.
 * @return bool
 */
function dear_using_widgeted_template( $templates = array() ) {
	if ( ! isset( $_REQUEST['post'] ) ) {
		return false;
	}

	if ( empty( $templates ) ) {
		$templates[] = 'templates/page-recipes.php';
	}

	foreach ( (array) $templates as $template ) {
		if ( get_page_template_slug( absint( $_REQUEST['post'] ) ) === $template ) {
			return true;
		}
	}

	return false;
}

/**
 * Check to make sure a widgeted page template is is selected and then disable
 * the default WordPress editor.
 *
 * @since  1.0.0
 * @access public
 * @return void
 */
function dear_remove_widgeted_editor() {
	if ( dear_using_widgeted_template() ) {
		remove_post_type_support( 'page', 'editor' );
		add_action( 'admin_notices', 'dear_widgeted_admin_notice' );
	}
}

/**
 * Check to make sure a widgeted page template is is selected and then show a
 * notice about the editor being disabled.
 *
 * @since  1.0.0
 */
function dear_widgeted_admin_notice() {
	printf( '<div class="updated"><p>%s</p></div>',
		sprintf(
			__( 'The normal editor is disabled because you&#39;re using a widgeted page template. You need to <a href="%s">use widgets</a> to edit this page.', 'dear' ),
			esc_url( admin_url( '/widgets.php' ) )
		)
	);
}
