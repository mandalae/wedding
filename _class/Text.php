<?php
class Text extends Content {
    
    protected $_id = 'id';
    protected $_tableName = 'texts';
    
    public function getAllActive(){
        $sql = "SELECT * FROM " . $this->_tableName . " WHERE active > 0";
        $res = $this->_db->query($sql);
        $return = array();
        while ($row = mysql_fetch_array($res)){
            $return[] = $row;
        }
        return $return;
    }
    
    public function getAllVisible(){
        $sql = "SELECT * FROM " . $this->_tableName . " WHERE active > 0 AND visible > 0";
        $res = $this->_db->query($sql);
        $return = array();
        while ($row = mysql_fetch_array($res)){
            $return[] = $row;
        }
        return $return;
    }
    
}