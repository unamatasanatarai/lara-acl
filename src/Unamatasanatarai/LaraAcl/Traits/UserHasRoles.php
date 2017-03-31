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
    /**
     * @param $roles string|array of strings
     */
    public function hasRole($roles)
    {
        if ( ! is_array($roles)) {
            $roles = [ $roles ];
        }

        return $this->roles()->whereIn('slug', $roles)->count();

    }
}
