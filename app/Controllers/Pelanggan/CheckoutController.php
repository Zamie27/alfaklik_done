<?php

namespace App\Controllers\Pelanggan;

use App\Controllers\BaseController;
use App\Models\CartModel;
use App\Models\OrderModel;
use App\Models\OrderDetailModel;

class CheckoutController extends BaseController
{
    protected $cartModel;
    protected $orderModel;
    protected $orderDetailModel;

    public function __construct()
    {
        $this->cartModel = new CartModel();
        $this->orderModel = new OrderModel();
        $this->orderDetailModel = new OrderDetailModel();
    }

    // Halaman Checkout
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
            'total' => $subtotal, // Tambahkan ongkir jika ada
            'user' => [
                'nama' => session()->get('nama_lengkap'),
                'no_telp' => session()->get('no_telp'),
                'alamat' => session()->get('alamat'),
            ],
        ];

        return view('users/pelanggan/checkout', $data);
    }

    // Proses ke Halaman Pembayaran
    // public function toPayment()
    // {
    //     $id_pengguna = session()->get('id_pengguna');
    //     $cart_items = $this->cartModel->getCartByUser($id_pengguna);

    //     if (empty($cart_items)) {
    //         return redirect()->to('pelanggan/cart')->with('error', 'Keranjang Anda kosong.');
    //     }

    //     $alamat_pengiriman = $this->request->getPost('alamat_pengiriman');

    //     if (!$alamat_pengiriman) {
    //         return redirect()->back()->with('error', 'Alamat pengiriman harus diisi.');
    //     }

    //     // Simpan data checkout ke sesi
    //     session()->set('checkout_data', [
    //         'alamat_pengiriman' => $alamat_pengiriman,
    //         'cart_items' => $cart_items,
    //         'subtotal' => array_sum(array_map(function ($item) {
    //             return $item['harga_barang'] * $item['quantity'];
    //         }, $cart_items)),
    //     ]);

    //     return redirect()->to('pelanggan/payment');
    // }
}
