<?php

namespace HivePress\Controllers;

use HivePress\Helpers as hp;
use HivePress\Models;
use HivePress\Forms;
use HivePress\Emails;

// Exit if accessed directly.
defined('ABSPATH') || exit;

/**
 * Controller class.
 */
final class Email_As_Username_For_Hivepress extends Controller
{

    /**
     * Class constructor.
     *
     * @param array $args Controller arguments.
     */
    public function __construct($args = [])
    {
        $args = hp\merge_arrays(
            [
                'routes' => [
                    'email_as_username_for_hivepress_register_action' => [
                        'base' => 'users_resource',
                        'method' => 'POST',
                        'action' => [$this, 'register_user'],
                        'rest' => true,
                    ],
                ],
            ],
            $args
        );

        parent::__construct($args);
    }

    /**
     * Registers user.
     *
     * @param WP_REST_Request $request API request.
     * @return WP_Rest_Response
     */
    public function register_user($request)
    {

        // Check permissions.
        if (!get_option('hp_user_enable_registration', true)) {
            return hp\rest_error(403);
        }

        if (is_user_logged_in() && !current_user_can('create_users')) {
            return hp\rest_error(403);
        }

        // Validate form.
        $form = (new Forms\User_Register())->set_values($request->get_params());

        if (!$form->validate()) {
            return hp\rest_error(400, $form->get_errors());
        }

        // Check username.
        if ($form->get_value('username')) {
            if (sanitize_user($form->get_value('username'), true) !== $form->get_value('username')) {
                return hp\rest_error(400, esc_html__('Username contains invalid characters.', 'hivepress'));
            } elseif (username_exists($form->get_value('username'))) {
                return hp\rest_error(400, esc_html__('This username is already in use.', 'hivepress'));
            }
        }

        // Check email.
        if (email_exists($form->get_value('email'))) {
            return hp\rest_error(400, esc_html__('This email is already registered.', 'hivepress'));
        }

        // Get username.
        $username = $form->get_value('email');

        if ($form->get_value('username')) {
            $username = $form->get_value('username');
        } else {
            $username = sanitize_user($username, true);

            if (empty($username)) {
                $username = 'user';
            }

            while (username_exists($username)) {
                $username .= wp_rand(1, 9);
            }
        }

        // Register user.
        $user = new Models\User();

        // @todo remove temporary fix when updated.
        $user->set_id(null);

        $user->fill(
            array_merge(
                $form->get_values(),
                [
                    'username' => $username,
                ]
            )
        );

        if (!$user->save()) {
            return hp\rest_error(400, $user->_get_errors());
        }

        /**
         * Fires when a new user is registered.
         *
         * @hook hivepress/v1/models/user/register
         * @param {int} $user_id User ID.
         * @param {array} $values Form values.
         */
        do_action('hivepress/v1/models/user/register', $user->get_id(), $form->get_values());

        if (get_option('hp_user_verify_email')) {

            // Set email key.
            $email_key = md5($user->get_email() . time() . wp_rand());

            update_user_meta($user->get_id(), 'hp_email_verify_key', $email_key);

            // Set email redirect.
            $email_redirect = wp_validate_redirect($form->get_value('_redirect'));

            if ($email_redirect) {
                update_user_meta($user->get_id(), 'hp_email_verify_redirect', $email_redirect);
            }

            // Send email.
            (new Emails\User_Email_Verify(
                [
                    'recipient' => $user->get_email(),
                    'tokens' => [
                        'user' => $user,
                        'user_name' => $user->get_username(),
                        'email_verify_url' => hivepress()->router->get_url(
                            'user_email_verify_page',
                            [
                                'username' => $user->get_username(),
                                'email_verify_key' => $email_key,
                            ]
                        ),
                    ],
                ]
            ))->send();
        } elseif (!is_user_logged_in()) {

            // Authenticate user.
            do_action('hivepress/v1/models/user/login');

            wp_signon(
                [
                    'user_login' => $user->get_username(),
                    'user_password' => $form->get_value('password'),
                    'remember' => true,
                ]
            );
        }

        return hp\rest_response(
            201,
            [
                'id' => $user->get_id(),
            ]
        );
    }
}