<?php

/*
Plugin Name: HTML5 Video Playlist Player
Plugin URI: http://html5.svnlabs.com/html5-video-player-with-playlist/
Description: Allows Wordpress users to easily use HTML5 <video> the element enable native video playback within the browser. It supports all browsers i.e. Firefox, Chrome, Safari, IE and Opera. HTML5 Video Player with Playlist, Stream Seek, Volume Control, Full Screen, Play-Pause option.
Date: 2012, April, 18
Author: Sandeep Verma
Author URI: http://www.svnlabs.com/
Version: 1.07

*/

/*
Author: Sandeep Verma
Website: http://www.svnlabs.com
Copyright 2012 SVN Labs Softwares, Jaipur, India All Rights Reserved.

*/


//Database table versions
global $html5video_player_db_table_version;
$html5video_player_db_table_version = "1.0";

//Create database tables
function html5video_db_create () {
    html5video_create_table_player();
}


function html5video_create_table_player(){
    //Get the table name with the WP database prefix
    global $wpdb;
    $table_name_playlist = $wpdb->prefix . "html5video_playlist";
	$table_name_items = $wpdb->prefix . "html5video_items";
	
    global $html5video_player_db_table_version;
    $installed_ver = get_option( "html5video_player_db_table_version" );
     
	//Check if the table already exists and if the table is up to date, if not create it
    if($wpdb->get_var("SHOW TABLES LIKE '$table_name_playlist'") != $table_name_playlist ||  $installed_ver != $html5video_player_db_table_version ) {
        $sql = "CREATE TABLE " . $table_name_playlist . " (
					`id` int(11) NOT NULL AUTO_INCREMENT,
					`title` varchar(150) NOT NULL,
					`description` text NOT NULL,
					`url` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
					`size` varchar(5) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
					`xml` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
					`sandbox` enum('1','0') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '1',
					`width` int(3) NOT NULL DEFAULT '600',
					`height` int(3) NOT NULL DEFAULT '400',
					`logo` varchar(255) NOT NULL,
					`playlistmod` enum('t','f') NOT NULL DEFAULT 'f',
					`autoNext` enum('t','f') NOT NULL DEFAULT 'f',
					`shuffle` enum('t','f') NOT NULL DEFAULT 'f',
					`loop` enum('t','f') NOT NULL DEFAULT 'f',
					`scrollMode` varchar(6) NOT NULL DEFAULT 'auto',
					`theme` varchar(50) NOT NULL DEFAULT 'smoothness',
					`adddate` datetime NOT NULL,
					PRIMARY KEY (`id`)				
            );";

        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql);
		
		$sql1 = "INSERT INTO `".$table_name_playlist."` (`id`, `title`, `description`, `url`, `size`, `xml`, `sandbox`, `width`, `height`, `logo`, `playlistmod`, `autoNext`, `shuffle`, `loop`, `scrollMode`, `theme`, `adddate`) VALUES (1, 'Sample', 'Sample', 'localhost', 'full', 'videolist.xml', '1', 600, 400, '', 't', 't', 'f', 'f', 'auto', 'absolution', '2012-10-11 18:13:24'); ";
		
		$wpdb->query($sql1);
		
		
		}
		
		
		if($wpdb->get_var("SHOW TABLES LIKE '$table_name_items'") != $table_name_items ||  $installed_ver != $html5video_player_db_table_version ) {
        $sql = "CREATE TABLE " . $table_name_items . " (
				`id` int(11) NOT NULL AUTO_INCREMENT,
				`pid` int(11) NOT NULL,
				`title` varchar(255) NOT NULL,
				`artist` varchar(255) NOT NULL,
				`song` varchar(255) NOT NULL,
				`image` varchar(255) NOT NULL,
				`download` enum('1','0') NOT NULL DEFAULT '0',
				`adddate` datetime NOT NULL,
				PRIMARY KEY (`id`)
            );";

        //require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql);		
		
        update_option( "html5video_player_db_table_version", $html5video_player_db_table_version );
        }
		
    //Add database table versions to options
    add_option("html5video_player_db_table_version", $html5video_player_db_table_version);
}

register_activation_hook( __FILE__, 'html5video_db_create' );


add_action( 'admin_menu', 'html5video_plugin_menu' );


function html5video_plugin_menu() {
	add_menu_page( 'HTML5 Video Player', 'HTML5 Video Player', 'manage_options', 'html5video-options', 'wp_html5video_options',plugin_dir_url( __FILE__ )."/html5mp3.png" );
	add_submenu_page('html5video-options','','','manage_options','html5video-options','wp_html5video_options');
	add_submenu_page('html5video-options', 'Manage Playlist', 'Manage Playlist', 'manage_options', 'html5video_playlist', 'wp_html5video_playlist' );
	add_submenu_page('html5video-options', 'Add Playlist', 'Add Playlist', 'manage_options', 'html5video_add_playlist', 'wp_add_html5video_playlist' );	
	add_submenu_page('html5video-options','Help','Help','manage_options','html5video_help','wp_html5video_help');
	
}


add_action( 'admin_init', 'register_html5videosettings' );

function register_html5videosettings() {
	/*register_setting( 'baw-settings-group', 'buy_text' );
	register_setting( 'baw-settings-group', 'color' );
	register_setting( 'baw-settings-group', 'showlist' );
	register_setting( 'baw-settings-group', 'showbuy' );
	register_setting( 'baw-settings-group', 'html5video_description' );
	register_setting( 'baw-settings-group', 'currency' );
	register_setting( 'baw-settings-group', 'tracks' );
	register_setting( 'baw-settings-group', 'tcolor' );*/
}



function wp_html5video_help() {

include 'html5plus/help.php';

}

function wp_html5video_preview() {

include 'html5plus/preview.php';

}



function wp_html5video_options() {

 global $wpdb;
	$table		=	$wpdb->prefix.'html5video_playlist';

//include 'player/settings.php';
include 'html5plus/formplus.php';

}



function wp_html5video_playlist(){
		
include('html5plus/playlist.php');
		
}


function wp_add_html5video_playlist(){
		
include('html5plus/addplaylist.php');
		
}


function html5video_player1($content){
	
	
    global $wpdb;
	$table		=	$wpdb->prefix.'html5video_playlist';	
	  
	$pluginurl	=	plugin_dir_url( __FILE__ );

    //$regex = '/\[html5video (.*?)]/i';
	
	$regex = '/\[html5video(\s+id=([0-9]+))?(\s+type=([a-z]+))?\s*}(.*)\]/i';
    preg_match_all( $regex, $content, $matches );
	//echo "<pre>";
	//print_r($matches);

    //include('html5plus/html5.php');

    $player_div	=	'<div id="myplayer">'.$content.'</div>';
    return $player_div;

}


function wp_html5video_player( $atts, $content = null ) {

    global $wpdb;
	$table		=	$wpdb->prefix.'html5video_playlist';	
	  
	$pluginurl	=	plugin_dir_url( __FILE__ );

   extract( shortcode_atts( array(
		'id' => '1',
		'width' => '600',
		'height' => '250',
		'fcolor' => '343434',
		'bcolor' => 'ff0000',
		'tcolor1' => 'ffffff',
		'tcolor2' => 'a19b9b',
		'dlicon' => '',
		'dlpos' => '10',
		'links' => '0',
		'stitle' => '0',
		'size' => 'full',
	), $atts ) );

	
	
	/* Actual Player code */
	
	
	
	include('videoplayer/index.php');
	
	
	
	
	/* Actual Player code */

    return '<span>' . $content . '</span>';
}


add_shortcode('html5video','wp_html5video_player');

//add_filter('the_content','wp_html5video_player');


