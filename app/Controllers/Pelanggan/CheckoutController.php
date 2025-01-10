<?php

namespace App\Controllers\Pelanggan;

use App\Controllers\BaseController;
use App\Models\CartModel;
use App\Models\PesananModel;
use App\Models\DetailPesananModel;

class CheckoutController extends BaseController
{
    protected $cartModel;
    protected $pesananModel;
    protected $detailPesananModel;

    public function __construct()
    {
        $this->cartModel = new CartModel();
        $this->pesananModel = new PesananModel();
        $this->detailPesananModel = new DetailPesananModel();
    }

    public function index()
    {
        $id_pengguna = session()->get('id_pengguna');
        $cart_items = $this->cartModel->getCartByUser($id_pengguna);

        if (empty($cart_items)) {
            return redirect()->to('pelanggan/cart')->with('error', 'Keranjang Anda kosong.');
        }

        $data = [
            'cart_items' => $cart_items,
            'subtotal' => array_sum(array_map(function ($item) {
                return $item['harga_barang'] * $item['quantity'];
            }, $cart_items)),
            'user' => session()->get(),
        ];

        return view('users/pelanggan/checkout', $data);
    }

    public function placeOrder()
    {
        $id_pengguna = session()->get('id_pengguna');
        $cart_items = $this->cartModel->getCartByUser($id_pengguna);

        if (empty($cart_items)) {
            return redirect()->to('pelanggan/cart')->with('error', 'Keranjang Anda kosong.');
        }

        $dataPesanan = [
            'id_pengguna' => $id_pengguna,
            'nama_penerima' => $this->request->getPost('nama_penerima'),
            'no_telp' => $this->request->getPost('no_telp'),
            'alamat' => $this->request->getPost('alamat'),
            'total_harga' => array_sum(array_map(function ($item) {
                return $item['harga_barang'] * $item['quantity'];
            }, $cart_items)),
        ];

        $id_pesanan = $this->pesananModel->insert($dataPesanan);

        foreach ($cart_items as $item) {
            $this->detailPesananModel->insert([
                'id_pesanan' => $id_pesanan,
                'id_barang' => $item['id_barang'],
                'nama_barang' => $item['nama_barang'],
                'harga_satuan' => $item['harga_barang'],
                'quantity' => $item['quantity'],
                'subtotal' => $item['harga_barang'] * $item['quantity'],
            ]);
        }

        // Clear the cart
        $this->cartModel->clearCartByUser($id_pengguna);

        return redirect()->to('pelanggan/checkout')->with('success', 'Pesanan berhasil dibuat.');
    }

    public function checkout()
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
            'user' => [
                'nama' => session()->get('nama_lengkap'),
                'no_telp' => session()->get('no_telp'),
                'alamat' => session()->get('alamat'),
            ],
        ];

        return view('users/pelanggan/checkout', $data);
    }

    public function toPayment()
    {
        $alamat_pengiriman = $this->request->getPost('alamat_pengiriman');

        if (!$alamat_pengiriman) {
            return redirect()->back()->with('error', 'Alamat pengiriman harus diisi.');
        }

        session()->set('checkout_data', [
            'alamat_pengiriman' => $alamat_pengiriman,
        ]);

        return redirect()->to('pelanggan/payment');
    }
}
