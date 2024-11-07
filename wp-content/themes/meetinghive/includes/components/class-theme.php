<?php
/**
 * Theme component.
 *
 * @package HiveTheme\Components
 */

namespace HiveTheme\Components;

use HiveTheme\Helpers as ht;
use HivePress\Helpers as hp;

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

/**
 * Theme component class.
 *
 * @class Theme
 */
final class Theme extends Component {

	/**
	 * Class constructor.
	 *
	 * @param array $args Component arguments.
	 */
	public function __construct( $args = [] ) {

		// Set hero background.
		add_action( 'wp_enqueue_scripts', [ $this, 'set_hero_background' ] );

		// Render hero content.
		add_filter( 'hivetheme/v1/areas/site_hero', [ $this, 'render_hero_content' ] );

		// Alter settings.
		add_action( 'customize_register', [ $this, 'alter_settings' ] );

		// Alter styles.
		add_filter( 'hivetheme/v1/styles', [ $this, 'alter_styles' ] );
		add_filter( 'hivepress/v1/styles', [ $this, 'alter_styles' ] );

		// Check HivePress status.
		if ( ! ht\is_plugin_active( 'hivepress' ) ) {
			return;
		}

		// Alter strings.
		add_filter( 'hivepress/v1/strings', [ $this, 'alter_strings' ] );

		// Alter blocks.
		add_filter( 'hivepress/v1/blocks/vendors/meta', [ $this, 'alter_slider_block_meta' ] );
		add_filter( 'hivepress/v1/blocks/testimonials/meta', [ $this, 'alter_slider_block_meta' ] );

		add_filter( 'hivepress/v1/blocks/vendors', [ $this, 'alter_slider_block_args' ], 10, 2 );
		add_filter( 'hivepress/v1/blocks/testimonials', [ $this, 'alter_slider_block_args' ], 10, 2 );

		// Alter models.
		add_filter( 'hivepress/v1/models/listing_category', [ $this, 'alter_listing_category_fields' ] );

		if ( is_admin() ) {

			// Alter meta boxes.
			add_filter( 'hivepress/v1/meta_boxes/listing_category_settings', [ $this, 'alter_listing_category_settings' ] );
		} else {

			// Alter forms.
			add_filter( 'hivepress/v1/forms/listing_filter', [ $this, 'alter_form_args' ], 10, 2 );
			add_filter( 'hivepress/v1/forms/request_filter', [ $this, 'alter_form_args' ], 10, 2 );
			add_filter( 'hivepress/v1/forms/vendor_filter', [ $this, 'alter_form_args' ], 10, 2 );
			add_filter( 'hivepress/v1/forms/listing_buy', [ $this, 'alter_form_args' ], 10, 2 );
			add_filter( 'hivepress/v1/forms/booking_make', [ $this, 'alter_form_args' ], 10, 2 );

			// Alter templates.
			add_filter( 'hivepress/v1/templates/listing_category_view_block/blocks', [ $this, 'alter_listing_category_view_block' ], 100, 2 );
			add_filter( 'hivepress/v1/templates/listing_categories_view_page', [ $this, 'alter_listing_categories_view_page' ], 100 );

			add_filter( 'hivepress/v1/templates/listing_view_block/blocks', [ $this, 'alter_listing_view_block' ], 100, 2 );
			add_filter( 'hivepress/v1/templates/listing_view_page', [ $this, 'alter_listing_view_page' ], 100 );

			add_filter( 'hivepress/v1/templates/listings_view_page', [ $this, 'alter_listings_view_page' ], 100 );
			add_filter( 'hivepress/v1/templates/vendor_view_page', [ $this, 'alter_listings_view_page' ], 100 );
			add_filter( 'hivepress/v1/templates/listings_favorite_page', [ $this, 'alter_listings_view_page' ], 100 );

			add_filter( 'hivepress/v1/templates/user_view_block', [ $this, 'alter_user_view_block' ], 100 );
			add_filter( 'hivepress/v1/templates/vendor_view_block', [ $this, 'alter_vendor_view_block' ], 100 );
			add_filter( 'hivepress/v1/templates/vendor_view_page', [ $this, 'alter_vendor_view_page' ], 100 );

			add_filter( 'hivepress/v1/templates/listing_package_view_block', [ $this, 'alter_listing_package_view_block' ], 100 );
			add_filter( 'hivepress/v1/templates/membership_plan_view_block', [ $this, 'alter_membership_plan_view_block' ], 100 );

			add_filter( 'hivepress/v1/templates/offer_view_block', [ $this, 'alter_offer_view_block' ], 100 );
			add_filter( 'hivepress/v1/templates/request_view_block', [ $this, 'alter_request_view_block' ], 100 );
			add_filter( 'hivepress/v1/templates/request_view_page', [ $this, 'alter_request_view_page' ], 100 );

			add_filter( 'hivepress/v1/templates/booking_view_block', [ $this, 'alter_booking_view_block' ], 100 );
			add_filter( 'hivepress/v1/templates/booking_view_page', [ $this, 'alter_booking_view_page' ], 100 );

			add_filter( 'hivepress/v1/templates/testimonial_view_block', [ $this, 'alter_testimonial_view_block' ], 100 );
		}

		parent::__construct( $args );
	}

	/**
	 * Sets hero background.
	 */
	public function set_hero_background() {

		// Get image URL.
		$image_url = get_header_image();

		if ( is_page() && has_post_thumbnail() ) {
			$image_url = get_the_post_thumbnail_url( null, 'ht_cover_large' );
		}

		// Add inline style.
		if ( $image_url ) {
			wp_add_inline_style( 'hivetheme-core-frontend', '.header-hero--large,.header-hero--medium{background-image:url(' . esc_url( $image_url ) . ')}' );
		}
	}

	/**
	 * Renders hero content.
	 *
	 * @param string $output Hero content.
	 * @return string
	 */
	public function render_hero_content( $output ) {
		$classes = [];

		// Render header.
		if ( is_page() ) {

			// Get content.
			$content = '';

			$parts = get_extended( get_post_field( 'post_content' ) );

			if ( $parts['extended'] ) {
				$content = apply_filters( 'the_content', $parts['main'] );

				$classes[] = 'header-hero--large';
			} else {
				$classes[] = 'header-hero--title';
			}

			// Check title.
			$title = get_the_ID() !== absint( get_option( 'page_on_front' ) );

			if ( ht\is_plugin_active( 'hivepress' ) ) {

				// @todo change condition when common category pages are added.
				$title = $title && ! hivepress()->request->get_context( 'post_query' ) && hivepress()->router->get_current_route_name() !== 'listings_view_page';
			}

			// Render part.
			if ( $content ) {
				$output .= $content;
			} elseif ( $title ) {
				$output .= hivetheme()->template->render_part( 'templates/page/page-title' );
			}
		} elseif ( is_singular( 'post' ) ) {

			// Add classes.
			$classes = array_merge(
				$classes,
				[
					'post',
					'post--single',
					'header-hero--medium',
				]
			);

			if ( has_post_thumbnail() ) {
				$classes[] = 'has-post-thumbnail';
			}

			// Render part.
			$output .= hivetheme()->template->render_part( 'templates/post/single/post-header' );
		} elseif ( ht\is_plugin_active( 'hivepress' ) && is_tax( 'hp_listing_category' ) ) {

			// Add classes.
			$classes = array_merge(
				$classes,
				[
					'hp-listing-category',
					'hp-listing-category--view-page',
					'header-hero--medium',
				]
			);

			// Render part.
			$output .= hivetheme()->template->render_part(
				'hivepress/listing-category/view/page/listing-category-header',
				[
					'listing_category' => \HivePress\Models\Listing_Category::query()->get_by_id( get_queried_object() ),
				]
			);
		}

		// Add wrapper.
		if ( $output ) {
			$output = hivetheme()->template->render_part(
				'templates/page/page-header',
				[
					'class'   => implode( ' ', $classes ),
					'content' => $output,
				]
			);
		}

		return $output;
	}

	/**
	 * Alters styles.
	 *
	 * @param array $styles Styles.
	 * @return array
	 */
	public function alter_styles( $styles ) {
		$styles['fontawesome']['src'] = hivetheme()->get_url( 'parent' ) . '/assets/css/fontawesome.min.css';

		unset( $styles['fontawesome_solid'] );

		return $styles;
	}

	/**
	 * Alters settings.
	 *
	 * @param WP_Customize_Manager $wp_customize Customizer object.
	 */
	public function alter_settings( $wp_customize ) {
		$wp_customize->remove_control( 'header_textcolor' );
	}

	/**
	 * Alters strings.
	 *
	 * @param array $strings Strings.
	 * @return array
	 */
	public function alter_strings( $strings ) {
		if ( isset( $strings['send_message'] ) ) {
			$strings['reply_to_listing'] = $strings['send_message'];
		}

		return $strings;
	}

	/**
	 * Alters slider block meta.
	 *
	 * @param array $meta Block meta.
	 * @return array
	 */
	public function alter_slider_block_meta( $meta ) {
		$meta['settings']['slider'] = [
			'label'  => esc_html__( 'Display in a slider', 'meetinghive' ),
			'type'   => 'checkbox',
			'_order' => 100,
		];

		return $meta;
	}

	/**
	 * Alters slider block arguments.
	 *
	 * @param array  $args Block arguments.
	 * @param object $block Block object.
	 * @return array
	 */
	public function alter_slider_block_args( $args, $block ) {
		if ( hp\get_array_value( $args, 'slider' ) ) {
			$attributes = [
				'data-component' => 'slider',
				'data-type'      => 'carousel',
				'class'          => [ 'hp-' . $block::get_meta( 'name' ) . '--slider', 'content-slider', 'alignfull' ],
			];

			if ( $block::get_meta( 'name' ) === 'testimonials' ) {
				$attributes['data-width'] = 640;
			}

			$args['attributes'] = hp\merge_arrays(
				hp\get_array_value( $args, 'attributes', [] ),
				$attributes
			);
		}

		return $args;
	}

	/**
	 * Alters form arguments.
	 *
	 * @param array  $form_args Form arguments.
	 * @param object $form Form object.
	 * @return array
	 */
	public function alter_form_args( $form_args, $form ) {

		// Get attributes.
		$icon    = 'filter';
		$classes = [];

		if ( in_array( $form::get_meta( 'name' ), [ 'listing_buy', 'booking_make' ] ) ) {
			$icon = 'arrow-right';
		} else {
			$classes[] = 'button--secondary';
		}

		// Add attributes.
		$form_args['button']['attributes'] = hp\merge_arrays(
			$form_args['button']['attributes'],
			[
				'data-component' => 'button',
				'data-icon'      => $icon,
				'class'          => $classes,
			]
		);

		return $form_args;
	}

	/**
	 * Alters listing category fields.
	 *
	 * @param array $model Model.
	 * @return array
	 */
	public function alter_listing_category_fields( $model ) {
		$model['fields']['icon'] = [
			'type'      => 'select',
			'options'   => 'icons',
			'_external' => true,
		];

		return $model;
	}

	/**
	 * Alters listing category settings.
	 *
	 * @param array $meta_box Meta box.
	 * @return array
	 */
	public function alter_listing_category_settings( $meta_box ) {
		$meta_box['fields']['icon'] = [
			'label'   => esc_html__( 'Icon', 'meetinghive' ),
			'type'    => 'select',
			'options' => 'icons',
			'_order'  => 5,
		];

		// @todo Use the color type when available.
		$meta_box['fields']['color'] = [
			'label'   => esc_html__( 'Color', 'meetinghive' ),
			'type'    => 'text',
			'pattern' => '#[A-Fa-f0-9]{3,6}',
			'_order'  => 10,
		];

		unset( $meta_box['fields']['image'] );

		return $meta_box;
	}

	/**
	 * Alters listing category view block.
	 *
	 * @param array  $blocks Template blocks.
	 * @param object $template Template object.
	 * @return array
	 */
	public function alter_listing_category_view_block( $blocks, $template ) {

		// Get category.
		$category = $template->get_context( 'listing_category' );

		if ( $category ) {

			// Get color.
			$color = sanitize_hex_color( get_term_meta( $category->get_id(), 'hp_color', true ) );

			if ( $color ) {

				// Set color.
				$blocks = hivepress()->template->merge_blocks(
					$blocks,
					[
						'listing_category_container' => [
							'attributes' => [
								'style' => 'background-color:' . $color,
							],
						],
					]
				);
			}
		}

		return hivepress()->template->merge_blocks(
			$blocks,
			[
				'listing_category_details_primary' => [
					'_order' => 100,

					'blocks' => [
						'listing_category_link' => [
							'type'   => 'part',
							'path'   => 'listing-category/view/block/listing-category-link',
							'_order' => 100,
						],
					],
				],
			]
		);
	}

	/**
	 * Alters listing categories view page.
	 *
	 * @param array $template Template arguments.
	 * @return array
	 */
	public function alter_listing_categories_view_page( $template ) {
		return hivepress()->template->merge_blocks(
			$template,
			[
				'listing_categories' => [
					'columns' => 4,
				],
			]
		);
	}

	/**
	 * Alters listing view block.
	 *
	 * @param array  $blocks Template blocks.
	 * @param object $template Template object.
	 * @return array
	 */
	public function alter_listing_view_block( $blocks, $template ) {

		// Remove blocks.
		$badge = hivepress()->template->fetch_block( $blocks, 'listing_featured_badge' );

		hivepress()->template->fetch_blocks( $blocks, [ 'listing_header', 'listing_created_date' ] );

		// Add blocks.
		$blocks = hivepress()->template->merge_blocks(
			$blocks,
			[
				'listing_title'                => [
					'blocks' => [
						'listing_featured_badge' => array_merge(
							$badge,
							[
								'_order' => 30,
							]
						),
					],
				],

				'listing_details_primary'      => [
					'_order' => 5,
				],

				'listing_attributes_secondary' => [
					'type'       => 'container',

					'attributes' => [
						'class' => [ 'hp-listing__attributes', 'hp-listing__attributes--secondary' ],
					],

					'blocks'     => [
						'listing_attributes_secondary_loop' => [
							'type'   => 'part',
							'path'   => 'listing/view/block/listing-attributes-secondary',
							'_order' => 20,
						],
					],
				],
			]
		);

		if ( hivepress()->get_version( 'geolocation' ) ) {
			$location = hivepress()->template->fetch_block( $blocks, 'listing_location' );

			if ( $location ) {
				$blocks = hivepress()->template->merge_blocks(
					$blocks,
					[
						'listing_attributes_secondary' => [
							'blocks' => [
								'listing_location' => array_merge(
									$location,
									[
										'_order' => 10,
									]
								),
							],
						],
					]
				);
			}
		}

		if ( get_option( 'hp_vendor_enable_display' ) ) {

			// Get listing.
			$listing = $template->get_context( 'listing' );

			if ( $listing ) {

				// Get vendor.
				$vendor = $listing->get_vendor();

				if ( $vendor && $vendor->get_status() === 'publish' ) {

					// Set context.
					$template->set_context( 'vendor', $vendor );

					// Add blocks.
					$blocks = hivepress()->template->merge_blocks(
						$blocks,
						[
							'listing_attributes_secondary' => [
								'blocks' => [
									'listing_vendor' => [
										'type'       => 'container',
										'_order'     => 5,

										'attributes' => [
											'class' => [ 'hp-listing__attribute', 'hp-vendor', 'hp-vendor--embed-block' ],
										],

										'blocks'     => [
											'vendor_image' => [
												'type'   => 'part',
												'path'   => 'vendor/view/block/vendor-image',
												'_order' => 10,
											],

											'vendor_name'  => [
												'type'   => 'container',
												'tag'    => 'span',
												'_order' => 20,

												'attributes' => [
													'class' => [ 'hp-vendor__name' ],
												],

												'blocks' => [
													'vendor_name_text' => [
														'type' => 'part',
														'path' => 'vendor/view/block/vendor-name',
														'_order' => 10,
													],
												],
											],
										],
									],
								],
							],
						]
					);
				}
			}
		}

		return $blocks;
	}

	/**
	 * Alters listing view page.
	 *
	 * @param array $template Template arguments.
	 * @return array
	 */
	public function alter_listing_view_page( $template ) {

		// Remove blocks.
		hivepress()->template->fetch_block( $template, 'listing_created_date' );

		// Add blocks.
		$template = hivepress()->template->merge_blocks(
			$template,
			[
				'related_listings'             => [
					'columns' => 1,
				],

				'listing_details_primary'      => [
					'_order' => 5,
				],

				'listing_attributes_secondary' => [
					'type'       => 'container',
					'_order'     => 25,

					'attributes' => [
						'class' => [ 'hp-listing__attributes', 'hp-listing__attributes--secondary' ],
					],

					'blocks'     => [
						'listing_attributes_secondary_loop' => [
							'type'   => 'part',
							'path'   => 'listing/view/page/listing-attributes-secondary',
							'_order' => 20,
						],
					],
				],

				'page_sidebar'                 => [
					'blocks' => [
						'listing_extras' => [
							'type'       => 'container',
							'_order'     => 10,

							'attributes' => [
								'class' => [ 'hp-listing__extras', 'hp-widget', 'widget' ],
							],

							'blocks'     => [
								'listing_attributes_primary' => hivepress()->template->fetch_block( $template, 'listing_attributes_primary' ),
							],
						],
					],
				],
			]
		);

		if ( hivepress()->get_version( 'geolocation' ) ) {
			$location = hivepress()->template->fetch_block( $template, 'listing_location' );

			if ( $location ) {
				$template = hivepress()->template->merge_blocks(
					$template,
					[
						'listing_attributes_secondary' => [
							'blocks' => [
								'listing_location' => array_merge(
									$location,
									[
										'_order' => 10,
									]
								),
							],
						],
					]
				);
			}
		}

		if ( hivepress()->get_version( 'bookings' ) ) {
			$template = hivepress()->template->merge_blocks(
				$template,
				[
					'listing_extras' => [
						'blocks' => [
							'booking_make_form' => hivepress()->template->fetch_block( $template, 'booking_make_form' ),
						],
					],
				]
			);
		} elseif ( hivepress()->get_version( 'marketplace' ) ) {
			$template = hivepress()->template->merge_blocks(
				$template,
				[
					'listing_extras' => [
						'blocks' => [
							'listing_buy_form' => hivepress()->template->fetch_block( $template, 'listing_buy_form' ),
						],
					],
				]
			);
		}

		return $template;
	}

	/**
	 * Alters listings view page.
	 *
	 * @param array $template Template arguments.
	 * @return array
	 */
	public function alter_listings_view_page( $template ) {
		return hivepress()->template->merge_blocks(
			$template,
			[
				'listings' => [
					'columns' => 1,
				],
			]
		);
	}

	/**
	 * Alters user view block.
	 *
	 * @param array $template Template arguments.
	 * @return array
	 */
	public function alter_user_view_block( $template ) {
		return hivepress()->template->merge_blocks(
			$template,
			[
				'user_container' => [
					'blocks' => [
						'user_summary' => [
							'type'       => 'container',
							'_order'     => 10,

							'attributes' => [
								'class' => [ 'hp-vendor__summary' ],
							],

							'blocks'     => [
								'user_header'  => hivepress()->template->fetch_block( $template, 'user_header' ),
								'user_content' => hivepress()->template->fetch_block( $template, 'user_content' ),
							],
						],
					],
				],
			]
		);
	}

	/**
	 * Alters vendor view block.
	 *
	 * @param array $template Template arguments.
	 * @return array
	 */
	public function alter_vendor_view_block( $template ) {
		$template = hivepress()->template->merge_blocks(
			$template,
			[
				'vendor_container' => [
					'blocks' => [
						'vendor_summary' => [
							'type'       => 'container',
							'_order'     => 10,

							'attributes' => [
								'class' => [ 'hp-vendor__summary' ],
							],

							'blocks'     => [
								'vendor_header'  => hivepress()->template->fetch_block( $template, 'vendor_header' ),
								'vendor_content' => hivepress()->template->fetch_block( $template, 'vendor_content' ),
							],
						],
					],
				],
			]
		);

		if ( hivepress()->get_version( 'reviews' ) ) {
			$template = hivepress()->template->merge_blocks(
				$template,
				[
					'vendor_rating' => [
						'_order' => 5,
					],
				]
			);
		}

		$template = hivepress()->template->merge_blocks(
			$template,
			[
				'vendor_attributes_secondary' => [
					'type'       => 'container',

					'attributes' => [
						'class' => [ 'hp-vendor__attributes', 'hp-vendor__attributes--secondary' ],
					],

					'blocks'     => [
						'vendor_attributes_secondary_loop' => [
							'type'   => 'part',
							'path'   => 'vendor/view/block/vendor-attributes-secondary',
							'_order' => 20,
						],
					],
				],
			]
		);

		if ( hivepress()->get_version( 'geolocation' ) ) {
			$location = hivepress()->template->fetch_block( $template, 'vendor_location' );

			if ( $location ) {
				$template = hivepress()->template->merge_blocks(
					$template,
					[
						'vendor_attributes_secondary' => [
							'blocks' => [
								'vendor_location' => array_merge(
									$location,
									[
										'_order' => 10,
									]
								),
							],
						],
					]
				);
			}
		}

		return $template;
	}

	/**
	 * Alters vendor view page.
	 *
	 * @param array $template Template arguments.
	 * @return array
	 */
	public function alter_vendor_view_page( $template ) {
		$template = hivepress()->template->merge_blocks(
			$template,
			[
				'page_sidebar' => [
					'blocks' => [
						'vendor_extras' => [
							'type'       => 'container',
							'_order'     => 20,

							'attributes' => [
								'class' => [ 'hp-vendor__extras', 'hp-widget', 'widget' ],
							],

							'blocks'     => [
								'vendor_attributes_primary' => hivepress()->template->fetch_block( $template, 'vendor_attributes_primary' ),
								'vendor_actions_primary' => hivepress()->template->fetch_block( $template, 'vendor_actions_primary' ),
							],
						],
					],
				],
			]
		);

		if ( hivepress()->get_version( 'reviews' ) ) {
			$template = hivepress()->template->merge_blocks(
				$template,
				[
					'vendor_rating' => [
						'_order' => 5,
					],
				]
			);
		}

		$template = hivepress()->template->merge_blocks(
			$template,
			[
				'vendor_attributes_secondary' => [
					'type'       => 'container',

					'attributes' => [
						'class' => [ 'hp-vendor__attributes', 'hp-vendor__attributes--secondary' ],
					],

					'blocks'     => [
						'vendor_attributes_secondary_loop' => [
							'type'   => 'part',
							'path'   => 'vendor/view/page/vendor-attributes-secondary',
							'_order' => 20,
						],
					],
				],
			]
		);

		if ( hivepress()->get_version( 'geolocation' ) ) {
			$location = hivepress()->template->fetch_block( $template, 'vendor_location' );

			if ( $location ) {
				$template = hivepress()->template->merge_blocks(
					$template,
					[
						'vendor_attributes_secondary' => [
							'blocks' => [
								'vendor_location' => array_merge(
									$location,
									[
										'_order' => 10,
									]
								),
							],
						],
					]
				);
			}
		}

		return $template;
	}

	/**
	 * Alters listing package view block.
	 *
	 * @param array $template Template arguments.
	 * @return array
	 */
	public function alter_listing_package_view_block( $template ) {
		return hivepress()->template->merge_blocks(
			$template,
			[
				'listing_package_container' => [
					'blocks' => [
						'listing_package_summary' => [
							'type'       => 'container',
							'_order'     => 10,

							'attributes' => [
								'class' => [ 'hp-listing-package__summary' ],
							],

							'blocks'     => [
								'listing_package_header'  => hivepress()->template->fetch_block( $template, 'listing_package_header' ),
								'listing_package_content' => hivepress()->template->fetch_block( $template, 'listing_package_content' ),
							],
						],
					],
				],
			]
		);
	}

	/**
	 * Alters membership plan view block.
	 *
	 * @param array $template Template arguments.
	 * @return array
	 */
	public function alter_membership_plan_view_block( $template ) {
		return hivepress()->template->merge_blocks(
			$template,
			[
				'membership_plan_container' => [
					'blocks' => [
						'membership_plan_summary' => [
							'type'       => 'container',
							'_order'     => 10,

							'attributes' => [
								'class' => [ 'hp-membership-plan__summary' ],
							],

							'blocks'     => [
								'membership_plan_header'  => hivepress()->template->fetch_block( $template, 'membership_plan_header' ),
								'membership_plan_content' => hivepress()->template->fetch_block( $template, 'membership_plan_content' ),
							],
						],
					],
				],
			]
		);
	}

	/**
	 * Alters booking view page.
	 *
	 * @param array $template Template arguments.
	 * @return array
	 */
	public function alter_booking_view_page( $template ) {
		return hivepress()->template->merge_blocks(
			$template,
			[
				'booking_details_primary'      => [
					'attributes' => [
						'class' => [ 'hp-booking__details', 'hp-booking__details--primary' ],
					],
				],

				'booking_attributes_secondary' => [
					'type'       => 'container',
					'_order'     => 25,

					'attributes' => [
						'class' => [ 'hp-listing__attributes', 'hp-listing__attributes--secondary' ],
					],

					'blocks'     => [
						'booking_attributes_secondary_loop' => [
							'type'   => 'part',
							'path'   => 'booking/view/page/booking-attributes-secondary',
							'_order' => 10,
						],
					],
				],

				'booking_sidebar'              => [
					'blocks' => [
						'booking_extras' => [
							'type'       => 'container',
							'_order'     => 10,

							'attributes' => [
								'class' => [ 'hp-listing__extras', 'hp-widget', 'widget' ],
							],

							'blocks'     => [
								'booking_attributes_primary' => hivepress()->template->fetch_block( $template, 'booking_attributes_primary' ),
							],
						],
					],
				],
			]
		);
	}

	/**
	 * Alters booking view block.
	 *
	 * @param array $template Template arguments.
	 * @return array
	 */
	public function alter_booking_view_block( $template ) {
		return hivepress()->template->merge_blocks(
			$template,
			[
				'booking_attributes_secondary' => [
					'type'       => 'container',

					'attributes' => [
						'class' => [ 'hp-listing__attributes', 'hp-listing__attributes--secondary' ],
					],

					'blocks'     => [
						'booking_attributes_secondary_loop' => [
							'type'   => 'part',
							'path'   => 'booking/view/block/booking-attributes-secondary',
							'_order' => 10,
						],
					],
				],
			]
		);
	}

	/**
	 * Alters request view page.
	 *
	 * @param array $template Template arguments.
	 * @return array
	 */
	public function alter_request_view_page( $template ) {

		// Remove blocks.
		hivepress()->template->fetch_block( $template, 'request_created_date' );

		// Add blocks.
		$template = hivepress()->template->merge_blocks(
			$template,
			[
				'request_details_primary'      => [
					'_order' => 5,
				],

				'request_attributes_secondary' => [
					'type'       => 'container',
					'_order'     => 25,

					'attributes' => [
						'class' => [ 'hp-listing__attributes', 'hp-listing__attributes--secondary' ],
					],

					'blocks'     => [
						'request_attributes_secondary_loop' => [
							'type'   => 'part',
							'path'   => 'request/view/page/request-attributes-secondary',
							'_order' => 20,
						],
					],
				],

				'page_sidebar'                 => [
					'blocks' => [
						'request_extras' => [
							'type'       => 'container',
							'_order'     => 10,

							'attributes' => [
								'class' => [ 'hp-listing__extras', 'hp-widget', 'widget' ],
							],

							'blocks'     => [
								'request_attributes_primary' => hivepress()->template->fetch_block( $template, 'request_attributes_primary' ),
							],
						],
					],
				],
			]
		);

		if ( hivepress()->get_version( 'geolocation' ) ) {
			$location = hivepress()->template->fetch_block( $template, 'request_location' );

			if ( $location ) {
				$template = hivepress()->template->merge_blocks(
					$template,
					[
						'request_attributes_secondary' => [
							'blocks' => [
								'request_location' => array_merge(
									$location,
									[
										'_order' => 10,
									]
								),
							],
						],
					]
				);
			}
		}

		return $template;
	}

	/**
	 * Alters request view block.
	 *
	 * @param array $template Template arguments.
	 * @return array
	 */
	public function alter_request_view_block( $template ) {

		// Remove blocks.
		hivepress()->template->fetch_block( $template, 'request_created_date' );

		// Add blocks.
		$template = hivepress()->template->merge_blocks(
			$template,
			[
				'request_attributes_secondary' => [
					'type'       => 'container',

					'attributes' => [
						'class' => [ 'hp-listing__attributes', 'hp-listing__attributes--secondary' ],
					],

					'blocks'     => [
						'request_attributes_secondary_loop' => [
							'type'   => 'part',
							'path'   => 'request/view/block/request-attributes-secondary',
							'_order' => 20,
						],
					],
				],
			]
		);

		if ( hivepress()->get_version( 'geolocation' ) ) {
			$location = hivepress()->template->fetch_block( $template, 'request_location' );

			if ( $location ) {
				$template = hivepress()->template->merge_blocks(
					$template,
					[
						'request_attributes_secondary' => [
							'blocks' => [
								'request_location' => array_merge(
									$location,
									[
										'_order' => 10,
									]
								),
							],
						],
					]
				);
			}
		}

		return $template;
	}

	/**
	 * Alters offer view block.
	 *
	 * @param array $template Template arguments.
	 * @return array
	 */
	public function alter_offer_view_block( $template ) {
		return hivepress()->template->merge_blocks(
			$template,
			[
				'offer_container' => [
					'blocks' => [
						'offer_wrapper' => [
							'type'       => 'container',
							'_order'     => 10,

							'attributes' => [
								'class' => [ 'hp-offer__wrapper' ],
							],

							'blocks'     => [
								'offer_header'  => hivepress()->template->fetch_block( $template, 'offer_header' ),
								'offer_content' => hivepress()->template->fetch_block( $template, 'offer_content' ),
							],
						],
					],
				],
			]
		);
	}

	/**
	 * Alters testimonial view block.
	 *
	 * @param array $template Template arguments.
	 * @return array
	 */
	public function alter_testimonial_view_block( $template ) {
		return hivepress()->template->merge_blocks(
			$template,
			[
				'testimonial_summary' => [
					'blocks' => [
						'testimonial_image'   => hivepress()->template->fetch_block( $template, 'testimonial_image' ),

						'testimonial_details' => [
							'type'   => 'container',
							'_order' => 20,

							'blocks' => hivepress()->template->fetch_blocks( $template, [ 'testimonial_author', 'testimonial_position' ] ),
						],
					],
				],
			]
		);
	}
}
