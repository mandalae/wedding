<?php
class ACL extends Content {
    
    protected $_id = 'id';
    protected $_tableName = 'acl';
    
    public function getAllActive(){
        $sql = "SELECT * FROM " . $this->_tableName;
        $res = $this->_db->query($sql);
        $return = array();
        while ($row = mysql_fetch_array($res)){
            $return[] = $row;
        }
        return $return;
    }
    
}