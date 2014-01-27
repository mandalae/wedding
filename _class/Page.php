<?php

require_once '_inc/Smarty/Smarty.class.php';

class Page extends Smarty {
    
    public function Page(){
        // initilize smarty by calling the smarty constructor class
        parent::__construct();
        $this->template_dir = DOCUMENT_ROOT.'/templates/';
        $this->compile_dir = DOCUMENT_ROOT.'/smarty/';
        //$this->caching = Smarty::CACHING_LIFETIME_CURRENT;
        $this->caching = Smarty::CACHING_OFF;
        $this->debugging = false;
    }
    
}