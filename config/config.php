<?php
return [
    'controllers' => [
        'factories' => [
            'Acelaya\Index' => 'Acelaya\IndexController'
        ]
    ],

    'service_mmanager' => [
        'factories' => [
            'Acelaya\FilesOptions' => 'Acelaya\FilesOptions'
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
        'base_path' => 'files'
    ]
];
