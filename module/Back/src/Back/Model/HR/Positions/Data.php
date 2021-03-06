<?

namespace Back\Model\HR\Positions;

use Zend\Db\Sql\Select;
use Back\Model\Data\ServiceLocator;
use Back\Model\HR\Positions\Entity as PositionsEntity;

class Data extends ServiceLocator
{
    public $filter;

	public function fetch($request, $filter)
	{
        $this->filter = new PositionsEntity();

        $where = [];
        $like = [];

        if ($request->isPost()) {
            $filter->visible = true;
            $this->filter = $request->getPost();

            if ($this->filter->id) {
                $where['back_positions.id'] = (int) $this->filter->id;
            }

            if ($this->filter->title) {
                $like[0]['col'] = 'back_positions.title';
                $like[0]['value'] = $this->filter->title;
            }

            if ($this->filter->created) {
                $where[] = 'DATE(back_positions.created)' .
                    '= DATE(\'' . date('Y-m-d', strtotime($this->filter->created)) . '\')';
            }

            if ($this->filter->update) {
                $where[] = 'DATE(back_positions.update)' .
                    '= DATE(\'' . date('Y-m-d', strtotime($this->filter->update)) . '\')';
            }
        }

		$select = new Select();

        if ($where) {
            $select->where($where);
        }

        if ($like) {
            $select->where->like(
                $like[0]['col'],
                '%' . $like[0]['value'] . '%'
            );
        }

        if ($filter->search) {
            $select->where->like(
                'back_positions.title',
                '%' . $filter->search . '%'
            );
        }

        $select->order($filter->order_by . ' ' . $filter->order);

        $result = $this->getServiceLocator()
            ->get('Back\Model\HR\Positions\Table')
            ->fetch($select);

        $pagination = $result->setCurrentPageNumber($filter->page)
            ->setItemCountPerPage($filter->itemPerPage)
            ->setPageRange(7);

        $filter->url_order = ($filter->order == 'ASC') ? 'DESC' : 'ASC';

        return (object) [
            'pagination' => $pagination,
            'filter' => $filter,
            'count' => $result->getAdapter()->count(),
            '_filter' => $this->filter,
        ];
    }

    public function get($id)
    {
        return $this->getServiceLocator()
            ->get('Back\Model\HR\Positions\Table')
            ->get($id);
    }
}
