<?php

namespace App\Models;

use CodeIgniter\Model;

class DetailPesananModel extends Model
{
    protected $table = 'detail_pesanan';
    protected $primaryKey = 'id_detail';
    protected $allowedFields = ['id_pesanan', 'id_barang', 'nama_barang', 'harga_satuan', 'quantity', 'subtotal'];
}
