<?php

/*
Plugin Name: Cat to home
Author: Team Cat to home
Version: 1.0
*/

require __DIR__ . '/vendor/autoload.php';

use Migration\User_PostMigration;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use Roles\Adopter;
use Roles\Owner;

// Customs post-types
require_once plugin_dir_path(__FILE__) . './post-types/cat.php';

// Customs Taxonomies
require_once plugin_dir_path(__FILE__) . './taxonomies/disease.php';
require_once plugin_dir_path(__FILE__) . './taxonomies/environment.php';
require_once plugin_dir_path(__FILE__) . './taxonomies/location.php';
require_once plugin_dir_path(__FILE__) . './taxonomies/sex.php';
require_once plugin_dir_path(__FILE__) . './taxonomies/vaccinate.php';

// Custom endpoint
require_once plugin_dir_path(__FILE__) . './endpoints/registration.php';
require_once plugin_dir_path(__FILE__) . './endpoints/favorite.php';
require_once plugin_dir_path(__FILE__) . './endpoints/catByAge.php';
require_once plugin_dir_path(__FILE__) . './endpoints/sendMail/reinitPass.php';
require_once plugin_dir_path(__FILE__) . './endpoints/sendMail/contact.php';
require_once plugin_dir_path(__FILE__) . './endpoints/resetPassword.php';
require_once plugin_dir_path(__FILE__) . './endpoints/retriveInfoUser.php';

// Customs users meta keys
require_once plugin_dir_path(__FILE__) . './users/birth.php';
require_once plugin_dir_path(__FILE__) . './users/phone.php';
require_once plugin_dir_path(__FILE__) . './users/reset_token.php';
require_once plugin_dir_path(__FILE__) . './users/exp_date.php';
require_once plugin_dir_path(__FILE__) . './users/reset_email.php';

require_once plugin_dir_path(__FILE__) . './users/allowPhone.php';
require_once plugin_dir_path(__FILE__) . './users/allowEmail.php';



register_activation_hook(__FILE__, 'cat_to_home_create_custom_roles');
function cat_to_home_create_custom_roles()
{
    Adopter::cat_to_home_create_adopter_role();
    Owner::cat_to_home_create_owner_role();
    User_PostMigration::cat_to_home_createTable();
}

register_deactivation_hook(__FILE__, 'cat_to_home_remove_custom_roles');
function cat_to_home_remove_custom_roles()
{
    Adopter::cat_to_home_remove_adopter_role();
    Owner::cat_to_home_remove_owner_role();
    User_PostMigration::cat_to_home_deleteTable();
}

add_action( 'phpmailer_init', 'send_smtp_email' );
function send_smtp_email( $phpmailer ) {
    $phpmailer->isSMTP();
    $phpmailer->Host       = 'smtp.gmail.com';
    $phpmailer->Port       = '587';
    $phpmailer->SMTPSecure = 'tls';
    $phpmailer->SMTPAuth   = true;
    $phpmailer->Username   = 'cattohome.contact@gmail.com';
    $phpmailer->Password   = 'mxflhkiqwpupmibv';

}

//? show wp_mail() errors
/*
add_action( 'wp_mail_failed', 'onMailError', 10, 1 );
function onMailError( $wp_error ) {
    echo "<pre>";
    print_r($wp_error);
    echo "</pre>";
}
*/