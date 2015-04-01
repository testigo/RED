<?

namespace Back\Form\Auth;

class Form extends \Zend\Form\Form
{
    public function __construct($name = null, $option = [])
    {
        parent::__construct('auth');

        $this->setAttribute('method', 'post');
        $this->setInputFilter(new InputFilter());

        $this->add([
            'name' => 'email',
            'type' => 'email',
            'attributes' => [
                'maxlength' => 45,
            ],
        ]);

        $this->add([
            'name' => 'password',
            'type' => 'password',
            'attributes' => [
                'maxlength' => 45,
            ],
        ]);

        $this->add([
            'type' => 'Zend\Form\Element\Checkbox',
            'name' => 'checkbox',
        	'options' => [
                'label' => 'Remember me',
                'use_hidden_element' => true,
                'checked_value' => 'good',
                'unchecked_value' => 'bad'
            ],
        ]);

        $this->add([
            'name' => 'submit',
            'attributes' => [
                'type'  => 'submit',
            ],
        ]);
    }
}
