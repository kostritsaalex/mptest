<?php
/**
 * Membership model.
 *
 * @package HivePress\Models
 */

namespace HivePress\Models;

use HivePress\Helpers as hp;

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

/**
 * Membership model class.
 *
 * @class Membership
 */
class Membership extends Membership_Plan {

	/**
	 * Class constructor.
	 *
	 * @param array $args Model arguments.
	 */
	public function __construct( $args = [] ) {
		$args = hp\merge_arrays(
			[
				'fields' => [
					'status'       => [
						'type'    => 'select',
						'_alias'  => 'post_status',

						'options' => [
							'publish'    => esc_html_x( 'Active', 'membership', 'hivepress-memberships' ),
							'future'     => '',
							'draft'      => esc_html_x( 'Expired', 'membership', 'hivepress-memberships' ),
							'pending'    => esc_html_x( 'Paused', 'membership', 'hivepress-memberships' ),
							'private'    => '',
							'trash'      => '',
							'auto-draft' => '',
							'inherit'    => '',
						],
					],

					'created_date' => [
						'type'   => 'date',
						'format' => 'Y-m-d H:i:s',
						'_alias' => 'post_date',
					],

					'expired_time' => [
						'type'      => 'number',
						'min_value' => 0,
						'_external' => true,
					],

					'default'      => [
						'type'      => 'checkbox',
						'_external' => true,
					],

					'user'         => [
						'type'      => 'number',
						'min_value' => 1,
						'required'  => true,
						'_alias'    => 'post_author',
						'_model'    => 'user',
					],

					'plan'         => [
						'type'      => 'number',
						'min_value' => 1,
						'required'  => true,
						'_alias'    => 'post_parent',
						'_model'    => 'membership_plan',
					],
				],
			],
			$args
		);

		parent::__construct( $args );
	}

	/**
	 * Bootstraps model properties.
	 */
	protected function boot() {

		// Remove fields.
		unset( $this->fields['description'] );
		unset( $this->fields['sort_order'] );
		unset( $this->fields['expire_period'] );
		unset( $this->fields['product'] );

		parent::boot();
	}
}
