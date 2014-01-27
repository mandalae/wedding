<?php
class DB{

    var $_db;
    var $_last_query;

    function __construct(){
        include "_inc/credentials.php";

        $this->_db = mysql_connect($dbhost, $dbuser, $dbpass);
        mysql_select_db($dbbass);
        return $this;
    }

    public function getMysqli(){
        return $this->_db;
    }

    public function query($sql){
    	$this->_last_query = $sql;
        $res = mysql_query($sql);
        if (!$res || is_string($res)){
            throw new Exception("Error in sql statement (" . $res . "): " . mysql_error($this->_db));
        }
        return $res;
    }

    public function getLastId(){
    	return mysql_insert_id();
    }

    public function getLastQuery()
{    	return $this->_last_query;
    }

    public function getOne($sql){
    	$this->_last_query = $sql;
    	$res = mysql_query($sql);
    	if (mysql_num_rows($res) > 0){
	    	$row = mysql_fetch_row($res);
	    	return $row[0];
    	} else {
    		return null;
    	}
    }

    public function getAll($sql){
    	$this->_last_query = $sql;
    	$res = mysql_query($sql);
        if (!$res || is_string($res)){
            throw new Exception("Error in sql statement (" . $res . "): " . mysql_error($this->_db));
        }
        $data = array();
        while ($row = mysql_fetch_array($res)){
        	$data[] = $row;
        }
        return $data;
    }

}
?>