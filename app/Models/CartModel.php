<?php

namespace App\Models;

use CodeIgniter\Model;

class CartModel extends Model
{
    protected $table = 'carts';
    protected $primaryKey = 'id_carts';
    protected $allowedFields = ['id_pengguna', 'id_barang', 'quantity', 'created_at', 'updated_at'];

    public function getCartByUser($userId)
    {
        return $this->select('carts.*, barang.nama_barang, barang.harga_barang, barang.gambar_barang')
            ->join('barang', 'carts.id_barang = barang.id_barang')
            ->where('carts.id_pengguna', $userId)
            ->findAll();
    }
}
