<?php
/**
 * Makes a custom Widget for displaying Aside, Link, Status, and Quote Posts available with Twenty Eleven
 *
 * Learn more: http://codex.wordpress.org/Widgets_API#Developing_Widgets
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */
class Twenty_Eleven_Ephemera_Widget extends WP_Widget {

	/**
	 * Constructor
	 *
	 * @return void
	 **/
	function Twenty_Eleven_Ephemera_Widget() {
		$widget_ops = array( 'classname' => 'widget_twentyeleven_ephemera', 'description' => __( 'Use this widget to list your recent Aside, Status, Quote, and Link posts', 'twentyeleven' ) );
		$this->WP_Widget( 'widget_twentyeleven_ephemera', __( 'Twenty Eleven Ephemera', 'twentyeleven' ), $widget_ops );
		$this->alt_option_name = 'widget_twentyeleven_ephemera';

		add_action( 'save_post', array(&$this, 'flush_widget_cache' ) );
		add_action( 'deleted_post', array(&$this, 'flush_widget_cache' ) );
		add_action( 'switch_theme', array(&$this, 'flush_widget_cache' ) );
	}

	/**
	 * Outputs the HTML for this widget.
	 *
	 * @param array An array of standard parameters for widgets in this theme
	 * @param array An array of settings for this widget instance
	 * @return void Echoes it's output
	 **/
	function widget( $args, $instance ) {
		$cache = wp_cache_get( 'widget_twentyeleven_ephemera', 'widget' );

		if ( !is_array( $cache ) )
			$cache = array();

		if ( ! isset( $args['widget_id'] ) )
			$args['widget_id'] = null;

		i