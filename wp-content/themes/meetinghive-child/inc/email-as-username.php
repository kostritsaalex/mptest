<?php

/**
 * Function to set the email address as the username for new users.
 *
 * @param int $user_id The ID of the newly registered user.
 */
function set_email_as_username($user_id) {
    // Get the user's data
    $user = get_userdata($user_id);

    // Check if the user exists and has a valid email
    if ($user && !empty($user->user_email)) {
        // Set the username to the email address
        wp_update_user(array(
            'ID'       => $user_id,
            'user_login' => $user->user_email
        ));
    }
}

// Hook into the user registration process
add_action('user_register', 'set_email_as_username', 10, 1);


/**
 * Set the email address as the username for new WooCommerce customers.
 *
 * @param array $data Array of customer data.
 * @return array Modified customer data with the email set as the username.
 */
function set_email_as_username_in_woocommerce($data) {
    // Check if the email is set in the customer data
    if (!empty($data['user_email'])) {
        // Set the username to the email address
        $data['user_login'] = $data['user_email'];
    }

    return $data;
}

// Hook into WooCommerce customer data filter
add_filter('woocommerce_new_customer_data', 'set_email_as_username_in_woocommerce', 10, 1);


