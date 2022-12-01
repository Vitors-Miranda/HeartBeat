<?php

namespace App\Controllers;
use App\Models\Login;

class LoginController{
    public static function post(){
        return Login::logar($_POST);
    }
    public static function get(){
        return Login::verificaLogin();
    }
}