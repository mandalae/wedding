<?php
class Category extends Content {
    
    protected $_id = 'id';
    protected $_tableName = 'categories';
    
    public function getAllActive(){
        $sql = "SELECT * FROM " . $this->_tableName . " WHERE active > 0";
        $res = $this->_db->query($sql);
        $return = array();
        while ($row = mysql_fetch_array($res)){
            $return[] = $row;
        }
        return $return;
    }

    public function getAllActiveForMenu(){
        $sql = "SELECT * FROM " . $this->_tableName . " WHERE active > 0 AND parent_category = 0";
        $res = $this->_db->query($sql);
        $return = array();
        while ($row = mysql_fetch_array($res)){
            $return[$row['id']]['parent'] = $row;
            $return[$row['id']]['children'] = $this->getChildren($row['id']);
        }
        return $return;
    }
    
    public function getChildren($rowId = null){
        if (is_null($rowId)) $rowId = $this->getId();
        
        $sql = "SELECT * FROM " . $this->_tableName . " WHERE active > 0 AND parent_category = " . $rowId;
        $childRes = $this->_db->query($sql);
        $return = array();
        while ($child = mysql_fetch_array($childRes)){
            $return[] = $child;
        }
        return $return;
    }
}