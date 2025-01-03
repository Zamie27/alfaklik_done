<?= $this->extend('users/pelanggan/template/index'); ?>

<?= $this->section('content'); ?>
<div class="container my-5">
    <h3>Pencarian Barang Berdasarkan: "<?= esc($query) ?>"</h3>
    <div id="product-list" class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4 mt-3">
        <?php if (!empty($barang)): ?>
            <?php foreach ($barang as $item): ?>
                <div class="col">
                    <div class="card h-100 position-relative d-flex flex-column">
                        <a href="<?= base_url('pelanggan/barang/detail/' . $item['id_barang']) ?>" class="text-decoration-none">
                            <img
                                src="<?= base_url($item['gambar_barang']) ?>"
                                class="card-img-top"
                                alt="<?= esc($item['nama_barang']) ?>" />
                            <div class="card-body d-flex flex-column">
                                <h6 class="card-title text-dark"><?= esc($item['nama_barang']) ?></h6>
                                <p class="price mt-auto">
                                    <span class="text-danger fw-bold">Rp <?= number_format($item['harga_barang'], 0, ',', '.') ?></span>
                                </p>
                            </div>
                        </a>
                        <div class="card-footer bg-white border-0 mt-auto">
                            <?php if ($item['jumlah_stock'] > 0): ?>
                                <button
                                    class="btn btn-danger w-100 add-to-cart"
                                    data-id="<?= $item['id_barang'] ?>"
                                    data-url="<?= base_url('pelanggan/cart/add') ?>">
                                    Beli
                                </button>
                            <?php else: ?>
                                <button
                                    class="btn btn-secondary w-100"
                                    disabled>
                                    Kosonggg
                                </button>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-12">
                <p class="text-center text-muted">Tidak ada barang yang ditemukan untuk kata kunci "<?= esc($query) ?>".</p>
            </div>
        <?php endif; ?>
    </div>
</div>
<?= $this->endSection(); ?>