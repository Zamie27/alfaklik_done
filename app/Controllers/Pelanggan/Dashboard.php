<?php

namespace App\Controllers\Pelanggan;

use App\Controllers\BasePelanggan;

class Dashboard extends BasePelanggan
{
    public function index()
    {
        return view('users/pelanggan/dashboard');
    }
}
