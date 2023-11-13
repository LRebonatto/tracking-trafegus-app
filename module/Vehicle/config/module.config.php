<?php

namespace Vehicle;

use Doctrine\ORM\Mapping\Driver\AnnotationDriver;
use Zend\Router\Http\Segment;
use Zend\View\Helper\FlashMessenger;

return [
    'router' => [
        'routes' => [
            'vehicles' => [
                'type' => Segment::class,
                'options' => [
                    'route' => '/vehicles[/:action[/:id]]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[0-9]+',
                    ],
                    'defaults' => [
                        'controller' => Controller\VehicleController::class,
                        'action' => 'index',
                    ],
                ],
            ],
        ],
    ],
    'controllers' => [
        'factories' => [
            Controller\VehicleController::class => Controller\Factory\VehicleControllerFactory::class,
        ],
    ],
    'view_manager' => [
        'template_path_stack' => [
            'vehicle' => __DIR__ . '/../view',
        ],
    ],
    'controller_plugins' => [
        'factories' => [
            'flashMessenger' => Controller\Factory\FlashMessengerFactory::class,
        ],
    ],
    'doctrine' => [
        'driver' => [
            __NAMESPACE__ . '_driver' => [
                'class' => AnnotationDriver::class,
                'cache' => 'array',
                'paths' => [__DIR__ . '/../src/Entity']
            ],
            'orm_default' => [
                'drivers' => [
                    __NAMESPACE__ . '\Entity' => __NAMESPACE__ . '_driver'
                ]
            ]
        ]
    ],

];
