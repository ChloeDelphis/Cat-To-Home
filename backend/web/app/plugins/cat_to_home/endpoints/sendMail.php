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

        $link = "<a href='http://localhost:8081/reinitialisation-mot-de-passe?key=".$user->ID."&token=".$token."&email=".$email."'>Reset password</a>";
        
        $subject = 'reset mot de passe';

        $message = 'Clique sur le lien pour réinisialiser ton mot de passe ' . $link;

        $headers = array(
            'Content-Type: text/html; charset=UTF-8',
            "Reply-To: damien laitani d.laitani@gmail.com",
            'From: Damien <d.laitani@gmail.com>'
        );
        $response = wp_mail('Damien <d.laitani@gmail.com>', $subject, $message, $headers);
    } else {
        $response = 'Aucun utilisateur ne correspond à cette adresse mail.';
    }
    return new WP_REST_Response($response, 200);
    
    // $phpmailer->SMTPDebug = SMTP::DEBUG_SERVER;
    // $phpmailer->isSMTP();
    // $phpmailer->Host       = 'smtp.gmail.com';
    // $phpmailer->Port       = '465';
    // $phpmailer->SMTPSecure = 'tls';
    // $phpmailer->SMTPAuth   = true;
    // $phpmailer->Username   = 'd.laitani@gmail.com';
    // $phpmailer->Password   = 'unDdciment1';
    // $phpmailer->From = 'd.laitani@gmail.com';
    // // $phpmailer->setFrom('d.laitani@gmail.com');
    // $phpmailer->FromName = 'test';
    // $phpmailer->addReplyTo('d.laitani@gmail.com', 'Information');

    // $phpmailer->addAddress($email);

    // //Content
    // $phpmailer->isHTML(true);                                  //Set email format to HTML
    // $phpmailer->Subject = 'Here is the subject';
    // $phpmailer->Body    = 'http://localhost:8081/reinitialisation-mot-de-passe';
    // $phpmailer->AltBody = 'This is the body in plain text for non-HTML mail clients';
    
    // if ($phpmailer->send()) {
    //     $response = true;
    // } else {
    //     $response = 'error : ' . $phpmailer->ErrorInfo;
    // }


}