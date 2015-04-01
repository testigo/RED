<?

namespace Back\Form\Accounts;

class Form extends \Zend\Form\Form
{
    public function __construct($name = null, $option = [])
    {
        parent::__construct('accounts');

        $this->setAttribute('method', 'post');
        $this->setInputFilter(new InputFilter());

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
            'name' => 'submit',
            'attributes' => [
                'type'  => 'submit',
            ],
        ]);
    }
}
