<?php

add_action('rest_api_init', 'cat_to_home_rest_get_favorite');

function cat_to_home_rest_get_favorite()
{
    register_rest_route( 'wp/v2', '/users/favorites', array(
        'methods' => 'GET',
        'callback' => 'cat_to_home_rest_get_favorite_handler',
        'permission_callback' => function () {
         return /*wp_get_current_user()->roles[0] != 'adopter' ? false :*/ true;
        }
      ) );

}

function cat_to_home_rest_get_favorite_handler($request)
{

  global $wpdb;
  $responses = [];

  $user_id = wp_get_current_user()->ID;

  $sql = "SELECT id_adoption FROM wp_cat_to_home_user_post WHERE id_adopter = $user_id";

  $results = $wpdb->get_results($sql);


  foreach ($results as $object) {
    $response = [];

    //  recup le post en fonction d'un id de la fiche adoption
    $response['post_info'] =  get_post($object->id_adoption); 
    
    // on recup url featured image
    $response['source_url'] = get_the_post_thumbnail_url(get_post($object->id_adoption)); 
    
    // On récupère les taxonomies associées au post
    $response['taxonomies_info'] =  wp_get_object_terms($object->id_adoption, ['disease', 'environment', 'location', 'sex', 'vaccinate']);

    // On "concatène" les réponses à l'intérieur d'un tableau de réponses
    $responses[] = $response;    
  }
  // $response = json_encode($response);
  return new WP_REST_Response($responses, 200);
}