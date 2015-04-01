<?

namespace Back\Model\Store;

use Zend\Db\Sql\Select;
use Back\Model\Data\ServiceLocator;

class Data extends ServiceLocator
{
    public $filter;

    public function getCatalog($id)
    {
    	$select = new Select();
    	$select->where([
			'id_catalog' => $id ? $id : null,
		]);

    	return $this->getServiceLocator()
    		->get('Back\Model\Catalog\Table')
    		->fetch($select);
    } 

    public function getCurrentCatalog($id)
    {
    	return $this->getServiceLocator()
    		->get('Back\Model\Catalog\Table')
    		->get($id);
    }

    public function getProducts($catalog)
    {
    	if ($catalog) {
    		$select = new Select();
	    	$select->where([
	    		'id_catalog' => $catalog->id,
			]);

			return $this->getServiceLocator()
				->get('Back\Model\Catalog\Products\Table')
				->fetch($select);
    	} else {
    		return $this->getServiceLocator()
    			->get('Back\Model\Catalog\Products\Table')
    			->fetchAll();
    	}
    }
}
