<?php

add_action('rest_api_init', 'cat_to_home_rest_get_favorite');

function cat_to_home_rest_get_favorite()
{
    register_rest_route( 'wp/v2', '/users/favorites', array(
        'methods' => 'GET',
        'callback' => 'cat_to_home_rest_get_favorite_handler',
        'permission_callback' => function () {
         return wp_get_current_user()->roles[0] != 'adopter' ? false : true;
        }
      ) );

}

function cat_to_home_rest_get_favorite_handler($request)
{

  global $wpdb;

  $user_id = wp_get_current_user()->ID;

  $sql = "SELECT id_adoption FROM wp_cat_to_home_user_post WHERE id_adopter = $user_id";

  $results = $wpdb->get_results($sql);

  foreach ($results as $value) {
    return new WP_REST_Response(get_post($value->id_adoption), 123); 
  }
}