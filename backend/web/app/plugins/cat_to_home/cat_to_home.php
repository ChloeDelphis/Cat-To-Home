<?php

/*
Plugin Name: Cat to home
Author: Team Cat to home
Version: 1.0
*/

global $wpdb;

// d($wpdb->get_results("SELECT * FROM wp_cat_to_home_user_post"));
// d(get_posts([
//     'include' => [7, 8],
//     'suppress_filters' => true,
//     'post_type' => 'cat'
// ]));
// d(wp_remote_get('http://cat_to_home.local/wp-json/wp/v2/cat/8'));
// die;

// d(WP_User::get_data_by('id', 1));die;
// $user = wp_get_current_user();
// d(get_users());die;

require __DIR__ . '/vendor/autoload.php';

use Migration\User_PostMigration;
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
require_once plugin_dir_path(__FILE__) . './endpoints/sendMail.php';


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
    $phpmailer->Host       = 'cat_to_home.local';
    $phpmailer->Port       = '8080';
    $phpmailer->SMTPSecure = 'tls';
    $phpmailer->SMTPAuth   = true;
    $phpmailer->Username   = 'admin';
    $phpmailer->Password   = 'admin';
    $phpmailer->addReplyTo('info@example.com', 'Information');
}