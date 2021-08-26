<?php

namespace App\Http\Controllers;
use App\Models\Permission;
class HomeController
{
    public function index()
    {   
        return view('home');
    }
}
