<?php

namespace Migration;

class User_PostMigration
{
    const TABLE_NAME = "wp_cat_to_home_user_post";
    public static function cat_to_home_createTable()
    {
        // Récupération de la variable $wpdb
        global $wpdb;

        // On défini la collation
        $charset = $wpdb->get_charset_collate();

        // Création de la requête
        $sql = "CREATE TABLE " . self::TABLE_NAME . "(
            id_adoption mediumint(9) NOT NULL,
            id_adopter mediumint(9) NOT NULL,
            PRIMARY KEY (id_adoption, id_adopter)
        ) $charset;";

        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql);
    }

    public static function cat_to_home_deleteTable()
    {
        global $wpdb;
        $wpdb->query("DROP TABLE IF EXISTS " . self::TABLE_NAME . "");
    }
}
