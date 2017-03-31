<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Models
    |--------------------------------------------------------------------------
    |
    | If you want, you can replace default models from this package by models
    | you created. Have a look at `Ultraware\Roles\Models\Role` model and
    | `Ultraware\Roles\Models\Permission` model.
    |
    */

    'providers' => [
        'permissions' => [
            'model' => \Unamatasanatarai\LaraAcl\Models\Permission::class,
        ],
        'roles'       => [
            'model' => \Unamatasanatarai\LaraAcl\Models\Role::class,
        ],
    ],

];