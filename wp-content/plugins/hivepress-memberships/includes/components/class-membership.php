<?php
/**
 * Membership component.
 *
 * @package HivePress\Components
 */

namespace HivePress\Components;

use HivePress\Helpers as hp;
use HivePress\Models;
use HivePress\Emails;

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

/**
 * Membership component class.
 *
 * @class Membership
 */
final class Membership extends Component {

	/**
	 * Class constructor.
	 *
	 * @param array $args Component arguments.
	 */
	public function __construct( $args = [] ) {

		// Expire memberships.
		add_action( 'hivepress/v1/events/hourly', [ $this, 'expire_memberships' ] );

		// Update membership.
		add_action( 'hivepress/v1/models/membership/update', [ $this, 'update_membership' ] );

		// Update membership status.
		add_action( 'hivepress/v1/models/membership/update_status', [ $this, 'update_membership_status' ], 10, 2 );

		if ( hp\is_plugin_active( 'woocommerce' ) ) {

			// Update order status.
			add_action( 'woocommerce_order_status_changed', [ $this, 'update_order_status' ], 10, 4 );

			// Redirect order page.
			add_action( 'template_redirect', [ $this, 'redirect_order_page' ] );
		}

		if ( ! hp\is_rest() ) {

			// Hide attributes.
			add_filter( 'hivepress/v1/models/listing/attributes', [ $this, 'hide_attributes' ] );
			add_filter( 'hivepress/v1/models/vendor/attributes', [ $this, 'hide_attributes' ] );
			add_filter( 'hivepress/v1/models/request/attributes', [ $this, 'hide_attributes' ] );

			// Hide fields.
			add_filter( 'hivepress/v1/models/listing/fields', [ $this, 'hide_fields' ], 150, 2 );
			add_filter( 'hivepress/v1/models/vendor/fields', [ $this, 'hide_fields' ], 150, 2 );
			add_filter( 'hivepress/v1/models/request/fields', [ $this, 'hide_fields' ], 150, 2 );
		}

		// Add fields.
		add_filter( 'hivepress/v1/models/membership_plan', [ $this, 'add_plan_fields' ] );

		// Validate models.
		add_filter( 'hivepress/v1/models/message/errors', [ $this, 'validate_message' ] );
		add_filter( 'hivepress/v1/models/review/errors', [ $this, 'validate_review' ] );

		if ( is_admin() ) {

			// Manage admin columns.
			add_filter( 'manage_hp_membership_posts_columns', [ $this, 'add_membership_admin_columns' ] );
			add_action( 'manage_hp_membership_posts_custom_column', [ $this, 'render_membership_admin_columns' ], 10, 2 );

			// Alter settings.
			add_filter( 'hivepress/v1/settings', [ $this, 'alter_settings' ] );

			// Alter meta boxes.
			add_filter( 'hivepress/v1/meta_boxes/membership_plan_settings', [ $this, 'alter_plan_settings' ] );
			add_filter( 'hivepress/v1/meta_boxes/membership_settings', [ $this, 'alter_membership_settings' ] );
		} else {

			// Set request context.
			if ( ! hp\is_rest() ) {
				add_action( 'init', [ $this, 'set_request_context' ], 50 );
			}

			// Redirect pages.
			add_action( 'template_redirect', [ $this, 'redirect_pages' ] );

			// Alter menus.
			add_filter( 'hivepress/v1/menus/user_account', [ $this, 'alter_user_account_menu' ] );

			// Alter templates.
			add_filter( 'hivepress/v1/templates/site_footer_block', [ $this, 'alter_site_footer_block' ] );

			if ( hivepress()->get_version( 'messages' ) ) {
				add_filter( 'hivepress/v1/templates/listing_view_block', [ $this, 'alter_message_send_modal' ], 100 );
				add_filter( 'hivepress/v1/templates/listing_view_page', [ $this, 'alter_message_send_modal' ], 100 );
				add_filter( 'hivepress/v1/templates/vendor_view_block', [ $this, 'alter_message_send_modal' ], 100 );
				add_filter( 'hivepress/v1/templates/vendor_view_page', [ $this, 'alter_message_send_modal' ], 100 );
			}

			if ( hivepress()->get_version( 'reviews' ) ) {
				add_filter( 'hivepress/v1/templates/listing_view_page', [ $this, 'alter_review_submit_modal' ], 100 );
			}

			if ( hivepress()->get_version( 'requests' ) ) {
				add_filter( 'hivepress/v1/templates/request_view_block', [ $this, 'alter_offer_make_modal' ], 100 );
				add_filter( 'hivepress/v1/templates/request_view_page', [ $this, 'alter_offer_make_modal' ], 100 );
			}

			if ( get_option( 'hp_membership_limit_views' ) ) {
				add_filter( 'hivepress/v1/templates/membership_view_block', [ $this, 'alter_membership_view_block' ] );

				add_filter( 'hivepress/v1/templates/listing_view_block/blocks', [ $this, 'alter_reveal_view_blocks' ] );
				add_filter( 'hivepress/v1/templates/vendor_view_block/blocks', [ $this, 'alter_reveal_view_blocks' ] );
				add_filter( 'hivepress/v1/templates/request_view_block/blocks', [ $this, 'alter_reveal_view_blocks' ] );

				add_filter( 'hivepress/v1/templates/listing_view_page/blocks', [ $this, 'alter_reveal_view_blocks' ] );
				add_filter( 'hivepress/v1/templates/vendor_view_page/blocks', [ $this, 'alter_reveal_view_blocks' ] );
				add_filter( 'hivepress/v1/templates/request_view_page/blocks', [ $this, 'alter_reveal_view_blocks' ] );
			}
		}

		parent::__construct( $args );
	}

	/**
	 * Gets plan product IDs.
	 *
	 * @return array
	 */
	protected function get_plan_product_ids() {
		return array_filter(
			array_map(
				function( $plan ) {
					return $plan->get_product__id();
				},
				Models\Membership_Plan::query()->filter(
					[
						'status' => 'publish',
					]
				)->get()->serialize()
			)
		);
	}

	/**
	 * Expires memberships.
	 */
	public function expire_memberships() {

		// Get memberships.
		$memberships = Models\Membership::query()->filter(
			[
				'status'            => 'publish',
				'expired_time__lte' => time(),
			]
		)->limit( 10 )
		->get();

		foreach ( $memberships as $membership ) {

			// Get user.
			$user = $membership->get_user();

			if ( $user ) {

				// Send email.
				( new Emails\Membership_Expire(
					[
						'recipient' => $user->get_email(),

						'tokens'    => [
							'user'                 => $user,
							'membership'           => $membership,
							'user_name'            => $user->get_display_name(),
							'membership_plan'      => $membership->get_name(),
							'membership_plans_url' => hivepress()->router->get_url( 'membership_plans_view_page' ),
						],
					]
				) )->send();
			}

			if ( $membership->is_default() ) {

				// Update membership.
				$membership->set_status( 'draft' )->save_status();

				if ( get_option( 'hp_membership_limit_views' ) ) {
					$membership->set_view_limit( null )->save_view_limit();
				}
			} else {

				// Delete membership.
				$membership->delete();
			}
		}
	}

	/**
	 * Updates membership.
	 *
	 * @param int $membership_id membership ID.
	 */
	public function update_membership( $membership_id ) {

		// Get membership.
		$membership = Models\Membership::query()->get_by_id( $membership_id );

		if ( $membership->validate() ) {
			return;
		}

		// Get plan.
		$plan = $membership->get_plan();

		if ( ! $plan ) {
			return;
		}

		// Get expiration.
		$expiration = $membership->get_expired_time();

		if ( ! $expiration && $plan->get_expire_period() ) {
			$expiration = time() + $plan->get_expire_period() * DAY_IN_SECONDS;
		}

		// Remove action.
		remove_action( 'hivepress/v1/models/membership/update', [ $this, 'update_membership' ] );

		// Update membership.
		$membership->fill(
			array_merge(
				$plan->serialize(),
				[
					'status'       => $membership->get_status(),
					'expired_time' => $expiration,
				]
			)
		)->save();
	}

	/**
	 * Updates membership status.
	 *
	 * @param int    $membership_id membership ID.
	 * @param string $new_status New status.
	 */
	public function update_membership_status( $membership_id, $new_status ) {

		// Check status.
		if ( 'publish' !== $new_status ) {
			return;
		}

		// Get membership.
		$membership = Models\Membership::query()->get_by_id( $membership_id );

		// Send email.
		$user = $membership->get_user();

		if ( $user ) {
			( new Emails\Membership_Activate(
				[
					'recipient' => $user->get_email(),

					'tokens'    => [
						'user'            => $user,
						'membership'      => $membership,
						'user_name'       => $user->get_display_name(),
						'membership_plan' => $membership->get_name(),
						'memberships_url' => hivepress()->router->get_url( 'memberships_view_page' ),
					],
				]
			) )->send();
		}
	}

	/**
	 * Updates order status.
	 *
	 * @param int      $order_id Order ID.
	 * @param string   $old_status Old status.
	 * @param string   $new_status New status.
	 * @param WC_Order $order Order object.
	 */
	public function update_order_status( $order_id, $old_status, $new_status, $order ) {

		// Check user.
		if ( ! $order->get_user_id() ) {
			return;
		}

		// Get product IDs.
		$product_ids = array_intersect( $this->get_plan_product_ids(), hivepress()->woocommerce->get_order_product_ids( $order ) );

		if ( empty( $product_ids ) ) {
			return;
		}

		// Get plans.
		$plans = Models\Membership_Plan::query()->filter(
			[
				'status'      => 'publish',
				'product__in' => $product_ids,
			]
		)->get();

		// Get memberships.
		$memberships = Models\Membership::query()->filter(
			[
				'status__in' => [ 'draft', 'pending', 'publish' ],
				'user'       => $order->get_user_id(),
				'plan__in'   => $plans->get_ids(),
			]
		);

		if ( in_array( $new_status, [ 'processing', 'completed' ], true ) ) {

			// Get plan IDs.
			$plan_ids = array_map(
				function( $membership ) {
					return $membership->get_plan__id();
				},
				$memberships->get()->serialize()
			);

			// Add memberships.
			foreach ( $plans as $plan ) {
				if ( ! in_array( $plan->get_id(), $plan_ids, true ) ) {

					// Get expiration.
					$expiration = null;

					if ( $plan->get_expire_period() ) {
						$expiration = time() + $plan->get_expire_period() * DAY_IN_SECONDS;
					}

					// Add membership.
					( new Models\Membership() )->fill(
						array_merge(
							$plan->serialize(),
							[
								'status'       => 'publish',
								'expired_time' => $expiration,
								'user'         => $order->get_user_id(),
								'plan'         => $plan->get_id(),
							]
						)
					)->save();
				}
			}
		} elseif ( in_array( $new_status, [ 'failed', 'cancelled', 'refunded' ], true ) ) {

			// Delete memberships.
			$memberships->delete();
		}
	}

	/**
	 * Redirects order page.
	 */
	public function redirect_order_page() {

		// Check authentication.
		if ( ! is_user_logged_in() || ! is_wc_endpoint_url( 'order-received' ) ) {
			return;
		}

		// Get order.
		$order = wc_get_order( get_query_var( 'order-received' ) );

		if ( empty( $order ) || ! in_array( $order->get_status(), [ 'processing', 'completed' ], true ) ) {
			return;
		}

		// Get product IDs.
		$product_ids = array_intersect( $this->get_plan_product_ids(), hivepress()->woocommerce->get_order_product_ids( $order ) );

		if ( empty( $product_ids ) ) {
			return;
		}

		// Redirect page.
		wp_safe_redirect( hivepress()->router->get_url( 'memberships_view_page' ) );

		exit;
	}

	/**
	 * Hides attributes.
	 *
	 * @param array $attributes Attribute arguments.
	 * @return array
	 */
	public function hide_attributes( $attributes ) {
		if ( ! current_user_can( 'edit_others_posts' ) ) {

			// Get model.
			$model = hp\get_array_value( explode( '/', current_filter() ), 3 );

			if ( $model && get_option( 'hp_membership_' . $model . '_restriction' ) ) {

				// Get plan.
				$plan = hivepress()->request->get_context( 'membership_plan' );

				if ( $plan ) {

					// Get attribute IDs.
					$attribute_ids = call_user_func( [ $plan, 'get_' . $model . '_attributes__id' ] );

					if ( $attribute_ids ) {

						// Get membership.
						$membership = hivepress()->request->get_context( 'membership' );

						// Get status.
						$restricted = get_option( 'hp_membership_limit_views' );

						foreach ( $attributes as $attribute_name => $attribute ) {

							// Get attribute ID.
							$attribute_id = hp\get_array_value( $attribute, 'id' );

							// Hide attribute.
							if ( in_array( $attribute_id, $attribute_ids, true ) ) {
								if ( ! $membership || ! in_array( $attribute_id, (array) call_user_func( [ $membership, 'get_' . $model . '_attributes__id' ] ), true ) ) {
									$attributes[ $attribute_name ]['edit_field']['_hidden'] = true;
								} else {
									if ( $restricted ) {
										$attributes[ $attribute_name ]['edit_field']['_restricted'] = true;
									}

									if ( 'attachment_upload' === $attribute['edit_field']['type'] ) {
										$attributes[ $attribute_name ]['edit_field']['_downloadable'] = true;
									}
								}
							}
						}
					}
				}
			}
		}

		return $attributes;
	}

	/**
	 * Hides fields.
	 *
	 * @param array  $fields Field arguments.
	 * @param object $model Model object.
	 * @return array
	 */
	public function hide_fields( $fields, $model ) {

		// Get user ID.
		$user_id = -1;

		if ( is_user_logged_in() ) {
			$user_id = (int) get_post_field( 'post_author', $model->get_id() );
		}

		if ( get_current_user_id() !== $user_id ) {

			// Get visibility.
			$visible = in_array( $model->get_id(), (array) hivepress()->request->get_context( 'membership_reveal_ids' ), true );

			if ( ! $visible ) {
				foreach ( $fields as $field_name => $field_args ) {

					// Get restriction.
					$restricted = hp\get_array_value( $field_args, '_restricted' );

					// Get modal.
					$modal = 'restrict_modal';

					if ( $restricted ) {
						$modal = 'reveal_modal_' . $model->get_id();
					}

					// Hide fields.
					if ( hp\get_array_value( $field_args, '_hidden' ) || $restricted ) {

						/* translators: %s: attribute label. */
						$fields[ $field_name ]['display_template'] = '<a href="#membership_' . $modal . '" class="hp-link"><i class="hp-icon fas fa-eye"></i><span>' . sprintf( esc_html__( 'Reveal %s', 'hivepress-memberships' ), hp\get_array_value( $field_args, 'label' ) ) . '</span></a>';
					} elseif ( hp\get_array_value( $field_args, '_downloadable' ) ) {

						// @todo Replace temporary fix.
						$attachment_id = absint( get_post_meta( $model->get_id(), hp\prefix( $field_name ), true ) );

						if ( $attachment_id ) {
							$fields[ $field_name ]['display_template'] = str_replace(
								'%value%',
								hivepress()->router->get_url( 'attachment_download_page', [ 'attachment_id' => $attachment_id ] ),
								$fields[ $field_name ]['display_template']
							);
						}
					}
				}
			}
		}

		return $fields;
	}

	/**
	 * Adds plan fields.
	 *
	 * @param array $model Model arguments.
	 * @return array
	 */
	public function add_plan_fields( $model ) {
		if ( hivepress()->get_version( 'requests' ) ) {
			$model['fields']['request_attributes'] = [
				'type'        => 'select',
				'options'     => 'posts',
				'option_args' => [ 'post_type' => 'hp_request_attribute' ],
				'multiple'    => true,
				'_external'   => true,
			];

			$model['fields']['offer'] = [
				'type'      => 'checkbox',
				'_external' => true,
			];
		}

		if ( hivepress()->get_version( 'messages' ) ) {
			$model['fields']['message'] = [
				'type'      => 'checkbox',
				'_external' => true,
			];
		}

		if ( hivepress()->get_version( 'reviews' ) ) {
			$model['fields']['review'] = [
				'type'      => 'checkbox',
				'_external' => true,
			];
		}

		return $model;
	}

	/**
	 * Validates message.
	 *
	 * @param array $errors Error messages.
	 * @return array
	 */
	public function validate_message( $errors ) {
		if ( empty( $errors ) && ! current_user_can( 'edit_others_posts' ) ) {

			// Get plan.
			$plan = hivepress()->request->get_context( 'membership_plan' );

			if ( $plan && ! $plan->has_message() ) {

				// Get membership.
				$membership = hivepress()->request->get_context( 'membership' );

				if ( ! $membership || ! $membership->has_message() ) {
					$errors[] = esc_html__( 'An active membership is required for this action.', 'hivepress-memberships' );
				}
			}
		}

		return $errors;
	}

	/**
	 * Validates review.
	 *
	 * @param array $errors Error messages.
	 * @return array
	 */
	public function validate_review( $errors ) {
		if ( empty( $errors ) && ! current_user_can( 'edit_others_posts' ) ) {

			// Get plan.
			$plan = hivepress()->request->get_context( 'membership_plan' );

			if ( $plan && ! $plan->has_review() ) {

				// Get membership.
				$membership = hivepress()->request->get_context( 'membership' );

				if ( ! $membership || ! $membership->has_review() ) {
					$errors[] = esc_html__( 'An active membership is required for this action.', 'hivepress-memberships' );
				}
			}
		}

		return $errors;
	}

	/**
	 * Adds membership admin columns.
	 *
	 * @param array $columns Columns.
	 * @return array
	 */
	public function add_membership_admin_columns( $columns ) {
		return array_merge(
			array_slice( $columns, 0, 2, true ),
			[
				'user'         => esc_html__( 'User', 'hivepress-memberships' ),
				'expired_time' => hivepress()->translator->get_string( 'expiration_date' ),
			],
			array_slice( $columns, 2, null, true )
		);
	}

	/**
	 * Renders membership admin columns.
	 *
	 * @param string $column Column name.
	 * @param int    $membership_id Membership ID.
	 */
	public function render_membership_admin_columns( $column, $membership_id ) {
		$output = '';

		if ( 'user' === $column ) {

			// Get user ID.
			$user_id = get_post_field( 'post_author', $membership_id );

			if ( $user_id ) {

				// Get user name.
				$name = get_the_author_meta( 'user_login', $user_id );

				// Get user URL.
				$url = admin_url(
					'user-edit.php?' . http_build_query(
						[
							'user_id' => $user_id,
						]
					)
				);

				// Render user link.
				$output = '<a href="' . esc_url( $url ) . '">' . esc_html( $name ) . '</a>';
			}
		} elseif ( 'expired_time' === $column ) {
			$output = '&mdash;';

			// Get expiration time.
			$expired_time = absint( get_post_meta( $membership_id, 'hp_expired_time', true ) );

			if ( $expired_time ) {

				// Render expiration date.
				$output = date_i18n( get_option( 'date_format' ), $expired_time );
			}
		}

		echo wp_kses_data( $output );
	}

	/**
	 * Alters settings.
	 *
	 * @param array $settings Settings configuration.
	 * @return array
	 */
	public function alter_settings( $settings ) {
		if ( ! hivepress()->get_version( 'requests' ) ) {
			unset( $settings['memberships']['sections']['restrictions']['fields']['membership_request_restriction'] );
			unset( $settings['memberships']['sections']['restrictions']['fields']['membership_offer_restriction'] );
		}

		if ( ! hivepress()->get_version( 'messages' ) ) {
			unset( $settings['memberships']['sections']['restrictions']['fields']['membership_message_restriction'] );
		}

		if ( ! hivepress()->get_version( 'reviews' ) ) {
			unset( $settings['memberships']['sections']['restrictions']['fields']['membership_review_restriction'] );
		}

		return $settings;
	}

	/**
	 * Alters plan settings.
	 *
	 * @param array $meta_box Meta box arguments.
	 * @return array
	 */
	public function alter_plan_settings( $meta_box ) {
		if ( ! get_option( 'hp_membership_listing_restriction' ) ) {
			unset( $meta_box['fields']['listing_attributes'] );
		}

		if ( ! get_option( 'hp_membership_vendor_restriction' ) ) {
			unset( $meta_box['fields']['vendor_attributes'] );
		}

		if ( ! hivepress()->get_version( 'requests' ) || ! get_option( 'hp_membership_request_restriction' ) ) {
			unset( $meta_box['fields']['request_attributes'] );
			unset( $meta_box['fields']['offer'] );
		}

		if ( ! hivepress()->get_version( 'messages' ) || ! get_option( 'hp_membership_message_restriction' ) ) {
			unset( $meta_box['fields']['message'] );
		}

		if ( ! hivepress()->get_version( 'reviews' ) || ! get_option( 'hp_membership_review_restriction' ) ) {
			unset( $meta_box['fields']['review'] );
		}

		if ( ! get_option( 'hp_membership_limit_views' ) ) {
			unset( $meta_box['fields']['view_limit'] );
		}

		return $meta_box;
	}

	/**
	 * Alters membership settings.
	 *
	 * @param array $meta_box Meta box arguments.
	 * @return array
	 */
	public function alter_membership_settings( $meta_box ) {
		if ( get_post_field( 'post_parent' ) ) {
			$meta_box['fields']['user']['disabled'] = true;
			$meta_box['fields']['plan']['disabled'] = true;
		} else {
			$meta_box['fields']['expired_time']['disabled'] = true;
		}

		return $meta_box;
	}

	/**
	 * Sets request context.
	 */
	public function set_request_context() {

		// Set models.
		$models = [ 'listing', 'vendor' ];

		// Set features.
		$features = [ 'message', 'review' ];

		if ( hivepress()->get_version( 'requests' ) ) {
			$models[]   = 'request';
			$features[] = 'offer';
		}

		// Get cached plan.
		$plan_args = hivepress()->cache->get_cache( 'membership_plan', 'models/membership_plan' );

		if ( is_null( $plan_args ) ) {
			$plan_args = [];

			// Get plans.
			$plans = Models\Membership_Plan::query()->filter(
				[
					'status' => 'publish',
				]
			)->get()
			->serialize();

			if ( $plans ) {
				foreach ( $models as $model ) {

					// Get attributes.
					$plan_args[ $model . '_attributes' ] = [];

					foreach ( $plans as $plan ) {
						$attributes = hp\get_array_value( $plan->serialize(), $model . '_attributes' );

						if ( $attributes ) {
							$plan_args[ $model . '_attributes' ] = array_merge( $plan_args[ $model . '_attributes' ], $attributes );
						}
					}

					$plan_args[ $model . '_attributes' ] = array_unique( $plan_args[ $model . '_attributes' ] );
				}

				// Get pages.
				$plan_args['pages'] = [];

				foreach ( $plans as $plan ) {
					$plan_args['pages'] = array_merge( $plan_args['pages'], (array) $plan->get_pages__id() );
				}
			}

			// Cache plan.
			hivepress()->cache->set_cache( 'membership_plan', 'models/membership_plan', $plan_args );
		}

		if ( $plan_args ) {

			// Get restrictions.
			foreach ( $features as $feature ) {
				$plan_args[ $feature ] = ! get_option( 'hp_membership_' . $feature . '_restriction' );
			}

			// Set request context.
			hivepress()->request->set_context( 'membership_plan', ( new Models\Membership_Plan() )->fill( $plan_args ) );
		}

		if ( is_user_logged_in() ) {

			// Get cached membership.
			$membership_args = hivepress()->cache->get_user_cache( get_current_user_id(), 'membership', 'models/membership' );

			if ( is_null( $membership_args ) ) {
				$membership_args = [];

				// Get memberships.
				$memberships = Models\Membership::query()->filter(
					[
						'status' => 'publish',
						'user'   => get_current_user_id(),
					]
				)->get()
				->serialize();

				if ( $memberships ) {
					foreach ( $models as $model ) {

						// Get attributes.
						$membership_args[ $model . '_attributes' ] = [];

						foreach ( $memberships as $membership ) {
							$attributes = hp\get_array_value( $membership->serialize(), $model . '_attributes' );

							if ( $attributes ) {
								$membership_args[ $model . '_attributes' ] = array_merge( $membership_args[ $model . '_attributes' ], $attributes );
							}
						}

						$membership_args[ $model . '_attributes' ] = array_unique( $membership_args[ $model . '_attributes' ] );
					}

					// Get restrictions.
					foreach ( $features as $feature ) {
						$membership_args[ $feature ] = hp\get_array_value( $plan_args, $feature, false );

						foreach ( $memberships as $membership ) {
							$restriction = hp\get_array_value( $membership->serialize(), $feature );

							if ( $restriction ) {
								$membership_args[ $feature ] = true;

								break;
							}
						}
					}

					// Get pages.
					$membership_args['pages'] = [];

					foreach ( $memberships as $membership ) {
						$membership_args['pages'] = array_merge( $membership_args['pages'], (array) $membership->get_pages__id() );
					}
				}

				// Cache membership.
				hivepress()->cache->set_user_cache( get_current_user_id(), 'membership', 'models/membership', $membership_args );
			}

			// Set request context.
			if ( $membership_args ) {
				hivepress()->request->set_context( 'membership', ( new Models\Membership() )->fill( $membership_args ) );
			}

			// Get cached membership count.
			$membership_count = hivepress()->cache->get_user_cache( get_current_user_id(), 'membership_count', 'models/membership' );

			if ( is_null( $membership_count ) ) {

				// Get membership count.
				$membership_count = Models\Membership::query()->filter(
					[
						'status__in' => [ 'draft', 'pending', 'publish' ],
						'user'       => get_current_user_id(),
					]
				)->get_count();

				// Cache membership count.
				hivepress()->cache->set_user_cache( get_current_user_id(), 'membership_count', 'models/membership', $membership_count );
			}

			// Set request context.
			hivepress()->request->set_context( 'membership_count', $membership_count );

			// Get reveal IDs.
			$reveal_ids = [];

			if ( get_option( 'hp_membership_limit_views' ) ) {
				$reveal_ids = (array) get_user_meta( get_current_user_id(), 'hp_membership_reveal_ids', true );
			}

			// Set request context.
			hivepress()->request->set_context( 'membership_reveal_ids', $reveal_ids );
		}
	}

	/**
	 * Redirects pages.
	 */
	public function redirect_pages() {

		// Check page.
		if ( ! is_page() || current_user_can( 'edit_others_posts' ) ) {
			return;
		}

		// Get plan.
		$plan = hivepress()->request->get_context( 'membership_plan' );

		if ( ! $plan ) {
			return;
		}

		// Check page ID.
		if ( ! in_array( get_the_ID(), (array) $plan->get_pages__id(), true ) ) {
			return;
		}

		// Get membership.
		$membership = hivepress()->request->get_context( 'membership' );

		if ( ! $membership || ! in_array( get_the_ID(), (array) $membership->get_pages__id(), true ) ) {

			// Redirect page.
			wp_safe_redirect( hivepress()->router->get_url( 'membership_plans_view_page' ) );

			exit;
		}
	}

	/**
	 * Alters user account menu.
	 *
	 * @param array $menu Menu arguments.
	 * @return array
	 */
	public function alter_user_account_menu( $menu ) {
		if ( hivepress()->request->get_context( 'membership_count' ) ) {
			$menu['items']['memberships_view'] = [
				'route'  => 'memberships_view_page',
				'_order' => 35,
			];
		}

		return $menu;
	}

	/**
	 * Alters site footer block.
	 *
	 * @param array $template Template arguments.
	 * @return array
	 */
	public function alter_site_footer_block( $template ) {
		return hp\merge_trees(
			$template,
			[
				'blocks' => [
					'modals' => [
						'blocks' => [
							'membership_restrict_modal' => [
								'type'   => 'modal',
								'title'  => esc_html__( 'Membership', 'hivepress-memberships' ),

								'blocks' => [
									'membership_restrict_message' => [
										'type'   => 'part',
										'path'   => 'membership/restrict/membership-restrict-message',
										'_order' => 10,
									],
								],
							],
						],
					],
				],
			]
		);
	}

	/**
	 * Alters message send modal.
	 *
	 * @param array $template Template arguments.
	 * @return array
	 */
	public function alter_message_send_modal( $template ) {
		if ( ! current_user_can( 'edit_others_posts' ) ) {

			// Get plan.
			$plan = hivepress()->request->get_context( 'membership_plan' );

			if ( $plan && ! $plan->has_message() ) {

				// Get membership.
				$membership = hivepress()->request->get_context( 'membership' );

				if ( ! $membership || ! $membership->has_message() ) {
					$template = hp\merge_trees(
						$template,
						[
							'blocks' => [
								'message_send_form' => [
									'type' => 'part',
									'path' => 'membership/restrict/membership-restrict-message',
								],
							],
						]
					);
				}
			}
		}

		return $template;
	}

	/**
	 * Alters review submit modal.
	 *
	 * @param array $template Template arguments.
	 * @return array
	 */
	public function alter_review_submit_modal( $template ) {
		if ( ! current_user_can( 'edit_others_posts' ) ) {

			// Get plan.
			$plan = hivepress()->request->get_context( 'membership_plan' );

			if ( $plan && ! $plan->has_review() ) {

				// Get membership.
				$membership = hivepress()->request->get_context( 'membership' );

				if ( ! $membership || ! $membership->has_review() ) {
					$template = hp\merge_trees(
						$template,
						[
							'blocks' => [
								'review_submit_form' => [
									'type' => 'part',
									'path' => 'membership/restrict/membership-restrict-message',
								],
							],
						]
					);
				}
			}
		}

		return $template;
	}

	/**
	 * Alters offer make modal.
	 *
	 * @param array $template Template arguments.
	 * @return array
	 */
	public function alter_offer_make_modal( $template ) {
		if ( ! current_user_can( 'edit_others_posts' ) ) {

			// Get plan.
			$plan = hivepress()->request->get_context( 'membership_plan' );

			if ( $plan && ! $plan->has_offer() ) {

				// Get membership.
				$membership = hivepress()->request->get_context( 'membership' );

				if ( ! $membership || ! $membership->has_offer() ) {
					$template = hp\merge_trees(
						$template,
						[
							'blocks' => [
								'offer_make_form' => [
									'type' => 'part',
									'path' => 'membership/restrict/membership-restrict-message',
								],
							],
						]
					);
				}
			}
		}

		return $template;
	}

	/**
	 * Alters membership view block.
	 *
	 * @param array $template Template arguments.
	 * @return array
	 */
	public function alter_membership_view_block( $template ) {
		return hp\merge_trees(
			$template,
			[
				'blocks' => [
					'membership_details_primary' => [
						'blocks' => [
							'membership_view_limit' => [
								'type'   => 'part',
								'path'   => 'membership/view/membership-view-limit',
								'_order' => 5,
							],
						],
					],
				],
			]
		);
	}

	/**
	 * Alters reveal view blocks.
	 *
	 * @param array $blocks Block arguments.
	 * @return array
	 */
	public function alter_reveal_view_blocks( $blocks ) {
		if ( is_user_logged_in() ) {

			// Get model.
			$model = hp\get_array_value( preg_split( '/(\/|_)/', current_filter() ), 3 );

			if ( $model ) {

				// Get container.
				$container = hp\get_first_array_value( array_keys( $blocks ) );

				if ( $container ) {

					// Add blocks.
					$blocks = hp\merge_trees(
						[
							'blocks' => $blocks,
						],
						[
							'blocks' => [
								$container => [
									'blocks' => [
										'membership_reveal_modal' => [
											'type'   => 'modal',
											'model'  => $model,
											'title'  => esc_html__( 'Reveal Details', 'hivepress-memberships' ),

											'blocks' => [
												'membership_reveal_form' => [
													'type' => 'membership_reveal_form',
													'model' => $model,
													'_order' => 10,
												],
											],
										],
									],
								],
							],
						]
					)['blocks'];
				}
			}
		}

		return $blocks;
	}
}
