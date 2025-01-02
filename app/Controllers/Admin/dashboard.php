<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseAdmin;
use App\Models\BarangModel;
use App\Models\PenggunaModel;

class Dashboard extends BaseAdmin
{
    protected $barangModel;
    protected $penggunaModel;

    public function __construct()
    {
        $this->barangModel = new BarangModel();
        $this->penggunaModel = new PenggunaModel();
    }

    public function index()
    {
        return view('users/admin/dashboard');
    }

    // Sistem CRUD barang
    // Tampilkan dashboard dengan tabel barang
    public function indexBarang()
    {
        $perPage = 15; // Jumlah item per halaman
        $searchQuery = $this->request->getGet('q'); // Kata kunci pencarian

        // Filter pencarian
        $barangQuery = $this->barangModel->orderBy('created_at', 'DESC');
        if ($searchQuery) {
            $barangQuery = $barangQuery->like('nama_barang', $searchQuery);
        }

        // Ambil data barang dengan pagination
        $currentPage = $this->request->getGet('page') ?? 1;
        $barang = $barangQuery->paginate($perPage);

        $data = [
            'barang' => $barang,
            'pager' => $this->barangModel->pager,
            'searchQuery' => $searchQuery,
            'currentPage' => $currentPage,
        ];

        return view('users/admin/barang/index', $data);
    }



    // Form tambah barang
    public function createBarang()
    {
        return view('users/admin/barang/create');
    }

    // Proses tambah barang
    public function storeBarang()
    {
        $this->barangModel->save($this->request->getPost());
        return redirect()->to('/admin/dashboard/barang')->with('success', 'Barang berhasil ditambahkan.');
    }

    // Form edit barang
    public function editBarang($id)
    {
        $data = [
            'barang' => $this->barangModel->find($id),
        ];
        return view('users/admin/barang/edit', $data);
    }

    // Proses update barang
    public function updateBarang($id)
    {
        $this->barangModel->update($id, $this->request->getPost());
        return redirect()->to('/admin/dashboard/barang')->with('success', 'Barang berhasil diubah.');
    }

    // Proses hapus barang
    public function deleteBarang($id)
    {
        $this->barangModel->delete($id);
        return redirect()->to('/admin/dashboard/barang')->with('success', 'Barang berhasil dihapus.');
    }


    // Sistem CRUD Akun
    // Menampilkan dashboard dan daftar pengguna
    // Menampilkan daftar pengguna
    public function indexAkun()
    {
        $data['pengguna'] = $this->penggunaModel->findAll();
        return view('users/admin/akun/index', $data);
    }

    // Menampilkan form tambah pengguna
    public function createAkun()
    {
        return view('users/admin/akun/create', [
            'roles' => ['admin', 'krew', 'pelanggan']
        ]);
    }

    // Proses tambah pengguna
    public function storeAkun()
    {
        if (!$this->validate([
            'username' => 'required|min_length[3]|max_length[50]',
            'nama_lengkap' => 'required',
            'email' => 'required|valid_email',
            'no_telp' => 'required|numeric',
            'password' => 'required|min_length[8]',
            'role' => 'required',
        ])) {
            return redirect()->to('/admin/dashboard/akun/indexAkun')->withInput();
        }

        $this->penggunaModel->insert([
            'username' => $this->request->getPost('username'),
            'nama_lengkap' => $this->request->getPost('nama_lengkap'),
            'email' => $this->request->getPost('email'),
            'no_telp' => $this->request->getPost('no_telp'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'role' => $this->request->getPost('role'),
            'status' => 'aktif',
        ]);

        return redirect()->to('/admin/dashboard/akun')->with('success', 'Akun pengguna berhasil ditambahkan');
    }

    // Menampilkan form edit pengguna
    public function editAkun($id)
    {
        $data['pengguna'] = $this->penggunaModel->find($id);
        $data['pengguna'] = $this->penggunaModel->find($id);
        $data['roles'] = ['admin', 'krew', 'pelanggan'];
        return view('users/admin/akun/edit', $data);
    }

    // Proses edit pengguna
    public function updateAkun($id)
    {
        if (!$this->validate([
            'username' => 'required|min_length[3]|max_length[50]',
            'nama_lengkap' => 'required',
            'email' => 'required|valid_email',
            'no_telp' => 'required|numeric',
            'role' => 'required',
        ])) {
            return redirect()->to('/admin/dashboarod/akun/editAkun/' . $id)->withInput();
        }

        $data = [
            'username' => $this->request->getPost('username'),
            'nama_lengkap' => $this->request->getPost('nama_lengkap'),
            'email' => $this->request->getPost('email'),
            'no_telp' => $this->request->getPost('no_telp'),
            'role' => $this->request->getPost('role'),
            'status' => $this->request->getPost('status'),
        ];

        // Update password jika ada perubahan
        if ($this->request->getPost('password')) {
            $data['password'] = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);
        }

        $this->penggunaModel->update($id, $data);

        return redirect()->to('/admin/dashboard/akun')->with('success', 'Akun pengguna berhasil diperbarui');
    }

    // Hapus pengguna
    public function deleteAkun($id)
    {
        $this->penggunaModel->delete($id);
        return redirect()->to('users/admin/akun')->with('success', 'Akun pengguna berhasil dihapus');
    }
}
