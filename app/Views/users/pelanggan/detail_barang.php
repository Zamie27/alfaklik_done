<?= $this->extend('users/pelanggan/template/index'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <div class="row py-lg-5 mb-5">
        <!-- Gambar Produk -->
        <div class="col-sm-12 col-md-12 col-lg-4 col-12">
            <div class="product-detail-image">
                <img src="<?= base_url($barang['gambar_barang']) ?>" class="d-block w-100 img-fluid" alt="<?= esc($barang['nama_barang']) ?>">
            </div>
        </div>

        <!-- Detail Produk -->
        <div class="col-sm-12 col-md-12 col-lg-5 col-12">
            <!-- Nama Produk -->
            <h1 class="fw-bold"><?= esc($barang['nama_barang']) ?></h1>

            <!-- Harga Produk -->
            <p class="text-danger fw-bold mb-3">Rp <?= number_format($barang['harga_barang'], 0, ',', '.') ?></p>
            <hr class="dashed my-4">

            <!-- Deskripsi Produk -->
            <h4 class="fw-bold">Deskripsi</h4>

            <?php if (strlen($barang['deskripsi_barang']) > 150): ?>
                <p id="short-description">
                    <?= esc(substr($barang['deskripsi_barang'], 0, 150)) ?>...
                </p>
                <p id="full-description" style="display: none;">
                    <?= esc($barang['deskripsi_barang']) ?>
                </p>
                <button class="btn btn-link text-sm p-0 fw-bold text-decoration-none" id="toggle-description">
                    Lihat Selengkapnya
                </button>
            <?php endif; ?>
            <hr class="dashed my-4">

            <!-- Informasi Stok -->
            <h4 class="fw-bold">Stok</h4>
            <p>
                <?= $barang['jumlah_stock'] > 0 ? $barang['jumlah_stock'] . ' tersedia' : '<span class="text-danger">Stok habis</span>' ?>
            </p>

            <!-- Tombol Aksi -->
            <?php if ($barang['jumlah_stock'] > 0): ?>
                <button
                    class="btn btn-danger add-to-cart"
                    data-id="<?= $barang['id_barang'] ?>"
                    data-url="<?= base_url('pelanggan/cart/add') ?>">
                    Tambahkan ke Keranjang
                </button>
            <?php else: ?>
                <button class="btn btn-secondary" disabled>
                    Stok Habis
                </button>
            <?php endif; ?>
        </div>
    </div>

</div>

<script src="<?= base_url('js/pelanggan/detail_barang.js'); ?>"></script>
<?= $this->endsection(); ?>