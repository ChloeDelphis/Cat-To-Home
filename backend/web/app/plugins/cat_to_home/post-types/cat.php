<?php

/**
 * Registers the `cat` post type.
 */
function cat_init()
{
	register_post_type(
		'cat',
		[
			'labels'                => [
				'name'                  => __('Cats', 'cat_to_home'),
				'singular_name'         => __('Cat', 'cat_to_home'),
				'all_items'             => __('All Cats', 'cat_to_home'),
				'archives'              => __('Cat Archives', 'cat_to_home'),
				'attributes'            => __('Cat Attributes', 'cat_to_home'),
				'insert_into_item'      => __('Insert into cat', 'cat_to_home'),
				'uploaded_to_this_item' => __('Uploaded to this cat', 'cat_to_home'),
				'featured_image'        => _x('Featured Image', 'cat', 'cat_to_home'),
				'set_featured_image'    => _x('Set featured image', 'cat', 'cat_to_home'),
				'remove_featured_image' => _x('Remove featured image', 'cat', 'cat_to_home'),
				'use_featured_image'    => _x('Use as featured image', 'cat', 'cat_to_home'),
				'filter_items_list'     => __('Filter cats list', 'cat_to_home'),
				'items_list_navigation' => __('Cats list navigation', 'cat_to_home'),
				'items_list'            => __('Cats list', 'cat_to_home'),
				'new_item'              => __('New Cat', 'cat_to_home'),
				'add_new'               => __('Add New', 'cat_to_home'),
				'add_new_item'          => __('Add New Cat', 'cat_to_home'),
				'edit_item'             => __('Edit Cat', 'cat_to_home'),
				'view_item'             => __('View Cat', 'cat_to_home'),
				'view_items'            => __('View Cats', 'cat_to_home'),
				'search_items'          => __('Search cats', 'cat_to_home'),
				'not_found'             => __('No cats found', 'cat_to_home'),
				'not_found_in_trash'    => __('No cats found in trash', 'cat_to_home'),
				'parent_item_colon'     => __('Parent Cat:', 'cat_to_home'),
				'menu_name'             => __('Cats', 'cat_to_home'),
			],
			'public'                => true,
			'hierarchical'          => false,
			'show_ui'               => true,
			'show_in_nav_menus'     => true,
			'supports'              => ['title', 'editor', 'thumbnail', 'author', 'custom-fields'],
			'taxonomies' 			=> ['disease', 'environment', 'location', 'sex', 'vaccinate'],
			'has_archive'           => true,
			'rewrite'               => true,
			'query_var'             => true,
			'menu_position'         => null,
			'menu_icon'             => 'dashicons-pets',
			'show_in_rest'          => true,
			'rest_base'             => 'cat',
			'rest_controller_class' => 'WP_REST_Posts_Controller',
		]
	);
}

add_action('init', 'cat_init');


/**
 * Sets the post updated messages for the `cat` post type.
 *
 * @param  array $messages Post updated messages.
 * @return array Messages for the `cat` post type.
 */
function cat_updated_messages($messages)
{
	global $post;

	$permalink = get_permalink($post);

	$messages['cat'] = [
		0  => '', // Unused. Messages start at index 1.
		/* translators: %s: post permalink */
		1  => sprintf(__('Cat updated. <a target="_blank" href="%s">View cat</a>', 'cat_to_home'), esc_url($permalink)),
		2  => __('Custom field updated.', 'cat_to_home'),
		3  => __('Custom field deleted.', 'cat_to_home'),
		4  => __('Cat updated.', 'cat_to_home'),
		/* translators: %s: date and time of the revision */
		5  => isset($_GET['revision']) ? sprintf(__('Cat restored to revision from %s', 'cat_to_home'), wp_post_revision_title((int) $_GET['revision'], false)) : false, // phpcs:ignore WordPress.Security.NonceVerification.Recommended
		/* translators: %s: post permalink */
		6  => sprintf(__('Cat published. <a href="%s">View cat</a>', 'cat_to_home'), esc_url($permalink)),
		7  => __('Cat saved.', 'cat_to_home'),
		/* translators: %s: post permalink */
		8  => sprintf(__('Cat submitted. <a target="_blank" href="%s">Preview cat</a>', 'cat_to_home'), esc_url(add_query_arg('preview', 'true', $permalink))),
		/* translators: 1: Publish box date format, see https://secure.php.net/date 2: Post permalink */
		9  => sprintf(__('Cat scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview cat</a>', 'cat_to_home'), date_i18n(__('M j, Y @ G:i', 'cat_to_home'), strtotime($post->post_date)), esc_url($permalink)),
		/* translators: %s: post permalink */
		10 => sprintf(__('Cat draft updated. <a target="_blank" href="%s">Preview cat</a>', 'cat_to_home'), esc_url(add_query_arg('preview', 'true', $permalink))),
	];

	return $messages;
}

add_filter('post_updated_messages', 'cat_updated_messages');

/**
 * Sets the bulk post updated messages for the `cat` post type.
 *
 * @param  array $bulk_messages Arrays of messages, each keyed by the corresponding post type. Messages are
 *                              keyed with 'updated', 'locked', 'deleted', 'trashed', and 'untrashed'.
 * @param  int[] $bulk_counts   Array of item counts for each message, used to build internationalized strings.
 * @return array Bulk messages for the `cat` post type.
 */
function cat_bulk_updated_messages($bulk_messages, $bulk_counts)
{
	global $post;

	$bulk_messages['cat'] = [
		/* translators: %s: Number of cats. */
		'updated'   => _n('%s cat updated.', '%s cats updated.', $bulk_counts['updated'], 'cat_to_home'),
		'locked'    => (1 === $bulk_counts['locked']) ? __('1 cat not updated, somebody is editing it.', 'cat_to_home') :
			/* translators: %s: Number of cats. */
			_n('%s cat not updated, somebody is editing it.', '%s cats not updated, somebody is editing them.', $bulk_counts['locked'], 'cat_to_home'),
		/* translators: %s: Number of cats. */
		'deleted'   => _n('%s cat permanently deleted.', '%s cats permanently deleted.', $bulk_counts['deleted'], 'cat_to_home'),
		/* translators: %s: Number of cats. */
		'trashed'   => _n('%s cat moved to the Trash.', '%s cats moved to the Trash.', $bulk_counts['trashed'], 'cat_to_home'),
		/* translators: %s: Number of cats. */
		'untrashed' => _n('%s cat restored from the Trash.', '%s cats restored from the Trash.', $bulk_counts['untrashed'], 'cat_to_home'),
	];

	return $bulk_messages;
}

add_filter('bulk_post_updated_messages', 'cat_bulk_updated_messages', 10, 2);

// Ajout du postmeta 'birthDate'
function register_experience_meta_fields(){
	
	register_meta( 'post', 'birthDate', array(
		'type' => 'string',
        'description' => 'age du chat',
        'single' => true,
        'show_in_rest' => true
    ));
	
}

add_action( 'rest_api_init', 'register_experience_meta_fields');