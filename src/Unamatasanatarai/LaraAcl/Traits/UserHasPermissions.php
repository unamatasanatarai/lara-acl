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
}
