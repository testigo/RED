<?

namespace Back\Controller\HR;

use Zend\View\Model\ViewModel;
use Back\Controller\Action;

class HR extends Action
{
	public $url = 'backHR';

    public function indexAction()
    {
        return new ViewModel([
        	'url' => $this->url,
    	]);
    }
}
