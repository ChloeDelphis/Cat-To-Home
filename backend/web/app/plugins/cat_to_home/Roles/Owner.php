<?php

namespace Roles;

class Owner
{
    public static function cat_to_home_create_owner_role()
    {
        $capabilitie = get_role('editor',)->capabilities;
        $owner = add_role('owner', 'Owner', $capabilitie);
        $owner->add_cap('edit_users');
        $owner->add_cap('list_users');
        $owner->add_cap('delete_users');
    }

    public static function cat_to_home_remove_owner_role()
    {
        remove_role('owner');
    }
}
