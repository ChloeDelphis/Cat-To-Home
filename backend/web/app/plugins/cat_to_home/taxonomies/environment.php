<?php

/**
 * Registers the `environment` taxonomy,
 * for use with 'cat'.
 */
function environment_init() {
	register_taxonomy( 'environment', [ 'cat' ], [
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
			'name'                       => __( 'Environments', 'cat_to_home' ),
			'singular_name'              => _x( 'Environment', 'taxonomy general name', 'cat_to_home' ),
			'search_items'               => __( 'Search Environments', 'cat_to_home' ),
			'popular_items'              => __( 'Popular Environments', 'cat_to_home' ),
			'all_items'                  => __( 'All Environments', 'cat_to_home' ),
			'parent_item'                => __( 'Parent Environment', 'cat_to_home' ),
			'parent_item_colon'          => __( 'Parent Environment:', 'cat_to_home' ),
			'edit_item'                  => __( 'Edit Environment', 'cat_to_home' ),
			'update_item'                => __( 'Update Environment', 'cat_to_home' ),
			'view_item'                  => __( 'View Environment', 'cat_to_home' ),
			'add_new_item'               => __( 'Add New Environment', 'cat_to_home' ),
			'new_item_name'              => __( 'New Environment', 'cat_to_home' ),
			'separate_items_with_commas' => __( 'Separate environments with commas', 'cat_to_home' ),
			'add_or_remove_items'        => __( 'Add or remove environments', 'cat_to_home' ),
			'choose_from_most_used'      => __( 'Choose from the most used environments', 'cat_to_home' ),
			'not_found'                  => __( 'No environments found.', 'cat_to_home' ),
			'no_terms'                   => __( 'No environments', 'cat_to_home' ),
			'menu_name'                  => __( 'Environments', 'cat_to_home' ),
			'items_list_navigation'      => __( 'Environments list navigation', 'cat_to_home' ),
			'items_list'                 => __( 'Environments list', 'cat_to_home' ),
			'most_used'                  => _x( 'Most Used', 'environment', 'cat_to_home' ),
			'back_to_items'              => __( '&larr; Back to Environments', 'cat_to_home' ),
		],
		'show_in_rest'          => true,
		'rest_base'             => 'environment',
		'rest_controller_class' => 'WP_REST_Terms_Controller',
	] );

}

add_action( 'init', 'environment_init' );

/**
 * Sets the post updated messages for the `environment` taxonomy.
 *
 * @param  array $messages Post updated messages.
 * @return array Messages for the `environment` taxonomy.
 */
function environment_updated_messages( $messages ) {

	$messages['environment'] = [
		0 => '', // Unused. Messages start at index 1.
		1 => __( 'Environment added.', 'cat_to_home' ),
		2 => __( 'Environment deleted.', 'cat_to_home' ),
		3 => __( 'Environment updated.', 'cat_to_home' ),
		4 => __( 'Environment not added.', 'cat_to_home' ),
		5 => __( 'Environment not updated.', 'cat_to_home' ),
		6 => __( 'Environments deleted.', 'cat_to_home' ),
	];

	return $messages;
}

add_filter( 'term_updated_messages', 'environment_updated_messages' );
