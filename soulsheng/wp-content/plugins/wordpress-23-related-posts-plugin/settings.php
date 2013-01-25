<?php

add_action('admin_menu', 'wp_add_related_posts_options_page');

function wp_add_related_posts_options_page() {
	$page = add_options_page(__('Related Posts','wp_related_posts'), __('Related Posts','wp_related_posts'), 'manage_options', 'wordpress-related-posts', 'wp_related_posts_options_subpanel');

	add_action('admin_print_scripts-' . $page, 'wp_rp_themes_scripts');
}

function wp_rp_themes_scripts() {
	$plugin_path = path_join(WP_PLUGIN_URL, basename( dirname( __FILE__ ) ));
	wp_enqueue_script("wp_rp_themes_script", path_join($plugin_path, "static/themes.js"), array( 'jquery' ) );
}

function wp_related_posts_options_subpanel() {
	if (isset($_POST["wp_rp_Submit"]) && $_POST["wp_rp_Submit"]){
		$message = __("WordPress Related Posts Setting Updated",'wp_related_posts');

		$wp_rp_saved = get_option("wp_rp");

		$wp_rp = array (
			"wp_rp_title" 			=> isset($_POST['wp_rp_title_option']) ? trim($_POST['wp_rp_title_option']) : false,
			"wp_rp_title_tag"		=> isset($_POST['wp_rp_title_tag_option']) ? trim($_POST['wp_rp_title_tag_option']) : false,
			"wp_no_rp"				=> isset($_POST['wp_no_rp_option']) ? trim($_POST['wp_no_rp_option']) : false,
			"wp_no_rp_text"			=> isset($_POST['wp_no_rp_text_option']) ? trim($_POST['wp_no_rp_text_option']) : false,
			"wp_rp_except"			=> isset($_POST['wp_rp_except_option']) ? trim($_POST['wp_rp_except_option']) : false,
			"wp_rp_except_number"	=> isset($_POST['wp_rp_except_number_option']) ? trim($_POST['wp_rp_except_number_option']) : false,
			"wp_rp_limit"			=> isset($_POST['wp_rp_limit_option']) ? trim($_POST['wp_rp_limit_option']) : false,
			'wp_rp_exclude'			=> isset($_POST['wp_rp_exclude_option']) ? join(',', $_POST['wp_rp_exclude_option']) : false,
			'wp_rp_auto'			=> isset($_POST['wp_rp_auto_option']) ? trim($_POST['wp_rp_auto_option']) : false,
			'wp_rp_rss'				=> isset($_POST['wp_rp_rss_option']) ? trim($_POST['wp_rp_rss_option']) : false,
			'wp_rp_comments'		=> isset($_POST['wp_rp_comments_option']) ? trim($_POST['wp_rp_comments_option']) : false,
			'wp_rp_date'			=> isset($_POST['wp_rp_date_option']) ? trim($_POST['wp_rp_date_option']) : false,
			'wp_rp_thumbnail'		=> isset($_POST['wp_rp_thumbnail_option']) ? trim($_POST['wp_rp_thumbnail_option']) : false,
			'wp_rp_thumbnail_text'	=> isset($_POST['wp_rp_thumbnail_text_option']) ? trim($_POST['wp_rp_thumbnail_text_option']) : false,
			'wp_rp_thumbnail_post_meta'	=> isset($_POST['wp_rp_thumbnail_post_meta_option']) ? trim($_POST['wp_rp_thumbnail_post_meta_option']) : false,
			'wp_rp_theme'	=> isset($_POST['wp_rp_theme']) ? trim($_POST['wp_rp_theme']) : false
		);

		if ($wp_rp_saved != $wp_rp)
			if(!update_option("wp_rp",$wp_rp))
				$message = "Update Failed";

		echo '<div id="message" class="updated fade"><p>'.$message.'.</p></div>';
	}

	$wp_rp = get_option("wp_rp");

?>

	<div class="wrap">
	<?php
		$wp_no_rp = $wp_rp["wp_no_rp"];
		$wp_rp_title_tag = $wp_rp["wp_rp_title_tag"];

		$wp_rp_theme = isset($wp_rp['wp_rp_theme']) ? $wp_rp['wp_rp_theme'] : WP_RP_THEME_DEFAULT;

		include dirname(__FILE__) . "/static/settings.js.php"
	?>

		<input type="hidden" id="wp_rp_theme_url" value="<?=WP_RP_STATIC_BASE_URL . WP_RP_THEMES_PATH?>" />
		<input type="hidden" id="wp_rp_json_url" value="<?=WP_RP_STATIC_BASE_URL . WP_RP_JSON_PATH?>" />
		<input type="hidden" id="wp_rp_theme_selected" value="<?=$wp_rp_theme?>" />

		<h2><?php _e("Related Posts Settings",'wp_related_posts');?></h2>

		<div id="wp-rp-survey" class="updated highlight" style="display:none;"><p><?php _e("Please fill out",'wp_related_posts');?> <a class="link" target="_blank" href="http://wprelatedposts.polldaddy.com/s/new-features"><?php _e("a quick survey", 'wp_related_posts');?></a>.<a href="#" class="close" style="float: right;">x</a></p></div>

		<p><?php _e("WordPress Related Posts Plugin places a list of related articles via WordPress tags at the bottom of your post.",'wp_related_posts');?> </p>
		<?php _e("If you have any questions please contact us at",'wp_related_posts');?> <a target="_blank" href="mailto:relatedpostsplugin@gmail.com"><?php _e("support", 'wp_related_posts');?></a>.</p>

		<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>?page=wordpress-related-posts">
		<h3><?php _e("Basic Settings",'wp_related_posts');?></h3>
		<table class="form-table">
		  <tr valign="top">
			<th scope="row"><?php _e("Related Posts Title:",'wp_related_posts'); ?></th>
			<td>
			  <input name="wp_rp_title_option" type="text" id="wp_rp_title"  value="<?php echo $wp_rp["wp_rp_title"]; ?>" class="regular-text" />
			</td>
		</tr>
		<tr valign="top">
			<th scope="row"><?php _e("Maximum Number of Posts:",'wp_related_posts');?></th>
			<td>
			  <input name="wp_rp_limit_option" type="text" id="wp_rp_limit" value="<?php echo $wp_rp["wp_rp_limit"]; ?>" />
			</td>
		</tr>
		<tr valign="top">
			<th scope="row"><?php _e("Categories to Exclude:",'wp_related_posts');?></th>
			<td>
				<?php
				$exclude = explode(",",$wp_rp["wp_rp_exclude"]);
				$args = array(
					'orderby' => 'name',
					'order' => 'ASC',
					'hide_empty' => false
					);
				foreach (get_categories($args) as $categorie) {
				?>
				<label>
					<input name="wp_rp_exclude_option[]" type="checkbox" id="wp_rp_exclude" value="<?=$categorie->cat_ID?>" <?= in_array($categorie->cat_ID, $exclude) ? "checked=\"checked\"" : ""; ?> />
					<?=$categorie->cat_name?>
					<br />
				</label>
				<?php } ?>
			</td>
		</tr>
		</table>
		<h3>Theme Settings <small style="color: #c33;">(new)</small></h3>
		<table class="form-table">
			<tr id="wp_rp_theme_options_wrap"></tr>
			<tr>
				<th scope="row"><?php _e("Thumbnail Options:",'wp_related_posts'); ?></th>
				<td>
					<label>
						<input name="wp_rp_thumbnail_option" type="checkbox" id="wp_rp_thumbnail" value="yes" <?php echo ($wp_rp["wp_rp_thumbnail"] == 'yes') ? 'checked' : ''; ?> onclick="wp_rp_thumbnail_onclick();" >
						<?php _e("Display Thumbnails For Related Posts",'wp_related_posts');?>
					</label>
					<br />
					<span id="wp_rp_thumbnail_span" style="<?php echo ($wp_rp["wp_rp_thumbnail"] == 'yes') ? '' : 'display:none;'; ?>">
					<label>
						<input name="wp_rp_thumbnail_text_option" type="checkbox" id="wp_rp_thumbnail_text" value="yes" <?php echo ($wp_rp["wp_rp_thumbnail_text"] == 'yes') ? 'checked' : ''; ?>>
						<?php _e("Do you still want to display text when display thumbnails for related posts?",'wp_related_posts');?>
					</label>
					<br />
					<br />
					<?php _e("Which field is used for thumbnail?",'wp_related_posts');?>
					<select name="wp_rp_thumbnail_post_meta_option" id="wp_rp_thumbnail_post_meta"  class="postform">
					<?php
					global $wpdb;

					if (function_exists('has_post_thumbnail')) {
						echo '<option value="wprp_featured_image">' . __("Use Featured Image", "wp_related_posts") . '</option>';
					}

					$post_metas = $wpdb->get_col( "SELECT meta_key FROM $wpdb->postmeta GROUP BY meta_key HAVING meta_key NOT LIKE '\_%' ORDER BY LOWER(meta_key)" );

					foreach ( $post_metas as $post_meta ) {
						$post_meta = esc_attr( $post_meta );
					?>

						<option value="<?php echo $post_meta; ?>" <?php if($wp_rp["wp_rp_thumbnail_post_meta"] == $post_meta) echo 'selected' ?>><?php echo $post_meta;?> </option>;
					<?php
					}
					?>
					</select>
					</span>
				</td>
			</tr>
			<tr>
				<th scope="row"><?php _e("Display Options:",'wp_related_posts'); ?></th>
				<td>
					<label>
					<input name="wp_rp_comments_option" type="checkbox" id="wp_rp_comments" value="yes"  <?php echo ($wp_rp["wp_rp_comments"] == 'yes') ? 'checked' : ''; ?>>
					<?php _e("Display Number of Comments",'wp_related_posts');?>
					</label>
					<br />
					<label>
					<input name="wp_rp_date_option" type="checkbox" id="wp_rp_date" value="yes"  <?php echo ($wp_rp["wp_rp_date"] == 'yes') ? 'checked' : ''; ?>>
					<?php _e("Display Publish Date",'wp_related_posts');?>
					</label>
					<br />
					<label>
						<input name="wp_rp_except_option" type="checkbox" id="wp_rp_except" value="yes" <?php echo ($wp_rp["wp_rp_except"] == 'yes') ? 'checked' : ''; ?> onclick="wp_rp_except_onclick();" >
						<?php _e("Display Post Excerpt",'wp_related_posts');?>
					</label>
					<label id="wp_rp_except_number_label" style="<?php echo ($wp_rp["wp_rp_except"] == 'yes') ? '' : 'display:none;'; ?>">
						<input name="wp_rp_except_number_option" type="text" id="wp_rp_except_number" value="<?php echo ($wp_rp["wp_rp_except_number"]); ?> "  /> <span class="description"><?php _e('Maximum Number of Characters.','wp_related_posts'); ?></span>
					</label>
					<br />
					<label for="wp_rp_title_tag">
						<?php _e("Related Posts Title Tag",'wp_related_posts'); ?>
						<select name="wp_rp_title_tag_option" id="wp_rp_title_tag" class="postform">
						<?php
						$wp_rp_title_tag_array = array('h2','h3','h4','p','div');
						if (!isset($wp_rp_title_tag) || $wp_rp_title_tag == 0 ) {
							$wp_rp_title_tag = WP_RP_TITLE_TAG_DEFAULT;
						}
						foreach ($wp_rp_title_tag_array as $wp_rp_title_tag_a){
						?>
							<option value="<?php echo $wp_rp_title_tag_a; ?>" <?php if($wp_rp_title_tag == $wp_rp_title_tag_a) echo 'selected' ?> >&lt;<?php echo $wp_rp_title_tag_a; ?>&gt;</option>
						<?php 
						}
						?>
						</select>
					</label>
				</td>
			</tr>
		</table>

		<h3><?php _e("If there are no related posts",'wp_related_posts');?></h3>
		<table class="form-table">
			<tr valign="top">
				<th scope="row"><?php _e("Display:",'wp_related_posts'); ?></th>
				<td>
					<select name="wp_no_rp_option" id="wp_no_rp" onchange="wp_no_rp_onchange();"  class="postform">
						<option value="text" <?php if($wp_no_rp == 'text') echo 'selected' ?> ><?php _e("Text: 'No Related Posts'",'wp_related_posts'); ?></option>
						<option value="random" <?php if($wp_no_rp == 'random') echo 'selected' ?>><?php _e("Random Posts",'wp_related_posts'); ?></option>
						<option value="commented" <?php if($wp_no_rp == 'commented') echo 'selected' ?>><?php _e("Most Commented Posts",'wp_related_posts'); ?></option>
						<?php if (function_exists('akpc_most_popular')){ ?>
						<option value="popularity" <?php if($wp_no_rp == 'popularity') echo 'selected' ?>><?php _e("Most Popular Posts",'wp_related_posts'); ?></option>
						<?php } ?> 
					</select>
				</td>
			</tr>
			<tr valign="top" scope="row">
				<th id="wp_no_rp_title" scope="row">
				<?php 
				switch ($wp_no_rp){
					case 'text':
						_e("No Related Posts Text:",'wp_related_posts'); 
						break;
					case 'random':
						_e("Random Posts Title:",'wp_related_posts'); 
						break;
					case 'commented':
						_e("Most Commented Posts Title:",'wp_related_posts'); 
						break;
					case 'popularity':
						_e("Most Popular Posts Title:",'wp_related_posts'); 
						break;
				}
				?>
				</th>
				<td>
					<input name="wp_no_rp_text_option" type="text" id="wp_no_rp_text" value="<?php echo $wp_rp["wp_no_rp_text"]; ?>" class="regular-text" />
				</td>
			</tr>
		</table>
		<table class="form-table">
			<h3><?php _e("Other Settings:",'wp_related_posts'); ?></h3>
			<tr valign="top">
				<td>
					<label>
					<input name="wp_rp_auto_option" type="checkbox" id="wp_rp_auto" value="yes"  <?php echo ($wp_rp["wp_rp_auto"] == 'yes') ? 'checked' : ''; ?>>
					<?php _e("Auto Insert Related Posts",'wp_related_posts');?>
					</label>
					<br />
					<label>
					<input name="wp_rp_rss_option" type="checkbox" id="wp_rp_rss" value="yes"  <?php echo ($wp_rp["wp_rp_rss"] == 'yes') ? 'checked' : ''; ?>>
					<?php _e("Display Related Posts in Feed",'wp_related_posts');?>
					</label>
				</td>
			</tr>
		</table>
		<p class="submit"><input type="submit" value="<?php _e("Save changes",'wp_related_posts');?>" name="wp_rp_Submit" class="button-primary" /></p>
	  </form>
	</div>
<?php }
