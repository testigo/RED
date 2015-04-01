<?

return [
    'controllers' => [
        'invokables' => [
            'Back\Controller\Default' => 'Back\Controller\DefaultController',
            'Back\Controller\Auth\Auth' => 'Back\Controller\Auth\Auth',
            'Back\Controller\Store\Store' => 'Back\Controller\Store\Store',
            'Back\Controller\Store\Ecommerce' => 'Back\Controller\Store\Ecommerce',
            'Back\Controller\Store\Report' => 'Back\Controller\Store\Report',
            'Back\Controller\Store\Catalog' => 'Back\Controller\Store\Catalog',
            'Back\Controller\Store\Catalog\Product' => 'Back\Controller\Store\Catalog\Product',
            'Back\Controller\Store\Orders' => 'Back\Controller\Store\Orders',
            'Back\Controller\Store\Shippment' => 'Back\Controller\Store\Shippment',
            'Back\Controller\Store\Marketplace' => 'Back\Controller\Store\Marketplace',
            'Back\Controller\Settings\Settings' => 'Back\Controller\Settings\Settings',
            'Back\Controller\Settings\Currency' => 'Back\Controller\Settings\Currency',
            'Back\Controller\Monitoring\Monitoring' => 'Back\Controller\Monitoring\Monitoring',
            'Back\Controller\CRM\CRM' => 'Back\Controller\CRM\CRM',
            'Back\Controller\CRM\Clients' => 'Back\Controller\CRM\Clients',
            'Back\Controller\CRM\Clients\Employees' => 'Back\Controller\CRM\Clients\Employees',
            'Back\Controller\CRM\Managers' => 'Back\Controller\CRM\Managers',
            'Back\Controller\Finance\Finance' => 'Back\Controller\Finance\Finance',
            'Back\Controller\Finance\Report' => 'Back\Controller\Finance\Report',
            'Back\Controller\Finance\Accounts' => 'Back\Controller\Finance\Accounts',
            'Back\Controller\Finance\Costs' => 'Back\Controller\Finance\Costs',
            'Back\Controller\Finance\Profit' => 'Back\Controller\Finance\Profit',
            'Back\Controller\Finance\Income' => 'Back\Controller\Finance\Income',
            'Back\Controller\Production\Production' => 'Back\Controller\Production\Production',
            'Back\Controller\Production\Resources' => 'Back\Controller\Production\Resources',
            'Back\Controller\HR\HR' => 'Back\Controller\HR\HR',
            'Back\Controller\HR\Employees' => 'Back\Controller\HR\Employees',
            'Back\Controller\HR\SecurityCredentials' => 'Back\Controller\HR\SecurityCredentials',
            'Back\Controller\HR\Departments' => 'Back\Controller\HR\Departments',
            'Back\Controller\HR\Positions' => 'Back\Controller\HR\Positions',
            'Back\Controller\Documentation\Documentation' => 'Back\Controller\Documentation\Documentation',
            'Back\Controller\Account\Account' => 'Back\Controller\Account\Account',
            'Back\Controller\Account\Settings' => 'Back\Controller\Account\Settings',
            'Back\Controller\Dev\Dev' => 'Back\Controller\Dev\Dev',
            'Back\Controller\Dev\News' => 'Back\Controller\Dev\News',
            'Back\Controller\CMS\CMS' => 'Back\Controller\CMS\CMS',
            'Back\Controller\CMS\News' => 'Back\Controller\CMS\News',
        ],
    ],
    'view_manager' => [
        'display_not_found_reason' => true,
        'display_exceptions' => true,
        'doctype' => 'HTML5',
        'not_found_template' => 'error/404',
        'exception_template' => 'error/index',
        'template_map' => [
            'Back/layout' => __DIR__ . '/../view/layout/back.phtml',
            'Auth/layout' => __DIR__ . '/../view/layout/auth.phtml',
            'Error/layout' => __DIR__ . '/../view/layout/error.phtml',
            'error/404' => __DIR__ . '/../view/error/404.phtml',
            'error/index' => __DIR__ . '/../view/error/index.phtml',
            'pagination\store\orders' => __DIR__ . '/../view/partial/pagination/store/orders/orders.phtml',
            'pagination\store\catalog\product' => __DIR__ . '/../view/partial/pagination/store/catalog/product/product.phtml',
            'pagination\store\catalog' => __DIR__ . '/../view/partial/pagination/store/catalog/catalog.phtml',
            'pagination\store\shippment' => __DIR__ . '/../view/partial/pagination/store/shippment/shippment.phtml',
            'pagination\store\marketplace' => __DIR__ . '/../view/partial/pagination/store/marketplace/marketplace.phtml',
            'pagination\crm\clients' => __DIR__ . '/../view/partial/pagination/crm/clients.phtml',
            'pagination\crm\clients\employees' => __DIR__ . '/../view/partial/pagination/crm/clients/employees.phtml',
            'pagination\crm\managers' => __DIR__ . '/../view/partial/pagination/crm/managers.phtml',
            'pagination\hr\employees' => __DIR__ . '/../view/partial/pagination/hr/employees.phtml',
            'pagination\hr\departments' => __DIR__ . '/../view/partial/pagination/hr/departments.phtml',
            'pagination\hr\positions' => __DIR__ . '/../view/partial/pagination/hr/positions.phtml',
            'pagination\monitoring' => __DIR__ . '/../view/partial/pagination/monitoring/monitoring.phtml',
            'pagination\finance\report' => __DIR__ . '/../view/partial/pagination/finance/report/report.phtml',
            'pagination\finance\accounts' => __DIR__ . '/../view/partial/pagination/finance/accounts/accounts.phtml',
            'pagination\finance\costs' => __DIR__ . '/../view/partial/pagination/finance/costs/costs.phtml',
            'pagination\finance\profit' => __DIR__ . '/../view/partial/pagination/finance/profit/profit.phtml',
            'pagination\finance\income' => __DIR__ . '/../view/partial/pagination/finance/income/income.phtml',
            'pagination\cms\news' => __DIR__ . '/../view/partial/pagination/cms/news/news.phtml',
        ],
        'template_path_stack' => [
            'Back' => __DIR__ . '/../view',
        ],
    ],
    'service_manager' => [
        'abstract_factories' => [
            'Zend\Cache\Service\StorageCacheAbstractServiceFactory',
            'Zend\Log\LoggerAbstractServiceFactory',
        ],
        'aliases' => [
            'translator' => 'MvcTranslator',
        ],
    ],
    'session' => [
        'config' => [
            'class' => 'Zend\Session\Config\SessionConfig',
            'options' => [
                'name' => 'Back',
            ],
        ],
        'storage' => 'Zend\Session\Storage\SessionArrayStorage',
        'validators' => [
            [
                'Zend\Session\Validator\RemoteAddr',
                'Zend\Session\Validator\HttpUserAgent',
            ],
        ],
    ],
    'translator' => [
        'locale' => 'en_EN',
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
            'backAuth' => [
                'type' => 'Literal',
                'options' => [
                    'route' => '/auth',
                    'defaults' => [
                        '__NAMESPACE__' => 'Back\Controller\Auth',
                        'controller' => 'Auth',
                        'action' => 'login',
                    ],
                ],
                'may_terminate' => true,
                'child_routes' => [
                    'process' => [
                        'type' => 'Segment',
                        'options' => [
                            'route' => '/[:action]',
                            'constraints' => [
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ],
                        ],
                    ],
                ],
            ],
            'back' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/back[/:locale]',
                    'defaults' => [
                        '__NAMESPACE__' => 'Back\Controller',
                        'controller' => 'Default',
                        'action' => 'index',
                    ],
                    'constraints' => [
                        'locale' => '[a-z]{2}?',
                    ],
                ],
                'may_terminate' => true,
            ],
            'backStore' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/back/store[/:action][/:id]',
                    'defaults' => [
                        '__NAMESPACE__' => 'Back\Controller\Store',
                        'controller' => 'Store',
                        'action' => 'index',
                    ],
                ],
                'may_terminate' => true,
            ],
            'backStoreEcommerce' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/back/store/e-commerce[/:action][/:id]',
                    'defaults' => [
                        '__NAMESPACE__' => 'Back\Controller\Store',
                        'controller' => 'Ecommerce',
                        'action' => 'index',
                    ],
                ],
                'may_terminate' => true,
            ],
            'backStoreMarketplace' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/back/store/marketplace[/icpp/:icpp][/:action][/:id][/:url][/page/:page][/order_by/:order_by][/:order]',
                    'constraints' => [
                        'action' => '(?!\bpage\b)(?!\border_by\b)[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[0-9]+',
                        'page' => '[0-9]+',
                        'order_by' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'order' => 'ASC|DESC',
                        'icpp' => '[0-9]+',
                        'url' => '[a-zA-Z][a-zA-Z0-9_-]*',
                    ],
                    'defaults' => [
                        '__NAMESPACE__' => 'Back\Controller\Store',
                        'controller' => 'Marketplace',
                        'action' => 'index',
                    ],
                ],
                'may_terminate' => true,
            ],
            'backStoreReport' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/back/store/report[/:action]',
                    'constraints' => [
                        'action' => '(?!\bpage\b)(?!\border_by\b)[a-zA-Z][a-zA-Z0-9_-]*',
                    ],
                    'defaults' => [
                        '__NAMESPACE__' => 'Back\Controller\Store',
                        'controller' => 'Report',
                        'action' => 'index',
                    ],
                ],
                'may_terminate' => true,
            ],
            'backStoreCatalog' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/back/store/catalog[/icpp/:icpp][[/:id_catalog]][/:action][/:id][/page/:page][/order_by/:order_by][/:order]',
                    'constraints' => [
                        'action' => '(?!\bpage\b)(?!\border_by\b)[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[0-9]+',
                        'page' => '[0-9]+',
                        'order_by' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'order' => 'ASC|DESC',
                        'icpp' => '[0-9]+',
                        'id_catalog' => '[0-9]+',
                    ],
                    'defaults' => [
                        '__NAMESPACE__' => 'Back\Controller\Store',
                        'controller' => 'Catalog',
                        'action' => 'index',
                    ],
                ],
                'may_terminate' => true,
            ],
            'backStoreCatalogProduct' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/back/store/catalog/product[/:id_catalog/:catalog_title][/icpp/:icpp][/:action][/:id][/page/:page][/order_by/:order_by][/:order]',
                    'constraints' => [
                        'action' => '(?!\bpage\b)(?!\border_by\b)[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[0-9]+',
                        'page' => '[0-9]+',
                        'order_by' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'order' => 'ASC|DESC',
                        'icpp' => '[0-9]+',
                        'id_catalog' => '[0-9]+',
                        'catalog_title' => '[a-zA-Z][a-zA-Z0-9_-]*',
                    ],
                    'defaults' => [
                        '__NAMESPACE__' => 'Back\Controller\Store\Catalog',
                        'controller' => 'Product',
                        'action' => 'index',
                    ],
                ],
                'may_terminate' => true,
            ],
            'backStoreOrders' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/back/store/orders[/icpp/:icpp][/:id_status][/:action][/:id][/page/:page][/order_by/:order_by][/:order]',
                    'constraints' => [
                        'action' => '(?!\bpage\b)(?!\border_by\b)[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[0-9]+',
                        'id_status' => '[0-9]+',
                        'page' => '[0-9]+',
                        'icpp' => '[0-9]+',
                        'order_by' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'order' => 'ASC|DESC',
                    ],
                    'defaults' => [
                        '__NAMESPACE__' => 'Back\Controller\Store',
                        'controller' => 'Orders',
                        'action' => 'index',
                    ],
                ],
                'may_terminate' => true,
            ],
            'backStoreShippment' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/back/store/delivery-and-payment[/:action][/:id][/page/:page][/order_by/:order_by][/:order]',
                    'constraints' => [
                        'action' => '(?!\bpage\b)(?!\border_by\b)[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[0-9]+',
                        'page' => '[0-9]+',
                        'order_by' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'order' => 'ASC|DESC',
                    ],
                    'defaults' => [
                        '__NAMESPACE__' => 'Back\Controller\Store',
                        'controller' => 'Shippment',
                        'action' => 'index',
                    ],
                ],
                'may_terminate' => true,
            ],
            'backSettings' => [
                'type'=> 'Segment',
                'options' => [
                    'route' => '/back/settings',
                    'defaults' => [
                        '__NAMESPACE__' => 'Back\Controller\Settings',
                        'controller' => 'Settings',
                        'action' => 'index',
                    ],
                ],
                'may_terminate' => true,
            ],
            'backSettingsCurrency' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/back/settings/currency[/:action]',
                    'constraints' => [
                        'action' => '(?!\bpage\b)(?!\border_by\b)[a-zA-Z][a-zA-Z0-9_-]*',
                    ],
                    'defaults' => [
                        '__NAMESPACE__' => 'Back\Controller\Settings',
                        'controller' => 'Currency',
                        'action' => 'index',
                    ],
                ],
                'may_terminate' => true,
            ],
            'backMonitoring' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/back/monitoring[/icpp/:icpp][/:id_clients][/:action][/:id][/page/:page][/order_by/:order_by][/:order]',
                    'constraints' => [
                        'action' => '(?!\bpage\b)(?!\border_by\b)[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[0-9]+',
                        'page' => '[0-9]+',
                        'order_by' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'order' => 'ASC|DESC',
                        'icpp' => '[0-9]+',
                        'id_clients' => '[0-9]+',
                    ],
                    'defaults' => [
                        '__NAMESPACE__' => 'Back\Controller\Monitoring',
                        'controller' => 'Monitoring',
                        'action' => 'index',
                    ],
                ],
                'may_terminate' => true,
            ],
            'backCRM' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/back/crm[/:action]',
                    'constraints' => [
                        'action' => '(?!\bpage\b)(?!\border_by\b)[a-zA-Z][a-zA-Z0-9_-]*',
                    ],
                    'defaults' => [
                        '__NAMESPACE__' => 'Back\Controller\CRM',
                        'controller' => 'CRM',
                        'action' => 'index',
                    ],
                ],
                'may_terminate' => true,
            ],
            'backCRMClients' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/back/crm/clients[/icpp/:icpp][/:action][/:id][/page/:page][/order_by/:order_by][/:order]',
                    'constraints' => [
                        'action' => '(?!\bpage\b)(?!\border_by\b)[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[0-9]+',
                        'page' => '[0-9]+',
                        'order_by' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'order' => 'ASC|DESC',
                        'icpp' => '[0-9]+',
                    ],
                    'defaults' => [
                        '__NAMESPACE__' => 'Back\Controller\CRM',
                        'controller' => 'Clients',
                        'action' => 'index',
                    ],
                ],
                'may_terminate' => true,
            ],
            'backCRMClientsEmployees' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/back/crm/clients/employees[/icpp/:icpp][/:id_clients][/:action][/:id][/page/:page][/order_by/:order_by][/:order]',
                    'constraints' => [
                        'action' => '(?!\bpage\b)(?!\border_by\b)[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[0-9]+',
                        'page' => '[0-9]+',
                        'order_by' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'order' => 'ASC|DESC',
                        'icpp' => '[0-9]+',
                        'id_clients' => '[0-9]+',
                    ],
                    'defaults' => [
                        '__NAMESPACE__' => 'Back\Controller\CRM\Clients',
                        'controller' => 'Employees',
                        'action' => 'index',
                    ],
                ],
                'may_terminate' => true,
            ],
            'backCRMManagers' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/back/crm/managers[/icpp/:icpp][/:action][/:id][/page/:page][/order_by/:order_by][/:order]',
                    'constraints' => [
                        'action' => '(?!\bpage\b)(?!\border_by\b)[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[0-9]+',
                        'page' => '[0-9]+',
                        'order_by' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'order' => 'ASC|DESC',
                        'icpp' => '[0-9]+',
                    ],
                    'defaults' => [
                        '__NAMESPACE__' => 'Back\Controller\CRM',
                        'controller' => 'Managers',
                        'action' => 'index',
                    ],
                ],
                'may_terminate' => true,
            ],
            'backFinance' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/back/finance[/:action]',
                    'constraints' => [
                        'action' => '(?!\bpage\b)(?!\border_by\b)[a-zA-Z][a-zA-Z0-9_-]*',
                    ],
                    'defaults' => [
                        '__NAMESPACE__' => 'Back\Controller\Finance',
                        'controller' => 'Finance',
                        'action' => 'index',
                    ],
                ],
                'may_terminate' => true,
            ],
            'backFinanceReport' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/back/finance/report[/icpp/:icpp][/:action][/:id][/page/:page][/order_by/:order_by][/:order]',
                    'constraints' => [
                        'action' => '(?!\bpage\b)(?!\border_by\b)[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[0-9]+',
                        'page' => '[0-9]+',
                        'order_by' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'order' => 'ASC|DESC',
                        'icpp' => '[0-9]+',
                    ],
                    'defaults' => [
                        '__NAMESPACE__' => 'Back\Controller\Finance',
                        'controller' => 'Report',
                        'action' => 'index',
                    ],
                ],
                'may_terminate' => true,
            ],
            'backFinanceAccounts' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/back/finance/accounts[/icpp/:icpp][/:action][/:id][/page/:page][/order_by/:order_by][/:order]',
                    'constraints' => [
                        'action' => '(?!\bpage\b)(?!\border_by\b)[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[0-9]+',
                        'page' => '[0-9]+',
                        'order_by' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'order' => 'ASC|DESC',
                        'icpp' => '[0-9]+',
                    ],
                    'defaults' => [
                        '__NAMESPACE__' => 'Back\Controller\Finance',
                        'controller' => 'Accounts',
                        'action' => 'index',
                    ],
                ],
                'may_terminate' => true,
            ],
            'backFinanceCosts' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/back/finance/costs[/icpp/:icpp][/:action][/:id][/page/:page][/order_by/:order_by][/:order]',
                    'constraints' => [
                        'action' => '(?!\bpage\b)(?!\border_by\b)[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[0-9]+',
                        'page' => '[0-9]+',
                        'order_by' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'order' => 'ASC|DESC',
                        'icpp' => '[0-9]+'
                    ],
                    'defaults' => [
                        '__NAMESPACE__' => 'Back\Controller\Finance',
                        'controller' => 'Costs',
                        'action' => 'index',
                    ],
                ],
                'may_terminate' => true,
            ],
            'backFinanceProfit' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/back/finance/profit[/icpp/:icpp][/:action][/:id][/page/:page][/order_by/:order_by][/:order]',
                    'constraints' => [
                        'action' => '(?!\bpage\b)(?!\border_by\b)[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[0-9]+',
                        'page' => '[0-9]+',
                        'order_by' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'order' => 'ASC|DESC',
                        'icpp' => '[0-9]+',
                    ],
                    'defaults' => [
                        '__NAMESPACE__' => 'Back\Controller\Finance',
                        'controller' => 'Profit',
                        'action' => 'index',
                    ],
                ],
                'may_terminate' => true,
            ],
            'backFinanceIncome' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/back/finance/income[/icpp/:icpp][/:action][/:id][/page/:page][/order_by/:order_by][/:order]',
                    'constraints' => [
                        'action' => '(?!\bpage\b)(?!\border_by\b)[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[0-9]+',
                        'page' => '[0-9]+',
                        'order_by' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'order' => 'ASC|DESC',
                        'icpp' => '[0-9]+',
                    ],
                    'defaults' => [
                        '__NAMESPACE__' => 'Back\Controller\Finance',
                        'controller' => 'Income',
                        'action' => 'index',
                    ],
                ],
                'may_terminate' => true,
            ],
            'backProduction' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/back/production[/:action]',
                    'constraints' => [
                        'action' => '(?!\bpage\b)(?!\border_by\b)[a-zA-Z][a-zA-Z0-9_-]*',
                    ],
                    'defaults' => [
                        '__NAMESPACE__' => 'Back\Controller\Production',
                        'controller' => 'Production',
                        'action' => 'index',
                    ],
                ],
                'may_terminate' => true,
            ],
            'backProductionResources' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/back/production/resources[/:action][/:id][/page/:page][/order_by/:order_by][/:order]',
                    'constraints' => [
                        'action' => '(?!\bpage\b)(?!\border_by\b)[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[0-9]+',
                        'page' => '[0-9]+',
                        'order_by' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'order' => 'ASC|DESC',
                    ],
                    'defaults' => [
                        '__NAMESPACE__' => 'Back\Controller\Production',
                        'controller' => 'Resources',
                        'action' => 'index',
                    ],
                ],
                'may_terminate' => true,
            ],
            'backHR' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/back/hr[/:action]',
                    'constraints' => [
                        'action' => '(?!\bpage\b)(?!\border_by\b)[a-zA-Z][a-zA-Z0-9_-]*',
                    ],
                    'defaults' => [
                        '__NAMESPACE__' => 'Back\Controller\HR',
                        'controller' => 'HR',
                        'action' => 'index',
                    ],
                ],
                'may_terminate' => true,
            ],
            'backHREmployees' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/back/hr/employees[/icpp/:icpp][/:action][/:id][/page/:page][/order_by/:order_by][/:order]',
                    'constraints' => [
                        'action' => '(?!\bpage\b)(?!\border_by\b)[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[0-9]+',
                        'page' => '[0-9]+',
                        'order_by' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'order' => 'ASC|DESC',
                        'icpp' => '[0-9]+',
                    ],
                    'defaults' => [
                        '__NAMESPACE__' => 'Back\Controller\HR',
                        'controller' => 'Employees',
                        'action' => 'index',
                    ],
                ],
                'may_terminate' => true,
            ],
            'backHRSecurityCredentials' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/back/hr/security-credentials[/:action]',
                    'constraints' => [
                        'action' => '(?!\bpage\b)(?!\border_by\b)[a-zA-Z][a-zA-Z0-9_-]*',
                    ],
                    'defaults' => [
                        '__NAMESPACE__' => 'Back\Controller\HR',
                        'controller' => 'SecurityCredentials',
                        'action' => 'index',
                    ],
                ],
                'may_terminate' => true,
            ],
            'backHRDepartments' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/back/hr/departments[/icpp/:icpp][/:action][/:id][/page/:page][/order_by/:order_by][/:order]',
                    'constraints' => [
                        'action' => '(?!\bpage\b)(?!\border_by\b)[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[0-9]+',
                        'page' => '[0-9]+',
                        'order_by' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'order' => 'ASC|DESC',
                        'icpp' => '[0-9]+',
                    ],
                    'defaults' => [
                        '__NAMESPACE__' => 'Back\Controller\HR',
                        'controller' => 'Departments',
                        'action' => 'index',
                    ],
                ],
                'may_terminate' => true,
            ],
            'backHRPositions' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/back/hr/positions[/icpp/:icpp][/:action][/:id][/page/:page][/order_by/:order_by][/:order]',
                    'constraints' => [
                        'action' => '(?!\bpage\b)(?!\border_by\b)[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[0-9]+',
                        'page' => '[0-9]+',
                        'order_by' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'order' => 'ASC|DESC',
                        'icpp' => '[0-9]+',
                    ],
                    'defaults' => [
                        '__NAMESPACE__' => 'Back\Controller\HR',
                        'controller' => 'Positions',
                        'action' => 'index',
                    ],
                ],
                'may_terminate' => true,
            ],
            'backDocumentation' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/back/documentation[/:action]',
                    'constraints' => [
                        'action' => '(?!\bpage\b)(?!\border_by\b)[a-zA-Z][a-zA-Z0-9_-]*',
                    ],
                    'defaults' => [
                        '__NAMESPACE__' => 'Back\Controller\Documentation',
                        'controller' => 'Documentation',
                        'action' => 'index',
                    ],
                ],
                'may_terminate' => true,
            ],
            'backAccount' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/back/account[/:action][/:id]',
                    'defaults' => [
                        '__NAMESPACE__' => 'Back\Controller\Account',
                        'controller' => 'Account',
                        'action' => 'index',
                    ],
                ],
                'may_terminate' => true,
            ],
            'backAccountSettings' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/back/account/settings[/:action][/:id]',
                    'defaults' => [
                        '__NAMESPACE__' => 'Back\Controller\Account',
                        'controller' => 'Settings',
                        'action' => 'index',
                    ],
                ],
                'may_terminate' => true,
            ],
            'backCMS' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/back/cms',
                    'defaults' => [
                        '__NAMESPACE__' => 'Back\Controller\CMS',
                        'controller' => 'CMS',
                        'action' => 'index',
                    ],
                ],
                'may_terminate' => true,
            ],
            'backCMSNews' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/back/cms/news[/icpp/:icpp][/:action][/:id][/page/:page][/order_by/:order_by][/:order]',
                    'constraints' => [
                        'action' => '(?!\bpage\b)(?!\border_by\b)[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[0-9]+',
                        'page' => '[0-9]+',
                        'order_by' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'order' => 'ASC|DESC',
                        'icpp' => '[0-9]+',
                    ],
                    'defaults' => [
                        '__NAMESPACE__' => 'Back\Controller\CMS',
                        'controller' => 'News',
                        'action' => 'index',
                    ],
                ],
                'may_terminate' => true,
            ],
        ],
    ],
];
