<?php

namespace App\Controllers\Pelanggan;

use App\Controllers\BasePelanggan;
use App\Models\OrderModel;
use App\Models\OrderDetailModel;

class OrderController extends BasePelanggan
{
    public function checkout()
    {
        $userId = session()->get('id_pengguna');
        $cartModel = new \App\Models\CartModel();
        $data['cart_items'] = $cartModel->getCartByUser($userId);

        return view('users/pelanggan/checkout', $data);
    }

    public function placeOrder()
    {
        $orderModel = new OrderModel();
        $orderDetailModel = new OrderDetailModel();
        $cartModel = new \App\Models\CartModel();

        $userId = session()->get('id_pengguna');
        $cartItems = $cartModel->getCartByUser($userId);

        // Simpan data pesanan
        $orderId = $orderModel->insert([
            'id_pengguna' => $userId,
            'alamat_pengiriman' => $this->request->getPost('alamat_pengiriman'),
            'jadwal_pengiriman' => $this->request->getPost('jadwal_pengiriman'),
            'subtotal' => $this->request->getPost('subtotal'),
            'ongkir' => $this->request->getPost('ongkir'),
            'total' => $this->request->getPost('total'),
            'metode_pembayaran' => 'cod',
        ]);

        // Simpan detail pesanan
        foreach ($cartItems as $item) {
            $orderDetailModel->insert([
                'order_id' => $orderId,
                'id_barang' => $item['id_barang'],
                'quantity' => $item['quantity'],
                'harga_satuan' => $item['harga_barang'],
                'subtotal' => $item['harga_barang'] * $item['quantity'],
            ]);
        }

        // Hapus keranjang
        $cartModel->where('id_pengguna', $userId)->delete();

        return redirect()->to('/pelanggan/orders')->with('message', 'Pesanan berhasil dibuat!');
    }
}
