<?php

use PHPMailer\PHPMailer\PHPMailer;

add_action('rest_api_init', 'cat_to_home_rest_send_mail');

function cat_to_home_rest_send_mail()
{
    // Nouvelle route pour inscription user
    register_rest_route('wp/v2', 'users/(?P<id>\d+)/send', array(
        'methods' => 'GET',
        'callback' => 'cat_to_home_rest_send_mail_handler',
        'permission_callback' => function () {
            return true;
        }
    ));
}

function cat_to_home_rest_send_mail_handler()
{
    

    $headers = array(
        'Content-Type: text/html; charset=UTF-8',
        "Reply-To: damien laitani d.laitani@gmail.com",
    );
    $isSend = wp_mail('d.laitani@gmail.com', 'Cat to home - Réinitialisation de votre mod de passe', 'cliquer ici', $headers);

    return new WP_REST_Response($isSend, 200);

}