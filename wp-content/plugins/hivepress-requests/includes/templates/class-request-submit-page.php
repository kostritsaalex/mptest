<?php
/**
 * Request submit page template.
 *
 * @package HivePress\Templates
 */

namespace HivePress\Templates;

use HivePress\Helpers as hp;

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

/**
 * Request submit page template class.
 *
 * @class Request_Submit_Page
 */
abstract class Request_Submit_Page extends Page_Wide {

	/**
	 * Class constructor.
	 *
	 * @param array $args Template arguments.
	 */
	public function __construct( $args = [] ) {
		$args = hp\merge_trees(
			[
				'blocks' => [
					'page_content' => [],
				],
			],
			$args
		);

		parent::__construct( $args );
	}
}
