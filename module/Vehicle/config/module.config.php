<?php

namespace Vehicle;

use Zend\Router\Http\Segment;

return [
    'router' => [
        'routes' => [
            'vehicle' => [
                'type' => Segment::class,
                'options' => [
                    'route' => '/vehicle[/:action[/:id]]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        // 'id' => '[0-9]+',
                        'id' => '[a-zA-Z0-9_-]*',
                    ],
                    'defaults' => [
                        'controller' => Controller\VehicleController::class,
                        'action' => 'index',
                    ],
                ],
            ],
        ],
    ],
    'view_manager' => [
        'template_path_stack' => [
            'vehicles' => __DIR__ . '/../view',
        ],
    ],
];
