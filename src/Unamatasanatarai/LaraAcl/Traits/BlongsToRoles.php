<?php

namespace Unamatasanatarai\LaraAcl\Traits;

use Unamatasanatarai\LaraAcl\Models\Role;

trait BelongsToRoles
{

    public function roles()
    {
        return $this->belongsToMany(config('acl.models.role', Role::class))->withTimestamps();
    }
}
