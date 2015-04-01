<?

namespace Back\Model;

use Zend\Db\Sql\Select;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;
use Zend\Paginator\Paginator;
use Zend\Paginator\Adapter\DbSelect;

class Table
{
    protected $_tableGateway;
    protected $_name = null;
    protected $_entity = null;

    public function __construct(TableGateway $tableGateway)
    {
        $this->_tableGateway = $tableGateway;
    }

    public function fetchAll()
    {
        $resultSet = $this->_tableGateway->select();
        return $resultSet;
    }

    public function fetch(Select $select)
    {
        $select->from($this->_name);
        $resultSetPrototype = new ResultSet();
        $resultSetPrototype->setArrayObjectPrototype($this->_entity);
        $paginatorAdapter = new DbSelect(
            $select,
            $this->_tableGateway->getAdapter(),
            $resultSetPrototype
        );
        $paginator = new Paginator($paginatorAdapter);
        return $paginator;
    }

    public function get($value, $col = 'id')
    {
        $rowset = $this->_tableGateway->select([$col => $value]);
        return $rowset->current();
    }

    public function save($entity)
    {
        $data = (array) $entity;
        $id = (int) $entity->id;

        if (isset($data['url'])) {
            if (!$data['url']) {
                $data['url'] = $this->translit($data['title']);
            } else {
                $data['url'] = $this->translit($data['url']);
            }
        }

        if ($id == 0) {
            $this->_tableGateway->insert($data);
            return $this->_tableGateway->getLastInsertValue();
        } else {
            if ($this->get($id)) {
                $this->_tableGateway->update(
                    $data,
                    ['id' => $id]
                );
            }
            return $id;
        }
    }

    public function delete($entity)
    {
        $this->_tableGateway->delete(['id' => (int) $entity->id]);
    }

    public function hide($id, $action)
    {
        if (!isset($id, $action))
            return false;

        if ($action) {
            $action = 'yes';
        } else {
            $action = 'no';
        }

        return $this->_tableGateway->update(
            ['hide' => $action],
            ['id' => $id]
        );
    }

    public function translit($str)
    {
        $tr = [
            "А"=>"a",
            "Б"=>"b",
            "В"=>"v",
            "Г"=>"g",
            "Д"=>"d",
            "Е"=>"e",
            "Ж"=>"j",
            "З"=>"z",
            "И"=>"i",
            "Й"=>"y",
            "К"=>"k",
            "Л"=>"l",
            "М"=>"m",
            "Н"=>"n",
            "О"=>"o",
            "П"=>"p",
            "Р"=>"r",
            "С"=>"s",
            "Т"=>"t",
            "У"=>"u",
            "Ф"=>"f",
            "Х"=>"h",
            "Ц"=>"ts",
            "Ч"=>"ch",
            "Ш"=>"sh",
            "Щ"=>"sch",
            "Ъ"=>"",
            "Ы"=>"yi",
            "Ь"=>"",
            "Э"=>"e",
            "Ю"=>"yu",
            "Я"=>"ya",
            "а"=>"a",
            "б"=>"b",
            "в"=>"v",
            "г"=>"g",
            "д"=>"d",
            "е"=>"e",
            "ж"=>"j",
            "з"=>"z",
            "и"=>"i",
            "й"=>"y",
            "к"=>"k",
            "л"=>"l",
            "м"=>"m",
            "н"=>"n",
            "о"=>"o",
            "п"=>"p",
            "р"=>"r",
            "с"=>"s",
            "т"=>"t",
            "у"=>"u",
            "ф"=>"f",
            "х"=>"h",
            "ц"=>"ts",
            "ч"=>"ch",
            "ш"=>"sh",
            "щ"=>"sch",
            "ъ"=>"y",
            "ы"=>"yi",
            "ь"=>"",
            "э"=>"e",
            "ю"=>"yu",
            "я"=>"ya",
            " "=>"_",
            "."=>"",
            "/"=>"_",
            'І' => 'I',
            'і' => 'i',
            'Ґ' => 'G',
            'ґ' => 'g',
            'Ї' => 'YI',
            'ї' => 'yi',
            'Є' => 'YE',
            'є' => 'ye',
            '0' => '',
            '1' => '',
            '2' => '',
            '3' => '',
            '4' => '',
            '5' => '',
            '6' => '',
            '7' => '',
            '8' => '',
            '9' => '',
        ];
        $urlstr = strtr($str, $tr);
        $urlstr = preg_replace('/[^A-Za-z0-9_\-]/', '', $urlstr);
        return $urlstr;
    }
}
