<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Admin extends BaseController
{
    public function index()
    {
        return view('Pages/dashboard', [
            'title' => 'Dashboard Admin'
        ]);
    }
}