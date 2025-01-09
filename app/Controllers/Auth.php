<?php

namespace App\Controllers;

use App\Models\PenggunaModel;

class Auth extends BaseController
{
    protected $penggunaModel;

    public function __construct()
    {
        $this->penggunaModel = new PenggunaModel();
    }

    public function login()
    {
        if (session()->get('logged_in')) {
            return redirect()->to('/dashboard');
        }

        return view('auth/login');
    }

    public function processLogin()
    {
        $identity = $this->request->getPost('identity');
        $password = $this->request->getPost('password');

        $user = $this->penggunaModel->verifyLogin($identity, $password);

        if ($user) {
            $sessionData = [
                'id_pengguna' => $user['id_pengguna'],
                'username'    => $user['username'],
                'email'       => $user['email'],
                'no_telp'       => $user['no_telp'],
                'alamat'        => $user['alamat'],
                'role'        => $user['role'],
                'nama_lengkap' => $user['nama_lengkap'],
                'foto_profil' => $user['foto_profil'],
                'logged_in'   => true
            ];

            session()->set($sessionData);

            // Redirect berdasarkan role
            switch ($user['role']) {
                case 'admin':
                    return redirect()->to('/admin/dashboard');
                case 'krew':
                    return redirect()->to('/krew/dashboard');
                default:
                    return redirect()->to('/pelanggan/dashboard');
            }
        }

        return redirect()->back()->with('error', 'Username/Email/No. Telp atau Password salah!');
    }


    public function register()
    {
        if (session()->get('logged_in')) {
            return redirect()->to('/dashboard');
        }

        return view('auth/register');
    }

    public function processRegister()
    {
        $rules = [
            'username' => 'required|is_unique[pengguna.username]|min_length[4]',
            'email'    => 'required|valid_email|is_unique[pengguna.email]',
            'no_telp'  => 'required|is_unique[pengguna.no_telp]|numeric',
            'foto_profil' => 'if_exist|is_image[foto_profil]|max_size[foto_profil,2048]|mime_in[foto_profil,image/jpg,image/jpeg,image/png]',
            'password' => 'required|min_length[6]'

        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'nama_lengkap' => $this->request->getPost('nama_lengkap'),
            'username' => $this->request->getPost('username'),
            'email'    => $this->request->getPost('email'),
            'no_telp'  => $this->request->getPost('no_telp'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'role'     => 'pelanggan'
        ];

        $this->penggunaModel->insert($data);
        return redirect()->to('/login')->with('success', 'Registrasi berhasil! Silakan login.');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}
