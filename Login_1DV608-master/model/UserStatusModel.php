<?php

//namespace model;
if(file_get_contents("model/status.txt") != NULL){
    $GLOBALS['loggedIn'] = TRUE;
}else{
    $GLOBALS['loggedIn'] = FALSE;
}
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