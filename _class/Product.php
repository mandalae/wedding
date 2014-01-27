<?php
class Product extends Content {
    
    protected $_id = 'id';
    protected $_tableName = 'products';
    
    public function getActiveProducts($options = array(), $offset = 0, $limit = 10){
        $sql = "SELECT * FROM " . $this->_tableName . " WHERE active > 0 AND name != ''";
        $countSql = "SELECT count(1) as number FROM " . $this->_tableName . " WHERE active > 0 AND name != ''";
        
        if (isset($options['categories']) && count($options['categories']) > 0){
            $sql .= " AND category IN (" . implode(',', $options['categories']) . ")";
            $countSql .= " AND category IN (" . implode(',', $options['categories']) . ")";
        }
        
        if (isset($options['brand']) && $options['brand'] > 0){
            $sql .= " AND brand = " . $options['brand'];
            $countSql .= " AND brand = " . $options['brand'];
        }

        if (isset($options['offer']) && $options['offer']){
            $sql .= " AND offer > 0";
            $countSql .= " AND brand > 0";
        }

        if (isset($options['query']) && $options['query']){
            $sql .= " AND name LIKE '%" . $options['query'] . "%'";
            $countSql .= " AND name LIKE '%" . $options['query'] . "%'";
        }

        if (isset($options['price']) && count($options['price']) > 0){
            $sql .= " AND price > " . $options['price']['lower']*100 . " AND price < " . $options['price']['upper']*100; 
            $countSql .= " AND price > " . $options['price']['lower']*100 . " AND price < " . $options['price']['upper']*100;
        }

        $count = $this->_db->query($countSql);
        $countRow = mysql_fetch_row($count);

        $sql .= " LIMIT " . $offset . "," . $limit;
        
        $res = $this->_db->query($sql);
        $return = array();
        while ($row = mysql_fetch_array($res)){
            $return[] = $row;
        }

        return array('products' => $return, 'numberOfProducts' => $countRow[0]);
    }
    
    public function getFormattedPrice(){
        return number_format($this->getPrice()/100, 2);
    }
    
    public function getFormattedWeight(){
        return number_format($this->getWeight()/100, 2);
    }
}