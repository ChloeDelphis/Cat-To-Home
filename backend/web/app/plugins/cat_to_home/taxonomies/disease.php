<?php

/**
 * Registers the `disease` taxonomy,
 * for use with 'cat'.
 */
function disease_init() {
	register_taxonomy( 'disease', [ 'cat' ], [
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
			'name'                       => __( 'Diseases', 'cat_to_home' ),
			'singular_name'              => _x( 'Disease', 'taxonomy general name', 'cat_to_home' ),
			'search_items'               => __( 'Search Diseases', 'cat_to_home' ),
			'popular_items'              => __( 'Popular Diseases', 'cat_to_home' ),
			'all_items'                  => __( 'All Diseases', 'cat_to_home' ),
			'parent_item'                => __( 'Parent Disease', 'cat_to_home' ),
			'parent_item_colon'          => __( 'Parent Disease:', 'cat_to_home' ),
			'edit_item'                  => __( 'Edit Disease', 'cat_to_home' ),
			'update_item'                => __( 'Update Disease', 'cat_to_home' ),
			'view_item'                  => __( 'View Disease', 'cat_to_home' ),
			'add_new_item'               => __( 'Add New Disease', 'cat_to_home' ),
			'new_item_name'              => __( 'New Disease', 'cat_to_home' ),
			'separate_items_with_commas' => __( 'Separate diseases with commas', 'cat_to_home' ),
			'add_or_remove_items'        => __( 'Add or remove diseases', 'cat_to_home' ),
			'choose_from_most_used'      => __( 'Choose from the most used diseases', 'cat_to_home' ),
			'not_found'                  => __( 'No diseases found.', 'cat_to_home' ),
			'no_terms'                   => __( 'No diseases', 'cat_to_home' ),
			'menu_name'                  => __( 'Diseases', 'cat_to_home' ),
			'items_list_navigation'      => __( 'Diseases list navigation', 'cat_to_home' ),
			'items_list'                 => __( 'Diseases list', 'cat_to_home' ),
			'most_used'                  => _x( 'Most Used', 'disease', 'cat_to_home' ),
			'back_to_items'              => __( '&larr; Back to Diseases', 'cat_to_home' ),
		],
		'show_in_rest'          => true,
		'rest_base'             => 'disease',
		'rest_controller_class' => 'WP_REST_Terms_Controller',
	] );

}

add_action( 'init', 'disease_init' );

/**
 * Sets the post updated messages for the `disease` taxonomy.
 *
 * @param  array $messages Post updated messages.
 * @return array Messages for the `disease` taxonomy.
 */
function disease_updated_messages( $messages ) {

	$messages['disease'] = [
		0 => '', // Unused. Messages start at index 1.
		1 => __( 'Disease added.', 'cat_to_home' ),
		2 => __( 'Disease deleted.', 'cat_to_home' ),
		3 => __( 'Disease updated.', 'cat_to_home' ),
		4 => __( 'Disease not added.', 'cat_to_home' ),
		5 => __( 'Disease not updated.', 'cat_to_home' ),
		6 => __( 'Diseases deleted.', 'cat_to_home' ),
	];

	return $messages;
}

add_filter( 'term_updated_messages', 'disease_updated_messages' );
