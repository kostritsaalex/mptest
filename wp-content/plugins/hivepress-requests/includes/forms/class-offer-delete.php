<?php
/**
 * Offer delete form.
 *
 * @package HivePress\Forms
 */

namespace HivePress\Forms;

use HivePress\Helpers as hp;

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

/**
 * Deletes offer.
 */
class Offer_Delete extends Model_Form {

	/**
	 * Class initializer.
	 *
	 * @param array $meta Class meta values.
	 */
	public static function init( $meta = [] ) {
		$meta = hp\merge_arrays(
			[
				'model' => 'offer',
			],
			$meta
		);

		parent::init( $meta );
	}

	/**
	 * Class constructor.
	 *
	 * @param array $args Form arguments.
	 */
	public function __construct( $args = [] ) {
		$args = hp\merge_arrays(
			[
				'description' => esc_html__( 'Are you sure you want to permanently delete this offer?', 'hivepress-requests' ),
				'method'      => 'DELETE',
				'redirect'    => true,

				'button'      => [
					'label' => esc_html__( 'Delete Offer', 'hivepress-requests' ),
				],
			],
			$args
		);

		parent::__construct( $args );
	}

	/**
	 * Bootstraps form properties.
	 */
	protected function boot() {

		// Set action.
		if ( $this->model->get_id() ) {
			$this->action = hivepress()->router->get_url(
				'offer_delete_action',
				[
					'offer_id' => $this->model->get_id(),
				]
			);
		}

		parent::boot();
	}
}
