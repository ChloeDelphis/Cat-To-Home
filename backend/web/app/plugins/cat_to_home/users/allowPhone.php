<?php

// Ajout du postmeta 'allowPhone'


function user_allowPhone()
{

    register_meta('user', 'allowPhone', array(
        'type' => 'bool',
        'description' => 'autorisation to display phone number',
        'single' => true,
        'show_in_rest' => true
    ));
};

add_action('rest_api_init', 'user_allowPhone');
