<?php

namespace Motorist;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\Driver\AnnotationDriver;
use Zend\Router\Http\Segment;
use Zend\View\Helper\FlashMessenger;

return [
    'router' => [
        'routes' => [
            'motorists' => [
                'type' => Segment::class,
                'options' => [
                    'route' => '/motorists[/:action[/:id]]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[0-9]+',
                    ],
                    'defaults' => [
                        'controller' => Controller\MotoristController::class,
                        'action' => 'index',
                    ],
                ],
            ],
        ],
    ],
    'controllers' => [
        'factories' => [
            Controller\MotoristController::class => Controller\Factory\MotoristControllerFactory::class,
        ],
    ],
    'view_manager' => [
        'template_path_stack' => [
            'motorist' => __DIR__ . '/../view',
        ],
    ],
    'controller_plugins' => [
        'factories' => [
            'flashMessenger' => function ($container) {
                return new FlashMessenger();
            },
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
