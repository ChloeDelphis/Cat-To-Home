<?php

namespace Roles;

class Adopter
{
    public static function cat_to_home_create_adopter_role()
    {
        add_role('adopter', 'Adopter', get_role('editor')->capabilities);
    }

    public static function cat_to_home_remove_adopter_role()
    {
        remove_role('adopter');
    }
}
