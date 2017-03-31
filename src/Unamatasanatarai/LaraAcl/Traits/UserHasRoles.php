<?php

namespace Unamatasanatarai\LaraAcl\Traits;

use Unamatasanatarai\LaraAcl\Models\Role;

trait UserHasRoles
{

    public function roles()
    {
        return $this->belongsToMany(
            config('acl.providers.roles.model', Role::class),
            'acl_users_roles'
        )->withTimestamps();
    }
}
