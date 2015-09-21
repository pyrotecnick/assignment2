<?php

//namespace model;

$serverFile = '/home/a8979129/public_html/model/status.txt';
$localFile ='model\status.txt';

$stat = stat($serverFile);

if(file_get_contents($serverFile) != NULL && time() - $stat['mtime'] < 25){
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