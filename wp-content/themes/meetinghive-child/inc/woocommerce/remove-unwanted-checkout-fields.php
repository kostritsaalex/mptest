<?php

function remove_unwanted_checkout_fields($fields) {

    // Unsetting 'Company name' field in the billing section
    if (isset($fields['billing']['billing_company'])) {
        unset($fields['billing']['billing_company']);
    }

    // Unsetting 'Street address' field in the billing section
    if (isset($fields['billing']['billing_address_1'])) {
        unset($fields['billing']['billing_address_1']);
    }

    // Unsetting 'Street address' field in the billing section
    if (isset($fields['billing']['billing_address_2'])) {
        unset($fields['billing']['billing_address_2']);
    }

    // Unsetting 'Postcode / ZIP' field in the billing section
    if (isset($fields['billing']['billing_postcode'])) {
        unset($fields['billing']['billing_postcode']);
    }

    // Unsetting 'Phone' field in the billing section
    if (isset($fields['billing']['billing_phone'])) {
        unset($fields['billing']['billing_phone']);
    }

    return $fields;
}

add_filter('woocommerce_checkout_fields', 'remove_unwanted_checkout_fields');
add_filter('woocommerce_enable_order_notes_field', '__return_false');