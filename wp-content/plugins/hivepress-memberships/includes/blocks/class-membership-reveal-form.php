<?php
/**
 * Membership reveal form block.
 *
 * @package HivePress\Blocks
 */

namespace HivePress\Blocks;

use HivePress\Helpers as hp;

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

/**
 * Membership reveal form block class.
 *
 * @class Membership_Reveal_Form
 */
class Membership_Reveal_Form extends Form {

	/**
	 * Model name.
	 *
	 * @var string
	 */
	protected $model;

	/**
	 * Class constructor.
	 *
	 * @param array $args Block arguments.
	 */
	public function __construct( $args = [] ) {
		$args = hp\merge_arrays(
			[
				'form' => 'membership_reveal',
			],
			$args
		);

		parent::__construct( $args );
	}

	/**
	 * Bootstraps block properties.
	 */
	protected function boot() {

		// Get ID.
		$reveal_id = 0;

		if ( $this->model ) {
			$object = $this->get_context( $this->model );

			if ( hp\is_class_instance( $object, '\HivePress\Models\\' . $this->model ) ) {
				$reveal_id = $object->get_id();
			}
		}

		$this->values['reveal_id'] = $reveal_id;

		parent::boot();
	}
}
