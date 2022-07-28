<?php

// Ajout du postmeta 'birth'


function user_birth()
{

    register_meta('user', 'birth', array(
        'type' => 'string',
        'description' => 'date of birth',
        'single' => true,
        'show_in_rest' => true
    ));
};

add_action('rest_api_init', 'user_birth');
