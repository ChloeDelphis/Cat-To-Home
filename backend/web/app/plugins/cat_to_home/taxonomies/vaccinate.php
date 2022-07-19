<?php

/**
 * Registers the `vaccinate` taxonomy,
 * for use with 'cat'.
 */
function vaccinate_init() {
	register_taxonomy( 'vaccinate', [ 'cat' ], [
		'hierarchical'          => false,
		'public'                => true,
		'show_in_nav_menus'     => true,
		'show_ui'               => true,
		'show_admin_column'     => false,
		'query_var'             => true,
		'rewrite'               => true,
		'capabilities'          => [
			'manage_terms' => 'edit_posts',
			'edit_terms'   => 'edit_posts',
			'delete_terms' => 'edit_posts',
			'assign_terms' => 'edit_posts',
		],
		'labels'                => [
			'name'                       => __( 'Vaccinates', 'cat_to_home' ),
			'singular_name'              => _x( 'Vaccinate', 'taxonomy general name', 'cat_to_home' ),
			'search_items'               => __( 'Search Vaccinates', 'cat_to_home' ),
			'popular_items'              => __( 'Popular Vaccinates', 'cat_to_home' ),
			'all_items'                  => __( 'All Vaccinates', 'cat_to_home' ),
			'parent_item'                => __( 'Parent Vaccinate', 'cat_to_home' ),
			'parent_item_colon'          => __( 'Parent Vaccinate:', 'cat_to_home' ),
			'edit_item'                  => __( 'Edit Vaccinate', 'cat_to_home' ),
			'update_item'                => __( 'Update Vaccinate', 'cat_to_home' ),
			'view_item'                  => __( 'View Vaccinate', 'cat_to_home' ),
			'add_new_item'               => __( 'Add New Vaccinate', 'cat_to_home' ),
			'new_item_name'              => __( 'New Vaccinate', 'cat_to_home' ),
			'separate_items_with_commas' => __( 'Separate vaccinates with commas', 'cat_to_home' ),
			'add_or_remove_items'        => __( 'Add or remove vaccinates', 'cat_to_home' ),
			'choose_from_most_used'      => __( 'Choose from the most used vaccinates', 'cat_to_home' ),
			'not_found'                  => __( 'No vaccinates found.', 'cat_to_home' ),
			'no_terms'                   => __( 'No vaccinates', 'cat_to_home' ),
			'menu_name'                  => __( 'Vaccinates', 'cat_to_home' ),
			'items_list_navigation'      => __( 'Vaccinates list navigation', 'cat_to_home' ),
			'items_list'                 => __( 'Vaccinates list', 'cat_to_home' ),
			'most_used'                  => _x( 'Most Used', 'vaccinate', 'cat_to_home' ),
			'back_to_items'              => __( '&larr; Back to Vaccinates', 'cat_to_home' ),
		],
		'show_in_rest'          => true,
		'rest_base'             => 'vaccinate',
		'rest_controller_class' => 'WP_REST_Terms_Controller',
	] );

}

add_action( 'init', 'vaccinate_init' );

/**
 * Sets the post updated messages for the `vaccinate` taxonomy.
 *
 * @param  array $messages Post updated messages.
 * @return array Messages for the `vaccinate` taxonomy.
 */
function vaccinate_updated_messages( $messages ) {

	$messages['vaccinate'] = [
		0 => '', // Unused. Messages start at index 1.
		1 => __( 'Vaccinate added.', 'cat_to_home' ),
		2 => __( 'Vaccinate deleted.', 'cat_to_home' ),
		3 => __( 'Vaccinate updated.', 'cat_to_home' ),
		4 => __( 'Vaccinate not added.', 'cat_to_home' ),
		5 => __( 'Vaccinate not updated.', 'cat_to_home' ),
		6 => __( 'Vaccinates deleted.', 'cat_to_home' ),
	];

	return $messages;
}

add_filter( 'term_updated_messages', 'vaccinate_updated_messages' );
