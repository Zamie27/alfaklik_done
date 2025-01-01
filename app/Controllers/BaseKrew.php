<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class BaseKrew extends Controller
{
    protected $session;

    public function __construct()
    {
        $this->session = session();

        // Cek jika user bukan admin
        if ($this->session->get('role') !== 'krew') {
            header('Location: ' . base_url('/login'));
            exit();
        }
    }
}
