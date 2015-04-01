<?

namespace Back\Form\Accounts\Password;

use Zend\Stdlib\Hydrator\ClassMethods;

class Form extends \Zend\Form\Form
{
    public function __construct($name = null, $options = [])
    {
        parent::__construct('password');

        $this->setAttribute('method', 'post');
        $this->setInputFilter(new InputFilter());
        $this->setHydrator(new ClassMethods());
        $this->setAttribute('enctype', 'multipart/form-data');

        $this->add([
            'name' => 'password_current',
            'type' => 'password',
            'attribute' => [
                'maxlength' => 32,
            ],
        ]);

        $this->add([
            'name' => 'password',
            'type' => 'password',
            'attribute' => [
                'maxlength' => 32,
            ],
        ]);

        $this->add([
            'name' => 'password_check',
            'type' => 'password',
            'attribute' => [
                'maxlength' => 32,
            ],
        ]);

        $this->add([
            'name' => 'submit',
            'attributes' => [
                'type' => 'submit',
            ],
        ]);
    }
}
