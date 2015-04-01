<?

namespace Back\Model\HR\Employees;

use Zend\Db\Sql\Select;
use Back\Model\Data\ServiceLocator;
use Back\Form\HR\Employees\Form;
use Back\Model\HR\Employees\Entity;
use Back\Model\Accounts\Entity as AccountsEntity;
use Back\Model\Users\Entity as UsersEntity;
use Back\Model\Users\Data as UsersData;

class Data extends ServiceLocator
{
    public $filter;

    private $_form;
    private $_entity;
    private $_user;

    public function fetch($request, $filter)
    {
        $this->filter = new AccountsEntity();

        $where = [];
        $like = [];

        $select = new Select();

        if ($request->isPost()) {
            $filter->visible = true;
            $this->filter = $request->getPost();

            if ($this->filter->id) {
                $where['id'] = (int) $this->filter->id;
            }

            if ($this->filter->first_name) {
                $select->where->like('first_name', '%' . $this->filter->first_name . '%');
            }

            if ($this->filter->last_name) {
                $select->where->like('last_name', '%' . $this->filter->last_name . '%');
            }

            if ($this->filter->city) {
                $select->where->like('city', '%' . $this->filter->city . '%');
            }

            if ($this->filter->address) {
                $select->where->like('address', '%' . $this->filter->address . '%');
            }

            if ($this->filter->phone) {
                $select->where->like('phone_number', '%' . $this->filter->phone_number . '%');
            }
        }

        $where['active'] = 'yes';
        
        if ($where) {
            $select->where($where);
        }

        if ($filter->search) {
            $select->where->like(
                'first_name',
                '%' . $filter->search . '%'
            )->or->like(
                'last_name',
                '%' . $filter->search . '%'
            )->or->like(
                'second_name',
                '%' . $filter->search . '%'
            )->or->like(
                'city',
                '%' . $filter->search . '%'
            )->or->like(
                'address',
                '%' . $filter->search . '%'
            )->or->like(
                'phone_number',
                $filter->search . '%'
            );
        }

        $select->order($filter->order_by . ' ' . $filter->order);

        $result = $this->getServiceLocator()
            ->get('Back\Model\Accounts\Table')
            ->fetch($select);

        $pagination = $result->setCurrentPageNumber($filter->page)
            ->setItemCountPerPage($filter->itemPerPage)
            ->setPageRange(7);

        $filter->url_order = ($filter->order == 'ASC') ? 'DESC' : 'ASC';

        return (object) [
            'pagination' => $pagination,
            'filter' => $filter,
            'count' => $result->getAdapter()->count(),
            '_filter' => $this->filter,
        ];
    }

    public function get($id)
    {
        return $this->getServiceLocator()
            ->get('Back\Model\Accounts\Table')
            ->get($id);
    }

    public function getForm()
    {
        $form = new Form();

        $form->getInputFilter()
            ->get('active')
            ->setRequired(false);

        $form->getInputFilter()
            ->get('email')
            ->getValidatorChain()
            ->attach(new \Zend\Validator\Db\NoRecordExists(
                    [
                        'table' => 'back_users',
                        'field' => 'email',
                        'adapter' => $this->getServiceLocator()->get('DbAdapter')
                    ]
                ));

        $positions = $this->getServiceLocator()
            ->get('Back\Model\HR\Positions\Table')
            ->fetchAll()
            ->toArray();

        $_positions = [
            -1 => [
                'value' => null,
                'label' => null,
            ],
        ];

        $selected = null;
        foreach ($positions as $key => $value) {
            $_positions[$key]['value'] = $value['id'];
            $_positions[$key]['label'] = $value['title'];
        }

        $form->get('id_position')
            ->setValueOptions($_positions);

        $departments = $this->getServiceLocator()
            ->get('Back\Model\HR\Departments\Table')
            ->fetchAll()
            ->toArray();

        $_departments = [
            -1 => [
                'value' => null,
                'label' => null,
            ],
        ];

        $selected = null;
        foreach ($departments as $key => $value) {
            $_departments[$key]['value'] = $value['id'];
            $_departments[$key]['label'] = $value['title'];
        }

        $form->get('id_departments')
            ->setValueOptions($_departments);

        $this->_form = $form;

        return $this->_form;
    }

    public function getFormEdit($item)
    {
        $this->_entity = new Entity();
        $this->_entity->exchangeArray((array) $item);

        $usersData = new UsersData();
        $this->_user = $usersData->get($item->id_back_users);

        $this->_entity->email = $this->_user->email;
        $this->_entity->id_type = $this->_user->id_type;

        $form = new Form();

        $form->getInputFilter()
            ->get('password')
            ->setRequired(false);

        $form->getInputFilter()
            ->get('password_check')
            ->setRequired(false);

        $positions = $this->getServiceLocator()
            ->get('Back\Model\HR\Positions\Table')
            ->fetchAll()
            ->toArray();

        $_positions = [
            -1 => [
                'value' => null,
                'label' => null,
            ],
        ];

        $selected = null;
        foreach ($positions as $key => $value) {
            $_positions[$key]['value'] = $value['id'];
            $_positions[$key]['label'] = $value['title'];
            if ($value['id'] == $this->_entity->id_position) {
                $_positions[$key]['selected'] = true;
            }
        }

        $form->get('id_position')
            ->setValueOptions($_positions);

        $departments = $this->getServiceLocator()
            ->get('Back\Model\HR\Departments\Table')
            ->fetchAll()
            ->toArray();

        $_departments = [
            -1 => [
                'value' => null,
                'label' => null,
            ],
        ];

        $selected = null;
        foreach ($departments as $key => $value) {
            $_departments[$key]['value'] = $value['id'];
            $_departments[$key]['label'] = $value['title'];
            if ($value['id'] == $this->_entity->id_departments) {
                $_departments[$key]['selected'] = true;
            }
        }

        $form->get('id_departments')
            ->setValueOptions($_departments);

        $created = date('Y-m-d H:i:s');

        $form->populateValues((array) $this->_entity);

        $this->_form = $form;
        return $this->_form;
    }

    public function getFormPassword($request, $filter)
    {
        $this->_entity = new \Back\Model\Accounts\Password\Entity();
        $item = $this->get($filer->id);
        $this->_entity->exchangeArray((array) $item);

        $usersData = new UsersData();
        $this->_user = $usersData->get($item->id_back_users);

        $form = new \Back\Form\Accounts\Password\Form();

        $form->getInputFilter()
            ->get('password_current')
            ->getValidatorChain()
            ->attach(
                new \Zend\Validator\Db\RecordExists(
                    [
                        'table' => 'back_users',
                        'field' => 'password',
                        'adapter' => $this->getServiceLocator()->get('DbAdapter')
                    ]
                )
            );
        
        $form->populateValues((array) $this->_entity);
        $this->_form = $form;

        return $this->_form;
    }

    public function add($request)
    {
        if ($request->isPost()) {

            $this->_form->setData($request->getPost());

            if ($this->_form->isValid()) {
                $entity = new Entity();

                $entity->exchangeArray((array) $this->_form->getData());

                $entity->created = date('Y-m-d H:i:s');
                $entity->update = date('Y-m-d H:i:s');
                $entity->active = 'yes';
                $entity->id_type = 3;
                $entity->password = md5($entity->password);

                if (!$entity->id_position) {
                    $entity->id_position = null;
                }

                if (!$entity->id_departmants) {
                    $entity->id_departmants = null;
                }

                $accountsEntity = new AccountsEntity();
                $accountsEntity->exchangeArray((array) $entity);

                $usersEntity = new UsersEntity();
                $usersEntity->exchangeArray((array) $entity);

                $accountsEntity->id_back_users = $this->getServiceLocator()
                    ->get('Back\Model\Users\Table')
                    ->save($usersEntity);

                $accountsEntity->id = $this->getServiceLocator()
                    ->get('Back\Model\Accounts\Table')
                    ->save($accountsEntity);

                return $accountsEntity->id;
            }
        }

        return false;
    }

    public function edit($request)
    {
        if ($request->isPost()) {

            $this->_form->setData($request->getPost());

            if ($this->_form->isValid()) {

                $this->_entity->exchangeArray((array) $this->_form->getData());

                $this->_entity->update = date('Y-m-d H:i:s');

                if (!$this->_entity->id_position) {
                    $this->_entity->id_position = null;
                }

                if (!$this->_entity->id_departments) {
                    $this->_entity->id_departments = null;
                }

                $accountsEntity = new AccountsEntity();
                $accountsEntity->exchangeArray((array) $this->_entity);
                $accountsEntity->id_back_users = $this->_user->id;

                $_usersEntity = (object) [
                    'id' => $this->_user->id,
                    'email' => $this->_entity->email,
                ];

                $this->getServiceLocator()
                    ->get('Back\Model\Users\Table')
                    ->save($_usersEntity);

                $this->getServiceLocator()
                    ->get('Back\Model\Accounts\Table')
                    ->save($accountsEntity);

                $current_item = $this->get($this->_entity->id);
                $current_item->id = null;

                $this->getServiceLocator()
                    ->get('Back\Model\Accounts\History\Table')
                    ->save($current_item);

                return $accountsEntity->id;
            }
        }

        return false;
    }

    public function change_password($request)
    {
       if ($request->isPost()) {
            $this->_form->setData($request->getPost());

            //var_dump($this->_form->isValid()); die;

            if ($this->_form->isValid()) {

                $entity->active = 'yes';                

                $this->_entity->exchangeArray((array) $this->_form->getData());

                $this->_entity->update = date('Y-m-d H:i:s');

                $accountsEntity = new AccountsEntity();
                $accountsEntity->exchangeArray((array) $this->_entity);
                $accountsEntity->id_back_users = $this->_user->id;

                 $_usersEntity = (object) [
                'id' => $this->_user->id,
                //'password' => $this->_entity->password,
                'password' => md5($this->_entity->password),
                ];

                $passwordHistoryEntity = (object) [
                        'id_users' => $accountsEntity->id_back_users,
                        'id_users_responsible' => $_SESSION['AuthStorage']['storage']['id'],
                        'created' => $this->_entity->update,
                ];

                $this->getServiceLocator()
                    ->get('Back\Model\Users\Table')
                    ->save($_usersEntity);

                $this->getServiceLocator()
                    ->get('Back\Model\Accounts\History\Password\Table')
                    ->save($passwordHistoryEntity);

                return $accountsEntity->id;
            }
        }

        return false;
    }
}
