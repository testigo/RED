<?

return [
    'controllers' => [
        'invokables' => [
            'Home\Controller\Home' => 'Home\Controller\HomeController',
        ],
    ],
    'view_manager' => [
        'display_not_found_reason' => true,
        'display_exceptions' => true,
        'doctype' => 'HTML5',
        'not_found_template' => 'error/404',
        'exception_template' => 'error/index',
        'template_map' => [
            'Home/layout' => __DIR__ . '/../view/layout/home.phtml',
            // 'Error/layout' => __DIR__ . '/../view/layout/error.phptml',
            'error/404' => __DIR__ . '/../view/error/404.phtml',
            'error/index' => __DIR__ . '/../view/error/index.phtml',
        ],
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
    'translator' => [
        'locale' => 'en_US',
        'translation_file_patterns' => [
            [
                'type' => 'gettext',
                'base_dir' => __DIR__ . '/../language',
                'pattern' => '%s.mo',
            ],
        ],
    ],
    'router' => [
        'routes' => [
            'home' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/[:locale]',
                    'defaults' => [
                        '__NAMESPACE__' => 'Home\Controller',
                        'controller' => 'Home',
                        'action' => 'index',
                    ],
                    'constraints' => [
                        'locale' => '[a-z]{2}?',
                    ],
                ],
            ],
        ],
    ],
];
