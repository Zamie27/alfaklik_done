<?= $this->extend('users/pelanggan/template/index'); ?>

<?= $this->section('content'); ?>


<div class="container mt-4 mb-4">
    <div class="card p-4 shadow-sm">
        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="fw-bold">Keranjang</h4>
            <button class="btn btn-danger" id="clear-cart">Hapus Semua</button>
        </div>

        <!-- List Produk -->
        <div class="cart-items">
            <?php foreach ($cartItems as $item): ?>
                <div class="d-flex justify-content-between align-items-center border-bottom py-3">
                    <div class="d-flex align-items-center">
                        <img
                            src="<?= base_url($item['foto_barang']) ?>"
                            alt="<?= $item['nama_barang'] ?>"
                            class="rounded me-3"
                            style="width: 80px; height: 80px; object-fit: cover" />
                        <span><?= $item['nama_barang'] ?></span>
                    </div>
                    <div class="d-flex align-items-center">
                        <form method="post" action="<?= base_url('/cart/update') ?>">
                            <input type="hidden" name="id_keranjang" value="<?= $item['id_keranjang'] ?>">
                            <button class="btn btn-outline-secondary btn-sm" onclick="updateQuantity(-1, <?= $item['id_keranjang'] ?>)">
                                <i class="bi bi-dash"></i>
                            </button>
                            <input
                                type="number"
                                class="form-control mx-2 text-center"
                                style="width: 50px"
                                name="jumlah"
                                value="<?= $item['jumlah'] ?>"
                                min="1" />
                            <button class="btn btn-outline-secondary btn-sm" onclick="updateQuantity(1, <?= $item['id_keranjang'] ?>)">
                                <i class="bi bi-plus"></i>
                            </button>
                            <span class="ms-3 fw-bold">Rp <?= number_format($item['harga'] * $item['jumlah'], 0, ',', '.') ?></span>
                        </form>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="mt-4">
            <h5 class="fw-bold">Ringkasan Pesanan</h5>
            <div class="d-flex justify-content-between">
                <span>Subtotal</span>
                <span>Rp <?= number_format($totalPrice, 0, ',', '.') ?></span>
            </div>
            <button class="btn btn-danger w-100 mt-3">Checkout</button>
        </div>


    </div>
</div>

<?= $this->endSection(); ?>