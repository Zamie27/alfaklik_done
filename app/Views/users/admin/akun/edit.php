<?= $this->extend('users/admin/template/index'); ?>

<?= $this->section('content'); ?>
<div class="container my-4">
    <h1 class="mb-4">Edit Pengguna</h1>
    <form action="<?= site_url('/admin/dashboard/akun/updateAkun/' . $pengguna['id_pengguna']) ?>" method="POST">
        <?= csrf_field(); ?>

        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control" id="username" name="username" value="<?= old('username', $pengguna['username']) ?>" required>
        </div>
        <div class="mb-3">
            <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
            <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" value="<?= old('nama_lengkap', $pengguna['nama_lengkap']) ?>" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="<?= old('email', $pengguna['email']) ?>" required>
        </div>
        <div class="mb-3">
            <label for="no_telp" class="form-label">No Telepon</label>
            <input type="text" class="form-control" id="no_telp" name="no_telp" value="<?= old('no_telp', $pengguna['no_telp']) ?>" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password">
        </div>
        <div class="mb-3">
            <label for="role" class="form-label">Role</label>
            <select class="form-control" id="role" name="role" required>
                <option value="admin" <?= $pengguna['role'] == 'admin' ? 'selected' : '' ?>>Admin</option>
                <option value="krew" <?= $pengguna['role'] == 'krew' ? 'selected' : '' ?>>Krew</option>
                <option value="pelanggan" <?= $pengguna['role'] == 'pelanggan' ? 'selected' : '' ?>>Pelanggan</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select class="form-control" id="status" name="status" required>
                <option value="aktif" <?= $pengguna['status'] == 'aktif' ? 'selected' : '' ?>>Aktif</option>
                <option value="nonaktif" <?= $pengguna['status'] == 'nonaktif' ? 'selected' : '' ?>>Nonaktif</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="<?= site_url('/admin/dashboard/akun') ?>" class="btn btn-secondary">Kembali</a>
    </form>
</div>
<?= $this->endSection(); ?>