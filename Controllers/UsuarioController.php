<?php

namespace App\Controllers;
use App\Models\Usuario;

class usuarioController{
    public static function post(){
        return Usuario::insert($_POST);
    }
    public static function get(){
        return Usuario::select();
    }
    public static function put(){
        $_PUT = json_decode(file_get_contents('php://input'), true);
        return Usuario::update($_PUT); 
    }
}