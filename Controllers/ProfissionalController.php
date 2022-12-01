<?php

namespace App\Controllers;

use App\Models\Profissional;

class ProfissionalController
{
    public static function post()
    {
        return Profissional::insert($_POST);
    }
    public static function get()
    {
        return Profissional::select();
    }
}
