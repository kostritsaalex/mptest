<?php
/**
 * Theme mods configuration.
 *
 * @package HiveTheme\Configs
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

return [
	'header_image' => [
		'fields' => [
			'header_image_parallax' => [
				'label'   => esc_html__( 'Enable parallax effect', 'meetinghive' ),
				'type'    => 'checkbox',
				'default' => true,
			],
		],
	],

	'colors'       => [
		'fields' => [
			'primary_color'        => [
				'default' => '#FFCD4D',
			],

			'secondary_color'      => [
				'default' => '#B6CDFB',
			],

			'secondary_background' => [
				'label'   => esc_html__( 'Background Color', 'meetinghive' ),
				'type'    => 'color',
				'default' => '#F5F0EE',
			],
		],
	],

	'fonts'        => [
		'fields' => [
			'heading_font'        => [
				'default' => 'Plus Jakarta Sans',
			],

			'heading_font_weight' => [
				'default' => '700',
			],

			'body_font'           => [
				'default' => 'Figtree',
			],

			'body_font_weight'    => [
				'default' => '400,500',
			],
		],
	],
];
