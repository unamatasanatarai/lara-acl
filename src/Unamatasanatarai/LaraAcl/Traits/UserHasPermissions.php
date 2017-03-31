<?php

namespace Unamatasanatarai\LaraAcl\Traits;

use Cache;
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
        $permissions = array_filter(array_map('trim', $permissions));
        asort($permissions);

        return Cache::remember(
            'user-has-permissions_' . $this->id . '_' . md5(implode('_', $permissions)),
            1,
            function () use ($permissions) {
                return $this->permissions()->whereIn('slug', $permissions)->count();
            }
        );
    }
}
