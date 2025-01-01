<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class BasePelanggan extends Controller
{
    protected $session;

    public function __construct()
    {
        $this->session = session();

        // Cek jika user bukan admin
        if ($this->session->get('role') !== 'pelanggan') {
            header('Location: ' . base_url('/login'));
            exit();
        }
    }
}
