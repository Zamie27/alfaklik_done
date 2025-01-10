<?php

namespace App\Controllers\Pelanggan;

use App\Controllers\BasePelanggan;
use App\Models\OrderModel;
use App\Models\CartModel;

class PaymentController extends BasePelanggan
{
    protected $orderModel;
    protected $cartModel;

    public function __construct()
    {
        $this->orderModel = new OrderModel();
        $this->cartModel = new CartModel();
    }

    public function index()
    {
        $id_pengguna = session()->get('id_pengguna');
        $cart_items = $this->cartModel->getCartByUser($id_pengguna);

        if (empty($cart_items)) {
            return redirect()->to('pelanggan/cart')->with('error', 'Keranjang Anda kosong.');
        }

        $subtotal = array_sum(array_map(function ($item) {
            return $item['harga_barang'] * $item['quantity'];
        }, $cart_items));

        $data = [
            'cart_items' => $cart_items,
            'subtotal' => $subtotal,
            'total' => $subtotal, // Tambahkan biaya pengiriman jika ada
        ];

        return view('users/pelanggan/payment', $data);
    }

    public function confirm()
    {
        $id_pengguna = session()->get('id_pengguna');
        $payment_method = $this->request->getPost('payment_method');

        if (!$payment_method) {
            return redirect()->back()->with('error', 'Silakan pilih metode pembayaran.');
        }

        $cart_items = $this->cartModel->getCartByUser($id_pengguna);

        if (empty($cart_items)) {
            return redirect()->to('pelanggan/cart')->with('error', 'Keranjang Anda kosong.');
        }

        $subtotal = array_sum(array_map(function ($item) {
            return $item['harga_barang'] * $item['quantity'];
        }, $cart_items));
        $ongkir = 0; // Ongkir bisa diatur sesuai kebutuhan
        $total = $subtotal + $ongkir;

        // Buat pesanan baru
        $order_id = $this->orderModel->insert([
            'id_pengguna' => $id_pengguna,
            'alamat_pengiriman' => $this->request->getPost('alamat_pengiriman'),
            'jadwal_pengiriman' => date('Y-m-d H:i:s'),
            'subtotal' => $subtotal,
            'ongkir' => $ongkir,
            'total' => $total,
            'metode_pembayaran' => $payment_method,
            'status' => 'baru',
        ]);

        // Simpan detail pesanan
        foreach ($cart_items as $item) {
            $this->orderModel->saveOrderDetails([
                'id_orders' => $order_id,
                'id_barang' => $item['id_barang'],
                'quantity' => $item['quantity'],
                'harga_satuan' => $item['harga_barang'],
                'subtotal' => $item['harga_barang'] * $item['quantity'],
            ]);
        }

        // Hapus keranjang setelah checkout
        $this->cartModel->where('id_pengguna', $id_pengguna)->delete();

        return redirect()->to('pelanggan/orders')->with('success', 'Pesanan Anda berhasil dibuat.');
    }
}
