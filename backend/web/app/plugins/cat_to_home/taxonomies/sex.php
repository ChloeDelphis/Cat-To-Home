<?php

/**
 * Registers the `sex` taxonomy,
 * for use with 'cat'.
 */
function sex_init() {
	register_taxonomy( 'sex', [ 'cat' ], [
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
			'name'                       => __( 'Sexes', 'cat_to_home' ),
			'singular_name'              => _x( 'Sex', 'taxonomy general name', 'cat_to_home' ),
			'search_items'               => __( 'Search Sexes', 'cat_to_home' ),
			'popular_items'              => __( 'Popular Sexes', 'cat_to_home' ),
			'all_items'                  => __( 'All Sexes', 'cat_to_home' ),
			'parent_item'                => __( 'Parent Sex', 'cat_to_home' ),
			'parent_item_colon'          => __( 'Parent Sex:', 'cat_to_home' ),
			'edit_item'                  => __( 'Edit Sex', 'cat_to_home' ),
			'update_item'                => __( 'Update Sex', 'cat_to_home' ),
			'view_item'                  => __( 'View Sex', 'cat_to_home' ),
			'add_new_item'               => __( 'Add New Sex', 'cat_to_home' ),
			'new_item_name'              => __( 'New Sex', 'cat_to_home' ),
			'separate_items_with_commas' => __( 'Separate sexes with commas', 'cat_to_home' ),
			'add_or_remove_items'        => __( 'Add or remove sexes', 'cat_to_home' ),
			'choose_from_most_used'      => __( 'Choose from the most used sexes', 'cat_to_home' ),
			'not_found'                  => __( 'No sexes found.', 'cat_to_home' ),
			'no_terms'                   => __( 'No sexes', 'cat_to_home' ),
			'menu_name'                  => __( 'Sexes', 'cat_to_home' ),
			'items_list_navigation'      => __( 'Sexes list navigation', 'cat_to_home' ),
			'items_list'                 => __( 'Sexes list', 'cat_to_home' ),
			'most_used'                  => _x( 'Most Used', 'sex', 'cat_to_home' ),
			'back_to_items'              => __( '&larr; Back to Sexes', 'cat_to_home' ),
		],
		'show_in_rest'          => true,
		'rest_base'             => 'sex',
		'rest_controller_class' => 'WP_REST_Terms_Controller',
	] );

}

add_action( 'init', 'sex_init' );

/**
 * Sets the post updated messages for the `sex` taxonomy.
 *
 * @param  array $messages Post updated messages.
 * @return array Messages for the `sex` taxonomy.
 */
function sex_updated_messages( $messages ) {

	$messages['sex'] = [
		0 => '', // Unused. Messages start at index 1.
		1 => __( 'Sex added.', 'cat_to_home' ),
		2 => __( 'Sex deleted.', 'cat_to_home' ),
		3 => __( 'Sex updated.', 'cat_to_home' ),
		4 => __( 'Sex not added.', 'cat_to_home' ),
		5 => __( 'Sex not updated.', 'cat_to_home' ),
		6 => __( 'Sexes deleted.', 'cat_to_home' ),
	];

	return $messages;
}

add_filter( 'term_updated_messages', 'sex_updated_messages' );
