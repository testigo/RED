<?

namespace Back\Model\Data\ServiceLocatorFactory;

use Zend\ServiceManager\ServiceManager;

class ServiceLocatorFactory
{
    private static $serviceManager = null;

    public static function getInstance()
    {
        if (null === self::$serviceManager) {
            throw new NullServiceLocatorException('ServiceLocator is not set');
        }

        return self::$serviceManager;
    }

    public static function setInstance(ServiceManager $sm)
    {
        self::$serviceManager = $sm;
    }
}
