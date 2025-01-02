<?= $this->extend('users/admin/template/index'); ?>

<?= $this->section('content'); ?>
<div class="container my-4">
    <h1 class="mb-4">Tambah Pengguna</h1>
    <form action="<?= site_url('/admin/dashboard/akun/storeAkun') ?>" method="POST">
        <?= csrf_field(); ?>

        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control" id="username" name="username" value="<?= old('username') ?>" required>
        </div>
        <div class="mb-3">
            <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
            <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" value="<?= old('nama_lengkap') ?>" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="<?= old('email') ?>" required>
        </div>
        <div class="mb-3">
            <label for="no_telp" class="form-label">No Telepon</label>
            <input type="text" class="form-control" id="no_telp" name="no_telp" value="<?= old('no_telp') ?>" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <div class="mb-3">
            <label for="role" class="form-label">Role</label>
            <select class="form-control" id="role" name="role" required>
                <option value="admin" <?= old('role') == 'admin' ? 'selected' : '' ?>>Admin</option>
                <option value="krew" <?= old('role') == 'krew' ? 'selected' : '' ?>>Krew</option>
                <option value="pelanggan" <?= old('role') == 'pelanggan' ? 'selected' : '' ?>>Pelanggan</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="<?= site_url('/admin/dashboard/akun') ?>" class="btn btn-secondary">Kembali</a>
    </form>
</div>
<?= $this->endSection(); ?>