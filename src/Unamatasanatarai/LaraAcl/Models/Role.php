<?php

namespace Unamatasanatarai\LaraAcl\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{

    protected $table = 'acl_roles';
    protected $fillable = [ 'slug', 'description' ];

    public function permissions()
    {
        return $this->belongsToMany(
            config('acl.providers.permissions.model', Permission::class),
            'acl_roles_permissions',
            'role_id',
            'permission_id'
        )->withTimestamps();
    }

    public function users()
    {
        return $this->belongsToMany(
            config('auth.providers.users.model'),
            'acl_users_roles',
            'role_id',
            'user_id'
        )->withTimestamps();
    }
}