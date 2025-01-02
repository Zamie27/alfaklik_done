<?= $this->extend('users/admin/template/index'); ?>

<?= $this->section('content'); ?>
<div class="container my-4">
    <h1 class="mb-4">Manajemen Barang</h1>

    <!-- Tombol Tambah Barang -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <a href="/admin/dashboard/create-barang" class="btn btn-success">Tambah Barang</a>
        <!-- Form Pencarian -->
        <form method="get" action="/admin/dashboard/barang" class="mb-3 d-flex justify-content-end">
            <div class="input-group" style="max-width: 300px;">
                <input type="text" name="q" class="form-control" placeholder="Cari nama barang..." value="<?= esc($searchQuery) ?>" />
                <button type="submit" class="btn btn-primary">Cari</button>
            </div>
        </form>
    </div>

    <!-- Pesan Sukses -->
    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
    <?php endif; ?>

    <!-- Tabel Barang -->
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Nama Barang</th>
                <th>Harga</th>
                <th>Stok</th>
                <th>Deskripsi</th>
                <th>Gambar</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($barang)): ?>
                <?php foreach ($barang as $key => $item): ?>
                    <tr>
                        <td><?= $key + 1 + ($currentPage - 1) * 15 ?></td>
                        <td><?= esc($item['nama_barang']) ?></td>
                        <td>Rp.<?= number_format($item['harga_barang'], 0, ',', '.') ?></td>
                        <td><?= $item['jumlah_stock'] ?></td>
                        <td>
                            <?= esc(strlen($item['deskripsi_barang']) > 200 ? substr($item['deskripsi_barang'], 0, 200) . '...' : $item['deskripsi_barang']) ?>
                        </td>
                        <td>
                            <img src="<?= base_url($item['gambar_barang']) ?>" alt="<?= esc($item['nama_barang']) ?>" style="width: 100px; height: auto;" />
                        </td>
                        <td>
                            <div class="btn-group" role="group">
                                <a href="/admin/dashboard/edit-barang/<?= $item['id_barang'] ?>" class="btn btn-warning btn-sm">Ubah</a>
                                <a href="/admin/dashboard/delete-barang/<?= $item['id_barang'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus barang ini?')">Hapus</a>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="7" class="text-center">Tidak ada barang ditemukan.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <!-- Pagination -->
    <div class="d-flex justify-content-center">
        <div class="pagination">
            <?= str_replace('<a', '<a class="btn btn-primary me-2"', $pager->links()) ?>
        </div>
    </div>




</div>
<?= $this->endSection(); ?>