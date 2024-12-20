<?php
/**
 * Plugin Name: HivePress Blocks
 * Description: A few useful blocks for HivePress themes.
 * Version: 1.0.1
 * Author: HivePress
 * Author URI: https://hivepress.io/
 * Text Domain: hivepress-blocks
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
