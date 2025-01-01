<?php

namespace App\Controllers\Krew;

use App\Controllers\BaseKrew;

class Dashboard extends BaseKrew
{
    public function index()
    {
        return view('users/krew/dashboard');
    }
}
