<?php

add_action('rest_api_init', 'cat_to_home_rest_user_register');

function cat_to_home_rest_user_register()
{
    // Nouvelle route pour inscription user
    register_rest_route('wp/v2', 'users/register', array(
        'methods' => 'POST',
        'callback' => 'cat_to_home_rest_user_register_handler',
        'permission_callback' => function () {
            return true;
        }
    ));
}

function cat_to_home_rest_user_register_handler($request)

{
    // répa réponse
    $response = [];

    $authorized_roles = [
        'adopter',
        'owner',
        'administrator'
    ];

    // Recup formulaire
    $parameters = $request->get_json_params();
    $email = sanitize_text_field($parameters['email']);
    $password = sanitize_text_field($parameters['password']);
    $role = sanitize_text_field($parameters['role']);
    $firstname = sanitize_text_field($parameters['firstname']);
    $lastname = sanitize_text_field($parameters['lastname']);
    $birth = $parameters['birth'];


    // Préparation des erreurs en cas de non validation des données
    $error = new WP_Error();
    // Verification du contenu du formulaire avec messages en français pour récup du front. 

    if (empty($email)) {
        $error->add(401, "L'email est obligatoire.", 'wp-rest-user', array('status' => 400));
        return $error;
    }
    if (empty($password)) {
        $error->add(404, "Le mot de passe est obligatoire.", 'wp-rest-user', array('status' => 400));
        return $error;
    }
    if (empty($role) || !in_array($role, $authorized_roles)) {
        $error->add(404, "Le choix d'un role est obligatoire.", 'wp-rest-user', array('status' => 400));
        return $error;
    }

    if (empty($firstname)) {
        $error->add(404, __("Le prénom est obligatoire.", 'wp-rest-user'), array('status' => 400));
        return $error;
    }
    if (empty($lastname)) {
        $error->add(404, __("Le nom est obligatoire.", 'wp-rest-user'), array('status' => 400));
        return $error;
    }
    if ($lastname === $firstname) {
        $error->add(404, __("Le prénom et le nom ne doivent pas être les mêmes", 'wp-rest-user'), array('status' => 400));
    }
    if (empty($birth)) {
        $error->add(404, __("La date de naissance est obligatoire.", 'wp-rest-user'), array('status' => 400));
        return $error;
    }

    // Verification qu'un utilisateur avec le même mail n'existe pas.
    if (!email_exists($email)) {
        $user_id = wp_insert_user([
            'user_pass' => $password,
            'user_login' => $email,
            'user_email' => $email,
            'first_name' => $firstname,
            'last_name' => $lastname
        ]);
        // Si la création du nouvel utilisateur est bonne
        if (!is_wp_error($user_id)) {

            add_user_meta($user_id, 'birth', $birth);
            // Recuperation de l'objet user
            $user = get_user_by('id', $user_id);

            $user->set_role($role);

            // Ger User Data (Non-Sensitive, Pass to front end.)
            $response['code'] = 200;

            $response['message'] = __("L'utilisateur " . $firstname . " est bien créé ! ", "wp-rest-user");
        } else {
            return $user_id;
        }
    } else {
        $error->add(406, __("L'Email existe déjà, veuillez vous connecter ou réinitialiser votre mot de passe.", 'wp-rest-user'), array('status' => 400));
        return $error;
    }
    return new WP_REST_Response($response, 200);
}
