<?php

function meetinghive_theme_enqueue_styles() {
    wp_enqueue_style( 'child-style', get_stylesheet_directory_uri() . '/style.css' );
}
add_action( 'wp_enqueue_scripts', 'meetinghive_theme_enqueue_styles' );


/**
 *  Includes
 */

// WooCommerce
include 'inc/woocommerce/remove-unwanted-checkout-fields.php';

//HivePress
// Set Required Fields + New User Fileds
include 'inc/hivepress/hivepress-required-user-fields.php'; //TODO Fix saving
// Load JS to Autofulfill User City, State, Country, Zip based on the Location string
include 'inc/hivepress/hivepress-user-location-autofulfillment.php';
// Manually accept new bookings - Hide and Checkbox
include 'inc/hivepress/hivepress-preset-manually-accept-new-bookings.php';
// Listing Adjustments
include 'inc/hivepress/hivepress-listing-adjustments.php';
// Registration Adjustments
include 'inc/hivepress/hivepress-registration-adjustments.php';
// Vendor Limitations
include 'inc/hivepress/hivepress-vendor-limits.php';
// Vendor Listing page
include 'inc/hivepress/hivepress-vendor-listing-page.php';
// Vendor Profile Adjustments
include 'inc/hivepress/hivepress-vendor-profile.php';


include 'temp.php';



