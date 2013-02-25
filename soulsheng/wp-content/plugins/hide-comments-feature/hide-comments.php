<?php

/*
Plugin Name: Hide Comments
Plugin URI: http://wordpress.org/extend/plugins/hide-comments-feature
Version: 0.4
Description: Remove comments functionality and related in your Wordpress instance.
Author: lightningspirit
Author URI: http://profiles.wordpress.org/lightningspirit
Text Domain: hide-comments
Domain Path: /languages/
Tags: plugin, hide, remove, comments, comment, comments, dashboard, feature, core
License: GPLv2 - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
*/


/*
 * @package Hide Comments
 * @author Vitor Carvalho
 * @copyright Lightningspirit.net 2009-2010
 * This code is released under the GPL licence version 2 or later
 * http://www.gnu.org/licenses/gpl.txt
 */



if ( ! class_exists ( 'Hide_Comments_Feature' ) ) :
/**
 * Hide_Comments_Feature
 * 
 * Central class to that removes all comments features.
 * All functions are aggregated to an action hook.
 * Everything here is static, thus the plugin is intented to be fast.
 * 
 * Just use the custom action hooks provided. If you need a specific hook
 * not listed here, please patch the file and send to he diff to my email
 * lightningspirit [at] gmail [dot] com.
 * I will release it asap.
 * 
 * 
 * Actions hooks:
 * --------------
 * 
 * a) hide_comments_post_types: 
 *    you may filter the array of post types to be used by the plugin
 * 
 * b) hide_comments_css: 
 *    for general purposes on your template,
 *    you may echo any custom css to hide links and such from your theme.
 * 
 * c) hide_comments_dashboard_right_now:
 *    just boolean values. If you return true, the discussion table of dashboard right now widget
 *    will be hidden. False otherwise. Defaults to true.
 * 
 * d) hide_comments_template_comments_path:
 *    the default path is the empty file template-comments.php located in the same dir of this
 *    plugin. just modify the path to your own file if you want to return anything else.
 * 
 * If you want to programmatically change any action used here, just add remove_action 
 * in your theme's functions.php, inside of a add_action('init') call.
 * 
 * 
 * @package WordPress
 * @subpackage Importer
 * @since 0.3
 */
class Hide_Comments_Feature {
	
	public function __construct() {
		Hide_Comments_Feature::init();
		
	}
	
	public static function init() {
		add_action( 'init', array( 'Hide_Comments_Feature', 'init_everything' ) );
		add_action( 'wp_head', array( 'Hide_Comments_Feature', 'remove_comments_css' ) );
		add_action( 'wp_meta', array( 'Hide_Comments_Feature', 'remove_comments_link_meta' ) );
		add_action( 'admin_menu', array( 'Hide_Comments_Feature', 'remove_discussion_options' ) );
		add_action( 'admin_head', array( 'Hide_Comments_Feature', 'dashboard_right_now_hide_discussion' ) );
		add_action( 'admin_bar_menu', array( 'Hide_Comments_Feature', 'remove_comments_from_admin_bar' ), 99 );
		add_action( 'get_comments_number', array( 'Hide_Comments_Feature', 'comments_number_always_zero' ) );
		add_action( 'comments_template', array( 'Hide_Comments_Feature', 'change_comments_template' ) );
		add_action( 'widgets_init', array( 'Hide_Comments_Feature', 'remove_comments_widget' ), 0 );
		add_action( 'wp_dashboard_setup', array( 'Hide_Comments_Feature', 'remove_dashboard_comments_widget' ), 0 );
		
	}
	
	public static function init_everything() {
		$args = array(
			'public' => true,
			'_builtin' => true,
		);
		
		foreach ( apply_filters( 'hide_comments_post_types', get_post_types( $args ) ) as $post_type )	{
			if ( post_type_supports( $post_type, 'comments' ) )
				remove_post_type_support( $post_type, 'comments' );
				
		}
		
	}
	
	public static function remove_comments_css() {
		?>
		<style type="text/css">
			.comments-link {
				display: none;
			}
			<?php do_action( 'hide_comments_css' ); ?>
		</style>
		<!-- Hide Comments plugin -->
		<?php
		
	}
	
	public static function remove_comments_link_meta() {
		?>
		<style type="text/css">
			.widget_meta li:nth-child(4) {
				display: none;
			}
		</style>
		<!-- Hide Comments plugin -->
		<?php
	}
	
	public static function remove_discussion_options() {
		remove_menu_page( 'edit-comments.php' );
		remove_submenu_page( 'options-general.php', 'options-discussion.php' );
		
	}
	
	public static function dashboard_right_now_hide_discussion() {
		if ( ! apply_filters( 'hide_comments_dashboard_right_now', true ) )
			return;
		
		?>
		<style type="text/css">
			#dashboard_right_now .table_discussion {
				display: none;
			}
		</style>
		<?php
	}
	
	public static function remove_comments_from_admin_bar( $admin_bar ) {
		$admin_bar->remove_menu( 'comments' );
		return $admin_bar;
		
	}
	
	public static function comments_number_always_zero() {
		return 0;
		
	}
	
	public static function change_comments_template() {
		global $wp_query;
		
		$wp_query->comments = array();
		$wp_query->comments_by_type = array();
		$wp_query->comment_count = '0';
		$wp_query->post->comment_count = '0';
		$wp_query->post->comment_status = 'closed';
		$wp_query->queried_object->comment_count = '0';
		$wp_query->queried_object->comment_status = 'closed';
		
		return apply_filters( 'hide_comments_template_comments_path', plugin_dir_path( __FILE__ ) . 'template-comments.php' );
		
	}
	
	public static function remove_comments_widget() {
		if ( function_exists( 'unregister_widget' ) ) {
			unregister_widget( 'WP_Widget_Recent_Comments' );
	
		}
		
	}
	
	public static function remove_dashboard_comments_widget() {
		remove_meta_box( 'dashboard_recent_comments', 'dashboard', 'normal' );
		
	}
	
	
}

new Hide_Comments_Feature;

endif;



/**
 * hide_comments_activation_hook
 * 
 * Register activation hook for plugin
 * 
 * @since 0.3
 */
function hide_comments_activation_hook() {
	// Wordpress version control. No compatibility with older versions. ( wp_die )
	if ( version_compare( get_bloginfo( 'version' ), '3.4', '<' ) ) {
		wp_die( 'Hide Comments is not compatible with versions prior to 3.4' );
	
	}
	
	// Update to last version in
	update_option( 'hide_comments_plugin_version', '0.4' );	
	
}
register_activation_hook( __FILE__, 'hide_comments_activation_hook' );
