<?php

namespace App\Models;

use CodeIgniter\Model;

class OrderDetailModel extends Model
{
    protected $table = 'order_details';
    protected $primaryKey = 'id_order_details';
    protected $allowedFields = ['order_id', 'id_barang', 'quantity', 'harga_satuan', 'subtotal'];
}
