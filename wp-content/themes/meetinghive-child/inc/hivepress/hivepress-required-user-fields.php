<?php
add_filter(
    'hivepress/v1/forms/user_update',
    function( $form ) {
        $form['fields']['first_name']['required'] = true;
        $form['fields']['last_name']['required'] = true;

        // Add billing fields
        $form['fields']['billing_country'] = array(
            'type' => 'select',
            'label' => __( 'Country', 'your-text-domain' ),
            'required' => true,
            'options' => WC()->countries->get_allowed_countries(), // Get allowed countries
            'class' => array('select2'), // Add class for Select2
        );

        $form['fields']['billing_state'] = array(
            'type' => 'custom_select',
         //   'source' =>  rest_url('custom/v1/get-states-by-country'),
             'label' => __( 'State', 'your-text-domain' ),
            'required' => true,
            'options' => [], // To be populated dynamically based on country
            'class' => array('select2'), // Add class for Select2

//            'attributes' => [
//                'data-parent' => 'billing_country',
//                'data-options' => wp_json_encode(
//                    [
//                        'action' => 'get_states'
//                    ]
//
//                )
//
//            ]
        );

        $form['fields']['billing_city'] = array(
            'type' => 'text',
            'label' => __( 'City/Town', 'your-text-domain' ),
            'required' => true,
        );

        $form['fields']['billing_zip'] = array(
            'type' => 'text',
            'label' => __( 'Zip/Postal Code', 'your-text-domain' ),
            'required' => true,
        );

        $form['fields']['billing_phone'] = array(
            'type' => 'text',
            'label' => __( 'Phone', 'your-text-domain' ),
            'required' => true,
        );

        return $form;
    },
    1000
);

// Enqueue JavaScript to load states based on selected country
add_action( 'wp_enqueue_scripts', function() {
    if ( is_user_logged_in() ) {
        wp_enqueue_script( 'load-states', get_stylesheet_directory_uri() . '/js/hivepress/hivepress-state-country-woocommerce-ajax.js', array('jquery'), null, true );
        wp_localize_script( 'load-states', 'ajax_object', array(
            'ajax_url' => admin_url( 'admin-ajax.php' ),
            'states' => WC()->countries->get_states(),
        ));
    }
});



// Add this to your theme's functions.php or in a custom plugin file

// Hook the function to WordPress
add_action('wp_ajax_get_states', 'get_states_ajax_handler');
add_action('wp_ajax_nopriv_get_states', 'get_states_ajax_handler');

function get_states_ajax_handler() {
    // Check for nonce security (you should add a nonce to your JS request)
    // if ( ! wp_verify_nonce( $_POST['nonce'], 'get_states_nonce' ) ) {
    //     die ( 'Busted!');
    // }

    // Ensure country is set
    if (!isset($_POST['country'])) {
        wp_send_json_error('Country not specified');
    }

    $country = sanitize_text_field($_POST['country']);

    // Get WooCommerce states for the country
    $states = WC()->countries->get_states($country);

    // If states exist, return them
    if ($states) {
        wp_send_json($states);
    } else {
        // If no states, return an empty array
        wp_send_json(array());
    }

    wp_die(); // Always include this to terminate the script properly
}







add_filter('hivepress/v1/models/user', function ($model) {

    $model['fields']['billing_first_name'] = [
        'type' => 'text',
        '_external' => true,
    ];

    $model['fields']['billing_last_name'] = [
        'type' => 'text',
        '_external' => true,
    ];


    $model['fields']['billing_city'] = [
        'type' => 'text',
        '_external' => true,
    ];

    $model['fields']['billing_country'] = [
        'type' => 'text',
        '_external' => true,
    ];

    $model['fields']['billing_state'] = [
        'type' => 'text',
        '_external' => true,
    ];

    $model['fields']['billing_zip'] = [
        'type' => 'text',
        '_external' => true,
    ];

    $model['fields']['billing_phone'] = [
        'type' => 'number',
        '_external' => true,
    ];


    return $model;



});


add_action( 'hivepress/v1/models/user/update', function ( $user_id ) {

    file_put_contents(ABSPATH  . 'log3.txt', get_user_meta($user_id, 'hp_billing_city', true));
    update_user_meta($user_id, 'billing_city', get_user_meta($user_id, 'hp_billing_city', true));
}
);





//print_r(get_user_meta('1'));

