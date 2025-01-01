<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class AuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // Dapatkan current path
        $currentPath = $request->getUri()->getPath();

        // Daftar path publik yang tidak perlu autentikasi
        $publicPaths = ['', 'login', 'register', 'auth/processLogin', 'auth/processRegister', 'logout'];

        // Jika user sudah login
        if (session()->get('logged_in')) {
            // Jika mencoba mengakses halaman login/register
            if (in_array($currentPath, ['login', 'register'])) {
                $userRole = session()->get('role');
                return redirect()->to(base_url($userRole . '/dashboard'));
            }

            // Cek role permission untuk halaman terproteksi
            if (!empty($arguments) && !in_array(session()->get('role'), $arguments)) {
                $userRole = session()->get('role');
                return redirect()->to(base_url($userRole . '/dashboard'))
                    ->with('error', 'Akses ditolak!');
            }
        }
        // Jika user belum login dan mencoba mengakses halaman terproteksi
        else {
            if (!in_array($currentPath, $publicPaths)) {
                return redirect()->to('/login');
            }
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null) {}
}
