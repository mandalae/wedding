<?php
class User extends Content {
    
    protected $_id = 'id';
    protected $_tableName = 'users';
    
    public function login($username, $password){
        $sql = "SELECT * FROM " . $this->_tableName . " WHERE email = '" . $username . "' AND password = '" . md5($password) . "' AND active > 0 AND deleted = 0 LIMIT 1";
        $res = $this->_db->query($sql);
        $row = mysql_fetch_array($res);
        if (count($row) > 0){
            // User found
            $_SESSION['user'] = serialize(new User($row));
            
            return true;
        } else {
            return false;
        }
    }
    
    public function isLoggedIn(){
        return isset($_SESSION['user']);
    }
    
    public function logout(){
        return session_destroy();
    }
    
    public function getAll(){
        $sql = "SELECT u.*, a.name as aclName FROM " . $this->_tableName . " u, acl a WHERE u.acl = a.id";
        $res = $this->_db->query($sql);
        $return = array();
        while ($row = mysql_fetch_array($res)){
            $return[] = $row;
        }
        return $return;
    }
    
    public function getAllByType($type){
        $sql = "SELECT u.*, a.name as aclName FROM " . $this->_tableName . " u, acl a WHERE u.acl = a.id AND a.acl_text IN ('" . implode("','", $type) . "')";
        $res = $this->_db->query($sql);
        $return = array();
        while ($row = mysql_fetch_array($res)){
            $return[] = $row;
        }
        return $return;
    }
}