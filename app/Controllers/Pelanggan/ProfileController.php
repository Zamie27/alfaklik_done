<?php

namespace App\Controllers\Pelanggan;

use App\Controllers\BaseController;
use App\Models\PenggunaModel;

class ProfileController extends BaseController
{
    protected $penggunaModel;

    public function __construct()
    {
        $this->penggunaModel = new PenggunaModel();
    }

    public function index()
    {
        $data['user'] = $this->penggunaModel->find(session()->get('id_pengguna'));

        if (!$data['user']) {
            return redirect()->back()->with('error', 'Data pengguna tidak ditemukan.');
        }

        return view('users/pelanggan/profile', $data);
    }

    public function update()
    {
        $id = session()->get('id_pengguna');
        $user = $this->penggunaModel->find($id);

        if (!$user) {
            return redirect()->back()->with('error', 'Pengguna tidak ditemukan.');
        }

        // Validasi data
        $rules = [
            'nama_lengkap' => 'required|min_length[3]|max_length[255]',
            'no_telp'      => 'required|min_length[10]|max_length[15]',
            'email'        => 'required|valid_email|max_length[255]',
            'alamat'       => 'permit_empty|max_length[255]',
            'password'     => 'permit_empty|min_length[6]',
            'confirm_password' => 'permit_empty|matches[password]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('error', $this->validator->getErrors());
        }

        // Data yang diperbarui
        $data = [
            'nama_lengkap' => $this->request->getPost('nama_lengkap'),
            'no_telp'      => $this->request->getPost('no_telp'),
            'email'        => $this->request->getPost('email'),
            'alamat'       => $this->request->getPost('alamat'),
        ];

        // Proses perubahan password
        $password = $this->request->getPost('password');
        $confirmPassword = $this->request->getPost('confirm_password');

        if (!empty($password) || !empty($confirmPassword)) {
            if ($password !== $confirmPassword) {
                return redirect()->back()->with('error', 'Password baru dan konfirmasi tidak cocok.');
            }
            $data['password'] = password_hash($password, PASSWORD_DEFAULT);
        }

        // Proses unggah foto profil
        $file = $this->request->getFile('foto_profil');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $fileName = $file->getRandomName();
            $file->move('uploads/profiles', $fileName);

            // Hapus foto lama
            if ($user['foto_profil'] && file_exists($user['foto_profil'])) {
                unlink($user['foto_profil']);
            }

            $data['foto_profil'] = 'uploads/profiles/' . $fileName;
        }

        // Perbarui data
        $this->penggunaModel->update($id, $data);

        // Tambahkan pesan sukses berdasarkan perubahan
        if (!empty($password)) {
            return redirect()->back()->with('success', 'Password berhasil diperbarui!');
        }

        if ($file && $file->isValid() && !$file->hasMoved()) {
            return redirect()->back()->with('success', 'Profil dan foto berhasil diperbarui!');
        }

        return redirect()->back()->with('success', 'Profil berhasil diperbarui!');
    }


    public function updatePhoto()
    {
        $idPengguna = session()->get('id_pengguna');
        $fotoProfil = $this->request->getFile('foto_profil');

        if ($fotoProfil && $fotoProfil->isValid() && !$fotoProfil->hasMoved()) {
            $newName = $fotoProfil->getRandomName();
            $fotoProfil->move('img/users/pelanggan/profile', $newName);

            $this->penggunaModel->update($idPengguna, ['foto_profil' => 'img/users/pelanggan/profile/' . $newName]);
            return redirect()->back()->with('success', 'Foto profil berhasil diperbarui.');
        }

        return redirect()->back()->with('error', 'Gagal mengupload foto profil.');
    }
}
