<?php

//Checkbox settled to Manually Accept New Bookings by Default for User Update page
add_filter(
    'hivepress/v1/forms/user_update',
    function( $form ) {
        if (isset($form['fields']['booking_moderated'])) {
            $form['fields']['booking_moderated']['default'] = true;
        }
        return $form;
    },
    1000
);

// Hide Manually Accept New Bookings - User Update page
add_filter(
    'hivepress/v1/forms/user_update',
    function( $form ) {
        unset($form['fields']['booking_moderated']);
        return $form;
    },
    1000
);


// Hide Manually Accept New Bookings - Listing page
add_filter(
    'hivepress/v1/models/listing/attributes',
    function( $attributes ) {

        if ( isset($attributes['booking_moderated']) ) {
            $attributes['booking_moderated']['editable'] = false;
        }

        return $attributes;
    },
    1000
);

//Checkbox settled to Manually Accept New Bookings by Default for New Listings page
add_action('hivepress/v1/models/listing/create', function($listing_id) {

    if(hivepress()->get_version( 'bookings' )){
        update_post_meta($listing_id, 'hp_booking_moderated', true);
    }

},
    1000
);