<?php

return [
    'role_structure' => [
        'super_admin' => [
            'users' =>    'c,r,u,d',
            'patients' => 'c,r,u,d',
            'reveals' => 'c,r,u,d',
            'reservations' => 'c,r,u,d'
        ],

        'doctor' => [
            'patients' => 'r,u,d',
            'reveals' => 'r,u,d',
            'reservations' => 'r,d'
        ],

        'nurse' => [
            'patients' => 'c,r,u',
            'reveals' => 'c,r,u',
            'reservations' => 'c,r,u,d'
        ],
       
    ],
    
    'permissions_map' => [
        'c' => 'create',
        'r' => 'read',
        'u' => 'update',
        'd' => 'delete'
    ]
];
