<?php

namespace Roles;

class Owner
{
    public static function cat_to_home_create_owner_role()
    {
        $capabilitie = get_role('editor')->capabilities;
        $capabilitie .= 'edit_users';
        add_role('owner', 'Owner', $capabilitie);
    }

    public static function cat_to_home_remove_owner_role()
    {
        remove_role('owner');
    }
}
