<?

namespace Back\Controller;

use Zend\View\Model\ViewModel;
use Back\Controller\Action;

class DefaultController extends Action
{
    public function indexAction()
    {
        return new ViewModel([
    	]);
    }
}
