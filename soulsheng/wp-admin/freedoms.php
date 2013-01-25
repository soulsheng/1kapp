<?php
/**
 * Your Rights administration panel.
 *
 * @package WordPress
 * @subpackage Administration
 */

/** WordPress Administration Bootstrap */
require_once( './admin.php' );

$title = __( 'Freedoms' );

list( $display_version ) = explode( '-', $wp_version );

include( ABSPATH . 'wp-admin/admin-header.php' );
?>
<div class="wrap about-wrap">

<h1><?php printf( __( 'Welcome to WordPress %s' ), $display_version ); ?></h1>

<div class="about-text"><?php printf( __( 'Thank you for updating to the latest version! WordPress %s is already making your website better, faster, and more attractive, just like you!' ), $display_version ); ?></div>

<div class="wp-badge"><?php printf( __( 'Version %s' ), $display_version ); ?></div>

<h2 class="nav-tab-wrapper">
	<a href="about.php" class="nav-tab">
		<?php _e( 'What&#8217;s New' ); ?>
	</a><a href="credits.php" class="nav-tab">
		<?php _e( 'Credits' ); ?>
	</a><a href="freedoms.php" class="nav-tab nav-tab-active">
		<?php _e( 'Freedoms' ); ?>
	</a>
</h2>

<p class="about-description"><?php printf( __( 'WordPress is Free and open source software, built by a distributed community of mostly volunteer developers from around the world. WordPress comes with some awesome, worldview-changing rights courtesy of its <a href="%s">license</a>, the GPL.' ), 'http://wordpress.org/about/license/' ); ?></p>

<ol start="0">
	<li><p><?php _e( 'You have the freedom to run the program, for any purpose.' ); ?></p><