<?

namespace Back\Model;

class Entity
{
    public function exchangeArray($data)
    {
        foreach ($this->getArrayCopy() as $key => $value) {
            $this->$key = $this->get($data[$key]);
        }
    }
    
	public function getArrayCopy()
    {
        return get_object_vars($this);
    }
    
	public function get(&$val, $default = null) 
    {
        if (isset($val)) { 
            return $val; 
        }

        return $default;
    }
}
