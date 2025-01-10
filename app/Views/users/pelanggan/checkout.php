<?= $this->extend('users/pelanggan/template/index'); ?>

<?= $this->section('content'); ?>

<div class="container py-4">
    <div class="row justify-content-center">
        <!-- Detail Pesanan -->
        <div class="col-lg-8">
            <h2 class="fw-bold mb-4">Checkout</h2>
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <p class="fw-bold">Detail Penerima</p>
                    <hr>
                    <p><strong><?= esc($user['nama']) ?></strong></p>
                    <p><?= esc($user['no_telp']) ?></p>
                    <p><?= esc($user['alamat']) ?></p>
                    <hr>
                    <p class="fw-bold">Rincian Pesanan</p>
                    <ul class="list-group mb-4">
                        <?php foreach ($cart_items as $item): ?>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <p class="mb-0"><?= esc($item['nama_barang']) ?></p>
                                    <small>Jumlah: <?= $item['quantity'] ?></small>
                                </div>
                                <span>Rp <?= number_format($item['harga_barang'] * $item['quantity'], 0, ',', '.') ?></span>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                    <div class="d-flex justify-content-between fw-bold">
                        <span>Total</span>
                        <span>Rp <?= number_format($total, 0, ',', '.') ?></span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Ringkasan Pesanan -->
        <div class="col-lg-4 sticky-summary">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h5 class="fw-bold">Ringkasan Pesanan</h5>
                    <form action="<?= base_url('pelanggan/checkout') ?>" method="POST">
                        <div class="mb-3">
                            <label for="alamat_pengiriman" class="form-label">Alamat Pengiriman</label>
                            <textarea name="alamat_pengiriman" id="alamat_pengiriman" class="form-control" rows="3" required><?= esc($user['alamat']) ?></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Pilih Pembayaran</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .sticky-summary {
        position: sticky;
        top: 70px;
    }

    @media (max-width: 992px) {
        .sticky-summary {
            position: static;
        }
    }
</style>

<?= $this->endSection(); ?>