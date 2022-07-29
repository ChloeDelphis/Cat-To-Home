<?php

// Ajout du postmeta 'exp_date'


function user_exp_date()
{

    register_meta('user', 'exp_date', array(
        'type' => 'string',
        'description' => 'date d\'expiration du token',
        'single' => true,
        'show_in_rest' => true
    ));
};

add_action('rest_api_init', 'user_exp_date');
