<?

namespace Home\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Db\Sql\Select;
use Zend\Paginator\Paginator;
use Zend\Paginator\Adapter\Iterator as paginatorIterator;
use Zend\Db\Sql\Expression;

class HomeController extends ActionController
{
    public function indexAction()
    {
        return new ViewModel([
        ]);
    }

    public function getCatalogItemMapper()
    {
        $sm = $this->getServiceLocator();
        return $sm->get('CatalogItemMapper');
    }

    public function getNewsMapper()
    {
        $sm = $this->getServiceLocator();
        return $sm->get('NewsMapper');
    }
}
