<?php
/**
 * Taxonomies configuration.
 *
 * @package HivePress\Configs
 */

use HivePress\Helpers as hp;

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

return [
	'request_category' => [
		'post_type'         => [ 'request', 'request_attribute' ],
		'hierarchical'      => true,
		'public'            => false,
		'show_ui'           => true,
		'show_admin_column' => true,
		'rewrite'           => [ 'slug' => 'request-category' ],

		'labels'            => [
			'name'          => hivepress()->translator->get_string( 'categories' ),
			'singular_name' => hivepress()->translator->get_string( 'category' ),
			'add_new_item'  => hivepress()->translator->get_string( 'add_category' ),
			'edit_item'     => hivepress()->translator->get_string( 'edit_category' ),
			'update_item'   => hivepress()->translator->get_string( 'update_category' ),
			'view_item'     => hivepress()->translator->get_string( 'view_category' ),
			'parent_item'   => hivepress()->translator->get_string( 'parent_category' ),
			'search_items'  => hivepress()->translator->get_string( 'search_categories' ),
			'not_found'     => hivepress()->translator->get_string( 'no_categories_found' ),
		],
	],
];
