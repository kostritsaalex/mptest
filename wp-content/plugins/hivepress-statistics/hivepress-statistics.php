<?php
/**
 * Plugin Name: HivePress Statistics
 * Description: Allow users to view listing statistics.
 * Version: 1.1.2
 * Author: HivePress
 * Author URI: https://hivepress.io/
 * Text Domain: hivepress-statistics
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
		return array_merge( $extensions, [ __DIR__ ] );
	}
);
