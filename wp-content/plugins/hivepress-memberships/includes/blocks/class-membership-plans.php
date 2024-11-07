<?php
/**
 * Membership plans block.
 *
 * @package HivePress\Blocks
 */

namespace HivePress\Blocks;

use HivePress\Helpers as hp;
use HivePress\Models;

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

/**
 * Membership plans block class.
 *
 * @class Membership_Plans
 */
class Membership_Plans extends Block {

	/**
	 * Class initializer.
	 *
	 * @param array $meta Block meta.
	 */
	public static function init( $meta = [] ) {
		$meta = hp\merge_arrays(
			[
				'label' => esc_html__( 'Membership Plans', 'hivepress-memberships' ),
			],
			$meta
		);

		parent::init( $meta );
	}

	/**
	 * Renders block HTML.
	 *
	 * @return string
	 */
	public function render() {
		$output = '';

		// Get plans.
		$plans = Models\Membership_Plan::query()->filter(
			[
				'status' => 'publish',
			]
		)->order( [ 'sort_order' => 'asc' ] )
		->get()->serialize();

		if ( $plans ) {

			// Get column width.
			$columns      = count( $plans );
			$column_width = 3;

			if ( $columns < 4 ) {
				$column_width = round( 12 / $columns );
			}

			// Get memberships.
			$memberships = [];

			if ( is_user_logged_in() ) {
				$memberships = Models\Membership::query()->filter(
					[
						'status__in' => [ 'draft', 'pending', 'publish' ],
						'user'       => get_current_user_id(),
					]
				)->get()->serialize();

				$memberships = array_combine(
					array_map(
						function( $membership ) {
							return $membership->get_plan__id();
						},
						$memberships
					),
					$memberships
				);
			}

			// Render plans.
			$output  = '<div class="hp-membership-plans hp-grid hp-block">';
			$output .= '<div class="hp-row">';

			foreach ( $plans as $plan ) {

				// Render plan.
				$output .= '<div class="hp-grid__item hp-col-sm-' . esc_attr( $column_width ) . ' hp-col-xs-12">';

				$output .= ( new Template(
					[
						'template' => 'membership_plan_view_block',

						'context'  => [
							'membership_plan' => $plan,
							'membership'      => hp\get_array_value( $memberships, $plan->get_id() ),
						],
					]
				) )->render();

				$output .= '</div>';
			}

			$output .= '</div>';
			$output .= '</div>';
		}

		return $output;
	}
}
