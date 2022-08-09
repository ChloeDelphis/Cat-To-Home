<?php

add_action('rest_api_init', 'cat_to_home_rest_get_favorite');
add_action('rest_api_init', 'cat_to_home_rest_add_favorite');
add_action('rest_api_init', 'cat_to_home_rest_remove_favorite');

// Route qui récupère les favoris d'un adoptant
function cat_to_home_rest_get_favorite()
{
  register_rest_route('wp/v2', '/users/favorites', array(
    'methods' => 'GET',
    'callback' => 'cat_to_home_rest_get_favorite_handler',
    'permission_callback' => function () {
      return /*wp_get_current_user()->roles[0] != 'adopter' ? false :*/ true;
    }
  ));
};


function cat_to_home_rest_get_favorite_handler($request)
{

  global $wpdb;
  $responses = [];

  $user_id = wp_get_current_user()->ID;

  $sql = "SELECT id_adoption FROM wp_cat_to_home_user_post WHERE id_adopter = $user_id";

  $results = $wpdb->get_results($sql);

  foreach ($results as $object) {
    $response = [];

    //  récupère le post en fonction d'un id de la fiche adoption
    $response['post_info'] =  get_post($object->id_adoption);

    // on récupère url featured image
    $response['source_url'] = get_the_post_thumbnail_url(get_post($object->id_adoption));

    // On récupère la 'location' à part pour l'avoir toujours au même endroit dans la réponse de l'API
    $response['location'] = wp_get_object_terms($object->id_adoption, 'location');

    // On récupère les taxonomies associées au post
    $response['taxonomies_info'] =  wp_get_object_terms($object->id_adoption, ['disease', 'environment', 'sex', 'vaccinate'], ['hide_empty' => false]);

    // On "concatène" les réponses à l'intérieur d'un tableau de réponses
    $responses[] = $response;
  }
  return new WP_REST_Response($responses, 200);
};

// Route qui permet d'ajouter une fiches en favoris
function cat_to_home_rest_add_favorite()
{
  register_rest_route('wp/v2', '/users/favorites/add', array(
    'methods' => 'POST',
    'callback' => 'cat_to_home_rest_add_favorite_handler',
    'permission_callback' => function () {
      return /*wp_get_current_user()->roles[0] != 'adopter' ? false :*/ true;
    }
  ));
};

function cat_to_home_rest_add_favorite_handler($request)
{
  global $wpdb;

  $user_id = wp_get_current_user()->ID;

  // On récupère l'info de l'id de la fiche du chat
  // Il faudra que la bouton "ajouter aux favoris"
  // Déclenche l'envoi d'une requête sous ce format :
  // const response = await FavoriteService.addToFavorites({
  // cat_id: l'id du chat});

  $parameters = $request->get_json_params();
  $cat_id = $parameters['cat_id'];

  // On prépare la requête
  $sql = "INSERT INTO wp_cat_to_home_user_post VALUES
  ($cat_id , $user_id) ";

  // On envoie la requête pour modifier la base de données
  $result = $wpdb->query($sql);

  // Si $result est différent de 0
  if ($result !== 0) {
    // On prépare les réponses
    $response['code'] = 200;
    $response['cat_id'] = $cat_id;
    $response['adopter_id'] = $user_id;
  } else{
    $response['code'] = 400;
    $response['message'] = "L'ajout n'a pas fonctionné";
  }

  return new WP_REST_Response($response, 200);
};

// Route qui permet de supprimer une fiche des favoris
function cat_to_home_rest_remove_favorite()
{
  register_rest_route('wp/v2', '/users/favorites/delete', array(
    'methods' => 'DELETE',
    'callback' => 'cat_to_home_rest_remove_favorite_handler',
    'permission_callback' => function () {
      return /*wp_get_current_user()->roles[0] != 'adopter' ? false :*/ true;
    }
  ));
};

function cat_to_home_rest_remove_favorite_handler($request)
{
  global $wpdb;

  $user_id = wp_get_current_user()->ID;

  $parameters = $request->get_json_params();
  $cat_id = $parameters['cat_id'];

  // On prépare la requête
  $sql = "DELETE FROM wp_cat_to_home_user_post
  WHERE id_adoption = $cat_id
  AND id_adopter = $user_id";

  // On envoie la requête pour modifier la bdd
  $result = $wpdb->query($sql);

  // Si $result est différent de 0
  if ($result !== 0) {
    // On prépare les réponses
    $response['code'] = 200;
    $response['cat_id'] = $cat_id;
    $response['adopter_id'] = $user_id;
  } else {
    $response['code'] = 400;
    $response['message'] = "La suppression n'a pas fonctionné";
  }
  return new WP_REST_Response($response, 200);
}
