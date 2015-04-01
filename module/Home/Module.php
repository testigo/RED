<?

namespace Home;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
use Zend\Session\Container;

class Module
{
    protected $default_locale = 'en';
    protected $moduleNamespace = 'Home';

    public function onBootstrap(MvcEvent $e)
    {
        $eventManager = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);

        $this->bootstrapSession($e);

        if ($this->getModuleNamespace($e) == $this->moduleNamespace) {
            $eventManager->attach(MvcEvent::EVENT_ROUTE, [$this, 'initLocale'], 1);
        }
        
        $viewModel = $e->getApplication()->getMvcEvent()->getViewModel();
        if (isset($_SESSION['module']['home']['locale'])) {
            $viewModel->locale = $_SESSION['module']['home']['locale'];
        }
        

        $e->getApplication()->getEventManager()->getSharedManager()->attach('Zend\Mvc\Controller\AbstractController', 'dispatch', function($e) {
            $controller = $e->getTarget();
            $controllerClass = get_class($controller);
            $moduleNamespace = substr($controllerClass, 0, strpos($controllerClass, '\\'));
            if ($moduleNamespace == 'Home') {
                $role = isset($_SESSION['role']) ? $_SESSION['role'] : null;
                if ($role != 'admin' && $role != 'client') {
                    $moduleNamespace = 'Error';
                }
            }
            $controller->layout($moduleNamespace . '/layout');
        }, 100);
    }

    public function initLocale(MvcEvent $e)
    {
        $translator = $e->getApplication()->getServiceManager()->get('translator');
        $config =  $e->getApplication()->getServiceManager()->get('Config');
        $setLocale = $e->getRouteMatch()->getParam('locale');

        $locale = null;

        if (isset($_SESSION['module']['home']['locale'])) {
            $locale = $_SESSION['module']['home']['locale'];
        } else {
            $locale = $this->default_locale;
        }
        
        if (isset($config['languages'][$setLocale])) {
            $translator->setLocale($config['languages'][$setLocale]['locale']);
            $locale = $config['languages'][$setLocale]['value'];
            
            $_SESSION['module']['home']['locale'] = $locale;
        } else {
            $translator->setLocale($config['languages'][$locale]['locale']);
        }
        
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
}
