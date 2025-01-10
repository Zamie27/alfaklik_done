<?php

namespace App\Controllers\Pelanggan;

use App\Controllers\BasePelanggan;
use App\Models\OrderModel;
use App\Models\OrderDetailModel;

class OrderController extends BasePelanggan
{
    protected $orderModel;

    public function __construct()
    {
        $this->orderModel = new OrderModel();
    }

    public function index()
    {
        $status = $this->request->getGet('status') ?? 'baru';
        $orderModel = new OrderModel();

        // Ambil pesanan berdasarkan status dan pengguna
        $orders = $orderModel
            ->select('orders.*, pengguna.nama_lengkap')
            ->join('pengguna', 'pengguna.id_pengguna = orders.id_pengguna', 'left')
            ->where('orders.id_pengguna', session()->get('id_pengguna'))
            ->where('orders.status', $status)
            ->findAll();

        // Tambahkan detail item pesanan ke masing-masing order
        foreach ($orders as &$order) {
            $order['items'] = $this->getOrderItems($order['id_orders']);
        }

        $data = [
            'status' => $status,
            'orders' => $orders,
        ];

        return view('users/pelanggan/order_list', $data);
    }

    private function getOrderItems($id_orders)
    {
        $db = \Config\Database::connect();
        $query = $db->table('order_details')
            ->join('barang', 'order_details.id_barang = barang.id_barang')
            ->where('id_orders', $id_orders)
            ->get();

        return $query->getResultArray();
    }

    public function detail($id_orders)
    {
        $orderModel = new \App\Models\OrderModel();

        // Ambil detail pesanan berdasarkan ID
        $order = $orderModel
            ->select('orders.*, pengguna.nama_lengkap, pengguna.no_telp, pengguna.email')
            ->join('pengguna', 'pengguna.id_pengguna = orders.id_pengguna', 'left')
            ->where('orders.id_orders', $id_orders)
            ->first();

        if (!$order) {
            return redirect()->to('pelanggan/orders')->with('error', 'Pesanan tidak ditemukan.');
        }

        // Ambil detail item pesanan
        $order['items'] = $this->getOrderItems($id_orders);

        $data = [
            'order' => $order,
        ];

        return view('users/pelanggan/order_detail', $data);
    }


    public function checkout()
    {
        $userId = session()->get('id_pengguna');
        $cartModel = new \App\Models\CartModel();
        $data['cart_items'] = $cartModel->getCartByUser($userId);

        return view('users/pelanggan/checkout', $data);
    }

    public function placeOrder()
    {
        $db = \Config\Database::connect();
        $db->transStart();

        $id_pengguna = session()->get('id_pengguna');
        $checkout_data = session()->get('checkout_data');

        if (!$checkout_data || empty($checkout_data['cart_items'])) {
            return redirect()->to('pelanggan/cart')->with('error', 'Keranjang Anda kosong.');
        }

        // Simpan ke tabel `orders`
        $orderModel = new \App\Models\OrderModel();
        $id_orders = $orderModel->insert([
            'id_pengguna' => $id_pengguna,
            'alamat_pengiriman' => $checkout_data['alamat_pengiriman'],
            'subtotal' => $checkout_data['subtotal'],
            'ongkir' => 0,
            'total' => $checkout_data['subtotal'],
            'metode_pembayaran' => $this->request->getPost('metode_pembayaran'),
            'status' => 'baru',
        ], true);

        if (!$id_orders) {
            $db->transRollback();
            return redirect()->back()->with('error', 'Gagal membuat pesanan.');
        }

        // Simpan ke tabel `order_details`
        $orderDetailModel = new \App\Models\OrderDetailModel();
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

        if ($db->transStatus() === false) {
            return redirect()->back()->with('error', 'Gagal membuat pesanan.');
        }

        return redirect()->to('pelanggan/orders/success')->with('success', 'Pesanan berhasil dibuat.');
    }

    public function success()
    {
        return view('users/pelanggan/order_success');
    }
}
