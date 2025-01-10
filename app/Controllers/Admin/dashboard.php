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
        $fotoBarang = $this->request->getFile('gambar_barang');

        if ($fotoBarang && $fotoBarang->isValid() && !$fotoBarang->hasMoved()) {
            // Generate nama file baru yang unik
            $newName = $fotoBarang->getRandomName();
            $fotoBarang->move('img/barang', $newName);

            // Simpan data barang ke database
            $this->barangModel->save([
                'nama_barang' => $this->request->getPost('nama_barang'),
                'harga_barang' => $this->request->getPost('harga_barang'),
                'deskripsi_barang' => $this->request->getPost('deskripsi_barang'),
                'jumlah_stock' => $this->request->getPost('jumlah_stock'),
                'gambar_barang' => 'img/barang/' . $newName, // Path lengkap gambar
            ]);

            return redirect()->to('/admin/dashboard/barang')->with('success', 'Barang berhasil ditambahkan.');
        }

        return redirect()->back()->with('error', 'Gagal menambahkan barang. Pastikan semua data diisi dengan benar.');
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
        // Ambil data barang berdasarkan ID
        $barang = $this->barangModel->find($id);

        if (!$barang) {
            return redirect()->to('/admin/dashboard/barang')->with('error', 'Barang tidak ditemukan.');
        }

        // Proses gambar baru jika diunggah
        $fotoBarang = $this->request->getFile('gambar_barang');
        $gambarPath = $barang['gambar_barang']; // Gunakan gambar lama sebagai default

        if ($fotoBarang && $fotoBarang->isValid() && !$fotoBarang->hasMoved()) {
            // Generate nama file baru
            $newName = $fotoBarang->getRandomName();
            $fotoBarang->move('img/barang', $newName);

            // Hapus gambar lama jika ada
            if ($gambarPath && file_exists($gambarPath)) {
                unlink($gambarPath);
            }

            // Update path gambar dengan file baru
            $gambarPath = 'img/barang/' . $newName;
        }

        // Update data barang
        $data = [
            'nama_barang' => $this->request->getPost('nama_barang'),
            'harga_barang' => $this->request->getPost('harga_barang'),
            'deskripsi_barang' => $this->request->getPost('deskripsi_barang'),
            'jumlah_stock' => $this->request->getPost('jumlah_stock'),
            'gambar_barang' => $gambarPath,
        ];

        $this->barangModel->update($id, $data);

        return redirect()->to('/admin/dashboard/barang')->with('success', 'Barang berhasil diperbarui.');
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

    // Sistem CRUD Banner
    public function indexBanner()
    {
        $bannerModel = new \App\Models\BannerModel();
        $banners = $bannerModel->findAll();

        $data = [
            'banners' => $banners,
        ];

        return view('users/admin/banner/index', $data);
    }

    public function createBanner()
    {
        return view('users/admin/banner/create');
    }

    public function storeBanner()
    {
        $bannerModel = new \App\Models\BannerModel();
        $image = $this->request->getFile('banner_image');

        if ($image && $image->isValid() && !$image->hasMoved()) {
            $newName = $image->getRandomName();
            $image->move('public/img/banner', $newName);

            $bannerModel->save([
                'image_path' => 'img/banner/' . $newName,
                'keterangan' => $this->request->getPost('keterangan'),
            ]);

            return redirect()->to('/admin/dashboard/banner')->with('success', 'Banner berhasil ditambahkan.');
        }

        return redirect()->back()->with('error', 'Gagal menambahkan banner.');
    }

    public function editBanner($id)
    {
        $bannerModel = new \App\Models\BannerModel();
        $banner = $bannerModel->find($id);

        if (!$banner) {
            return redirect()->to('/admin/dashboard/banner')->with('error', 'Banner tidak ditemukan.');
        }

        $data = [
            'banner' => $banner,
        ];

        return view('users/admin/banner/edit', $data);
    }

    public function updateBanner($id)
    {
        $bannerModel = new \App\Models\BannerModel();
        $banner = $bannerModel->find($id);

        if (!$banner) {
            return redirect()->to('/admin/dashboard/banner')->with('error', 'Banner tidak ditemukan.');
        }

        $image = $this->request->getFile('banner_image');
        $imagePath = $banner['image_path']; // Default path adalah gambar lama

        if ($image && $image->isValid() && !$image->hasMoved()) {
            $newName = $image->getRandomName();
            $image->move('public/img/banner', $newName);

            // Hapus gambar lama jika ada
            if ($imagePath && file_exists('public/' . $imagePath)) {
                unlink('public/' . $imagePath);
            }

            $imagePath = 'img/banner/' . $newName;
        }

        $bannerModel->update($id, [
            'image_path' => $imagePath,
            'keterangan' => $this->request->getPost('keterangan'),
        ]);

        return redirect()->to('/admin/dashboard/banner')->with('success', 'Banner berhasil diperbarui.');
    }

    public function deleteBanner($id)
    {
        $bannerModel = new \App\Models\BannerModel();
        $banner = $bannerModel->find($id);

        if (!$banner) {
            return redirect()->to('/admin/dashboard/banner')->with('error', 'Banner tidak ditemukan.');
        }

        // Hapus gambar dari folder jika ada
        if ($banner['image_path'] && file_exists('public/' . $banner['image_path'])) {
            unlink('public/' . $banner['image_path']);
        }

        $bannerModel->delete($id);

        return redirect()->to('/admin/dashboard/banner')->with('success', 'Banner berhasil dihapus.');
    }

    // Sistem CRUD profile
    public function indexProfile()
    {
        $data['user'] = $this->penggunaModel->find(session()->get('id_pengguna'));

        if (!$data['user']) {
            return redirect()->back()->with('error', 'Data pengguna tidak ditemukan.');
        }

        return view('users/admin/profile', $data);
    }

    public function updateProfile()
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


    public function updatePhotoProfile()
    {
        $idPengguna = session()->get('id_pengguna');
        $fotoProfil = $this->request->getFile('foto_profil');

        if ($fotoProfil && $fotoProfil->isValid() && !$fotoProfil->hasMoved()) {
            $newName = $fotoProfil->getRandomName();
            $fotoProfil->move('img/users/admin/profile', $newName);

            $this->penggunaModel->update($idPengguna, ['foto_profil' => 'img/users/admin/profile/' . $newName]);
            return redirect()->back()->with('success', 'Foto profil berhasil diperbarui.');
        }

        return redirect()->back()->with('error', 'Gagal mengupload foto profil.');
    }
}
