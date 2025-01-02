<?= $this->extend('users/admin/template/index'); ?>

<?= $this->section('content'); ?>
<div class="container my-4">
    <h1 class="mb-4">Manajemen Pengguna</h1>
    <!-- Tombol Tambah Pengguna -->
    <a href="<?= site_url('/admin/dashboard/akun/createAkun') ?>" class="btn btn-primary mb-3">Tambah Pengguna</a>

    <!-- Tabel Pengguna -->
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Username</th>
                <th>Nama Lengkap</th>
                <th>Email</th>
                <th>No Telp</th>
                <th>Role</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($pengguna as $key => $item): ?>
                <tr>
                    <td><?= $key + 1 ?></td>
                    <td><?= esc($item['username']) ?></td>
                    <td><?= esc($item['nama_lengkap']) ?></td>
                    <td><?= esc($item['email']) ?></td>
                    <td><?= esc($item['no_telp']) ?></td>
                    <td><?= esc($item['role']) ?></td>
                    <td><?= esc($item['status']) ?></td>
                    <td>
                        <a href="/admin/dashboard/akun/editAkun/<?= $item['id_pengguna'] ?>" class="btn btn-warning btn-sm">Ubah</a>
                        <a href="/admin/dashboard/akun/deleteAkun/<?= $item['id_pengguna'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus pengguna ini?')">Hapus</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?= $this->endSection(); ?>