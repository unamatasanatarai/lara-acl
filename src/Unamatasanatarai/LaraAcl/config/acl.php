<?php

return [

    'providers' => [
        'permissions' => [
            'model' => \Unamatasanatarai\LaraAcl\Models\Permission::class,
        ],
        'roles'       => [
            'model' => \Unamatasanatarai\LaraAcl\Models\Role::class,
        ],
    ],

];