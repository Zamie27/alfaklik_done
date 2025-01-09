<?= $this->extend('users/pelanggan/template/index'); ?>

<?= $this->section('content'); ?>


<div class="container my-4">
    <!-- Carousel Banner -->
    <div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <?php foreach ($banners as $index => $banner): ?>
                <div class="carousel-item <?= $index === 0 ? 'active' : '' ?>">
                    <a href="<?= esc($banner['link']) ?>">
                        <img
                            src="<?= base_url($banner['image_path']) ?>"
                            class="d-block w-100"
                            alt="Banner <?= esc($banner['id']) ?>" />
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
        <button
            class="carousel-control-prev"
            type="button"
            data-bs-target="#carouselExample"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button
            class="carousel-control-next"
            type="button"
            data-bs-target="#carouselExample"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <!-- Produk Terbaru -->
    <h4 class="mt-5 mb-4">Produk Terbaru</h4>
    <div
        id="product-list-container"
        class="overflow-hidden bg-light rounded-3 p-3">
        <div
            id="product-list"
            class="d-flex flex-nowrap gap-3"
            style="overflow-x: auto; scroll-behavior: smooth;">
            <?php foreach ($barang_terbaru as $index => $item): ?>
                <div class="flex-shrink-0" style="width: 200px;">
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
                                    data-name="<?= esc($item['nama_barang']) ?>"
                                    data-url="cart/add">
                                    Beli
                                </button>
                            <?php else: ?>
                                <button class="btn btn-secondary w-100" disabled> Kosong </button>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>


    <!-- Produk Rekomendasi -->
    <h4 class="mt-5 mb-4">Koleksi Produk</h4>
    <div id="product-list" class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
        <?php foreach ($barang_sorted as $index => $item): ?>
            <div class="col" <?= $index >= 8 ? 'style="display: none;"' : '' ?>>
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
                            <!-- Tombol Beli -->
                            <button
                                class="btn btn-danger w-100 add-to-cart"
                                data-id="<?= $item['id_barang'] ?>"
                                data-name="<?= esc($item['nama_barang']) ?>"
                                data-url="cart/add">
                                Beli
                            </button>

                        <?php else: ?>
                            <!-- Tombol Kosong -->
                            <button
                                class="btn btn-secondary w-100"
                                disabled>
                                Kosong
                            </button>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <!-- Tombol Lihat Lainnya -->
    <div class="text-center mt-4">
        <button id="see-more" class="btn btn-danger">Lihat Lainnya</button>
    </div>
</div>


<!-- css Sembunyikan scrollbar produk -->
<style>
    #product-list {
        overflow-x: auto;
        scroll-behavior: smooth;
        -ms-overflow-style: none;
        /* Hides scrollbar on Internet Explorer and Edge */
        scrollbar-width: none;
        /* Hides scrollbar on Firefox */
    }

    #product-list::-webkit-scrollbar {
        display: none;
        /* Hides scrollbar on Chrome, Safari, and Opera */
    }
</style>

<script src="<?= base_url('js/pelanggan/katalog.js'); ?>"></script>

<?= $this->endSection(); ?>