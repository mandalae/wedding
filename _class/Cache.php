<?php
class Cache {
    
    private $_cacheDir = '/cache/';
    
    function Cache($cacheDir = null){
        if (!is_null($cacheDir)){
            $this->_cacheDir = $cacheDir;
        } else {
            $this->_cacheDir = str_replace('mobile', '', $_SERVER['DOCUMENT_ROOT']) . "/../cache/";
        }
        
        if (!is_dir($this->_cacheDir))
            mkdir($this->_cacheDir, 0777);
    }
    
    public function getData($key){
        if (is_file($this->_cacheDir . $key)){
            return unserialize(file_get_contents($this->_cacheDir . $key));
        }
        return false;
    }
    
    public function setData($key, $data){
        if (is_file($this->_cacheDir . $key)){
            //unset($this->_cacheDir . $key);
        }
        $file = fopen($this->_cacheDir . $key, 'w');
        fwrite($file, serialize($data));
        fclose($file);
    }
    
}