<?php

namespace App\Controllers\Pelanggan;

use App\Controllers\BasePelanggan;
use App\Models\CartModel;
use App\Models\BarangModel;

class CartController extends BasePelanggan
{
    protected $cartModel;
    protected $barangModel;

    public function __construct()
    {
        $this->cartModel = new CartModel();
        $this->barangModel = new BarangModel();
    }

    public function index()
    {
        // Ambil data keranjang untuk pengguna saat ini
        $cartItems = $this->cartModel->getCartByUser(session()->get('id_pengguna'));

        // Hitung subtotal
        $subtotal = 0;
        foreach ($cartItems as $item) {
            $subtotal += $item['harga_barang'] * $item['quantity'];
        }

        // Diskon (bisa disesuaikan)
        $discount = 5000; // Contoh nilai diskon tetap

        // Total belanja
        $total = $subtotal - $discount;

        // Kirim data ke view
        $data['cart_items'] = $cartItems;
        $data['subtotal'] = $subtotal;
        $data['discount'] = $discount;
        $data['total'] = $total;

        return view('users/pelanggan/keranjang', $data);
    }

    public function addToCart()
    {
        $id_pengguna = session()->get('id_pengguna');
        $input = $this->request->getJSON();

        $id_barang = $input->id_barang ?? null;
        $quantity = $input->quantity ?? 1;

        if (!$id_barang) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'ID barang tidak valid'
            ])->setStatusCode(400);
        }

        // Cek apakah barang sudah ada di keranjang
        $existingItem = $this->cartModel
            ->where('id_pengguna', $id_pengguna)
            ->where('id_barang', $id_barang)
            ->first();

        if ($existingItem) {
            // Update jumlah barang jika sudah ada
            $this->cartModel->update($existingItem['id_carts'], [
                'quantity' => $existingItem['quantity'] + $quantity,
            ]);
        } else {
            // Tambahkan barang baru
            $this->cartModel->insert([
                'id_pengguna' => $id_pengguna,
                'id_barang' => $id_barang,
                'quantity' => $quantity,
            ]);
        }

        return $this->response->setJSON([
            'status' => 'success',
            'message' => 'Barang berhasil ditambahkan ke keranjang'
        ]);
    }




    public function removeFromCart($id_carts)
    {
        try {
            $id_pengguna = session()->get('id_pengguna');

            // Validasi apakah item ada di keranjang pengguna
            $cartItem = $this->cartModel->where('id_carts', $id_carts)
                ->where('id_pengguna', $id_pengguna)
                ->first();

            if (!$cartItem) {
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => 'Barang tidak ditemukan di keranjang'
                ])->setStatusCode(404);
            }

            // Hapus item dari keranjang
            $this->cartModel->delete($id_carts);

            return $this->response->setJSON([
                'status' => 'success',
                'message' => 'Barang berhasil dihapus dari keranjang'
            ]);
        } catch (\Exception $e) {
            log_message('error', 'Error removing item from cart: ' . $e->getMessage());
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Terjadi kesalahan saat menghapus barang'
            ])->setStatusCode(500);
        }
    }


    public function clearCart()
    {
        try {
            $id_pengguna = session()->get('id_pengguna');

            // Debugging log untuk memastikan session tersedia
            log_message('info', 'ID Pengguna: ' . $id_pengguna);

            if (!$id_pengguna) {
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => 'Pengguna tidak terautentikasi'
                ])->setStatusCode(401);
            }

            // Hapus semua barang di keranjang milik pengguna
            $this->cartModel->where('id_pengguna', $id_pengguna)->delete();

            return $this->response->setJSON([
                'status' => 'success',
                'message' => 'Semua barang berhasil dihapus dari keranjang'
            ]);
        } catch (\Exception $e) {
            log_message('error', 'Error in clearCart: ' . $e->getMessage());
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Terjadi kesalahan saat menghapus semua barang'
            ])->setStatusCode(500);
        }
    }

    public function updateQuantity()
    {
        try {
            $id_pengguna = session()->get('id_pengguna');
            $input = $this->request->getJSON();

            $id_carts = $input->id_carts ?? null;
            $quantity = $input->quantity ?? 1;

            // Validasi input
            if (!$id_carts || $quantity < 1) {
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => 'Data tidak valid'
                ])->setStatusCode(400);
            }

            // Update kuantiti di keranjang
            $this->cartModel->update($id_carts, ['quantity' => $quantity]);

            return $this->response->setJSON([
                'status' => 'success',
                'message' => 'Kuantiti berhasil diperbarui',
            ]);
        } catch (\Exception $e) {
            log_message('error', 'Error updating quantity: ' . $e->getMessage());
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Terjadi kesalahan saat memperbarui kuantiti'
            ])->setStatusCode(500);
        }
    }
}
