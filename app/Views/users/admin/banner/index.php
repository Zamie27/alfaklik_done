<?= $this->extend('users/admin/template/index'); ?>

<?= $this->section('content'); ?>
<div class="container my-5">
    <h2 class="mb-4">Daftar Banner</h2>
    <a href="<?= base_url('/admin/dashboard/banner/create') ?>" class="btn btn-primary mb-3">Tambah Banner</a>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
    <?php endif; ?>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Gambar</th>
                <th>Keterangan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($banners as $key => $banner): ?>
                <tr>
                    <td><?= $key + 1 ?></td>
                    <td><img src="<?= base_url('public/' . $banner['image_path']) ?>" alt="Banner" width="100"></td>
                    <td><?= $banner['keterangan'] ?></td>
                    <td>
                        <a href="<?= base_url('/admin/dashboard/banner/edit/' . $banner['id']) ?>" class="btn btn-warning btn-sm">Edit</a>
                        <a href="<?= base_url('/admin/dashboard/banner/delete/' . $banner['id']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus banner ini?')">Hapus</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?= $this->endSection(); ?>