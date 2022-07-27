<?php

namespace Roles;

class Adopter
{
    public static function cat_to_home_create_adopter_role()
    {
        $capabilitie = get_role('editor')->capabilities;
        $adopter = add_role('adopter', 'Adopter', $capabilitie);
        $adopter->add_cap('edit_users');
    }

    public static function cat_to_home_remove_adopter_role()
    {
        remove_role('adopter');
    }
}
