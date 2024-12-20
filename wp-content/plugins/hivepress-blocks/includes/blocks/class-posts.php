<?php
/**
 * Posts block.
 *
 * @package HivePress\Blocks
 */

namespace HivePress\Blocks;

use HivePress\Helpers as hp;

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

/**
 * Posts block class.
 *
 * @class Posts
 */
class Posts extends Block {

	/**
	 * Columns number.
	 *
	 * @var int
	 */
	protected $columns;

	/**
	 * Posts number.
	 *
	 * @var int
	 */
	protected $number;

	/**
	 * Post category ID.
	 *
	 * @var int
	 */
	protected $category;

	/**
	 * Posts order.
	 *
	 * @var string
	 */
	protected $order;

	/**
	 * Container attributes.
	 *
	 * @var array
	 */
	protected $attributes = [];

	/**
	 * Class initializer.
	 *
	 * @param array $meta Block meta.
	 */
	public static function init( $meta = [] ) {
		$meta = hp\merge_arrays(
			[
				'label'    => esc_html__( 'Posts', 'hivepress-blocks' ),

				'settings' => [
					'columns'  => [
						'label'    => hivepress()->translator->get_string( 'columns_number' ),
						'type'     => 'select',
						'default'  => 3,
						'required' => true,
						'_order'   => 10,

						'options'  => [
							1 => '1',
							2 => '2',
							3 => '3',
						],
					],

					'number'   => [
						'label'     => hivepress()->translator->get_string( 'items_number' ),
						'type'      => 'number',
						'min_value' => 1,
						'default'   => 3,
						'required'  => true,
						'_order'    => 20,
					],

					'category' => [
						'label'       => hivepress()->translator->get_string( 'category' ),
						'type'        => 'select',
						'options'     => 'terms',
						'option_args' => [ 'taxonomy' => 'category' ],
						'_order'      => 30,
					],

					'order'    => [
						'label'    => hivepress()->translator->get_string( 'sort_order' ),
						'type'     => 'select',
						'required' => true,
						'_order'   => 40,

						'options'  => [
							'created_date' => hivepress()->translator->get_string( 'by_date_added' ),
							'random'       => hivepress()->translator->get_string( 'by_random' ),
						],
					],
				],
			],
			$meta
		);

		parent::init( $meta );
	}

	/**
	 * Bootstraps block properties.
	 */
	protected function boot() {

		// Set attributes.
		$this->attributes = hp\merge_arrays(
			$this->attributes,
			[
				'class' => [ 'hp-posts', 'hp-block', 'hp-grid' ],
			]
		);

		parent::boot();
	}

	/**
	 * Renders block HTML.
	 *
	 * @return string
	 */
	public function render() {
		$output = '';

		if ( $this->number ) {

			// Get column width.
			$column_width = hp\get_column_width( $this->columns );

			// Set query arguments.
			$query_args = [
				'post_status'    => 'publish',
				'posts_per_page' => $this->number,
			];

			if ( $this->category ) {
				$query_args['cat'] = $this->category;
			}

			if ( 'random' === $this->order ) {
				$query_args['orderby'] = 'rand';
			}

			// Query posts.
			$query = new \WP_Query( $query_args );

			// Render posts.
			if ( $query->have_posts() ) {
				$output  = '<div ' . hp\html_attributes( $this->attributes ) . '>';
				$output .= '<div class="hp-row">';

				while ( $query->have_posts() ) {
					$query->the_post();

					// Render post.
					$output .= '<div class="hp-grid__item hp-col-sm-' . esc_attr( $column_width ) . ' hp-col-xs-12">';

					ob_start();

					get_template_part( 'templates/post-archive' );
					$output .= ob_get_contents();

					ob_end_clean();

					$output .= '</div>';
				}

				$output .= '</div>';
				$output .= '</div>';
			}

			// Reset query.
			wp_reset_postdata();
		}

		return $output;
	}
}
