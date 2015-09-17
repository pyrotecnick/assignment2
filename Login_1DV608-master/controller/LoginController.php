<?php

//namespace controller;

static $loggedIn = FALSE;

class LoginController {
    
    
    public function _constructor(){
    }
    
    public static function login(){
        $this->loggedIn = TRUE;
    }
    
    public static function logout(){
        $this->loggedIn = FALSE;
    }
    
    function getUserStatus(){
        return $this->loggedIn;
    }
}

