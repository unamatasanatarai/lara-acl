<?php

namespace Unamatasanatarai\LaraAcl\Traits;

trait UserHasRolesAndPermissions
{
    use UserHasPermissions, UserHasRoles;
    public function hasPermission($f){
        if (!is_array($f)){
            $f = [$f];
        }
        return $f;
    }

    public function hasRole($f){
        if (!is_array($f)){
            $f = [$f];
        }
        return $f;
    }
}
