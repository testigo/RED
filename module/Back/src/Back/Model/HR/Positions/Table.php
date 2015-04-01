<?

namespace Back\Model\HR\Positions;

use Zend\Db\TableGateway\TableGateway;
use Back\Model\Table as ParentTable;

class Table extends ParentTable
{
    public function __construct(TableGateway $tableGateway)
    {
        parent::__construct($tableGateway);

        $this->_entity = new Entity();
        $this->_name = 'back_positions';
    }
}
