<?php
/**
 * Membership controller.
 *
 * @package HivePress\Controllers
 */

namespace HivePress\Controllers;

use HivePress\Helpers as hp;
use HivePress\Models;
use HivePress\Blocks;

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

/**
 * Membership controller class.
 *
 * @class Membership
 */
final class Membership extends Controller {

	/**
	 * Class constructor.
	 *
	 * @param array $args Controller arguments.
	 */
	public function __construct( $args = [] ) {
		$args = hp\merge_arrays(
			[
				'routes' => [
					'membership_reveal_action'    => [
						'path'   => '/memberships/reveal',
						'method' => 'POST',
						'action' => [ $this, 'reveal_membership' ],
						'rest'   => true,
					],

					'membership_plans_view_page'  => [
						'title'    => esc_html_x( 'Select Plan', 'imperative', 'hivepress-memberships' ),
						'path'     => '/select-plan',
						'redirect' => [ $this, 'redirect_membership_plans_view_page' ],
						'action'   => [ $this, 'render_membership_plans_view_page' ],
					],

					'membership_plan_select_page' => [
						'base'     => 'membership_plans_view_page',
						'path'     => '/(?P<membership_plan_id>\d+)',
						'redirect' => [ $this, 'redirect_membership_plan_select_page' ],
					],

					'memberships_view_page'       => [
						'title'    => esc_html__( 'Membership', 'hivepress-memberships' ),
						'base'     => 'user_account_page',
						'path'     => '/memberships',
						'redirect' => [ $this, 'redirect_memberships_view_page' ],
						'action'   => [ $this, 'render_memberships_view_page' ],
					],

					'attachment_download_page'    => [
						'path'     => '/download-attachment/(?P<attachment_id>\d+)',
						'redirect' => [ $this, 'redirect_attachment_download_page' ],
					],

					'listings_view_page'          => [
						'redirect' => [
							'membership' => [
								'callback' => [ $this, 'redirect_listings_view_page' ],
								'_order'   => 100,
							],
						],
					],

					'listing_view_page'           => [
						'redirect' => [
							'membership' => [
								'callback' => [ $this, 'redirect_listings_view_page' ],
								'_order'   => 100,
							],
						],
					],

					'vendors_view_page'           => [
						'redirect' => [
							'membership' => [
								'callback' => [ $this, 'redirect_vendors_view_page' ],
								'_order'   => 100,
							],
						],
					],

					'vendor_view_page'            => [
						'redirect' => [
							'membership' => [
								'callback' => [ $this, 'redirect_vendors_view_page' ],
								'_order'   => 100,
							],
						],
					],
				],
			],
			$args
		);

		parent::__construct( $args );
	}

	/**
	 * Reveals membership.
	 *
	 * @param WP_REST_Request $request API request.
	 * @return WP_Rest_Response
	 */
	public function reveal_membership( $request ) {

		// Check permissions.
		if ( ! get_option( 'hp_membership_limit_views' ) ) {
			return hp\rest_error( 403 );
		}

		// Check authentication.
		if ( ! is_user_logged_in() ) {
			return hp\rest_error( 401 );
		}

		// Get reveal ID.
		$reveal_id = absint( $request->get_param( 'reveal_id' ) );

		if ( ! $reveal_id || ! in_array( get_post_status( $reveal_id ), [ 'publish', 'private' ], true ) ) {
			return hp\rest_error( 400 );
		}

		// Get reveal IDs.
		$reveal_ids = (array) get_user_meta( get_current_user_id(), 'hp_membership_reveal_ids', true );

		if ( in_array( $reveal_id, $reveal_ids, true ) ) {
			return hp\rest_error( 400, esc_html__( 'The details are already revealed.', 'hivepress-memberships' ) );
		}

		// Get membership.
		$membership = Models\Membership::query()->filter(
			[
				'status'         => 'publish',
				'user'           => get_current_user_id(),
				'view_limit__gt' => 0,
			]
		)->order( [ 'view_limit' => 'desc' ] )
		->get_first();

		if ( ! $membership ) {
			return hp\rest_error( 401, esc_html__( 'An active membership is required for this action.', 'hivepress-memberships' ) );
		}

		if ( $membership->get_view_limit() > 1 ) {

			// Update view limit.
			$membership->set_view_limit( $membership->get_view_limit() - 1 )->save_view_limit();
		} elseif ( $membership->is_default() ) {

			// Update membership.
			$membership->fill(
				[
					'status'     => 'draft',
					'view_limit' => null,
				]
			)->save( [ 'status', 'view_limit' ] );
		} else {

			// Delete membership.
			$membership->delete();
		}

		// Add reveal ID.
		$reveal_ids[] = $reveal_id;

		update_user_meta( get_current_user_id(), 'hp_membership_reveal_ids', array_filter( $reveal_ids ) );

		return hp\rest_response(
			200,
			[
				'id' => $membership->get_id(),
			]
		);
	}

	/**
	 * Redirects membership plans view page.
	 *
	 * @return mixed
	 */
	public function redirect_membership_plans_view_page() {

		// Check plans.
		if ( ! hivepress()->request->get_context( 'membership_plan' ) ) {
			return true;
		}

		// Get page ID.
		$page_id = get_option( 'hp_page_membership_plans' );

		// Redirect page.
		if ( $page_id ) {
			return get_permalink( $page_id );
		}

		return false;
	}

	/**
	 * Renders membership plans view page.
	 *
	 * @return string
	 */
	public function render_membership_plans_view_page() {
		return ( new Blocks\Template(
			[
				'template' => 'membership_plans_view_page',
			]
		) )->render();
	}

	/**
	 * Redirects membership plan select page.
	 *
	 * @return mixed
	 */
	public function redirect_membership_plan_select_page() {

		// Get plan.
		$plan = Models\Membership_Plan::query()->get_by_id( hivepress()->request->get_param( 'membership_plan_id' ) );

		if ( ! $plan || $plan->get_status() !== 'publish' ) {
			return true;
		}

		// Check authentication.
		if ( ! is_user_logged_in() && ( ! hp\is_plugin_active( 'woocommerce' ) || ! $plan->get_product__id() ) ) {
			return hivepress()->router->get_return_url( 'user_login_page' );
		}

		// Get membership ID.
		$membership_id = null;

		if ( is_user_logged_in() ) {
			$membership_id = Models\Membership::query()->filter(
				[
					'status__in' => [ 'draft', 'pending', 'publish' ],
					'user'       => get_current_user_id(),
					'plan'       => $plan->get_id(),
				]
			)->get_first_id();
		}

		if ( ! $membership_id ) {
			if ( hp\is_plugin_active( 'woocommerce' ) && $plan->get_product__id() ) {

				// Add product to cart.
				WC()->cart->empty_cart();
				WC()->cart->add_to_cart( $plan->get_product__id() );

				return wc_get_page_permalink( 'checkout' );
			}

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
						'user'         => get_current_user_id(),
						'plan'         => $plan->get_id(),
						'default'      => true,
					]
				)
			)->save();

			return hivepress()->router->get_url( 'memberships_view_page' );
		}

		return hivepress()->router->get_url( 'membership_plans_view_page' );
	}

	/**
	 * Redirects memberships view page.
	 *
	 * @return mixed
	 */
	public function redirect_memberships_view_page() {

		// Check authentication.
		if ( ! is_user_logged_in() ) {
			return hivepress()->router->get_return_url( 'user_login_page' );
		}

		// Check memberships.
		if ( ! hivepress()->request->get_context( 'membership_count' ) ) {
			return hivepress()->router->get_url( 'user_account_page' );
		}

		return false;
	}

	/**
	 * Renders memberships view page.
	 *
	 * @return string
	 */
	public function render_memberships_view_page() {
		return ( new Blocks\Template(
			[
				'template' => 'memberships_view_page',
			]
		) )->render();
	}

	/**
	 * Redirects attachment download page.
	 *
	 * @return mixed
	 */
	public function redirect_attachment_download_page() {

		// Get redirect URL.
		$redirect_url = hivepress()->router->get_url( 'membership_plans_view_page' );

		// Get attachment.
		$attachment = Models\Attachment::query()->get_by_id( hivepress()->request->get_param( 'attachment_id' ) );

		if ( ! $attachment ) {
			return $redirect_url;
		}

		// Get model name.
		$model = $attachment->get_parent_model();

		if ( ! $model || ! $attachment->get_parent_field() ) {
			return $redirect_url;
		}

		// Get membership.
		$membership = hivepress()->request->get_context( 'membership' );

		if ( ! $membership ) {
			return $redirect_url;
		}

		// Get attribute.
		$attribute = hp\get_array_value( hivepress()->attribute->get_attributes( $model ), $attachment->get_parent_field() );

		if ( ! $attribute || ! isset( $attribute['id'] ) ) {
			return $redirect_url;
		}

		// Get attribute IDs.
		$attribute_ids = (array) call_user_func( [ $membership, 'get_' . $model . '_attributes__id' ] );

		if ( ! in_array( $attribute['id'], $attribute_ids, true ) ) {
			return $redirect_url;
		}

		// Get file path.
		$file_path = get_attached_file( $attachment->get_id() );

		if ( ! $file_path ) {
			return $redirect_url;
		}

		// Get file type.
		$file_type = get_post_mime_type( $attachment->get_id() );

		if ( ! $file_type ) {
			return $redirect_url;
		}

		// Get file details.
		$file_name = basename( $file_path );
		$file_size = filesize( $file_path );

		// Download file.
		header( 'Content-Type: ' . $file_type );
		header( 'Content-disposition: attachment; filename="' . $file_name . '"' );
		header( 'Content-Length: ' . $file_size );

		readfile( $file_path );

		exit;
	}

	/**
	 * Redirects listings view page.
	 *
	 * @return mixed
	 */
	public function redirect_listings_view_page() {

		// Check authentication.
		if ( current_user_can( 'edit_others_posts' ) ) {
			return false;
		}

		// Get plan.
		$plan = hivepress()->request->get_context( 'membership_plan' );

		if ( ! $plan ) {
			return false;
		}

		// Get restriction.
		$restriction = get_option( 'hp_membership_listing_restriction' );

		// Get listing.
		$listing = hivepress()->request->get_context( 'listing' );

		if ( $listing ) {

			// Check restriction.
			if ( ! in_array( $restriction, [ 'all_pages', 'single_pages' ], true ) ) {
				return false;
			}

			// Check user.
			if ( get_current_user_id() === $listing->get_user__id() ) {
				return false;
			}
		}

		// Check restriction.
		if ( ! $listing && 'all_pages' !== $restriction ) {
			return false;
		}

		// Get membership.
		$membership = hivepress()->request->get_context( 'membership' );

		// Check membership.
		if ( $membership ) {
			return false;
		}

		return hivepress()->router->get_url( 'membership_plans_view_page' );
	}

	/**
	 * Redirects vendors view page.
	 *
	 * @return mixed
	 */
	public function redirect_vendors_view_page() {

		// Check authentication.
		if ( current_user_can( 'edit_others_posts' ) ) {
			return false;
		}

		// Get plan.
		$plan = hivepress()->request->get_context( 'membership_plan' );

		if ( ! $plan ) {
			return false;
		}

		// Get restriction.
		$restriction = get_option( 'hp_membership_vendor_restriction' );

		// Get vendor.
		$vendor = hivepress()->request->get_context( 'vendor' );

		if ( $vendor ) {

			// Check restriction.
			if ( ! in_array( $restriction, [ 'all_pages', 'single_pages' ], true ) ) {
				return false;
			}

			// Check user.
			if ( get_current_user_id() === $vendor->get_user__id() ) {
				return false;
			}
		}

		// Check restriction.
		if ( ! $vendor && 'all_pages' !== $restriction ) {
			return false;
		}

		// Get membership.
		$membership = hivepress()->request->get_context( 'membership' );

		// Check membership.
		if ( $membership ) {
			return false;
		}

		return hivepress()->router->get_url( 'membership_plans_view_page' );
	}
}
