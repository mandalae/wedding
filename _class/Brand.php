<?php
class Brand extends Content {
    
    protected $_id = 'id';
    protected $_tableName = 'brands';
    
    public function getAllActive(){
        $sql = "SELECT * FROM " . $this->_tableName . " WHERE active > 0";
        $res = $this->_db->query($sql);
        $return = array();
        while ($row = mysql_fetch_array($res)){
            $return[] = $row;
        }
        return $return;
    }
    
}