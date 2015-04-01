<?

namespace Back\Model\HR\Employees;

class Entity extends \Back\Model\Entity
{
    public
        $id,
        $created,
        $update,
        $first_name,
        $second_name,
        $last_name,
        $city,
        $address,
        $email,
        $phone_number,
        $id_position,
        $id_departments,
        $previous_password,
        $password,
        $id_type,
        $active;
}