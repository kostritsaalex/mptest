<?php

// Add vendor email link to the vendor listing page
add_filter(
    'hivepress/v1/templates/listing_view_page/blocks',
    function( $blocks, $template ) {
        $listing = $template->get_context( 'listing' );

        if ( $listing ) {
            $blocks = hivepress()->helper->merge_trees(
                [ 'blocks' => $blocks ],
                [
                    'blocks' => [
                        'listing_actions_primary' => [
                            'blocks' => [
                                'vendor_email_link' => [
                                    'type'    => 'content',
                                    'content' => '<a href="mailto:' . esc_attr( $listing->get_user__email() ) . '">Contact Vendor</a>',
                                    '_order'  => 5,
                                ],
                            ],
                        ],
                    ],
                ]
            )['blocks'];
        }

        return $blocks;
    },
    1000,
    2
);