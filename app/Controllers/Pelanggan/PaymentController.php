<?php

namespace App\Controllers\Pelanggan;

use App\Controllers\BaseController;
use App\Models\OrderModel;
use App\Models\OrderDetailModel;
use App\Models\CartModel;

class PaymentController extends BaseController
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

    // Halaman Pembayaran
    public function index()
    {
        // Ambil data checkout dari session
        $checkout_data = session()->get('checkout_data');
        if (!$checkout_data) {
            return redirect()->to('pelanggan/checkout')->with('error', 'Checkout data tidak ditemukan.');
        }

        // Siapkan data untuk tampilan
        $data = [
            'alamat_pengiriman' => $checkout_data['alamat_pengiriman'],
            'cart_items' => $checkout_data['cart_items'], // Barang dalam keranjang
            'subtotal' => $checkout_data['subtotal'],
            'ongkir' => 0, // Tambahkan biaya ongkir jika ada
            'total' => $checkout_data['subtotal'], // Subtotal + ongkir
        ];

        return view('users/pelanggan/payment', $data);
    }


    // Proses Konfirmasi Pembayaran
    public function confirmPayment()
    {
        $checkout_data = session()->get('checkout_data');
        if (!$checkout_data) {
            return redirect()->to('pelanggan/cart')->with('error', 'Checkout data tidak ditemukan.');
        }

        $metode_pembayaran = $this->request->getPost('metode_pembayaran');
        if (!$metode_pembayaran) {
            return redirect()->back()->with('error', 'Metode pembayaran harus dipilih.');
        }

        // Simpan ke database
        $orderModel = new OrderModel();
        $orderDetailModel = new OrderDetailModel();

        $db = \Config\Database::connect();
        $db->transStart();

        $id_orders = $orderModel->insert([
            'id_pengguna' => session()->get('id_pengguna'),
            'alamat_pengiriman' => $checkout_data['alamat_pengiriman'],
            'subtotal' => $checkout_data['subtotal'],
            'ongkir' => 0,
            'total' => $checkout_data['subtotal'],
            'metode_pembayaran' => $metode_pembayaran,
            'status' => 'baru',
        ], true);

        foreach ($checkout_data['cart_items'] as $item) {
            $orderDetailModel->insert([
                'id_orders' => $id_orders,
                'id_barang' => $item['id_barang'],
                'quantity' => $item['quantity'],
                'harga_satuan' => $item['harga_barang'],
                'subtotal' => $item['harga_barang'] * $item['quantity'],
            ]);
        }

        $db->transComplete();

        if (!$db->transStatus()) {
            return redirect()->back()->with('error', 'Gagal memproses pembayaran.');
        }

        return redirect()->to('pelanggan/order/success')->with('success', 'Pesanan berhasil dibuat.');
    }
}
