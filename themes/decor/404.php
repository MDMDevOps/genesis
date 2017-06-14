<?php
/**
 * Custom 404 Template for the Decor Theme.
 */

//* Remove default loop
remove_action( 'genesis_loop', 'genesis_do_loop' );

//* Output 404 message with wrap
add_action( 'genesis_loop', 'decor_404' );
function decor_404() {

	echo '<div class="post entry hentry">';
	
		echo '<div class="wrap"><div class="left-corner"></div><div class="right-corner"></div>';

			printf( '<h1 class="entry-title">%s</h1>', __( 'Not found, error 404', 'genesis' ) );
			echo '<div class="entry-content">';
			
	?>

				<p><?php printf( __( 'The page you are looking for no longer exists. Perhaps you can return back to the site\'s <a href="%s">homepage</a> and see if you can find what you are looking for. Or, you can try finding it with the information below.', 'genesis' ), home_url() ); ?></p>

				<h4><?php _e( 'Pages:', 'genesis' ); ?></h4>
				<ul>
					<?php wp_list_pages( 'title_li=' ); ?>
				</ul>

				<h4><?php _e( 'Categories:', 'genesis' ); ?></h4>
				<ul>
					<?php wp_list_categories( 'sort_column=name&title_li=' ); ?>
				</ul>

				<h4><?php _e( 'Authors:', 'genesis' ); ?></h4>
				<ul>
					<?php wp_list_authors( 'exclude_admin=0&optioncount=1' ); ?>
				</ul>

				<h4><?php _e( 'Monthly:', 'genesis' ); ?></h4>
				<ul>
					<?php wp_get_archives( 'type=monthly' ); ?>
				</ul>

				<h4><?php _e( 'Recent Posts:', 'genesis' ); ?></h4>
				<ul>
					<?php wp_get_archives( 'type=postbypost&limit=100' ); ?>
				</ul>

<?php
				echo '</div>';
				
			echo '</div>';

		echo '</div>';

}

genesis();
