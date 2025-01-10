<?= $this->extend('users/pelanggan/template/index'); ?>

<?= $this->section('content'); ?>

<div class="container py-4">
    <div class="row justify-content-center">
        <!-- Pilihan Metode Pembayaran -->
        <div class="col-lg-8">
            <h2 class="fw-bold mb-4">Metode Pembayaran</h2>
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <form action="<?= base_url('pelanggan/payment/confirm') ?>" method="POST">
                        <!-- Alamat Pengiriman -->
                        <div class="mb-4">
                            <label for="alamat_pengiriman" class="form-label">Alamat Pengiriman</label>
                            <textarea name="alamat_pengiriman" id="alamat_pengiriman" class="form-control" rows="3" required><?= session()->get('alamat') ?></textarea>
                        </div>

                        <!-- Pilihan Pembayaran -->
                        <div class="form-check mb-4">
                            <input class="form-check-input" type="radio" name="payment_method" id="cod" value="cod" required>
                            <label class="form-check-label" for="cod">
                                <img src="<?= base_url('img/cod.png') ?>" alt="COD" style="width: 40px; height: 40px;">
                                Cash On Delivery (COD)
                            </label>
                        </div>
                        <div class="form-check mb-4">
                            <input class="form-check-input" type="radio" name="payment_method" id="qris" value="qris" required>
                            <label class="form-check-label" for="qris">
                                <img src="<?= base_url('img/qris.png') ?>" alt="QRIS" style="width: 40px; height: 40px;">
                                QRIS
                            </label>
                        </div>
                        <div class="text-end">
                            <button type="submit" class="btn btn-primary">Bayar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Ringkasan Pesanan -->
        <div class="col-lg-4 sticky-summary">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h5 class="fw-bold">Ringkasan Pesanan</h5>
                    <div class="d-flex justify-content-between py-2">
                        <span>Subtotal</span>
                        <span>Rp <?= number_format($subtotal, 0, ',', '.'); ?></span>
                    </div>
                    <div class="d-flex justify-content-between py-2">
                        <span>Ongkos Kirim</span>
                        <span>Rp 0</span>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between py-2 fw-bold">
                        <span>Total</span>
                        <span>Rp <?= number_format($total, 0, ',', '.'); ?></span>
                    </div>
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