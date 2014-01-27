<?php
class Content{
    
    protected $_db = null;
    protected $_data = array();
    protected $_tableName = '';
    protected $_id = 'id';
    protected $_cache = null;
    
    function __construct($data = null){
        $this->_db = new DB();
        
        $this->_cache = new Cache();
        
        if (is_array($data))
            $this->populate($data);
        if (is_numeric($data)){
            $this->setId($data);
            $this->load();
        }
        if (is_null($data)){
            $this->setId(0);
        }
    }
    
    public function __call($name, $args) {
        if (method_exists($this, $name)) return $this->$name(isset($args[0]) ? $args[0] : null);
        
        if (preg_match('!(get|set)(\w+)!', $name, $match)) {
            $prop = $match[2];
            if ($match[1] == 'get') {
                if (count($args) != 0) {
                    throw new Exception("Method '$name' expected 0 arguments, got " . count($args)."\n");
                }
                return isset($this->_data[$this->fromCamelCase($prop)]) ? $this->_data[$this->fromCamelCase($prop)] : '';
            } else {
                if (count($args) != 1) {
                    throw new Exception("Method '$name' expected 1 argument, got " . count($args)."\n");
                }
                $this->_data[$this->fromCamelCase($prop)] = $args[0];
            }
        } else {
            throw new Exception("Unknown method $name");
        }
    }
    
    function fromCamelCase($str) {
        $str[0] = strtolower($str[0]);
        $func = create_function('$c', 'return "" . strtoupper($c[1]);');
        return preg_replace_callback('/([A-Z])/', $func, $str);
    } 
    
    public function save(){
    	$this->_save();
    }
    
	protected function _save(){
		if ($this->isNew()){
			$sql = "INSERT INTO " . $this->_tableName . " (";

			$x = 1;
			foreach ($this->_data as $key => $value){
				$sql .= $key;
				if (count($this->_data) > $x){
					$sql .= ", ";
				}
				$x++;
			}
			$sql .= ") VALUES (";
			$x = 1;
			foreach ($this->_data as $key => $value){
				if (is_integer($value)){
					$sql .= $value;
				} else {
					//$sql .= "'" . mysql_real_escape_string($value) . "'";
					$sql .= "'" . stripslashes($value) . "'";
				}
				if (count($this->_data) > $x){
					$sql .= ", ";
				}
				$x++;
			}
			$sql .= ");";
		} else {
			$sql = "UPDATE " . $this->_tableName . " SET ";
			$x = 1;
			foreach ($this->_data as $key => $value){
				if (is_integer($value) > 0){
					$sql .= $key. " = " . $value;
				} else {
					//$sql .= $key. " = '" . mysql_real_escape_string($value) . "'";
					$sql .= $key . " = '" . stripslashes($value) . "'";
				}
				if (count($this->_data) > $x){
					$sql .= ", ";
				}
				$x++;
			}
			$sql .= " WHERE " . $this->_id . " = " . $this->getId();
		}
		$this->_db->query($sql);

		// Load object if it was just created
		if ($this->isNew()){
			$this->setId($this->_db->getLastId());
			$this->load();
		}
	}

    private function getId(){
        return $this->_data[$this->_id];
    }
    
    private function setId($id){
        $this->_data[$this->_id] = $id;
    }

	public function isNew(){
		return ($this->getId() == 0);
	}

    public function loadByType($type, $value){
    	$rs = $this->_db->query("SELECT " . $this->_id . " FROM " . $this->_tableName . " WHERE " . $type . " = '" . $value . "' LIMIT 1");
    	if (mysql_num_rows($rs) == 1){
    		$row = mysql_fetch_array($rs);
    		$this->setId($row[$this->_id]);
    		$this->load();
    	}
    	return $this;
    }

	public function load($fields = "*"){
		$rs = $this->_db->query("SELECT " . $fields . " FROM " . $this->_tableName . " WHERE " . $this->_id . " = " . $this->getId());
		$newsarr = mysql_fetch_array($rs);
		
		$this->populate($newsarr);
	}
	
	protected function populate($values){
	    $key = __CLASS__ . '-' . __FUNCTION__ . '-' . $this->_tableName;
	    if (false !== $data = $this->_cache->getData($key)){
	        foreach ($data as $row){
	            if (isset($values[$row['Field']]))
	            	$this->_data[$row['Field']] = $values[$row['Field']];
	            else if (!isset($this->_data[$row['Field']]))
	                $this->_data[$row['Field']] = $row['Default'];
	        }
	    } else {
    	    $rs = $this->_db->query("DESCRIBE " . $this->_tableName);
    	    $rows = array();
    	    while ($row = mysql_fetch_array($rs)){
    	        $rows[] = $row;
    	        if (isset($values[$row['Field']]))
        	    	$this->_data[$row['Field']] = $values[$row['Field']];
        	    else if (!isset($this->_data[$row['Field']]))
        	        $this->_data[$row['Field']] = $row['Default'];
    	    }
    	    $this->_cache->setData($key, $rows);
    	}
	}

    protected function getAll($orderBy = null){
        $sql = "SELECT * FROM " . $this->_tableName;
        if (!is_null($orderBy)){
            $sql .= " ORDER BY " . $orderBy;
        }
        $res = $this->_db->query($sql);
        $return = array();
        while ($row = mysql_fetch_array($res)){
            $return[] = $row;
        }
        return $return;
    }

    protected function toArray(){
        return $this->_data;
    }

    public function delete($softDelete = true){
        $this->_delete($softDelete);
    }

	protected function _delete($softDelete = true){
	    if ($softDelete){
	        $this->_db->query("UPDATE " . $this->_tableName . " SET deleted = unix_timestamp() WHERE " . $this->_id . " = " . $this->getId());
	    } else {
    		$this->_db->query("DELETE FROM " . $this->_tableName . " WHERE " . $this->_id . " = " . $this->getId());
    	}
	}
}