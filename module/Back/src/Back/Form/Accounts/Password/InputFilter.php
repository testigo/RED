<?

namespace Back\Form\Accounts\Password;

class InputFilter extends \Zend\InputFilter\InputFilter
{
    public function __construct()
    {
        $this->add([
            'name' => 'password_current',
            'required' => true,
            'validators' => [
                [
                    'name' => 'StringLength',
                    'options' => [
                        'encoding' => 'UTF-8',
                        'max' => 32,
                        'min' => 8,
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
                        'max' => 32,
                        'min' => 8,
                    ],
                ],
            ],
        ]);

        $this->add([
            'name' => 'password_check',
            'required' => true,
            'validators' => [
                [
                    'name' => 'StringLength',
                    'options' => [
                        'encoding' => 'UTF-8',
                        'max' => 32,
                        'min' => 8,
                    ],
                ],
                [
                    'name' => 'Identical',
                    'options' => [
                        'token' => 'password',
                    ],
                ],
            ],
        ]);
    }
}
