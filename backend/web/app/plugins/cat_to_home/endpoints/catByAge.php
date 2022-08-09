<?php

add_action('rest_api_init', 'cat_to_home_rest_filter_register');

function cat_to_home_rest_filter_register()
{
    // Route pour récupérer l'id des fiches en fonction de l'age
    register_rest_route('wp/v2', 'cat/filter/(?P<age>[a-zA-Z]+)', array(
        'methods' => 'GET',
        'callback' => 'cat_to_home_rest__register_filter_handler',
        'permission_callback' => function () {
            return true;
        }
    ));
}

function cat_to_home_rest__register_filter_handler($data)
{
    global $wpdb;
    $responses = [];

    $params = sanitize_text_field($data['age']);
  
    $sql = "SELECT * FROM wp_postmeta WHERE meta_key = 'age' AND meta_value = '$params' ";
    
    $results = $wpdb->get_results($sql);

    // Pour chaque résultat on récupère l'id de la fiche et on l'ajoute à la réponse
    foreach ($results as $value) {
        $responses[] = $value->post_id;
    }

    return new WP_REST_Response($responses, 200);
    
}