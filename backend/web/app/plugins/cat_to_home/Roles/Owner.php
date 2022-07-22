<?php

namespace Roles;

class Owner
{
    public static function cat_to_home_create_owner_role()
    {
        add_role('owner', 'Owner', get_role('editor')->capabilities);
    }

    public static function cat_to_home_remove_owner_role()
    {
        remove_role('owner');
    }
}
