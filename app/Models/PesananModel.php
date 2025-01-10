<?php

namespace App\Models;

use CodeIgniter\Model;

class PesananModel extends Model
{
    protected $table = 'pesanan';
    protected $primaryKey = 'id_pesanan';
    protected $allowedFields = ['id_pengguna', 'nama_penerima', 'no_telp', 'alamat', 'total_harga', 'status'];
}
