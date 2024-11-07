<?php
/**
 * Plugin Name: HivePress Memberships
 * Description: Charge users for viewing listings.
 * Version: 1.1.4
 * Author: HivePress
 * Author URI: https://hivepress.io/
 * Text Domain: hivepress-memberships
 * Domain Path: /languages/
 *
 * @package HivePress
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

// Include the updates manager.
require_once __DIR__ . '/vendor/hivepress/hivepress-updates/hivepress-updates.php';
