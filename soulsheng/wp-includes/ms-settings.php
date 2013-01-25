<?php
/**
 * Used to set up and fix common variables and include
 * the Multisite procedural and class library.
 *
 * Allows for some configuration in wp-config.php (see ms-default-constants.php)
 *
 * @package WordPress
 * @subpackage Multisite
 * @since 3.0.0
 */

/** Include Multisite initialization functions */
require( ABSPATH . WPINC . '/ms-load.php' );
require( ABSPATH . WPINC . '/ms-default-constants.php' );

if ( defined( 'SUNRISE' ) )
	include_once( WP_CONTENT_DIR . '/sunrise.php' );

/** Check for and define SUBDOMAIN_INSTALL and the deprecated VHOST constant. */
ms_subdomain_constants();

if ( !isset( $current_site ) || !isset( $current_blog ) ) {

	$domain = addslashes( $_SERVER['HTTP_HOST'] );
	if ( false !== strpos( $domain, ':' ) ) {
		if ( substr( $domain, -3 ) == ':80' ) {
			$domain = substr( $domain, 0, -3 );
			$_SERVER['HTTP_HOST'] = substr( $_SERVER['HTTP_HOST'], 0, -3 );
		} elseif ( substr( $domain, -4 ) == ':443' ) {
			$domain = substr( $domain, 0, -4 );
			$_SERVER['HTTP_HOST'] = substr( $_SERVER['HTTP_HOST'], 0, -4 );
		} else {
			wp_load_translations_early();
			wp_die( __( 'Multisite only works without the port number in the URL.' ) );
		}
	}

	$domain = rtrim( $domain, '.' );
	$cookie_domain = $domain;
	if ( substr( $cookie_domain, 0, 4 ) == 'www.' )
		$cookie_domain = substr( $cookie_domain, 4 );

	$path = preg_replace( '|([a-z0-9-]+.php.*)|', '', $_SERVER['REQUEST_URI'] );
	$path = str_replace ( '/wp-a