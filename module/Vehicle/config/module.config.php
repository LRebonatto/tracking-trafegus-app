<?php

namespace Vehicle;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\Driver\AnnotationDriver;
use Doctrine\ORM\Tools\Setup;
use Zend\Router\Http\Segment;

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
            Controller\VehicleController::class => function ($container) {
                $entityManager = $container->get(EntityManager::class);
                return new Controller\VehicleController($entityManager);
            },
        ],
    ],
    'view_manager' => [
        'template_path_stack' => [
            'vehicle' => __DIR__ . '/../view',
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
