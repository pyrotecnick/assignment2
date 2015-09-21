<?php

//namespace model;

$serverFile = '/home/a8979129/public_html/model/status.txt';
$localFile ='model\status.txt';

$stat = stat($localFile);

if(file_get_contents($localFile) != NULL && time() - $stat['mtime'] < 25){
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