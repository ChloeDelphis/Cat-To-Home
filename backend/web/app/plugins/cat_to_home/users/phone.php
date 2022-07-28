<?php

// Ajout du postmeta 'phone'


function user_phone()
{

    register_meta('user', 'phone', array(
        'type' => 'string',
        'description' => 'phone number',
        'single' => true,
        'show_in_rest' => true
    ));
};

add_action('rest_api_init', 'user_phone');
