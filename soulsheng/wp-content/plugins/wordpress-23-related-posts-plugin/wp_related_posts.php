<?php
/*
Plugin Name: WordPress Related Posts
Version: 1.3
Plugin URI: http://fairyfish.net/2007/09/12/wordpress-23-related-posts-plugin/
Description: Generate a related posts list via tags of WordPress
Author: Denis
Author URI: http://fairyfish.net/
*/

include_once dirname(__FILE__) . '/defaults.php';
include_once dirname(__FILE__) . '/utils.php';
include_once dirname(__FILE__) . '/widget.php';
include_once dirname(__FILE__) . '/settings.php';

add_action('init', 'init_textdomain');
function init_textdomain(){
  load_plugin_textdomain('wp_related_posts', false, dirname(plugin_basename (__FILE__)) . '/lang');
}

register_activation_hook( __FILE__, 'activate_wp_related_posts' );
function activate_wp_related_posts() {
	$wp_rp = get_option("wp_rp");

	if (!isset($wp_rp['wp_rp_template'])) {
		// plain for old users, modern for new
		// This hook doesn't fire on updates for wp >= 3.1
		if (count($wp_rp) === 0 && version_compare($wp_version, '3.1', '>=')) {
			$wp_rp['wp_rp_template'] = WP_RP_THEME_DEFAULT;
		} else {
			$wp_rp['wp_rp_template'] = WP_RP_THEME_PLAIN;
		}
	}

	if (!isset($wp_rp['wp_rp_auto'])) {
		$wp_rp['wp_rp_auto'] = WP_RP_AUTO_APPEND;
	}
	if (!isset($wp_rp['wp_rp_title'])) {
		$wp_rp['wp_rp_title'] = WP_RP_TITLE;
	}
	if (!isset($wp_rp['wp_rp_limit'])) {
		$wp_rp['wp_rp_limit'] = WP_RP_POST_LIMIT;
	}
	if (!isset($wp_rp['wp_rp_rss'])) {
		$wp_rp['wp_rp_rss'] = WP_RP_APPEND_TO_RSS;
	}
	if (!isset($wp_rp['wp_rp_thumbnail_text'])) {
		$wp_rp['wp_rp_thumbnail_text'] = 'yes';
	}
	if (!isset($wp_rp['wp_rp_except_number'])) {
		$wp_rp['wp_rp_except_number'] = 200;
	}
	if (!isset($wp_rp['wp_no_rp'])) {
		$wp_rp['wp_no_rp'] = WP_RP_RELATED_FALLBACK;
		if (!isset($wp_rp['wp_no_rp_text'])) {
			$wp_rp['wp_no_rp_text'] = WP_RP_RELATED_FALLBACK_TITLE;
		}
	}
	update_option( "wp_rp", $wp_rp );
}

function wp_fetch_related_posts($limitclause="") {
	global $wpdb, $post;
	$wp_rp = get_option("wp_rp");

	if(!$post->ID){return;}
	$now = current_time('mysql', 1);
	$tags = wp_get_post_tags($post->ID);

	$tagcount = count($tags);
	$taglist = false;
	if ($tagcount > 0) {
		$taglist = "'" . $tags[0]->term_id. "'";
		for ($i = 1; $i < $tagcount; $i++) {
			$taglist = $taglist . ", '" . $tags[$i]->term_id . "'";
		}
	}

	$related_posts = false;
	if ($taglist) {
		$q = "SELECT p.ID, p.post_title, p.post_content,p.post_excerpt, p.post_date,  p.comment_count, count(t_r.object_id) as cnt FROM $wpdb->term_taxonomy t_t, $wpdb->term_relationships t_r, $wpdb->posts p WHERE t_t.taxonomy ='post_tag' AND t_t.term_taxonomy_id = t_r.term_taxonomy_id AND t_r.object_id  = p.ID AND (t_t.term_id IN ($taglist)) AND p.ID != $post->ID AND p.post_status = 'publish' AND p.post_date_gmt < '$now' GROUP BY t_r.object_id ORDER BY cnt DESC, p.post_date_gmt DESC $limitclause;";

		$related_posts = $wpdb->get_results($q);
	}

	return $related_posts;
}

function wp_fetch_random_posts ($limitclause="") {
	global $wpdb, $post;

	$q = "SELECT ID, post_title, post_content,post_excerpt, post_date, comment_count FROM $wpdb->posts WHERE post_status = 'publish' AND post_type = 'post' AND ID != $post->ID ORDER BY RAND() $limitclause";
	return $wpdb->get_results($q);
}

function wp_fetch_most_commented_posts($limitclause="") {
	global $wpdb;
	$q = "SELECT ID, post_title, post_content, post_excerpt, post_date, COUNT($wpdb->comments.comment_post_ID) AS 'comment_count' FROM $wpdb->posts, $wpdb->comments WHERE comment_approved = '1' AND $wpdb->posts.ID=$wpdb->comments.comment_post_ID AND post_status = 'publish' GROUP BY $wpdb->comments.comment_post_ID ORDER BY comment_count DESC $limitclause";
	return $wpdb->get_results($q);
}

function wp_fetch_most_popular_posts ($limitclause="") {
	global $wpdb, $table_prefix;

	$q = $sql = "SELECT p.ID, p.post_title, p.post_content,p.post_excerpt, p.post_date, p.comment_count FROM ". $table_prefix ."ak_popularity as akpc,".$table_prefix ."posts as p WHERE p.ID = akpc.post_id ORDER BY akpc.total DESC $limitclause";;
	return $wpdb->get_results($q);
}

function wp_fetch_content() {
	$default_wp_no_rp_text = array(
		"random" =>  __("Random Posts",'wp_related_posts'),
		"popularity" =>  __("Random Posts",'wp_related_posts'),
		"commented" =>  __("Random Posts",'wp_related_posts'),
		"text" =>  __("No Related Post",'wp_related_posts')
	);

	$wp_rp = get_option("wp_rp");

	if (isset($wp_rp["wp_rp_limit"]) && $wp_rp["wp_rp_limit"]) {
		$limitclause = "LIMIT " . $wp_rp["wp_rp_limit"];
	} else {
		$limitclause = "LIMIT " . WP_RP_POST_LIMIT;
	}

	$wp_rp_title = isset($wp_rp["wp_rp_title"]) ? $wp_rp["wp_rp_title"] : "";
	$related_posts = wp_fetch_related_posts($limitclause);

	if (!$related_posts) {
		$wp_no_rp = isset($wp_rp["wp_no_rp"]) ? $wp_rp["wp_no_rp"] : "random";
		$wp_no_rp_text = isset($wp_rp["wp_no_rp_text"]) ? $wp_rp["wp_no_rp_text"] : false;

		if ($wp_no_rp_text) {
			$wp_rp_title = $wp_no_rp_text;
		} else if ($wp_no_rp_text === false && isset($default_wp_no_rp_text[$wp_no_rp])) {
			$wp_rp_title = $default_wp_no_rp_text[$wp_no_rp];
		} else {
			$wp_rp_title = "";
		}

		if ($wp_no_rp === "commented") {
			$related_posts = wp_fetch_most_commented_posts($limitclause);
		} else if ($wp_no_rp === "popularity" && function_exists('akpc_most_popular')) {
			$related_posts = wp_fetch_most_popular_posts($limitclause);
		} else if ($wp_no_rp === "text") {
			$related_posts = false;
		} else { // random
			$related_posts = wp_fetch_random_posts($limitclause);
		}
	}

	return array(
		"posts" => $related_posts,
		"title" => $wp_rp_title
	);
}

function wp_get_post_thumbnail_img($related_post) {
	$wp_rp = get_option("wp_rp");

	$img = false;
	if (isset($wp_rp["wp_rp_thumbnail"]) && $wp_rp["wp_rp_thumbnail"] && isset($wp_rp["wp_rp_thumbnail_post_meta"]) && $wp_rp["wp_rp_thumbnail_post_meta"]) {
		if ($wp_rp["wp_rp_thumbnail_post_meta"] === 'wprp_featured_image') {
			if (function_exists('has_post_thumbnail') && has_post_thumbnail($related_post->ID)) {
				$img = get_the_post_thumbnail($related_post->ID, 'thumbnail');
			}
		} else {
			$thumbnail_src = get_post_meta($related_post->ID, $wp_rp["wp_rp_thumbnail_post_meta"], true);
			if ($thumbnail_src) {
				$img = '<img src="'. $thumbnail_src .'" alt="'.wptexturize($related_post->post_title).'" />';
			}
		}
	}

	return $img;
}

function wp_generate_related_posts_list_items($related_posts) {
	$wp_rp = get_option("wp_rp");
	$output = "";

	foreach ($related_posts as $related_post ) {
		$output .= '<li>';

		$img = wp_get_post_thumbnail_img($related_post);
		if ($img) {
			$output .=  '<a href="'.get_permalink($related_post->ID).'" title="'.wptexturize($related_post->post_title).'">' . $img . '</a>';
		}

		if (!$wp_rp["wp_rp_thumbnail"] || ($wp_rp["wp_rp_thumbnail"] && ($wp_rp["wp_rp_thumbnail_text"] || !$img))) {
			if ($wp_rp["wp_rp_date"]){
				$dateformat = get_option('date_format');
				$output .= mysql2date($dateformat, $related_post->post_date) . " -- ";
			}

			$output .=  '<a href="'.get_permalink($related_post->ID).'" title="'.wptexturize($related_post->post_title).'">'.wptexturize($related_post->post_title).'</a>';

			if ($wp_rp["wp_rp_comments"]){
				$output .=  " (" . $related_post->comment_count . ")";
			}

			if ($wp_rp["wp_rp_except"]){
				$wp_rp_except_number = trim($wp_rp["wp_rp_except_number"]);
				if(!$wp_rp_except_number) $wp_rp_except_number = 200;
				if($related_post->post_excerpt){
					$output .= '<br /><small>'.(mb_substr(strip_shortcodes(strip_tags($related_post->post_excerpt)),0,$wp_rp_except_number)).'...</small>';
				}else{
					$output .= '<br /><small>'.(mb_substr(strip_shortcodes(strip_tags($related_post->post_content)),0,$wp_rp_except_number)).'...</small>';
				}
			}
		}
		$output .=  '</li>';
	}

	return $output;
}

function wp_should_exclude() {
	global $wpdb, $post;
	$wp_rp = get_option("wp_rp");

	$exclude = explode(",",$wp_rp["wp_rp_exclude"]);
	if ( $exclude != '' ) {
		$q = 'SELECT tt.term_id FROM '. $wpdb->term_taxonomy.'  tt, ' . $wpdb->term_relationships.' tr WHERE tt.taxonomy = \'category\' AND tt.term_taxonomy_id = tr.term_taxonomy_id AND tr.object_id = '.$post->ID;

		$cats = $wpdb->get_results($q);

		foreach($cats as $cat) {
			if (in_array($cat->term_id, $exclude) != false){
				return true;
			}
		}
	}
	return false;
}


function wp_get_related_posts($before_title="", $after_title="") {
	if (wp_should_exclude()) {
		return;
	}

	global $wpdb, $post;
	$wp_rp = get_option("wp_rp");

	$output = "";

	$content = wp_fetch_content();
	$related_posts = $content['posts'];
	$wp_rp_title = $content['title'];

	$wp_rp_theme = isset($wp_rp['wp_rp_theme']) ? $wp_rp['wp_rp_theme'] : WP_RP_THEME_PLAIN;
	$wp_rp_theme_url = WP_RP_STATIC_BASE_URL . WP_RP_THEMES_PATH . $wp_rp_theme;

	if ($related_posts) {
		$output = wp_generate_related_posts_list_items($related_posts);
	} else {
		$wp_no_rp_text = isset($wp_rp["wp_no_rp_text"]) ? $wp_rp["wp_no_rp_text"] : "";
		if (!$wp_no_rp_text) {
			$wp_no_rp_text = $wp_rp_title;
		}
		$wp_rp_title = "";
		$output = '<li>' . $wp_no_rp_text . '</li>';
	}

	$output = '<ul class="related_post">' . $output . '</ul>';

	$wp_rp_title_tag = isset($wp_rp["wp_rp_title_tag"]) ? $wp_rp["wp_rp_title_tag"] : WP_RP_TITLE_TAG_DEFAULT;
	if ($before_title) {
		if ($wp_rp_title != '') {
			$output = $before_title.$wp_rp_title .$after_title. $output;
		}
	} else {
		if ($wp_rp_title != '') {
			$output =  '<'.$wp_rp_title_tag.'  class="related_post_title">'.$wp_rp_title .'</'.$wp_rp_title_tag.'>'. $output;
		}
	}

 	// figure out how to use wp_enqueue_style
	$wp_rp_theme_style_loader = '<script type="text/javascript">
		setTimeout(function () {
			var link = document.createElement("link");
			link.rel = "stylesheet";
			link.href= "' . $wp_rp_theme_url . '";
			link.type= "text/css";
			document.getElementsByTagName("body")[0].appendChild(link);
		}, 1);
		</script>';

	$output .= $wp_rp_theme_style_loader;

	return $output;
}

function wp_related_posts_auto($content){
	$wp_rp = get_option("wp_rp");
	if ((is_single() && $wp_rp["wp_rp_auto"])||(is_feed() && $wp_rp["wp_rp_rss"])) {
		$output = wp_get_related_posts();
		$content = $content . $output;
	}

	return $content;
}
add_filter('the_content', 'wp_related_posts_auto', 99);
