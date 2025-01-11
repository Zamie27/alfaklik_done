<?php

namespace App\Controllers\Krew;

use App\Controllers\BaseController;
use App\Models\OrderModel;
use App\Models\PenggunaModel;

class Dashboard extends BaseController
{
    protected $penggunaModel;
    protected $orderModel;

    public function __construct()
    {
        $this->penggunaModel = new PenggunaModel();
        $this->orderModel = new OrderModel();
    }

    public function index()
    {
        $counts = [
            'baru' => $this->orderModel->where('status', 'baru')->countAllResults(),
            'diproses' => $this->orderModel->where('status', 'diproses')->countAllResults(),
            'dikirim' => $this->orderModel->where('status', 'dikirim')->countAllResults(),
            'selesai' => $this->orderModel->where('status', 'selesai')->countAllResults(),
            'dibatalkan' => $this->orderModel->where('status', 'dibatalkan')->countAllResults(),
        ];

        return view('users/krew/dashboard', ['counts' => $counts]);
    }

    // List Order
    public function orders()
    {
        $status = $this->request->getGet('status') ?? 'baru';

        $orders = $this->orderModel
            ->select('orders.*, pengguna.nama_lengkap')
            ->join('pengguna', 'pengguna.id_pengguna = orders.id_pengguna', 'left')
            ->where('orders.status', $status)
            ->findAll();

        foreach ($orders as &$order) {
            $order['items'] = $this->getOrderItems($order['id_orders']);
        }

        $data = [
            'status' => $status,
            'orders' => $orders,
        ];

        return view('users/krew/order_list', $data);
    }

    // Detail Order
    public function detail($id_orders)
    {
        $order = $this->orderModel
            ->select('orders.*, pengguna.nama_lengkap')
            ->join('pengguna', 'pengguna.id_pengguna = orders.id_pengguna', 'left')
            ->find($id_orders);

        if (!$order) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Pesanan tidak ditemukan.");
        }

        $order['items'] = $this->getOrderItems($id_orders);

        return view('users/krew/order_detail', ['order' => $order]);
    }

    // Proses Pesanan
    public function process($id_orders)
    {
        $order = $this->orderModel->find($id_orders);

        if (!$order || $order['status'] !== 'baru') {
            return redirect()->back()->with('error', 'Pesanan tidak valid untuk diproses.');
        }

        // Update status pesanan ke "diproses"
        $this->orderModel->update($id_orders, ['status' => 'diproses']);
        return redirect()->to('/krew/orders?status=diproses')->with('success', 'Pesanan telah diproses.');
    }


    // Kirim Pesanan
    public function ship($id_orders)
    {
        $order = $this->orderModel->find($id_orders);

        if (!$order || $order['status'] != 'diproses') {
            return redirect()->back()->with('error', 'Pesanan tidak valid untuk dikirim.');
        }

        $this->orderModel->update($id_orders, ['status' => 'dikirim']);
        return redirect()->to('/krew/orders?status=dikirim')->with('success', 'Pesanan telah dikirim.');
    }

    // Selesaikan Pesanan
    public function complete($id_orders)
    {
        $order = $this->orderModel->find($id_orders);

        if (!$order || $order['status'] != 'dikirim') {
            return redirect()->back()->with('error', 'Pesanan tidak valid untuk diselesaikan.');
        }

        $this->orderModel->update($id_orders, ['status' => 'selesai']);
        return redirect()->to('/krew/orders?status=selesai')->with('success', 'Pesanan telah selesai.');
    }

    // Batalkan Pesanan
    public function cancel($id_orders)
    {
        $order = $this->orderModel->find($id_orders);

        if (!$order || in_array($order['status'], ['selesai', 'dibatalkan'])) {
            return redirect()->back()->with('error', 'Pesanan tidak valid untuk dibatalkan.');
        }

        // Update status pesanan ke "dibatalkan"
        $this->orderModel->update($id_orders, ['status' => 'dibatalkan']);
        return redirect()->to('/krew/orders?status=dibatalkan')->with('success', 'Pesanan telah dibatalkan.');
    }

    // Fungsi untuk mengambil detail item pesanan
    private function getOrderItems($id_orders)
    {
        $db = \Config\Database::connect();
        $query = $db->table('order_details')
            ->join('barang', 'order_details.id_barang = barang.id_barang')
            ->where('id_orders', $id_orders)
            ->get();

        return $query->getResultArray();
    }

    // Menampilkan Profil Krew
    public function indexProfile()
    {
        $data['user'] = $this->penggunaModel->find(session()->get('id_pengguna'));

        if (!$data['user']) {
            return redirect()->back()->with('error', 'Data krew tidak ditemukan.');
        }

        return view('users/krew/profile', $data);
    }

    // Memperbarui Profil Krew
    public function updateProfile()
    {
        $id = session()->get('id_pengguna');
        $user = $this->penggunaModel->find($id);

        if (!$user) {
            return redirect()->back()->with('error', 'Data krew tidak ditemukan.');
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
        if (!empty($password)) {
            $data['password'] = password_hash($password, PASSWORD_DEFAULT);
        }

        // Proses unggah foto profil
        $file = $this->request->getFile('foto_profil');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $fileName = $file->getRandomName();
            $file->move('img/users/krew/profile', $fileName);

            // Hapus foto lama jika ada
            if ($user['foto_profil'] && file_exists($user['foto_profil'])) {
                unlink($user['foto_profil']);
            }

            $data['foto_profil'] = 'img/users/krew/profile/' . $fileName;
        }

        // Perbarui data
        $this->penggunaModel->update($id, $data);

        return redirect()->back()->with('success', 'Profil berhasil diperbarui!');
    }

    // Memperbarui Foto Profil Krew
    public function updatePhotoProfile()
    {
        $idPengguna = session()->get('id_pengguna');
        $fotoProfil = $this->request->getFile('foto_profil');

        if ($fotoProfil && $fotoProfil->isValid() && !$fotoProfil->hasMoved()) {
            $newName = $fotoProfil->getRandomName();
            $fotoProfil->move('img/users/krew/profile', $newName);

            // Hapus foto lama jika ada
            $user = $this->penggunaModel->find($idPengguna);
            if ($user['foto_profil'] && file_exists($user['foto_profil'])) {
                unlink($user['foto_profil']);
            }

            $this->penggunaModel->update($idPengguna, ['foto_profil' => 'img/users/krew/profile/' . $newName]);
            return redirect()->back()->with('success', 'Foto profil berhasil diperbarui.');
        }

        return redirect()->back()->with('error', 'Gagal mengupload foto profil.');
    }
}
