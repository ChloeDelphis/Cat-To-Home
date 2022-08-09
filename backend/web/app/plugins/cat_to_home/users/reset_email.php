<?php

// Ajout du postmeta 'reset_email'
function user_reset_email()
{

    register_meta('user', 'reset_email', array(
        'type' => 'string',
        'description' => 'email pour réinitialisation mdp',
        'single' => true,
        'show_in_rest' => true
    ));
};

add_action('rest_api_init', 'user_reset_email');
