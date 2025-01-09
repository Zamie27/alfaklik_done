<?php

namespace App\Models;

use CodeIgniter\Model;

class BarangModel extends Model
{
    protected $table = 'barang';
    protected $primaryKey = 'id_barang';
    protected $allowedFields = ['nama_barang', 'harga_barang', 'deskripsi_barang', 'gambar_barang', 'jumlah_stock'];

    public function getBarangTerbaru($limit = 20)
    {
        return $this->orderBy('created_at', 'DESC')->limit($limit)->findAll();
    }
    public function getBarangSortedByName()
    {
        return $this->orderBy('nama_barang', 'ASC')->findAll();
    }
    public function getBarangByLatest()
    {
        return $this->orderBy('created_at', 'DESC')->findAll();
    }
    // Fungsi untuk mendapatkan barang berdasarkan ID
    public function getBarangById($id)
    {
        return $this->find($id);
    }
}
