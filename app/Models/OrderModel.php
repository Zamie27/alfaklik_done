<?php

namespace App\Models;

use CodeIgniter\Model;

class OrderModel extends Model
{
    protected $table = 'orders';
    protected $primaryKey = 'id_orders';
    protected $allowedFields = [
        'id_pengguna',
        'alamat_pengiriman',
        'jadwal_pengiriman',
        'subtotal',
        'ongkir',
        'total',
        'metode_pembayaran',
        'status',
        'created_at'
    ];

    public function getOrdersWithUser()
    {
        return $this->select('orders.*, pengguna.nama_lengkap')
            ->join('pengguna', 'pengguna.id_pengguna = orders.id_pengguna', 'left')
            ->findAll();
    }
}
