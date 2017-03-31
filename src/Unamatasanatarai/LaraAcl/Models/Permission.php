<?php

namespace Unamatasanatarai\LaraAcl\Models;

use Illuminate\Database\Eloquent\Model;
use Unamatasanatarai\LaraAcl\Traits\BelongsToUsers;

class Permission extends Model
{

    protected $table = 'acl_permissions';
    protected $fillable = [ 'slug', 'description' ];

    public function roles()
    {
        return $this->belongsToMany(
            config('acl.providers.roles.model', Role::class),
            'acl_roles_permissions',
            'permission_id',
            'role_id'
        )->withTimestamps();
    }

    public function users()
    {
        return $this->belongsToMany(
            config('auth.providers.users.model'),
            'acl_users_permissions',
            'permission_id',
            'user_id'
        )->withTimestamps();
    }

}