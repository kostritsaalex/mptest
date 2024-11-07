<?php
/**
 * Meta boxes configuration.
 *
 * @package HivePress\Configs
 */

use HivePress\Helpers as hp;

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

return [
	'membership_plan_settings' => [
		'title'  => hivepress()->translator->get_string( 'settings' ),
		'screen' => 'membership_plan',

		'fields' => [
			'product'            => [
				'label'       => hivepress()->translator->get_string( 'ecommerce_product' ),
				'description' => esc_html__( 'Choose a product that must be purchased in order to get this membership.', 'hivepress-memberships' ),
				'type'        => 'select',
				'options'     => 'posts',
				'option_args' => [ 'post_type' => 'product' ],
				'_alias'      => 'post_parent',
				'_order'      => 10,
			],

			'expire_period'      => [
				'label'       => hivepress()->translator->get_string( 'expiration_period' ),
				'description' => esc_html__( 'Set the number of days after which a membership expires.', 'hivepress-memberships' ),
				'type'        => 'number',
				'min_value'   => 1,
				'_order'      => 20,
			],

			'view_limit'         => [
				'label'       => esc_html__( 'View Limit', 'hivepress-memberships' ),
				'description' => esc_html__( 'Set the maximum number of the attribute views.', 'hivepress-memberships' ),
				'type'        => 'number',
				'min_value'   => 1,
				'_order'      => 30,
			],

			'pages'              => [
				'label'       => esc_html__( 'Pages', 'hivepress-memberships' ),
				'type'        => 'select',
				'options'     => 'posts',
				'option_args' => [ 'post_type' => 'page' ],
				'multiple'    => true,
				'_order'      => 40,
			],

			'listing_attributes' => [
				'label'       => hivepress()->translator->get_string( 'listing_attributes' ),
				'type'        => 'select',
				'options'     => 'posts',
				'option_args' => [ 'post_type' => 'hp_listing_attribute' ],
				'multiple'    => true,
				'_order'      => 50,
			],

			'vendor_attributes'  => [
				'label'       => hivepress()->translator->get_string( 'vendor_attributes' ),
				'type'        => 'select',
				'options'     => 'posts',
				'option_args' => [ 'post_type' => 'hp_vendor_attribute' ],
				'multiple'    => true,
				'_order'      => 60,
			],

			'request_attributes' => [
				// @todo use the core string instead.
				'label'       => esc_html__( 'Request Attributes', 'hivepress-memberships' ),
				'type'        => 'select',
				'options'     => 'posts',
				'option_args' => [ 'post_type' => 'hp_request_attribute' ],
				'multiple'    => true,
				'_order'      => 70,
			],

			'message'            => [
				'label'   => hivepress()->translator->get_string( 'messages' ),
				'caption' => esc_html__( 'Allow sending messages', 'hivepress-memberships' ),
				'type'    => 'checkbox',
				'_order'  => 80,
			],

			'review'             => [
				'label'   => hivepress()->translator->get_string( 'reviews' ),
				'caption' => esc_html__( 'Allow submitting reviews', 'hivepress-memberships' ),
				'type'    => 'checkbox',
				'_order'  => 90,
			],

			'offer'              => [
				// @todo use the core string instead.
				'label'   => esc_html__( 'Offers', 'hivepress-memberships' ),
				'caption' => esc_html__( 'Allow making offers', 'hivepress-memberships' ),
				'type'    => 'checkbox',
				'_order'  => 100,
			],
		],
	],

	'membership_settings'      => [
		'title'  => hivepress()->translator->get_string( 'settings' ),
		'screen' => 'membership',

		'fields' => [
			'user'         => [
				'label'    => esc_html__( 'User', 'hivepress-memberships' ),
				'type'     => 'select',
				'options'  => 'users',
				'source'   => hivepress()->router->get_url( 'users_resource' ),
				'required' => true,
				'_alias'   => 'post_author',
				'_order'   => 10,
			],

			'plan'         => [
				'label'       => esc_html__( 'Plan', 'hivepress-memberships' ),
				'type'        => 'select',
				'options'     => 'posts',
				'option_args' => [ 'post_type' => 'hp_membership_plan' ],
				'required'    => true,
				'_alias'      => 'post_parent',
				'_order'      => 20,
			],

			'expired_time' => [
				'label'       => hivepress()->translator->get_string( 'expiration_date' ),
				'description' => esc_html__( 'Set a date on which the membership will expire.', 'hivepress-memberships' ),
				'type'        => 'date',
				'format'      => 'U',
				'_order'      => 30,
			],
		],
	],
];
