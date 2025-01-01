<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseAdmin;

class Dashboard extends BaseAdmin
{
    public function index()
    {
        return view('users/admin/dashboard');
    }
}
