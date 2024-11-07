<?php

// Set the maximum number of images per listing
add_filter(
    'hivepress/v1/models/listing',
    function( $model ) {
        $model['fields']['images']['max_files'] = 10;

        return $model;
    },
    100
);

// Set label for the Listing offer "Offer Price"
add_filter(
    'hivepress/v1/models/listing/attributes',
    function( $attributes ) {
        if ( isset( $attributes['price'] ) ) {
            $attributes['price']['display_format'] = 'Offer Price %value%';
        }

        return $attributes;
    },
    1000
);

// Set the minimum description length in the listing edit form
add_filter(
    'hivepress/v1/forms/listing_update',
    function ($form) {
        $form['fields']['description']['min_length'] = 200;

        return $form;
    },
    1000
);



//add_action(
//    'hivepress/v1/models/listing/create',
//    function($listing_id, $listing) {
//        error_log('t');
//        if(hivepress()->get_version( 'bookings' ) && hivepress()->booking->is_time_enabled($listing)){
//            update_post_meta($listing_id, 'hp_booking_slot_duration', 10);
//            error_log('te');
//        }
//    },
//    1000,
//    2
//);
//
//add_filter(
//    'hivepress/v1/models/listing/attributes',
//    function( $attributes ) {
//        if ( isset($attributes['booking_slot_duration']) ) {
//            $attributes['booking_slot_duration']['editable'] = false;
//        }
//
//        return $attributes;
//    },
//    1000
//);