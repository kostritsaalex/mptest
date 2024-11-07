<?php
/**
 * Settings configuration.
 *
 * @package HivePress\Configs
 */

use HivePress\Helpers as hp;

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

return [
	'memberships' => [
		'title'    => esc_html__( 'Memberships', 'hivepress-memberships' ),
		'_order'   => 120,

		'sections' => [
			'display'      => [
				'title'  => hivepress()->translator->get_string( 'display_noun' ),
				'_order' => 10,

				'fields' => [
					'page_membership_plans' => [
						'label'       => esc_html__( 'Plans Page', 'hivepress-memberships' ),
						'description' => esc_html__( 'Choose a page that displays all plans.', 'hivepress-memberships' ),
						'type'        => 'select',
						'options'     => 'posts',
						'option_args' => [ 'post_type' => 'page' ],
						'_order'      => 10,
					],
				],
			],

			'restrictions' => [
				'title'  => esc_html__( 'Restrictions', 'hivepress-memberships' ),
				'_order' => 20,

				'fields' => [
					'membership_listing_restriction' => [
						'label'   => hivepress()->translator->get_string( 'listings' ),
						'type'    => 'select',
						'_order'  => 10,

						'options' => [
							'attributes'   => hivepress()->translator->get_string( 'attributes' ),
							'single_pages' => esc_html__( 'Single Pages', 'hivepress-memberships' ),
							'all_pages'    => esc_html__( 'All Pages', 'hivepress-memberships' ),
						],
					],

					'membership_vendor_restriction'  => [
						'label'   => hivepress()->translator->get_string( 'vendors' ),
						'type'    => 'select',
						'_order'  => 20,

						'options' => [
							'attributes'   => hivepress()->translator->get_string( 'attributes' ),
							'single_pages' => esc_html__( 'Single Pages', 'hivepress-memberships' ),
							'all_pages'    => esc_html__( 'All Pages', 'hivepress-memberships' ),
						],
					],

					'membership_request_restriction' => [
						// @todo use the core string instead.
						'label'   => esc_html__( 'Requests', 'hivepress-memberships' ),
						'type'    => 'select',
						'_order'  => 30,

						'options' => [
							'attributes'   => hivepress()->translator->get_string( 'attributes' ),
							'single_pages' => esc_html__( 'Single Pages', 'hivepress-memberships' ),
							'all_pages'    => esc_html__( 'All Pages', 'hivepress-memberships' ),
						],
					],

					'membership_message_restriction' => [
						'label'   => hivepress()->translator->get_string( 'messages' ),
						'type'    => 'select',
						'_order'  => 40,

						'options' => [
							'all_users' => esc_html__( 'All Users', 'hivepress-memberships' ),
						],
					],

					'membership_review_restriction'  => [
						'label'   => hivepress()->translator->get_string( 'reviews' ),
						'type'    => 'select',
						'_order'  => 50,

						'options' => [
							'all_users' => esc_html__( 'All Users', 'hivepress-memberships' ),
						],
					],

					'membership_offer_restriction'   => [
						// @todo use the core string instead.
						'label'   => esc_html__( 'Offers', 'hivepress-memberships' ),
						'type'    => 'select',
						'_order'  => 60,

						'options' => [
							'all_users' => esc_html__( 'All Users', 'hivepress-memberships' ),
						],
					],

					'membership_limit_views'         => [
						'label'       => esc_html__( 'Views', 'hivepress-memberships' ),
						'caption'     => esc_html__( 'Limit the number of views', 'hivepress-memberships' ),
						'description' => esc_html__( 'Check this option to limit the number of attribute views.', 'hivepress-memberships' ),
						'type'        => 'checkbox',
						'_order'      => 70,
					],
				],
			],
		],
	],
];
