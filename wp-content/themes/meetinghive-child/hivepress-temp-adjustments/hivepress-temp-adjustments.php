<?php

/**
 * Replace name of Button "Proceed to Payment"
 * URL: domain/make-booking/details/
 */

function modify_button_text_script() {
    if (is_user_logged_in()) {
        if (is_home() . '/make-booking/details') { // Check if the URL path matches
            wp_enqueue_script(
                'hivepress-temp-adjustments',
                get_stylesheet_directory_uri() . '/hivepress-temp-adjustments/js/hivepress-temp-adjustments.js', // Path to your custom JS file
                array('jquery'), // Add jQuery as a dependency
                null,
                true // Load in the footer
            );
        }
    }
}
add_action('wp_enqueue_scripts', 'modify_button_text_script');


function hivepress_location_fulfillment() {
    if (is_user_logged_in()) {
        if (is_home() . '/account/settings') { // Check if the URL path matches
            wp_enqueue_script(
                'hivepress-location-fulfillment',
                get_stylesheet_directory_uri() . '/hivepress-temp-adjustments/js/hivepress-location-fulfillment.js', // Path to your custom JS file
                array('jquery'), // Add jQuery as a dependency
                null,
                true // Load in the footer
            );
        }
    }
}
add_action('wp_enqueue_scripts', 'hivepress_location_fulfillment');
