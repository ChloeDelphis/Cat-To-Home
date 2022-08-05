<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

// require __DIR__ . '/../vendor/autoload.php';


add_action('rest_api_init', 'cat_to_home_rest_send_mail');

function cat_to_home_rest_send_mail()
{
    // Nouvelle route pour inscription user
    register_rest_route('wp/v2', 'users/send', array(
        'methods' => 'POST',
        'callback' => 'cat_to_home_rest_send_mail_handler',
        'permission_callback' => function () {
            return true;
        }
    ));
}

function cat_to_home_rest_send_mail_handler($request)
{
    
    $parameters = $request->get_json_params();
    $email = sanitize_text_field($parameters['email']);

    $user = get_user_by('email', $email);

    if ($user) {
        $token = md5($email).rand(10,9999);

        date_default_timezone_set('Europe/Paris');

        $expFormat = mktime(
            date("H"), date("i"), date("s"), date("m") ,date("d")+1, date("Y")
        );
        
        $expDate = date("Y-m-d H:i:s",$expFormat);

        update_user_meta($user->ID, 'reset_token', $token);
        update_user_meta($user->ID, 'exp_date', $expDate);
        update_user_meta($user->ID, 'reset_email', $email);

        $link = "<a href=\"http://localhost:8080/reinitialisation-mot-de-passe?key=$user->ID&token=$token\">Reset password</a>";
        
        $subject = 'reset mot de passe';

        $message = 'Clique sur le lien pour réinisialiser ton mot de passe ' . $link . '<br>' . 'Si le lien ne fonctionne pas, copiez l\'url suivante : <br>' . 'http://localhost:8080/reinitialisation-mot-de-passe?key='.$user->ID.'&token='.$token.'';

        $headers = array(
            'Content-Type: text/html; charset=UTF-8',
            "Reply-To: Cat to home cattohome.contact@gmail.com",
            'From: Cat to home <cattohome.contact@gmail.com>'
        );
        $response['code'] = 200;
        $response['sent'] = wp_mail(''. $user->first_name . ' <'. $email .'>', $subject, $message, $headers);
    } else {
        $response['code'] = 400;
        $response = 'Aucun utilisateur ne correspond à cette adresse mail.';
    }
    return new WP_REST_Response($response, 200);
}