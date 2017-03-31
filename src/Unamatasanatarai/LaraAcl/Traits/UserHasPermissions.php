<?php

namespace Unamatasanatarai\LaraAcl\Traits;

use Unamatasanatarai\LaraAcl\Models\Permission;

trait UserHasPermissions
{

    public function permissions()
    {
        return $this->belongsToMany(
            config('acl.providers.permissions.model', Permission::class),
            'acl_users_permissions'
        )->withTimestamps();
    }

    /**
     * @param $permissions string|array of strings
     */
    public function hasPermission($permissions)
    {
        if ( ! is_array($permissions)) {
            $permissions = [ $permissions ];
        }

        return $this->permissions()->whereIn('slug', $permissions)->count();

    }
}
