<?php

add_action('plugins_loaded', 'widget_sidebar_wp_related_posts');
function widget_sidebar_wp_related_posts() {
	function widget_wp_related_posts($args) {
	    extract($args);
		if(!is_single()) return;
		echo $before_widget;
		
		//echo $before_title . $wp_rp["wp_rp_title"] . $after_title;
		$output = wp_get_related_posts($before_title,$after_title);
		echo $output;
		echo $after_widget;
	}

	wp_register_sidebar_widget('wp_related_posts_widget', 'Related Posts', 'widget_wp_related_posts');
}
