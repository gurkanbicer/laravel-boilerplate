<?php

// Roles and capabilities
return [
    'admin' => [
        'alias' => 'Admin',
        'contains' => [
            'admin',
            'superuser',
            'user',
            'enduser'
        ],
    ],
    'superuser' => [
        'alias' => 'Super User',
        'contains' => [
            'superuser',
            'user',
            'enduser',
        ],
    ],
    'user' => [
        'alias' => 'User',
        'contains' => [
            'user',
            'enduser',
        ],
    ],
    'enduser' => [
        'alias' => 'Client',
        'contains' => [
            'enduser'
        ]
    ]
];
