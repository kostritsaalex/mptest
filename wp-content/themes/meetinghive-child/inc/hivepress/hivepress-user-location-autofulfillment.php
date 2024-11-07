<?php

// Call JS Code to Autofulfill User's City, State, Country, Zip

function hivepress_user_location_autofulfillment() {
    if (is_user_logged_in()) {
        if (is_home() . '/account/settings') { // Check if the URL path matches
            wp_enqueue_script(
                'hivepress-user-location-autofulfillment',
                get_stylesheet_directory_uri() . '/js/hivepress/hivepress-user-location-autofulfillment.js', // Path to your custom JS file
                array('jquery'), // Add jQuery as a dependency
                null,
                true // Load in the footer
            );
        }
    }
}
add_action('wp_enqueue_scripts', 'hivepress_user_location_autofulfillment');