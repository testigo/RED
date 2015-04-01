<?

namespace Back\Form\HR\Employees;

class InputFilter extends \Zend\InputFilter\InputFilter
{
    public function __construct()
    {
        $this->add([
            'name' => 'first_name',
            'required' => true,
            'filters' => [
                [
                    'name' => 'StripTags',
                ],
                [
                    'name' => 'StringTrim',
                ],
            ],
            'validators' => [
                [
                    'name' => 'StringLength',
                    'options' => [
                        'encoding' => 'UTF-8',
                        'max' => 50,
                        'min' => 2,
                    ],
                ],
            ],
        ]);

        $this->add([
            'name' => 'second_name',
            'required' => false,
            'filters' => [
                [
                    'name' => 'StripTags',
                ],
                [
                    'name' => 'StringTrim',
                ],
            ],
            'validators' => [
                [
                    'name' => 'StringLength',
                    'options' => [
                        'encoding' => 'UTF-8',
                        'max' => 50,
                        'min' => 2,
                    ],
                ],
            ],
        ]);

        $this->add([
            'name' => 'last_name',
            'required' => true,
            'filters' => [
                [
                    'name' => 'StripTags',
                ],
                [
                    'name' => 'StringTrim',
                ],
            ],
            'validators' => [
                [
                    'name' => 'StringLength',
                    'options' => [
                        'encoding' => 'UTF-8',
                        'max' => 50,
                        'min' => 2,
                    ],
                ],
            ],
        ]);

        $this->add([
            'name' => 'city',
            'required' => true,
            'filters' => [
                ['name' => 'StripTags'],
                ['name' => 'StringTrim'],
            ],
            'validators' => [
                [
                    'name' => 'StringLength',
                    'options' => [
                        'encoding' => 'UTF-8',
                        'max' => 50,
                        'min' => 2,
                    ],
                ],
            ],
        ]);

        $this->add([
            'name' => 'address',
            'required' => true,
            'filters' => [
                ['name' => 'StripTags'],
                ['name' => 'StringTrim'],
            ],
            'validators' => [
                [
                    'name' => 'StringLength',
                    'options' => [
                        'encoding' => 'UTF-8',
                        'max' => 255,
                        'min' => 2,
                    ],
                ],
            ],
        ]);

        $this->add([
            'name' => 'email',
            'required' => false,
            'filters' => [
                [
                    'name' => 'StringTrim',
                ],
            ],
            'validators' => [
                [
                    'name' => 'StringLength',
                    'options' => [
                        'encoding' => 'UTF-8',
                        'min' => 3,
                        'max' => 100,
                    ],
                ],
                [
                    'name' => 'EmailAddress',
                    'options' => [
                        'useMxCheck' => FALSE
                    ],
                ],
            ],
        ]);

        $this->add([
            'name' => 'phone_number',
            'required' => true,
            'filters' => [
                [
                    'name' => 'StripTags',
                ],
                [
                    'name' => 'StringTrim',
                ],
            ],
            'validators' => [
                [
                    'name' => 'StringLength',
                    'options' => [
                        'encoding' => 'UTF-8',
                        'max' => 14,
                        'min' => 8,
                    ],
                ],
                [
                    'name' => 'Digits',
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

        $this->add([
            'name' => 'active',
            'required' => true,
        ]);

        $this->add([
            'name' => 'id_position',
            'required' => false,
        ]);

        $this->add([
            'name' => 'id_departments',
            'required' => false,
        ]);
    }
}
