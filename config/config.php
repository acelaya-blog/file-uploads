<?php
return [
    'controllers' => [
        'factories' => [
            'Acelaya\Index' => function ($sm) {
                return new Acelaya\IndexController($sm->getServiceLocator()->get('Acelaya\FilesService'));
            }
        ]
    ],

    'service_manager' => [
        'factories' => [
            'Acelaya\FilesOptions' => function ($sm) {
                $config = $sm->get('Config');
                return new Acelaya\Files\FilesOptions(isset($config['files']) ? $config['files'] : []);
            },
            'Acelaya\FilesService' => function ($sm) {
                $options = $sm->get('Acelaya\FilesOptions');
                return new Acelaya\Files\FilesService($options);
            }
        ]
    ],

    'router' => [
        'routes' => [
            'home' => [
                'type' => 'Literal',
                'options' => [
                    'route' => '/',
                    'defaults' => [
                        'controller' => 'Acelaya\Index',
                        'action' => 'index'
                    ]
                ],
                'may_terminate' => true,
                'child_routes' => [
                    'upload-files' => [
                        'type' => 'Literal',
                        'options' => [
                            'route' => 'upload-files',
                            'defaults' => [
                                'action' => 'upload'
                            ]
                        ]
                    ],
                    'list-files' => [
                        'type' => 'Literal',
                        'options' => [
                            'route' => 'list-files',
                            'defaults' => [
                                'action' => 'list'
                            ]
                        ]
                    ]
                ]
            ]
        ]
    ],

    'view_manager' => [
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => '404',
        'exception_template'       => 'error',
        'layout'                   => 'layout',
        'template_map' => [
            'layout'    => __DIR__ . '/../view/layout.phtml',
            'index'     => __DIR__ . '/../view/index.phtml',
            '404'       => __DIR__ . '/../view/404.phtml',
            'error'     => __DIR__ . '/../view/error.phtml',
        ],
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
        'strategies' => [
            'ViewJsonStrategy'
        ]
    ],

    'files' => [
        'base_path' => 'files',
        'max_size' => '1536MB'
    ]
];
