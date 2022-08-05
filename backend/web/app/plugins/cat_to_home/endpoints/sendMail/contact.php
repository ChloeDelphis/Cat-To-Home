<?php

add_action('rest_api_init', 'cat_to_home_rest_send_mail_contact');

function cat_to_home_rest_send_mail_contact()
{
    // Nouvelle route pour inscription user
    register_rest_route('wp/v2', 'users/send/contact', array(
        'methods' => 'POST',
        'callback' => 'cat_to_home_rest_send_mail_contact_handler',
        'permission_callback' => function () {
            return true;
        }
    ));
}

function cat_to_home_rest_send_mail_contact_handler($request)
{

    $parameters = $request->get_json_params();
    $name = sanitize_text_field($parameters['name']);
    $email = sanitize_text_field($parameters['email']);
    $content = sanitize_textarea_field($parameters['content']);
    
    $error = new WP_Error();

    if (empty($name)) {
        $error->add(400, 'Merci d\'indiquer vos nom et prénom');
        return $error;
    }
    if (empty($email)) {
        $error->add(400, 'Merci d\'indiquer votre adresse email');
        return $error;
    }
    if (empty($content)) {
        $error->add(400, 'Merci d\'ajouter un message');
        return $error;
    }

    $headers = [
        'Reply-to: '.$name.' <'.$email.'>',
        'From: Cat to home <cattohome.contact@gmail.com>'
    ];

    $send = wp_mail(get_option('admin_email'), 'contact - '.$name.' ', $content, $headers);

    if ($send) {
        $response['code'] = 200;
        $response['sent'] = true; 
    } else {
        $response['code'] = 400;
        $response['message'] = 'L\'envoi du mail à échoué';
    }
    return new WP_REST_Response($response, 200);
}