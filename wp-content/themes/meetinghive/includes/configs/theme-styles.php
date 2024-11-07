<?php
/**
 * Theme styles configuration.
 *
 * @package HiveTheme\Configs
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

return [
	[
		'selector'   => '
			.wp-block-button.is-style-primary .wp-block-button__link,
			.hp-vendor--view-block .hp-vendor__actions--primary .hp-vendor__action--message,
			.hp-listing--view-block .hp-listing__actions--primary .hp-listing__action--message,
			.post__readmore
		',

		'properties' => [
			[
				'name'      => 'background-color',
				'theme_mod' => 'primary_color',
			],
		],
	],

	[
		'selector'   => '
			.hp-listing--view-page .hp-listing__images-carousel .slick-current img
		',

		'properties' => [
			[
				'name'      => 'border-color',
				'theme_mod' => 'primary_color',
			],
		],
	],

	[
		'selector'   => '
			.wp-block-button.is-style-secondary .wp-block-button__link,
			button[type="submit"].button--secondary,
			.button--secondary
		',

		'properties' => [
			[
				'name'      => 'background-color',
				'theme_mod' => 'secondary_color',
			],
		],
	],

	[
		'selector'   => '
			body.customize-support,
			.content-section
		',

		'properties' => [
			[
				'name'      => 'background-color',
				'theme_mod' => 'secondary_background',
			],
		],
	],
];
