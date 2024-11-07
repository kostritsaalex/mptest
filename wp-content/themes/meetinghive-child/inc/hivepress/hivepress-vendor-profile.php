<?php

// Add vendor profile link to the user account menu
add_filter(
    'hivepress/v1/menus/user_account',
    function ( $menu ) {
        if ( is_user_logged_in() ) {
            $vendor_id = HivePress\Models\Vendor::query()->filter(
                [
                    'user' => get_current_user_id(),
                ]
            )->get_first_id();

            if ( $vendor_id ) {
                $menu['items']['vendor_view'] = [
                    'label'  => 'Profile View',
                    'url'    => hivepress()->router->get_url( 'vendor_view_page', [ 'vendor_id' => $vendor_id ] ),
                    '_order' => 123,
                ];
            }
        }

        return $menu;
    },
    1000
);