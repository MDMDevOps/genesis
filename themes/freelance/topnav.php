<div id="topnav">
	<div class="topnav-left">
		<p><?php echo date_i18n( get_option( 'date_format' ) ); ?></p>
	</div><!-- end .topnav-left -->
	<div class="topnav-right">
		<p>
			<a class="rss-topnav" href="<?php bloginfo('rss_url'); ?>" rel="nofollow"><?php _e("Posts", 'genesis'); ?></a>
			<a class="rss-topnav" href="<?php bloginfo('comments_rss2_url'); ?>" rel="nofollow"><?php _e("Comments", 'genesis'); ?></a>
		</p>
	</div><!-- end .topnav-right -->
</div><!-- end #topnav -->