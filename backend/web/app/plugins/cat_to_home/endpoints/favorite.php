<?php

add_action('rest_api_init', 'cat_to_home_rest_get_favorite');
add_action('rest_api_init', 'cat_to_home_rest_add_favorite');
add_action('rest_api_init', 'cat_to_home_rest_remove_favorite');


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
};



function cat_to_home_rest_add_favorite()
{
  register_rest_route('wp/v2', '/users/addfavorites', array(
    'methods' => 'POST',
    'callback' => 'cat_to_home_rest_add_favorite_handler',
    'permission_callback' => function () {
      return /*wp_get_current_user()->roles[0] != 'adopter' ? false :*/ true;
    }
  ));
};

function cat_to_home_rest_add_favorite_handler($request)
{

  // Préparation du tableau de réponses
  $responses = [];

  global $wpdb;

  $user_id = wp_get_current_user()->ID;

  // On récupère l'info de l'id de la fiche du chat
  // Il faudra que la bouton "ajouter aux favoris"
  // Déclenche l'envoi d'une requête sous ce format :
  // const response = await FavoriteService.addToFavorites({
  // cat_id: l'id du chat});
  // 

  $parameters = $request->get_json_params();
  $cat_id = $parameters['cat_id'];

  // On prépare la requête
  $sql = "INSERT INTO wp_cat_to_home_user_post VALUES
  ($cat_id , $user_id) ";

  // TODO Ajouter une condition qui vérifie si l'id du chat et de l'adoptant sont déjà liés. Si c'est le cas, renvoyer une response avec un code d'erreur (400 : Mauvaise requête ?). (Côté front end on pourra simplement faire vette vérification et ne pas envoyer la requête si le résultat est positif) 

  // Sinon exécuter le code qui suit

  // On envoie la requête pour modifier la base de données
  $wpdb->query($sql);

  // FIXME les réponses ne fonctionnent pas
  // ? A-t-on vraiment besoin de réponse pour un ajout ??

  // On prépare les réponses
  $response['code'] = 200;
  $response['cat_id'] = $cat_id;
  $response['adopter_id'] = $user_id;


  // On renvoie toutes les réponses dans un tableau 
  $responses[] = $response;
};


function cat_to_home_rest_remove_favorite()
{
  register_rest_route('wp/v2', '/users/removefavorites', array(
    'methods' => 'DELETE',
    'callback' => 'cat_to_home_rest_remove_favorite_handler',
    'permission_callback' => function () {
      return /*wp_get_current_user()->roles[0] != 'adopter' ? false :*/ true;
    }
  ));
};

function cat_to_home_remove_favorite_handler($request)
{
  // Préparation du tableau de réponses
  $responses = [];

  global $wpdb;

  $user_id = wp_get_current_user()->ID;

  // On récupère l'info de l'id de la fiche du chat
  // Il faudra que la bouton "retirer des favoris"
  // Déclenche l'envoi d'une requête sous ce format :
  // const response = await FavoriteService.addToFavorites({
  // cat_id: l'id du chat});
  // 

  $parameters = $request->get_json_params();
  $cat_id = $parameters['cat_id'];

  // On prépare la requête
  $sql = "DELETE FROM wp_cat_to_home_user_post
  WHERE id_adoption = $cat_id
  AND id_adopter = $user_id";

  // TODO Ajouter une condition qui vérifie que l'id du chat et de l'utilisateur sont déjà liés

  // On envoie la requête pour modifier la bdd
  $wpdb->query($sql);

    // On prépare les réponses
    $response['code'] = 200;
    $response['cat_id'] = $cat_id;
    $response['adopter_id'] = $user_id;
  
  
    // On renvoie toutes les réponses dans un tableau 
    $responses[] = $response;
}
