<?= $this->extend('users/pelanggan/template/index'); ?>

<?= $this->section('content'); ?>

<div class="container py-4">
    <div class="row justify-content-center">
        <!-- Bagian Keranjang -->
        <div class="col-lg-8">
            <h2 class="fw-bold mb-4">Keranjang</h2>
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body">
                    <?php if (empty($cart_items)): ?>
                        <p class="text-muted text-center">Keranjang Anda kosong.</p>
                    <?php else: ?>
                        <ul class="list-group gap-4">
                            <?php foreach ($cart_items as $item): ?>
                                <li class="list-group-item d-flex justify-content-between align-items-center shadow">
                                    <!-- Informasi Barang -->
                                    <div class="d-flex align-items-center py-4">
                                        <img src="<?= base_url($item['gambar_barang']) ?>"
                                            alt="<?= esc($item['nama_barang']) ?>"
                                            class="rounded"
                                            style="width: 80px; height: 80px; object-fit: cover; margin-right: 15px;">
                                        <div>
                                            <h6 class="fw-bold mb-1"><?= esc($item['nama_barang']) ?></h6>
                                            <p class="text-muted fw-bold mb-1">Rp <?= number_format($item['harga_barang'], 0, ',', '.') ?></p>
                                            <!-- Jumlah dan Tombol Ubah -->
                                            <div class="d-flex align-items-center">
                                                <p class="text-muted mb-0 me-2">Jumlah: <?= $item['quantity'] ?></p>
                                                <button class="btn btn-primary btn-sm btn-edit-quantity"
                                                    data-id="<?= $item['id_carts'] ?>"
                                                    data-quantity="<?= $item['quantity'] ?>"
                                                    data-name="<?= esc($item['nama_barang']) ?>">
                                                    Ubah
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Subtotal dan Tombol Hapus -->
                                    <div class="text-end">
                                        <p class="fw-bold text-danger mb-2 subtotal-item">Rp <?= number_format($item['harga_barang'] * $item['quantity'], 0, ',', '.') ?></p>
                                        <button class="btn btn-danger btn-sm btn-delete-item"
                                            data-id="<?= $item['id_carts'] ?>"
                                            data-name="<?= esc($item['nama_barang']) ?>">
                                            Hapus
                                        </button>
                                    </div>
                                </li>

                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                </div>
            </div>
            <?php if (!empty($cart_items)): ?>
                <button class="btn btn-danger btn-sm btn-delete-all mb-3 shadow-sm">Hapus Semua</button>
            <?php endif; ?>
        </div>

        <!-- Ringkasan Pesanan -->
        <div class="col-lg-4 sticky-summary">
            <div class="card border-0 shadow">
                <div class="card-body">
                    <h5 class="fw-bold">Ringkasan Pesanan</h5>
                    <div class="d-flex justify-content-between py-2">
                        <span>Subtotal</span>
                        <span id="summary-subtotal">Rp <?= number_format($subtotal, 0, ',', '.') ?></span>
                    </div>
                    <div class="d-flex justify-content-between py-2">
                        <span>Diskon</span>
                        <span>Rp <?= number_format($discount, 0, ',', '.') ?></span>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between py-2 fw-bold">
                        <span>Total Belanja</span>
                        <span id="summary-total">Rp <?= number_format($total, 0, ',', '.') ?></span>
                    </div>
                    <form action="<?= base_url('pelanggan/checkout') ?>" method="POST">
                        <button type="submit" class="btn btn-primary w-100 mt-3">Checkout</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<style>
    .btn-delete-item:hover {
        text-decoration: underline;
    }

    .btn-delete-all {
        display: block;
        margin-left: auto;
        margin-right: auto;
    }

    .sticky-summary {
        position: sticky;
        top: 70px;
        /* Tinggi navbar agar tidak tertutup */
        z-index: 1000;
        /* Pastikan di atas konten lainnya */
    }

    @media (max-width: 992px) {

        /* Nonaktifkan sticky untuk layar kecil */
        .sticky-summary {
            position: static;
        }
    }
</style>

<script src="<?= base_url('js/pelanggan/keranjang.js'); ?>"></script>

<?= $this->endSection(); ?>