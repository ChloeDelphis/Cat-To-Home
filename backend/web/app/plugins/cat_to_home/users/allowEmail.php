<?php

// Ajout du postmeta 'allow_email'


function user_allowEmail()
{

    register_meta('user', 'allowEmail', array(
        'type' => 'boolean',
        'description' => 'autorisation to display email adress',
        'single' => true,
        'show_in_rest' => true
    ));
};

add_action('rest_api_init', 'user_allowEmail');
