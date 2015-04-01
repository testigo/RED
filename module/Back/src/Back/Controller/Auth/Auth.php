<?

namespace Back\Controller\Auth;

use Zend\View\Model\ViewModel;
use Zend\Db\Sql\Select;
use Back\Form\Auth\Form;
use Back\Controller\Action;

class Auth extends Action
{
    protected $form;
    protected $authservice;

    public function loginAction()
    {
        if ($this->getAuthService()->hasIdentity()) {
            return $this->redirect()->toRoute('back');
        }

        $this->layout('Auth/layout');
        
        $form = $this->getForm();

        return new ViewModel([
            'form' => $form,
            'messages' => $this->flashMessenger()->getMessages(),
        ]);
    }

    public function authenticateAction()
    {
        $form = $this->getForm();
        $redirect = 'backAuth';
        $request = $this->getRequest();
        
        if ($request->isPost()) {
            $form->setData($request->getPost());

            if ($form->isValid()) {
                $this->getAuthService()
                    ->getAdapter()
                    ->setIdentityColumn('email')
                    ->setIdentity($request->getPost('email'))
                    ->setCredential($request->getPost('password'));
                
                $result = $this->getAuthService()->authenticate();

                foreach($result->getMessages() as $message) {
                    $this->flashmessenger()->addMessage($message);
                }

                if ($result->isValid()) {
                    $redirect = 'back';
                    
                    if ($request->getPost('rememberme') == 1) {
                        $this->getSessionStorage()->setRememberMe(1);
                    }

                    $user = $this->getServiceLocator()
                        ->get('Back\Model\Users\Table')
                        ->get($this->getSessionStorage()->read(), 'email');

                    $type = $this->getServiceLocator()
                        ->get('Back\Model\Users\Type\Table')
                        ->get($user->id_type);

                    $account = $this->getServiceLocator()
                        ->get('Back\Model\Accounts\Table')
                        ->get($user->id, 'id_back_users');
                    
                    $container = [
                        'id' => $user->id,
                        'email' => $request->getPost('email'),
                        'role' => $type->title,
                        'first_name' => $account->first_name,
                        'last_name' => $account->last_name,
                        'shoppingCart' => 0,
                    ];

                    $this->getAuthService()->getStorage()->write($container);
                    $_SESSION['account'] = $container;
                }
            } else {
                $this->flashmessenger()->addMessage('Empty fields');
            }
        }

        return $this->redirect()->toRoute($redirect);
    }

    public function logoutAction()
    {
        $this->getSessionStorage()->forgetMe();
        $this->getAuthService()->clearIdentity();
        $this->flashmessenger()->addMessage("You've been logged out");
        unset($_SESSION['account']);

        return $this->redirect()->toRoute('backAuth');
    }

    public function getForm()
    {
        if (!$this->form) {
            $this->form = new Form();
        }

        return $this->form;
    }
}
