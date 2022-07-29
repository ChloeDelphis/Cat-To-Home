<?php

// Ajout du postmeta 'reset_token'


function user_reset_token()
{

    register_meta('user', 'reset_token', array(
        'type' => 'string',
        'description' => 'token pour réinitialisation mdp',
        'single' => true,
        'show_in_rest' => true
    ));
};

add_action('rest_api_init', 'user_reset_token');
