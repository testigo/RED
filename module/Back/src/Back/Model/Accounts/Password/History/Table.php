<?

namespace Back\Model\Accounts\Password\History;

use Zend\Db\TableGateway\TableGateway;

class Table extends \Back\Model\Table
{
    public function __construct(TableGateway $tableGateway)
    {
        parent::__construct($tableGateway);

        $this->_entity = new Entity();
        $this->_name = 'back_accounts_password_history';    
    }
}
