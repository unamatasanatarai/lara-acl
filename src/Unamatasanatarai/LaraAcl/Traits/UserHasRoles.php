<?php

namespace Unamatasanatarai\LaraAcl\Traits;

use Cache;
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
        $roles = array_filter(array_map('trim', $roles));
        asort($roles);

        return Cache::remember(
            'user-has-roles_' . $this->id . '_' . md5(implode('_', $roles)),
            1,
            function () use ($roles) {
                return $this->roles()->whereIn('slug', $roles)->count();
            }
        );

    }
}
