=== Hide Comments Feature ===
Contributors: lightningspirit
Tags: plugin, hide, remove, comments, comment, comments, dashboard, feature, core
Donate link: http://vcarvalho.com/donate/
Requires at least: 3.4
Tested up to: 3.5
Stable tag: 0.4
License: GPLv2 - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html

Remove comments functionality and related in your Wordpress instance.



== Description ==

For those who do not need to have the Comments feature in WordPress (there are a lot of reasons), this plugin removes any trace of that existence in both wp-admin and front-end.
Your theme must rely properly on the WordPress API for the front-end support. The tag <?php comments_template(); ?> must be present.
Completely done through techniques based on both action hooks and CSS.

Doesn't requires any configuration, just install and any trace of Comments will disappear.

NOTE: This does NOT play with the core, so you are able to update both plugins and WordPress without any trouble.

= Provided Custom Hooks =

This plugin provides 4 custom hooks you may play if you need more substance in your theme.

`add_action( 'hide_comments_post_types', 'my_hide_comments_post_types' );` to change the list of post types to be processed by the plugin. Comments will be removed from all listed post types.
`add_action( 'hide_comments_css', 'my_hide_comments_css' );` to add arbitrary CSS to hide comment's stuff from your theme.
`add_action( 'hide_comments_template_comments_path', 'my_hide_comments_template_comments_path' );` the default path is the empty file template-comments.php located in the same dir of this plugin. Just modify the path to your own file if you want to return anything else.
`add_action( 'hide_comments_dashboard_right_now', 'my_hide_comments_dashboard_right_now' );` if true is returned, the discussion table of dashboard right now widget will be hidden. False otherwise. Defaults to true.

The use of these hooks are recommended, thus, if the plugin gets deactivated, those hooks will not be called anymore and then you get things consistent and clean.

Do you want to translate it to your language? Just reply to the «Translations» topic in the forum.


== Installation ==

1. Upload `hide-comments-feature` folder to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. No more configuration required.


== Frequently Asked Questions ==

= Will this affect my Wordpress Instalation? =

No. This won't play with the core! In other words, the feature still exists there but it is hidden by the plugin.

= And about my theme? Comments still there... =

That's because your theme either is too old or it doesn't rely on the newest WordPress API. So you have to upgrade it, find a new one or, play with CSS to hide some HTML parts of the theme.
Example of code to go into functions.php:
`<?php
function my_hide_comments_css() {
	?>
	<style type="text/css">
	/* Your CSS here */
	</style>
	<?php
}
add_action( 'hide_comments_css', 'my_hide_comments_css' );
?>`

Though, the main purpose of this plugin is to help web designers and developers creating WordPress sites they can ensure that their users will no longer see mentioned the word "Comment".

== Screenshots ==

1. There is no Comments menu link!
2. The comments template disappeared (magically) from the Twenty Twelve theme.


== Changelog ==

= 0.4 =
* Huge update! Everything is now handled consistently. It is expected to be 3.4 and 3.5 compatible.
* Optimal support for the new Twenty Twelve theme.
* Added 4 custom action hooks (see ) 
* Added translation for Portuguese 

= 0.2 =
* Bugfix: comment icon in menu shouldn't appear in instances prior than 3.0.3

= 0.1 =

* Initial Release
* Good support from FF3/4 and IE7

== Upgrade Notice ==

= 0.4 =

Huge update! Completely rewritten! Everything is now handled consistently. 
New support for WordPress 3.4 and 3.5 using a combination of action hooks and CSS. 
Optimal support for the new Twenty Twelve theme. 
Provided 4 action hooks for developers.

 
