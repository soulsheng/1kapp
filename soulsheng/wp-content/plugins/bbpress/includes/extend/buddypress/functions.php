<?php

/**
 * Main bbPress BuddyPress Class
 *
 * @package bbPress
 * @subpackage BuddyPress
 * @todo maybe move to BuddyPress Forums once bbPress 1.1 can be removed
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/** BuddyPress Helpers ********************************************************/

/**
 * Filter the current bbPress user ID with the current BuddyPress user ID
 *
 * @since bbPress (r3552)
 *
 * @param int $user_id
 * @param bool $displayed_user_fallback
 * @param bool $current_user_fallback
 *
 * @return int User ID
 */
function bbp_filter_user_id( $user_id = 0, $displayed_user_fallback = true, $current_user_fallback = false ) {

	// Define local variable
	$bbp_user_id = 0;

	// Get possible user ID's
	$did = bp_displayed_user_id();
	$lid = bp_loggedin_user_id();

	// Easy empty checking
	if ( !empty( $user_id ) && is_numeric( $user_id ) )
		$bbp_user_id = $user_id;

	// Currently viewing or editing a user
	elseif ( ( true == $displayed_user_fallback ) && !empty( $did ) )
		$bbp_user_id = $did;

	// Maybe fallback on the current_user ID
	elseif ( ( true == $current_user_fallback ) && !empty( $lid ) )
		$bbp_user_id = $lid;

	return $bbp_user_id;
}
add_filter( 'bbp_get_user_id', 'bbp_filter_user_id', 10, 3 );

/**
 * Filter the bbPress is_single_user function with BuddyPress eqivalent
 *
 * @since bbPress (r3552)
 *
 * @param bool $is Optional. Default false
 * @return bool True if viewing single user, fa