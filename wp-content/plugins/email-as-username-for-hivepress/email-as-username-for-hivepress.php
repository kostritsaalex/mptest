<?php
/**
 * Plugin Name: Email as Username for HivePress
 * Description: This plugin extends HivePress functionality and allows saving usernames as emails without shortening or processing them.
 * Version: 1.0.0
 * Author: Vegvisir
 * Author URI: https://vegvisir.pro/
 * Text Domain: email-as-username-for-hivepress
 * Domain Path: /languages/
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

// Register extension directory.
add_filter(
	'hivepress/v1/extensions',
	function( $extensions ) {
		$extensions[] = __DIR__;
		return $extensions;
	}
);

add_filter(
	'hivepress/v1/routes',
	function( $routes ) {
        $routes['user_register_action'] = $routes['email_as_username_for_hivepress_register_action'];
        unset($routes['custom_user_register_action']);
		return $routes;
	}
);