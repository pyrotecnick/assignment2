<?php

//namespace model;
$GLOBALS['loggedIn'] = FALSE;
class UserStatusModel {
    
    private $loginView;
    private $layoutView;
    private $loginController;
    
    
    
    public function _constructor($loginView, $layoutView, $loginController){
        $this->loginView = $loginView;
        $this->layoutView = $layoutView;
        $this->loginController = $loginController;
        
    }
    
}