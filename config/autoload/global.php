<?

return [
    'db' => [
        'driver' => 'Pdo',
        'dsn' => 'mysql:dbname=red;host=localhost',
        'driver_options' => [
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''
        ],
    ],
    'service_manager' => [
        'factories' => [
            'Zend\Db\Adapter\Adapter' => 'Zend\Db\Adapter\AdapterServiceFactory',
        ],
    ],
    'languages'=> [
        'en' => [
            'name' => 'English',
            'locale' => 'en_US',
            'value' => 'en',
        ],
        'ua' => [
            'name' => 'Ukraine',
            'locale' => 'uk_UA',
            'value' => 'ua',
        ],
        'ru' => [
            'name' => 'Russian',
            'locale' => 'ru_RU',
            'value' => 'ru',
        ],
    ],
];
