<?php
/**
 * Memberships block.
 *
 * @package HivePress\Blocks
 */

namespace HivePress\Blocks;

use HivePress\Helpers as hp;
use HivePress\Models;

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

/**
 * Memberships block class.
 *
 * @class Memberships
 */
class Memberships extends Block {

	/**
	 * Renders block HTML.
	 *
	 * @return string
	 */
	public function render() {
		$output = '';

		if ( is_user_logged_in() ) {

			// Get memberships.
			$memberships = Models\Membership::query()->filter(
				[
					'status__in' => [ 'draft', 'pending', 'publish' ],
					'user'       => get_current_user_id(),
				]
			)->order( [ 'created_date' => 'desc' ] )
			->get()->serialize();

			// Render memberships.
			if ( $memberships ) {
				$output  = '<div class="hp-memberships hp-grid hp-block">';
				$output .= '<div class="hp-row">';

				foreach ( $memberships as $membership ) {

					// Render membership.
					$output .= '<div class="hp-grid__item hp-col-xs-12">';

					$output .= ( new Template(
						[
							'template' => 'membership_view_block',

							'context'  => [
								'membership' => $membership,
							],
						]
					) )->render();

					$output .= '</div>';
				}

				$output .= '</div>';
				$output .= '</div>';
			}
		}

		return $output;
	}
}
