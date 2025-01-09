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
        'status'
    ];
}
