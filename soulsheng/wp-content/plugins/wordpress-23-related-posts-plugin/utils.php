<?php

/* WP backwards compatibility */
if( !function_exists('strip_shortcodes') ) {
	// strip_shortcodes introduced in 2.5
	function strip_shortcodes( $content ){
		return $content;
	}
}

if( !function_exists('path_is_absolute') ) {
	function path_is_absolute( $path ) {
		// this is definitive if true but fails if $path does not exist or contains a symbolic link
		if ( realpath($path) == $path )
			return true;

		if ( strlen($path) == 0 || $path[0] == '.' )
			return false;

		// windows allows absolute paths like this
		if ( preg_match('#^[a-zA-Z]:\\\\#', $path) )
			return true;

		// a path starting with / or \ is absolute; anything else is relative
		return ( $path[0] == '/' || $path[0] == '\\' );
	}
}

if( !function_exists('path_join') ) {
	function path_join( $base, $path ) {
		if ( path_is_absolute($path) )
			return $path;
		return rtrim($base, '/') . '/' . ltrim($path, '/');
	}
}

if ( !defined('WP_SITEURL') )
	define( 'WP_SITEURL', get_option('siteurl') );
if ( ! defined( 'WP_CONTENT_URL' ) )
	define( 'WP_CONTENT_URL', WP_SITEURL . '/wp-content' );
if ( ! defined( 'WP_CONTENT_DIR' ) )
	define( 'WP_CONTENT_DIR', ABSPATH . 'wp-content' );
if ( ! defined( 'WP_PLUGIN_URL' ) )
	define( 'WP_PLUGIN_URL', WP_CONTENT_URL. '/plugins' );
if ( ! defined( 'WP_PLUGIN_DIR' ) )
	define( 'WP_PLUGIN_DIR', WP_CONTENT_DIR . '/plugins' );
if ( ! defined( 'WPMU_PLUGIN_URL' ) )
	define( 'WPMU_PLUGIN_URL', WP_CONTENT_URL. '/mu-plugins' );
if ( ! defined( 'WPMU_PLUGIN_DIR' ) )
	define( 'WPMU_PLUGIN_DIR', WP_CONTENT_DIR . '/mu-plugins' );


/* WP RP backwards compatibility */
function wp_random_posts ($number = 10){
	$limitclause="LIMIT " . $number;
	$random_posts = wp_get_random_posts ($limitclause);

	foreach ($random_posts as $random_post ){
		$output .= '<li>';

		$output .=  '<a href="'.get_permalink($random_post->ID).'" title="'.wptexturize($random_post->post_title).'">'.wptexturize($random_post->post_title).'</a></li>';
	}

	$output = '<ul class="randome_post">' . $output . '</ul>';

	echo $output;
}

function wp_most_popular_posts ($number = 10){
	$limitclause="LIMIT " . $number;
	$most_popular_posts = wp_get_most_popular_posts ($limitclause);

	foreach ($most_popular_posts as $most_popular_post ){
		$output .= '<li>';

		$output .=  '<a href="'.get_permalink($most_popular_post->ID).'" title="'.wptexturize($most_popular_post->post_title).'">'.wptexturize($most_popular_post->post_title).'</a></li>';
	}

	$output = '<ul class="most_popular_post">' . $output . '</ul>';

	echo $output;
}

function wp_most_commented_posts ($number = 10){
	$limitclause="LIMIT " . $number;
	$most_commented_posts = wp_get_most_commented_posts ($limitclause);

	foreach ($most_commented_posts as $most_commented_post ){
		$output .= '<li>';

		$output .=  '<a href="'.get_permalink($most_commented_post->ID).'" title="'.wptexturize($most_commented_post->post_title).'">'.wptexturize($most_commented_post->post_title).'</a></li>';
	}

	$output = '<ul class="most_commented_post">' . $output . '</ul>';

	echo $output;
}

function wp23_related_posts() {
	wp_related_posts();
}

function wp_related_posts() {
	$output = wp_get_related_posts();
	echo $output;
}

function wp_get_random_posts ($limitclause="") {
	return wp_fetch_random_posts($limitclause);
}

function wp_get_most_commented_posts($limitclause="") {
	return wp_fetch_most_commented_posts($limitclause);
}

function wp_get_most_popular_posts ($limitclause="") {
	return wp_fetch_most_popular_posts($limitclause);
}

?>
