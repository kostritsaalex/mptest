<?php
/**
 * Plugin Name: HivePress Magic Practitioners
 * Description: Custom Magic Practitioners Extensions
 * Version: 1.0.0
 * Text Domain: hivepress-magic-practitioners
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