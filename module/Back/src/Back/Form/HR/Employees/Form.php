<?

namespace Back\Form\HR\Employees;

use Zend\Stdlib\Hydrator\ClassMethods;

class Form extends \Zend\Form\Form
{
    public function __construct($name = null, $options = [])
    {
        parent::__construct('employees');

        $this->setAttribute('method', 'post');
        $this->setInputFilter(new InputFilter());
        $this->setHydrator(new ClassMethods());
        $this->setAttribute('enctype', 'multipart/form-data');

        $this->add([
            'name' => 'id',
            'type' => 'hidden',
        ]);

        $this->add([
            'name' => 'created',
            'type' => 'hidden',
        ]);

        $this->add([
            'name' => 'update',
            'type' => 'hidden',
        ]);

        $this->add([
            'name' => 'first_name',
            'type' => 'text',
            'attribute' => [
                'maxlength' => 50,
            ],
        ]);

        $this->add([
            'name' => 'second_name',
            'type' => 'text',
            'attribute' => [
                'maxlength' => 50,
            ],
        ]);

        $this->add([
            'name' => 'last_name',
            'type' => 'text',
            'attribute' => [
                'maxlength' => 50,
            ],
        ]);

        $this->add([
            'name' => 'city',
            'type' => 'text',
            'attribute' => [
                'maxlength' => 50,
            ],
        ]);

        $this->add([
            'name' => 'address',
            'type' => 'text',
            'attribute' => [
                'maxlength' => 255,
            ],
        ]);

        $this->add([
            'name' => 'email',
            'type' => 'email',
            'attributes' => [
                'maxlength' => 45,
            ],
        ]);

        $this->add([
            'name' => 'phone_number',
            'type' => 'text',
            'attribute' => [
                'maxlength' => 15,
            ],
        ]);

        $this->add([
            'name' => 'id_position',
            'type' => 'select',
        ]);

        $this->add([
            'name' => 'id_departments',
            'type' => 'select',
        ]);

        $this->add([
            'name' => 'id_type',
            'type' => 'hidden',
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
            'name' => 'active',
            'type' => 'hidden',
        ]);

        $this->add([
            'name' => 'submit',
            'attributes' => [
                'type' => 'submit',
            ],
        ]);
    }
}
