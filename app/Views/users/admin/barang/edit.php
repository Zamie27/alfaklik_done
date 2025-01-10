<?= $this->extend('users/admin/template/index'); ?>

<?= $this->section('content'); ?>
<div class="container my-5">
    <h2 class="mb-4">Edit Barang</h2>
    <form action="<?= base_url('/admin/dashboard/update-barang/' . $barang['id_barang']) ?>" method="post" enctype="multipart/form-data">
        <?= csrf_field() ?>
        <div class="mb-3">
            <label for="nama_barang" class="form-label">Nama Barang</label>
            <input type="text" name="nama_barang" id="nama_barang" class="form-control" value="<?= old('nama_barang', $barang['nama_barang']) ?>" required>
        </div>
        <div class="mb-3">
            <label for="harga_barang" class="form-label">Harga</label>
            <input type="number" name="harga_barang" id="harga_barang" class="form-control" value="<?= old('harga_barang', $barang['harga_barang']) ?>" required>
        </div>
        <div class="mb-3">
            <label for="jumlah_stock" class="form-label">Stok</label>
            <input type="number" name="jumlah_stock" id="jumlah_stock" class="form-control" value="<?= old('jumlah_stock', $barang['jumlah_stock']) ?>" required>
        </div>
        <div class="mb-3">
            <label for="deskripsi_barang" class="form-label">Deskripsi</label>
            <textarea name="deskripsi_barang" id="deskripsi_barang" class="form-control" rows="4" required><?= old('deskripsi_barang', $barang['deskripsi_barang']) ?></textarea>
        </div>
        <div class="mb-3">
            <label for="gambar_barang" class="form-label">Gambar Barang</label>
            <input type="file" name="gambar_barang" id="gambar_barang" class="form-control" accept="image/*">
            <small>Gambar saat ini:</small>
            <?php if ($barang['gambar_barang']): ?>
                <img src="<?= base_url($barang['gambar_barang']) ?>" alt="Gambar Barang" width="100" class="mt-2">
            <?php endif; ?>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="<?= base_url('/admin/dashboard/barang') ?>" class="btn btn-secondary">Batal</a>
    </form>
</div>

<?= $this->endSection(); ?>