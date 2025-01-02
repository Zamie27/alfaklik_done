<?php

namespace App\Controllers\Pelanggan;

use App\Controllers\BasePelanggan;
use App\Models\BannerModel;
use App\Models\BarangModel;

class Dashboard extends BasePelanggan
{
    protected $barangModel;

    public function __construct()
    {
        $this->barangModel = new BarangModel();
    }

    public function index()
    {
        $model = new BarangModel();
        $bannerModel = new BannerModel();
        $barangModel = new BarangModel();

        $data['barang'] = $model->findAll();
        $data['barang_terbaru'] = $this->barangModel->getBarangTerbaru();
        $data['barang_sorted'] = $barangModel->getBarangSortedByName();
        $data['banners'] = $bannerModel->findAll();

        return view('users/pelanggan/dashboard', $data);
    }

    // Fungsi melihat detail barang
    public function detail_barang($id)
    {
        $model = new BarangModel();
        $data['barang'] = $model->find($id);

        if (!$data['barang']) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Barang tidak ditemukan.');
        }

        return view('users/pelanggan/detail_barang', $data);
    }

    // Fungsi Search barang
    public function search()
    {
        $query = $this->request->getGet('q'); // Ambil kata kunci dari query string
        $barangModel = new BarangModel();

        // Cari barang berdasarkan nama
        $barang = $barangModel->like('nama_barang', $query)->findAll();

        return view('users/pelanggan/search', [
            'query' => $query,
            'barang' => $barang,
        ]);
    }
}
