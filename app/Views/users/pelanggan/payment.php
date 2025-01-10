<?= $this->extend('users/pelanggan/template/index'); ?>

<?= $this->section('content'); ?>

<div class="container py-4">
    <div class="row justify-content-center">
        <!-- Detail Pembayaran -->
        <div class="col-lg-8">
            <h2 class="fw-bold mb-4">Pembayaran</h2>
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <p class="fw-bold">Detail Pengiriman</p>
                    <hr>
                    <p><strong>Alamat:</strong> <?= esc($alamat_pengiriman) ?></p>
                    <hr>
                    <p class="fw-bold">Detail Pesanan</p>
                    <ul class="list-group mb-4">
                        <?php foreach ($cart_items as $item): ?>
                            <li class="list-group-item d-flex align-items-center shadow-sm">
                                <!-- Gambar Barang -->
                                <img src="<?= base_url($item['gambar_barang']) ?>" alt="<?= esc($item['nama_barang']) ?>"
                                    class="rounded me-3" style="width: 70px; height: 70px; object-fit: cover;">
                                <div class="d-flex justify-content-between w-100">
                                    <div>
                                        <p class="mb-0 fw-bold"><?= esc($item['nama_barang']) ?></p>
                                        <small>Jumlah: <?= $item['quantity'] ?></small>
                                    </div>
                                    <span>Rp <?= number_format($item['harga_barang'] * $item['quantity'], 0, ',', '.') ?></span>
                                </div>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                    <div class="d-flex justify-content-between fw-bold">
                        <span>Subtotal</span>
                        <span>Rp <?= number_format($subtotal, 0, ',', '.') ?></span>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span>Ongkos Kirim</span>
                        <span>Rp <?= number_format($ongkir, 0, ',', '.') ?></span>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between fw-bold">
                        <span>Total</span>
                        <span>Rp <?= number_format($total, 0, ',', '.') ?></span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pilih Metode Pembayaran -->
        <div class="col-lg-4 sticky-summary">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h5 class="fw-bold">Pilih Metode Pembayaran</h5>
                    <form action="<?= base_url('pelanggan/payment/confirm') ?>" method="POST">
                        <?= csrf_field() ?>
                        <!-- Kirim ulang data keranjang dan pengiriman -->
                        <?php foreach ($cart_items as $item): ?>
                            <input type="hidden" name="cart_items[<?= $item['id_barang'] ?>][id_barang]" value="<?= $item['id_barang'] ?>">
                            <input type="hidden" name="cart_items[<?= $item['id_barang'] ?>][nama_barang]" value="<?= esc($item['nama_barang']) ?>">
                            <input type="hidden" name="cart_items[<?= $item['id_barang'] ?>][quantity]" value="<?= $item['quantity'] ?>">
                            <input type="hidden" name="cart_items[<?= $item['id_barang'] ?>][harga_barang]" value="<?= $item['harga_barang'] ?>">
                        <?php endforeach; ?>
                        <input type="hidden" name="alamat_pengiriman" value="<?= esc($alamat_pengiriman) ?>">
                        <input type="hidden" name="subtotal" value="<?= $subtotal ?>">
                        <input type="hidden" name="ongkir" value="<?= $ongkir ?>">
                        <input type="hidden" name="total" value="<?= $total ?>">

                        <!-- Pilihan Metode Pembayaran -->
                        <div class="form-check">
                            <input type="radio" name="metode_pembayaran" id="cod" value="cod" class="form-check-input" required>
                            <label for="cod" class="form-check-label">Cash on Delivery (COD)</label>
                        </div>
                        <div class="form-check">
                            <input type="radio" name="metode_pembayaran" id="qris" value="qris" class="form-check-input">
                            <label for="qris" class="form-check-label">QRIS</label>
                        </div>
                        <button type="submit" class="btn btn-primary w-100 mt-3">Bayar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .form-check-input {
        margin-right: 10px;
    }

    .sticky-summary {
        position: sticky;
        top: 70px;
        z-index: 1000;
    }

    @media (max-width: 992px) {
        .sticky-summary {
            position: static;
        }
    }
</style>

<?= $this->endSection(); ?>