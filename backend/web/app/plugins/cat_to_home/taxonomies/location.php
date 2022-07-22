<?php

/**
 * Registers the `location` taxonomy,
 * for use with 'cat'.
 */
function location_init() {
	register_taxonomy( 'location', [ 'cat' ], [
		'hierarchical'          => false,
		'public'                => true,
		'show_in_nav_menus'     => true,
		'show_ui'               => true,
		'show_admin_column'     => true,
		'query_var'             => true,
		'rewrite'               => true,
		'capabilities'          => [
			'manage_terms' => 'edit_posts',
			'edit_terms'   => 'edit_posts',
			'delete_terms' => 'edit_posts',
			'assign_terms' => 'edit_posts',
		],
		'labels'                => [
			'name'                       => __( 'Locations', 'cat_to_home' ),
			'singular_name'              => _x( 'Location', 'taxonomy general name', 'cat_to_home' ),
			'search_items'               => __( 'Search Locations', 'cat_to_home' ),
			'popular_items'              => __( 'Popular Locations', 'cat_to_home' ),
			'all_items'                  => __( 'All Locations', 'cat_to_home' ),
			'parent_item'                => __( 'Parent Location', 'cat_to_home' ),
			'parent_item_colon'          => __( 'Parent Location:', 'cat_to_home' ),
			'edit_item'                  => __( 'Edit Location', 'cat_to_home' ),
			'update_item'                => __( 'Update Location', 'cat_to_home' ),
			'view_item'                  => __( 'View Location', 'cat_to_home' ),
			'add_new_item'               => __( 'Add New Location', 'cat_to_home' ),
			'new_item_name'              => __( 'New Location', 'cat_to_home' ),
			'separate_items_with_commas' => __( 'Separate locations with commas', 'cat_to_home' ),
			'add_or_remove_items'        => __( 'Add or remove locations', 'cat_to_home' ),
			'choose_from_most_used'      => __( 'Choose from the most used locations', 'cat_to_home' ),
			'not_found'                  => __( 'No locations found.', 'cat_to_home' ),
			'no_terms'                   => __( 'No locations', 'cat_to_home' ),
			'menu_name'                  => __( 'Locations', 'cat_to_home' ),
			'items_list_navigation'      => __( 'Locations list navigation', 'cat_to_home' ),
			'items_list'                 => __( 'Locations list', 'cat_to_home' ),
			'most_used'                  => _x( 'Most Used', 'location', 'cat_to_home' ),
			'back_to_items'              => __( '&larr; Back to Locations', 'cat_to_home' ),
		],
		'show_in_rest'          => true,
		'rest_base'             => 'location',
		'rest_controller_class' => 'WP_REST_Terms_Controller',
	] );

}

add_action( 'init', 'location_init' );

/**
 * Sets the post updated messages for the `location` taxonomy.
 *
 * @param  array $messages Post updated messages.
 * @return array Messages for the `location` taxonomy.
 */
function location_updated_messages( $messages ) {

	$messages['location'] = [
		0 => '', // Unused. Messages start at index 1.
		1 => __( 'Location added.', 'cat_to_home' ),
		2 => __( 'Location deleted.', 'cat_to_home' ),
		3 => __( 'Location updated.', 'cat_to_home' ),
		4 => __( 'Location not added.', 'cat_to_home' ),
		5 => __( 'Location not updated.', 'cat_to_home' ),
		6 => __( 'Locations deleted.', 'cat_to_home' ),
	];

	return $messages;
}

add_filter( 'term_updated_messages', 'location_updated_messages' );
