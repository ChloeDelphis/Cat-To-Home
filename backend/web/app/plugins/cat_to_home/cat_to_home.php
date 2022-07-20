<?php

/*
Plugin Name: Cat to home
Author: Team Cat to home
Version: 1.0
*/

require __DIR__ . '/vendor/autoload.php';

use Migration\User_PostMigration;

// Customs post-types
require_once plugin_dir_path(__FILE__) . './post-types/cat.php';

// Customs Taxonomies
require_once plugin_dir_path(__FILE__) . './taxonomies/disease.php';
require_once plugin_dir_path(__FILE__) . './taxonomies/environment.php';
require_once plugin_dir_path(__FILE__) . './taxonomies/location.php';
require_once plugin_dir_path(__FILE__) . './taxonomies/sex.php';
require_once plugin_dir_path(__FILE__) . './taxonomies/vaccinate.php';

// Custom endpoint
require_once plugin_dir_path(__FILE__) . './custom-endpoints/registration.php';

register_activation_hook(__FILE__, 'cat_to_home_create_custom_roles');
function cat_to_home_create_custom_roles()
{
    // cat_to_home_create_cook_role();
    User_PostMigration::createTable();
}

register_deactivation_hook(__FILE__, 'cat_to_home_remove_custom_roles');
function cat_to_home_remove_custom_roles()
{
    // cat_to_home_remove_cook_role();
    User_PostMigration::deleteTable();
}
