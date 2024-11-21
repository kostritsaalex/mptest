<?php
function my_custom_registration($username, $email, $password) {
    // Check if the email is valid
    if (is_email($email)) {
        // Use the email as the username
        $username = sanitize_user($email);

        // Proceed to create the user
        $user_id = wp_create_user($username, $password, $email);

        if (!is_wp_error($user_id)) {
            // User created successfully
            return $user_id;
        } else {
            // Handle the error
            return $user_id; // This returns the WP error object
        }
    } else {
        return new WP_Error('invalid_email', __('Invalid email address.'));
    }
}

// Hook into the WordPress registration process
add_action('registration_errors', function($errors, $username, $email) {
    $password = $_POST['password']; // Get the password from the registration POST data

    // Call custom registration function
    $user_id = my_custom_registration($username, $email, $password);

    if (is_wp_error($user_id)) {
        $errors->add('registration_failed', $user_id->get_error_message());
    }

    return $errors;
}, 10, 3);
/**
// * Function to set the email address as the username for new users.
// *
// * @param int $user_id The ID of the newly registered user.
// */
//function set_email_as_username($user_id) {
//    // Get the user's data
//    $user = get_userdata($user_id);
//
//    // Check if the user exists and has a valid email
//    if ($user && !empty($user->user_email)) {
//        // Set the username to the email address
//        wp_update_user(array(
//            'ID'       => $user_id,
//            'user_login' => $user->user_email
//        ));
//    }
//}
//
//// Hook into the user registration process
//add_action('user_register', 'set_email_as_username', 10, 1);
//
//
///**
// * Set the email address as the username for new WooCommerce customers.
// *
// * @param array $data Array of customer data.
// * @return array Modified customer data with the email set as the username.
// */
//function set_email_as_username_in_woocommerce($data) {
//    // Check if the email is set in the customer data
//    if (!empty($data['user_email'])) {
//        // Set the username to the email address
//        $data['user_login'] = $data['user_email'];
//    }
//
//    return $data;
//}
//
//// Hook into WooCommerce customer data filter
//add_filter('woocommerce_new_customer_data', 'set_email_as_username_in_woocommerce', 10, 1);


