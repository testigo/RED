<?

namespace Back;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
use Zend\Authentication\AuthenticationService;
use Zend\Authentication\Adapter\DbTable as DbTableAuthAdapter;
use Zend\Session\SessionManager;
use Zend\Session\Container;
use Zend\Db\TableGateway\TableGateway;
use Zend\Db\ResultSet\ResultSet;
use Back\Model\Users\Table as UsersTable;
use Back\Model\Users\Entity as UsersEntity;
use Back\Model\Users\Type\Table as UsersTypeTable;
use Back\Model\Users\Type\Entity as UsersTypeEntity;
use Back\Model\Accounts\Table as AccountsTable;
use Back\Model\Accounts\Entity as AccountsEntity;
use Back\Model\HR\Departments\Table as DepartmentsTable;
use Back\Model\HR\Departments\Entity as DepartmentsEntity;
use Back\Model\HR\Positions\Table as PositionsTable;
use Back\Model\HR\Positions\Entity as PositionsEntity;
use Back\Model\Accounts\History\Password\Table as HistoryPasswordTable;
use Back\Model\Accounts\History\Password\Entity as HistoryPasswordEntity;
use Back\Model\Accounts\History\Table as AccountsHistoryTable;
use Back\Model\Data\ServiceLocatorFactory\ServiceLocatorFactory;

class Module
{
    protected $systemTitle = 'Red Application';
    protected $defaultLocale = 'en';
    protected $moduleNamespace = 'Back';

    public function onBootstrap(MvcEvent $e)
    {
        $this->_initServiceManager($e);

        $eventManager = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);

        $eventManager->getSharedManager()->attach('*', MvcEvent::EVENT_DISPATCH_ERROR, [$this, 'onDispatchError'], -100);
        $eventManager->getSharedManager()->attach('*', MvcEvent::EVENT_RENDER_ERROR, [
            $this,
            'onDispatchError'
        ], - 100);

        $this->initAcl($e);
        $e->getApplication()->getEventManager()->attach('route', [$this, 'checkAcl']);

        $eventManager = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);
        $this->bootstrapSession($e);

        $viewModel = $e->getApplication()->getMvcEvent()->getViewModel();
        $viewModel->systemTitle = $this->systemTitle;

        if ($this->getModuleNamespace($e) == $this->moduleNamespace)
            $eventManager->attach(MvcEvent::EVENT_ROUTE, [$this, 'initLocale'], 1);

        if (isset($_SESSION['module']['back']['locale']))
            $viewModel->locale = $_SESSION['module']['back']['locale'];

        if (isset($_SESSION['role']))
            $viewModel->role = $_SESSION['role'];

        $e->getApplication()->getEventManager()->getSharedManager()->attach('Zend\Mvc\Controller\AbstractController', 'dispatch', function($e) {
            $controller = $e->getTarget();
            $controllerClass = get_class($controller);
            $moduleNamespace = substr($controllerClass, 0, strpos($controllerClass, '\\'));
            if ($moduleNamespace == 'Back') {
                $role = isset($_SESSION['account']['role']) ? $_SESSION['account']['role'] : null;
                if ($role != 'admin' && $role != 'client') {
                    $moduleNamespace = 'Error';
                }
            }
            $controller->layout($moduleNamespace . '/layout');
        }, 100);
    }

    private function _initServiceManager(MvcEvent $e)
    {
        $sm = $e->getApplication()->getServiceManager();
        ServiceLocatorFactory::setInstance($sm);
    }

    public function initLocale(MvcEvent $e)
    {
        $translator = $e->getApplication()->getServiceManager()->get('translator');
        $config =  $e->getApplication()->getServiceManager()->get('Config');
        $setLocale = $e->getRouteMatch()->getParam('locale');

        $locale = null;

        if (isset($_SESSION['module']['back']['locale']))
            $locale = $_SESSION['module']['back']['locale'];
        else
            $locale = $this->defaultLocale;

        if (isset($config['languages'][$setLocale])) {
            $translator->setLocale($config['languages'][$setLocale]['locale']);
            $locale = $config['languages'][$setLocale]['value'];
            $_SESSION['module']['back']['locale'] = $locale;
        } else
            $translator->setLocale($config['languages'][$locale]['locale']);

        $viewModel = $e->getApplication()->getMvcEvent()->getViewModel();
        $viewModel->locale = $locale;

        $viewModel->locale_title = $config['languages'][$locale]['name'];
    }

    public function getModuleNamespace(MvcEvent $e)
    {
        $sm = $e->getApplication()->getServiceManager();
        $router = $sm->get('router');
        $request = $sm->get('request');
        $matchedRoute = $router->match($request);
        if ($matchedRoute) {
            $namespace = $matchedRoute->getParams()['__NAMESPACE__'];
            return explode('\\', $namespace)[0];
        }
    }

    public function bootstrapSession($e)
    {
        $session = $e->getApplication()->getServiceManager()->get('Zend\Session\SessionManager');
        $session->start();
        $container = new Container('initialized');
        if (!isset($container->init)) {
            $session->regenerateId(true);
            $container->init = 1;
        }
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return [
            'Zend\Loader\StandardAutoloader' => [
                'namespaces' => [
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ],
            ],
        ];
    }

    public function onDispatchError(MvcEvent $e)
    {
        $vm = $e->getViewModel();
        $vm->setTemplate('Error/layout');
    }

    public function getServiceConfig()
    {
        return [
            'factories' => [
                'Back\Model\AuthStorage' => function ($sm) {
                    return new \Back\Model\AuthStorage('AuthStorage');
                },
                'DbAdapter' => function ($sm) {
                    return $sm->get('Zend\Db\Adapter\Adapter');
                },
                'AuthService' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $dbTableAuthAdapter = new DbTableAuthAdapter(
                        $dbAdapter,
                        'back_users',
                        'email',
                        'password',
                        'MD5(?)'
                    );
                    $authService = new AuthenticationService();
                    $authService->setAdapter($dbTableAuthAdapter);
                    $authService->setStorage($sm->get('Back\Model\AuthStorage'));
                    return $authService;
                },
                'Zend\Session\SessionManager' => function ($sm) {
                    $config = $sm->get('config');
                    if (isset($config['session'])) {
                        $session = $config['session'];
                        $sessionConfig = null;

                        if (isset($session['config'])) {
                            $class = isset($session['config']['class']) ? $session['config']['class'] : 'Zend\Session\Config\SessionConfig';
                            $options = isset($session['config']['options']) ? $session['config']['options'] : [];
                            $sessionConfig = new $class();
                            $sessionConfig->setOptions($options);
                        }

                        $sessionStorage = null;

                        if (isset($session['storage'])) {
                            $class = $session['storage'];
                            $sessionStorage = new $class();
                        }

                        $sessionSaveHandler = null;

                        if (isset($session['save_handler']))
                            $sessionSaveHandler = $sm->get($session['save_handler']);

                        $sessionManager = new SessionManager($sessionConfig, $sessionStorage, $sessionSaveHandler);

                        if (isset($session['validator'])) {
                            $chain = $sessionManager->getValidatorChain();
                            foreach ($session['validator'] as $validator) {
                                $validator = new $validator();
                                $chain->attach('session.validate', [$validator, 'isValid']);
                            }
                        }
                    } else
                        $sessionManager = new SessionManager();

                    Container::setDefaultManager($sessionManager);
                    return $sessionManager;
                },
                'Back\Model\Accounts\History\Table' => function ($sm) {
                    $tableGateway = $sm->get('Accounts\History\Table\Gateway');
                    $table = new AccountsHistoryTable($tableGateway);
                    return $table;  
                },
                'Accounts\History\Table\Gateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new AccountsEntity());
                    return new TableGateway('back_accounts_history', $dbAdapter, null, $resultSetPrototype);
                },
                'Back\Model\HR\Departments\Table' => function ($sm) {
                    $tableGateway = $sm->get('Departments\Table\Gateway');
                    return new DepartmentsTable($tableGateway);
                },
                'Back\Model\HR\Positions\Table' => function ($sm) {
                    $tableGateway = $sm->get('Positions\Table\Gateway');
                    return new PositionsTable($tableGateway);
                },
                'Positions\Table\Gateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new PositionsEntity());
                    return new TableGateway('back_positions', $dbAdapter, null, $resultSetPrototype);
                },
                'Back\Model\Accounts\Table' => function ($sm) {
                    $tableGateway = $sm->get('Accounts\Table\Gateway');
                    return new AccountsTable($tableGateway);
                },
                'Accounts\Table\Gateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new AccountsEntity());
                    return new TableGateway('back_accounts', $dbAdapter, null, $resultSetPrototype);
                },
                'Back\Model\Accounts\History\Password\Table' => function ($sm) {
                    $tableGateway = $sm->get('History\Password\Table\Gateway');
                    return new HistoryPasswordTable($tableGateway);
                },
                'History\Password\Table\Gateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new HistoryPasswordEntity());
                    return new TableGateway('back_accounts_password_history', $dbAdapter, null, $resultSetPrototype);
                },
                'Back\Model\Users\Table' => function ($sm) {
                    $tableGateway = $sm->get('Users\Table\Gateway');
                    return new UsersTable($tableGateway);
                },
                'Users\Table\Gateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new UsersEntity);
                    return new TableGateway('back_users', $dbAdapter);
                },
                'Back\Model\Users\Type\Table' => function ($sm) {
                    $tableGateway = $sm->get('Users\Type\Table\Gateway');
                    return new UsersTypeTable($tableGateway);
                },
                'Users\Type\Table\Gateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new UsersTypeEntity);
                    return new TableGateway('back_users_type', $dbAdapter);
                },
                'Departments\Table\Gateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new DepartmentsEntity());
                    return new TableGateway('back_departments', $dbAdapter, null, $resultSetPrototype);
                },
            ],
        ];
    }

    public function initAcl(MvcEvent $e)
    {
        $acl = new \Zend\Permissions\Acl\Acl();
        $roles = include __DIR__ . '/config/module.acl.roles.php';
        $allResources = [];

        foreach ($roles as $role => $resources) {
            $role = new \Zend\Permissions\Acl\Role\GenericRole($role);
            $acl->addRole($role);
            $allResources = array_merge($resources, $allResources);

            foreach ($resources as $resource)
                if (!$acl->hasResource($resource))
                    $acl->addResource(new \Zend\Permissions\Acl\Resource\GenericResource($resource));

            foreach ($allResources as $resource)
                $acl->allow($role, $resource);
        }

        $e->getViewModel()->acl = $acl;
    }

    public function checkAcl(MvcEvent $e)
    {
        $route = $e->getRouteMatch()->getMatchedRouteName();
        $userRole = isset($_SESSION['account']['role']) ? $_SESSION['account']['role'] : 'guest';

        if (!$e->getViewModel()->acl->isAllowed($userRole, $route)) {
            $response = $e -> getResponse();
            $response->getHeaders()->addHeaderLine('Location', $e->getRequest()->getBaseUrl() . '/404');
            $response->setStatusCode(404);
        }
    }
}
