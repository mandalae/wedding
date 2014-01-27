<?php
class Image_Tag extends Content {
    
    protected $_id = 'id';
    protected $_tableName = 'image_tags';
    
    public function addTags($tags, $imageId){
        $sql = "REPLACE INTO " . $this->_tableName . " (tag, image_id) VALUES ";
        foreach ($tags as $tag){
            $sql .= " ('".trim($tag)."', ".$imageId."),";
        }
        $this->_db->query(substr($sql, 0, -1));
    }
}