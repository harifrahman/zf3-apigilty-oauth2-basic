<?php
return [
    'service_manager' => [
        'factories' => [
            \Vehicle\V1\Rest\Vehicle\VehicleResource::class => \Vehicle\V1\Rest\Vehicle\VehicleResourceFactory::class,
            \Vehicle\V1\Service\Vehicle::class => \Vehicle\V1\Service\VehicleFactory::class,
            \Vehicle\V1\Service\Listener\VehicleEventListener::class => \Vehicle\V1\Service\Listener\VehicleEventListenerFactory::class,
        ],
        'abstract_factories' => [
            0 => \Vehicle\Mapper\AbstractMapperFactory::class,
        ],
    ],
    'hydrators' => [
        'factories' => [
            'Vehicle\\Hydrator\\Vehicle' => \Vehicle\V1\Hydrator\VehicleHydratorFactory::class,
        ],
    ],
    'router' => [
        'routes' => [
            'vehicle.rest.vehicle' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/api/v1/vehicle[/:uuid]',
                    'defaults' => [
                        'controller' => 'Vehicle\\V1\\Rest\\Vehicle\\Controller',
                    ],
                ],
            ],
        ],
    ],
    'zf-versioning' => [
        'uri' => [
            0 => 'vehicle.rest.vehicle',
        ],
    ],
    'zf-rest' => [
        'Vehicle\\V1\\Rest\\Vehicle\\Controller' => [
            'listener' => \Vehicle\V1\Rest\Vehicle\VehicleResource::class,
            'route_name' => 'vehicle.rest.vehicle',
            'route_identifier_name' => 'uuid',
            'collection_name' => 'vehicle',
            'entity_http_methods' => [
                0 => 'GET',
                1 => 'PATCH',
                2 => 'DELETE',
            ],
            'collection_http_methods' => [
                0 => 'GET',
                1 => 'POST',
            ],
            'collection_query_whitelist' => [
                0 => 'order',
                1 => 'ascending',
                2 => 'name',
            ],
            'page_size' => 25,
            'page_size_param' => 'limit',
            'entity_class' => \Vehicle\Entity\Vehicle::class,
            'collection_class' => \Vehicle\V1\Rest\Vehicle\VehicleCollection::class,
            'service_name' => 'Vehicle',
        ],
    ],
    'zf-content-negotiation' => [
        'controllers' => [
            'Vehicle\\V1\\Rest\\Vehicle\\Controller' => 'HalJson',
        ],
        'accept_whitelist' => [
            'Vehicle\\V1\\Rest\\Vehicle\\Controller' => [
                0 => 'application/vnd.vehicle.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ],
        ],
        'content_type_whitelist' => [
            'Vehicle\\V1\\Rest\\Vehicle\\Controller' => [
                0 => 'application/vnd.vehicle.v1+json',
                1 => 'application/json',
            ],
        ],
    ],
    'zf-hal' => [
        'metadata_map' => [
            'Vehicle\\V1\\Rest\\Vehicle\\VehicleEntity' => [
                'entity_identifier_name' => 'id',
                'route_name' => 'vehicle.rest.vehicle',
                'route_identifier_name' => 'vehicle_id',
                'hydrator' => \Zend\Hydrator\ArraySerializable::class,
            ],
            \Vehicle\V1\Rest\Vehicle\VehicleCollection::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'vehicle.rest.vehicle',
                'route_identifier_name' => 'vehicle_id',
                'is_collection' => true,
            ],
            \Vehicle\Entity\Vehicle::class => [
                'entity_identifier_name' => 'uuid',
                'route_name' => 'vehicle.rest.vehicle',
                'route_identifier_name' => 'uuid',
                'hydrator' => 'Vehicle\\Hydrator\\Vehicle',
            ],
        ],
    ],
    'zf-content-validation' => [
        'Vehicle\\V1\\Rest\\Vehicle\\Controller' => [
            'input_filter' => 'Vehicle\\V1\\Rest\\Vehicle\\Validator',
        ],
    ],
    'input_filter_specs' => [
        'Vehicle\\V1\\Rest\\Vehicle\\Validator' => [
            0 => [
                'required' => false,
                'validators' => [],
                'filters' => [],
                'name' => 'merk',
            ],
            1 => [
                'required' => false,
                'validators' => [],
                'filters' => [],
                'name' => 'plateNumber',
            ],
            2 => [
                'required' => false,
                'validators' => [],
                'filters' => [],
                'name' => 'type',
            ],
        ],
    ],
];
