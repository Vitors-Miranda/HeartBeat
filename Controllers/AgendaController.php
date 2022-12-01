<?php

namespace App\Controllers;

use App\Models\Agenda;

class AgendaController
{
    public static function post()
    {
        return Agenda::insert($_POST);
    }
    public static function get()
    {
        return Agenda::select();
    }
}
