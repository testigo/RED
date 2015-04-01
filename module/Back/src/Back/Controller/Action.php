<?

namespace Back\Controller;

use Zend\Mvc\MvcEvent;
use Zend\Mvc\Controller\AbstractActionController;
use Back\Model\Monitor\Entity as MonitorEntity;
use Back\Model\Data\Filter\Entity as DataFilterEntity;

class Action extends AbstractActionController
{
    protected $url = 'back';
    protected $name = null;
    protected $module = null;

    protected $icpp = 5;
    protected $icppv = [];
    protected $itemsPerPage;

    protected $filter = null;
    protected $filterVisible = false;
    protected $disableFilter = false;

    protected $data = null;

    protected $authservice;

    protected $storage;
    
    public function onDispatch(MvcEvent $e)
    {
        $this->itemsPerPage = $this->params()->fromRoute('icpp') ? (int) $this->params()->fromRoute('icpp') : null;
        $this->_fillIcpp();
        $this->_fillIcppv();

        if (!$this->disableFilter) {
            $this->filter();
        }

        return parent::onDispatch($e);
    }

    public function filter()
    {
        $this->_getFilter();

        $this->filter->order_by = $this->params()->fromRoute('order_by') ? $this->params()->fromRoute('order_by') : 'id';
        $this->filter->order = $this->params()->fromRoute('order') ? $this->params()->fromRoute('order') : 'DESC';
        $this->filter->page = $this->params()->fromRoute('page') ? (int) $this->params()->fromRoute('page') : 1;
        $this->filter->itemPerPage = $this->itemsPerPage;
        $this->filter->search = isset($_GET['s']) ? $_GET['s'] : null;
        $this->filter->id = $this->params()->fromRoute('id') ? (int) $this->params()->fromRoute('id') : null;
        $this->filter->id_catalog = $this->params()->fromRoute('id_catalog') ? (int) $this->params()->fromRoute('id_catalog') : null;
    }

    private function _getFilter()
    {
        if (!$this->filter) {
            $this->filter = new DataFilterEntity();
        }
        return $this->filter;
    }

    private function _fillIcpp()
    {
        if ($this->itemsPerPage) {
            $_SESSION[$this->module][$this->name]['icpp'] = $this->itemsPerPage;
        } elseif (isset($_SESSION[$this->module][$this->name]['icpp'])) {
            $this->itemsPerPage = $_SESSION[$this->module][$this->name]['icpp'];
        } else {
            $this->itemsPerPage = $this->icpp;
        }
    }

    private function _fillIcppv()
    {
        if (!$this->icppv) {
            for ($i=5; $i<=100; $i+=5) {
                $this->icppv[$i] = $i;
            }
        }
    }

    public function getSessionStorage()
    {
        if (!$this->storage)
            $this->storage = $this->getServiceLocator()->get('Back\Model\AuthStorage');
        return $this->storage;
    }

    public function getAuthService()
    {
        if (!$this->authservice) {
            $this->authservice = $this->getServiceLocator()->get('AuthService');
        }

        return $this->authservice;
    }
}
