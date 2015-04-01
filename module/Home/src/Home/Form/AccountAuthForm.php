<?

namespace Home\Form;

use Zend\Form\Form;

class AccountAuthForm extends Form
{
    public function __construct($name = null, $option = [])
    {
        parent::__construct('auth');

        $this->setAttribute('method', 'post');
        $this->setInputFilter(new AccountAuthFilter());

        $this->add([
            'name' => 'email',
            'type' => 'email',
            'options' => [
                'label' => 'Email',
            ],
            'attributes' => [
                'id'        => 'email',
                'maxlength' => 45,
            ],
            'validators' => [
                [
                    'name' => 'StringLength',
                    'options' => [
                        'encoding' => 'UTF-8',
                        'max' => 45,
                        'min' => 5,
                    ],
                ],
            ],
            'required' => true,
        ]);

        $this->add([
            'name' => 'password',
            'type' => 'password',
            'options' => [
                'label' => 'Password',
            ],
            'attributes' => [
                'id'        => 'password',
                'maxlength' => 45,
            ],
            'validators' => [
                [
                    'name' => 'StringLength',
                    'options' => [
                        'encoding' => 'UTF-8',
                        'max' => 45,
                    ],
                ],
            ],
            'required' => true,
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

use Zend\InputFilter\InputFilter;

class AccountAuthFilter extends InputFilter
{
    public function __construct()
    {
        $this->add([
            'name' => 'email',
            'required' => true,
            'validators' => [
                [
                    'name' => 'StringLength',
                    'options' => [
                        'encoding' => 'UTF-8',
                        'max' => 45,
                        'min' => 5,
                    ],
                ],
            ],
        ]);

        $this->add([
            'name' => 'password',
            'required' => true,
            'validators' => [
                [
                    'name' => 'StringLength',
                    'options' => [
                        'encoding' => 'UTF-8',
                        'max' => 45,
                        'min' => 5,
                    ],
                ],
            ],
        ]);
    }
}
