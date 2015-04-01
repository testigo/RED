<?

namespace Back\Form\Accounts;

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
    }
}
