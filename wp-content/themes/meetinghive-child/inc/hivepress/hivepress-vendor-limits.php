<?php

// Set the maximum number of listings per user account
add_filter(
    'hivepress/v1/forms/listing_submit/errors',
    function( $errors, $form ) {
        $listing = $form->get_model();

        if ( $listing && $listing->get_user__id() ) {
            $listing_count = \HivePress\Models\Listing::query()->filter(
                [
                    'status__in' => [ 'publish', 'pending', 'draft' ],
                    'user'       => $listing->get_user__id(),
                ]
            )->get_count();

            if ( $listing_count >= 2 ) {
                $errors[] = 'Only 2 listings per account are allowed.';
            }
        }

        return $errors;
    },
    1000,
    2
);