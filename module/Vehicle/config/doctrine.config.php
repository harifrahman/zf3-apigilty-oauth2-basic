<?php
return [
    'doctrine' => [
        'driver' => [
            'vehicle_entity' => [
                'class' => 'Doctrine\ORM\Mapping\Driver\XmlDriver',
                'cache' => 'array',
                'paths' => [__DIR__ . '/orm']
            ],
            'orm_default' => [
                'drivers' => [
                    'Vehicle\Entity' => 'vehicle_entity',
                ]
            ]
        ],
    ],
];
