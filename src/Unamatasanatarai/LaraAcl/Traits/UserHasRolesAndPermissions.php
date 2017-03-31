<?php

namespace Unamatasanatarai\LaraAcl\Traits;

use Cache;
use Unamatasanatarai\LaraAcl\Models\Permission;
use Unamatasanatarai\LaraAcl\Models\Role;

trait UserHasRolesAndPermissions
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
                $rolePermissions = $this->roles()->with('permissions')->get()->pluck('permissions');

                foreach ($rolePermissions as $rolePermission) {
                    if ($rolePermission->whereIn('slug', $permissions)->isNotEmpty()) {
                        return true;
                    }
                }

                return (bool) $this->permissions()->whereIn('slug', $permissions)->count();
            }
        );
    }

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
