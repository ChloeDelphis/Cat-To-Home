<?php

// Ajout du postmeta 'allowEmail'


function user_allowEmail()
{

    register_meta('user', 'allowEmail', array(
        'type' => 'bool',
        'description' => 'autorisation to display email adress',
        'single' => true,
        'show_in_rest' => true
    ));
};

add_action('rest_api_init', 'user_allowEmail');
