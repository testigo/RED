<?

namespace Back\Model\Users;

use Back\Model\Data\ServiceLocator;

class Data extends ServiceLocator
{
    public function get($id)
    {
        return $this->getServiceLocator()
            ->get('Back\Model\Users\Table')
            ->get($id);
    }
}
