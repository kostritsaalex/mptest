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


add_action('user_register', 'set_username_as_email');
function set_username_as_email($user_id) {
    $user = get_userdata($user_id);
    $email = $user->user_email;

    // Обновляем user_login на email
    global $wpdb;
    $wpdb->update(
        $wpdb->users,
        array('user_login' => $email),
        array('ID' => $user_id)
    );

    wp_set_current_user($user_id, $email);
    wp_set_auth_cookie($user_id);
    do_action('wp_login', $email);
}

//add_action('user_register', 'set_username_as_email');
//function set_username_as_email($user_id) {
//    $user = get_userdata($user_id);
//    $email = $user->user_email;
//
//    // Обновляем user_login на email
//    global $wpdb;
//    $wpdb->update(
//        $wpdb->users,
//        array('user_login' => $email),
//        array('ID' => $user_id)
//    );
//}
//
//add_filter('authenticate', 'allow_login_with_email', 20, 3);
//function allow_login_with_email($user, $username, $password) {
//    if (is_email($username)) {
//        $user = get_user_by('email', $username);
//        if ($user) {
//            // Проверяем пароль пользователя
//            if (wp_check_password($password, $user->user_pass, $user->ID)) {
//                return $user;
//            } else {
//                return null; // Пароль неверный
//            }
//        }
//    }
//    return $user;
//}
//
//
//




// Регистрация API-метода
add_action('rest_api_init', function () {
    register_rest_route('custom/v1', '/get-states-by-country', [
        'methods' => 'GET',
        'callback' => 'get_states_by_country',
        'permission_callback' => '__return_true', // Если API закрыт, нужно добавить проверку прав доступа
    ]);
});

// Функция для получения списка областей по коду страны
function get_states_by_country(WP_REST_Request $request) {
    // Получаем код страны из запроса
    $country_code = $request->get_param('parent_value');


$search = $request->get_param('search');



    // Проверяем, что WooCommerce активен
    if (!function_exists('WC')) {
        return new WP_Error('woocommerce_not_active', 'WooCommerce не активен', ['status' => 404]);
    }

    // Получаем список областей из WooCommerce
    $states = WC()->countries->get_states($country_code);

    // Если областей для страны нет, возвращаем пустой массив
    if (empty($states)) {
        return [];
    }

    // Форматируем список областей
    $formatted_states = [];
    foreach ($states as $id => $state_name) {
        if ($search && stripos($state_name, $search) === false) {
            continue; // Пропустить области, если параметр поиска не совпадает
        }

        $formatted_states[] = [
            'id' => $id,
            'text' => $state_name,
        ];
    }

    // Возвращаем JSON ответ
    return ['data' => $formatted_states];
}







//add_filter('hivepress/v1/forms/user_register', function($form){
//
//
//
//    if ( get_option( 'hp_user_verify_email' ) ) {
//
//        // Set form message.
//        $form['message']  = esc_html__( 'Please check your email to activate your account.', 'hivepress' );
//        $form['redirect'] = false;
//
//        // Add redirect field.
//        $form['fields']['_redirect'] = [
//            'type'         => 'url',
//            'display_type' => 'hidden',
//            'default'      => hp\get_array_value( $_GET, 'redirect' ),
//            '_separate'    => true,
//        ];
//    }
//
//    // Add username field.
//    if ( ! get_option( 'hp_user_generate_username' ) ) {
//
//
//        $form['fields']['username'] = [
//            'label'      => esc_html__( 'Username', 'hivepress' ),
//            'type'       => 'text',
//            'max_length' => 60,
//            'required'   => true,
//            '_order'     => 5,
//
//            'attributes' => [
//                'autocomplete' => 'username',
//            ],
//        ];
//    }
//
//    // Get terms page ID.
//    $page_id = absint( get_option( 'hp_page_user_registration_terms' ) );
//
//    if ( $page_id ) {
//
//        // Get terms page URL.
//        $page_url = get_permalink( $page_id );
//
//        if ( $page_url ) {
//
//            // Add terms field.
//            $form['fields']['_terms'] = [
//                'caption'   => sprintf( hivepress()->translator->get_string( 'i_agree_to_terms_and_conditions' ), esc_url( $page_url ) ),
//                'type'      => 'checkbox',
//                'required'  => true,
//                '_separate' => true,
//                '_order'    => 1000,
//            ];
//        }
//    }
//
//    return $form;
//
//
//
//
//}
//
//
//
//
//
//
//
//
//
//
//);





//add_action('hivepress/v1/models/user/create', 'custom_hivepress_set_email_as_username', 5, 2);
//
//function custom_hivepress_set_email_as_username($user_id, $values) {
//    if (!empty($values['email'])) {
//        wp_update_user(
//            array(
//                'ID' => $user_id,
//                'user_login' => $values['email'],
//            )
//        );
//    }
//}
//
//// Optionally, remove the username field from the registration form
//add_filter('hivepress/v1/models/user/fields', 'custom_hivepress_remove_username_field');
//
//function custom_hivepress_remove_username_field($fields) {
//    if (isset($fields['username'])) {
//        unset($fields['username']);
//    }
//    return $fields;
//}


//add_filter('hivepress/v1/forms/user_register', function ($form) {
//
//    // Add username field.
//    if (!get_option('hp_user_generate_username')) {
//        $email_address = $form['fields']['username'];
//
//        // Check if the email address is valid
//        if (is_email($email_address)) {
//            // Automatically generate a password or use a provided one
//            $password = wp_generate_password(); // Generate a random password
//
//            // Prepare the user data array
//            $user_data = array(
//                'user_login' => $email_address, // Set username as the email
//                'user_email' => $email_address,  // Set email address
//                'user_pass'  => $password,       // Set the user password
//                'role'       => 'subscriber',     // Set the user role, change as necessary
//            );
//
//            // Create the user
//            $user_id = wp_insert_user($user_data);
//
//            // Check for errors
//            if (is_wp_error($user_id)) {
//                // There was an error creating the user
//                echo 'Error: ' . $user_id->get_error_message();
//            } else {
//                echo 'User created successfully. User ID: ' . $user_id;
//                // Optionally: Send an email to the user with their login details
//                wp_new_user_notification($user_id, null, 'user');
//            }
//        } else {
//            echo 'Invalid email address.';
//        }
//
//
//
//    }
//}
//);







//
//
//// Add this code to your custom plugin or theme's functions.php file
//
//// Custom code to set HivePress username as email address
//add_filter( 'hivepress/v1/models/user/fields', 'custom_hivepress_user_fields', 10, 2 );
//
//function custom_hivepress_user_fields( $fields, $user ) {
//    // Remove the username field from the registration form
//    if ( isset( $fields['username'] ) ) {
//        unset( $fields['username'] );
//    }
//
//    return $fields;
//}
//
//add_action( 'hivepress/v1/models/user/create', 'custom_hivepress_set_username', 10, 2 );
//
//function custom_hivepress_set_username( $user_id, $values ) {
//    if ( ! empty( $values['email'] ) ) {
//        $email = $values['email'];
//
//        // Update the user's username to be the email address
//        wp_update_user(
//            array(
//                'ID' => $user_id,
//                'user_login' => $email,
//            )
//        );
//    }
//}