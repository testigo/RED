<?

namespace Back\Controller\HR;

use Zend\View\Model\ViewModel;
use Zend\Mvc\MvcEvent;
use Back\Controller\Action;
use Back\Model\HR\Employees\Data;
use Back\Model\Users\Data as UsersData;
use Back\Model\HR\Positions\Data as PositionsData;
use Back\Model\HR\Departments\Data as DepartmentsData;


class Employees extends Action
{
	protected $url = 'backHREmployees';
    protected $name = 'employees';
    protected $module = 'hr';
    protected $data;

    public function onDispatch(MvcEvent $e)
    {
        $this->data = new Data();
        return parent::onDispatch($e);
    }

    public function indexAction()
    {
        $data = $this->data->fetch(
            $this->getRequest(),
            $this->filter
        );

        return new ViewModel([
            'url' => $this->url,
            'pagination' => $data->pagination,
            'filter' => $this->filter,
            '_filter' => $data->_filter,
            'count' => $data->count,
            'itemsPerPage' => $this->itemsPerPage,
            'itemsCountPerPage' => $this->icppv,
        ]);
    }

    public function viewAction()
    {
        if (!$this->filter->id) {
            return $this->redirect()->toRoute($this->url);
        }

        $account = $this->data->get($this->filter->id);

        $usersData = new UsersData();
        $user = $usersData->get($account->id_back_users);

        $positiosnData = new PositionsData();
        $position = $positiosnData->get($account->id_position);

        $departmentsData = new DepartmentsData();
        $departments = $departmentsData->get($account->id_departments);

        return new ViewModel([
            'url' => $this->url,
            'id' => $this->filter->id,
            'account' => $account,
            'user' => $user,
            'position' => $position,
            'departments' => $departments,
        ]);
    }

    public function addAction()
    {
        $form = $this->data->getForm();

        $id = $this->data->add($this->getRequest());
        if ($id) {
            return $this->redirect()->toRoute(
                $this->url,
                [
                    'action' => 'view',
                    'id' => $id,
                ]
            );
        }

        return new ViewModel([
            'url' => $this->url,
            'form' => $form,
        ]);
    }

    public function editAction()
    {
        if (!$this->filter->id) {
            return $this->redirect()->toRoute($this->url);
        }

        $item = $this->data->get($this->filter->id);
        
        $form = $this->data->getFormEdit($item);

        $id = $this->data->edit($this->getRequest());

        if ($id) {
            return $this->redirect()->toRoute(
                $this->url,
                [
                    'action' => 'view',
                    'id' => $id,
                ]
            );
        }

        return new ViewModel([
            'url' => $this->url,
            'form' => $form->prepare(),
            'item' => $item,
        ]);
    }

    public function deleteAction()
    {
        if (!$this->filter->id) {
            return $this->redirect()->toRoute($this->url);
        }

        $account = $this->data->get($this->filter->id);

        $request = $this->getRequest();
        if ($request->isPost()) {
            $this->data->delete($account);

            return $this->redirect()->toRoute($this->url);
        }

        return new ViewModel([
            'url'=> $this->url,
            'account' => $account,
            'id' => $this->filter->id,
        ]);
    }

    public function historyAction()
    {
        
        /*
        get history logich here =)
        */

        return new ViewModel([
        ]);
    }
}
