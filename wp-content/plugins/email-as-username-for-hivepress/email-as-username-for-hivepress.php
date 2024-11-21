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
if (!defined('ABSPATH')) {
    exit;
}

// Check if HivePress is active
if (!in_array('hivepress/hivepress.php', apply_filters('active_plugins', get_option('active_plugins')))) {
    // HivePress is not active, so deactivate this plugin
    function email_as_username_for_hivepress_error_notice() {
        ?>
        <div class="error notice">
            <p><?php _e('Email as Username for HivePress requires HivePress to be installed and activated.', 'email-as-username-for-hivepress'); ?></p>
        </div>
        <?php
    }
    add_action('admin_notices', 'email_as_username_for_hivepress_error_notice');

    function email_as_username_for_hivepress_deactivate() {
        deactivate_plugins(plugin_basename(__FILE__));
    }
    add_action('admin_init', 'email_as_username_for_hivepress_deactivate');
} else {
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
}