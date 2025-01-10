<?= $this->extend('users/admin/template/index'); ?>

<?= $this->section('content'); ?>
<div class="container my-5">
    <h2 class="mb-4">Tambah Barang</h2>
    <form action="<?= base_url('/admin/dashboard/store-barang') ?>" method="post" enctype="multipart/form-data">
        <?= csrf_field() ?>
        <div class="mb-3">
            <label for="nama_barang" class="form-label">Nama Barang</label>
            <input type="text" name="nama_barang" id="nama_barang" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="harga_barang" class="form-label">Harga</label>
            <input type="number" name="harga_barang" id="harga_barang" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="jumlah_stock" class="form-label">Stok</label>
            <input type="number" name="jumlah_stock" id="jumlah_stock" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="deskripsi_barang" class="form-label">Deskripsi</label>
            <textarea name="deskripsi_barang" id="deskripsi_barang" class="form-control" rows="4" required></textarea>
        </div>
        <div class="mb-3">
            <label for="gambar_barang" class="form-label">Gambar Barang</label>
            <input type="file" name="gambar_barang" id="gambar_barang" class="form-control" accept="image/*" required>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="<?= base_url('/admin/dashboard/barang') ?>" class="btn btn-secondary">Batal</a>
    </form>
</div>

<?= $this->endSection(); ?>