<?php

namespace Unamatasanatarai\LaraAcl\Traits;

trait BelongsToUsers
{

    public function users()
    {
        return $this->belongsToMany(config('auth.providers.users.model'))->withTimestamps();
    }
}
