<?= $this->extend('users/admin/template/index'); ?>

<?= $this->section('content'); ?>

<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <h2 class="fw-bold mb-4">Profil Anda</h2>
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <!-- Foto Profil -->
                    <div class="text-center mb-4">
                        <img src="<?= base_url($user['foto_profil'] ?? 'img/default-profile.png') ?>" alt="Foto Profil" class="rounded-circle" style="width: 120px; height: 120px; object-fit: cover;">
                        <form action="<?= base_url('admin/dashboard/profile/updatePhoto') ?>" method="POST" enctype="multipart/form-data" class="mt-3">
                            <?= csrf_field(); ?>
                            <input type="file" name="foto_profil" id="fotoProfil" class="form-control mb-2" accept="image/*">
                            <button type="submit" class="btn btn-primary btn-sm">Simpan Foto</button>
                        </form>
                    </div>
                    <hr>
                    <!-- Form Profil -->
                    <form action="<?= base_url('admin/dashboard/profile/update') ?>" method="POST">
                        <?= csrf_field(); ?>
                        <!-- Nama Lengkap -->
                        <div class="mb-3">
                            <label for="namaLengkap" class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control" id="namaLengkap" name="nama_lengkap" value="<?= esc($user['nama_lengkap']) ?>" required>
                        </div>
                        <!-- Username -->
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username" value="<?= esc($user['username']) ?>" disabled readonly>
                        </div>
                        <!-- Email -->
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="<?= esc($user['email']) ?>" required>
                        </div>
                        <!-- Nomor Telepon -->
                        <div class="mb-3">
                            <label for="noTelp" class="form-label">Nomor Telepon</label>
                            <input type="number" class="form-control" id="noTelp" name="no_telp" value="<?= esc($user['no_telp']) ?>" required>
                        </div>
                        <!-- Alamat -->
                        <h5 class="fw-bold mt-4">Alamat</h5>
                        <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat Lengkap</label>
                            <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Alamat, RT, RW, Desa, Kecamatan, Kabupaten, Provinsi" value="<?= esc($user['alamat']) ?>">
                        </div>
                        <!-- Password -->
                        <h5 class="fw-bold mt-4">Keamanan</h5>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password Baru</label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan password baru (opsional)">
                                <button class="btn btn-outline-secondary toggle-password" type="button">
                                    <i class="bi bi-eye-slash"></i>
                                </button>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="confirmPassword" class="form-label">Konfirmasi Password Baru</label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="confirmPassword" name="confirm_password" placeholder="Konfirmasi password baru">
                                <button class="btn btn-outline-secondary toggle-password" type="button">
                                    <i class="bi bi-eye-slash"></i>
                                </button>
                            </div>
                        </div>
                        <!-- Tombol Simpan -->
                        <div class="text-end">
                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        <?php if (session()->getFlashdata('success')): ?>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: '<?= session()->getFlashdata('success'); ?>',
                timer: 3000,
                showConfirmButton: false
            });
        <?php endif; ?>

        <?php if (session()->getFlashdata('error')): ?>
            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: '<?= session()->getFlashdata('error'); ?>',
                timer: 3000,
                showConfirmButton: false
            });
        <?php endif; ?>
    });

    document.addEventListener('DOMContentLoaded', function() {
        // SweetAlert untuk pesan flash success dan error
        <?php if (session()->getFlashdata('success')): ?>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: '<?= session()->getFlashdata('success'); ?>',
                timer: 3000,
                showConfirmButton: false
            });
        <?php endif; ?>

        <?php if (session()->getFlashdata('error')): ?>
            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                html: '<?= is_array(session()->getFlashdata('error')) ? implode("<br>", session()->getFlashdata('error')) : session()->getFlashdata('error'); ?>',
                timer: 3000,
                showConfirmButton: false
            });
        <?php endif; ?>

        // Validasi Password
        const form = document.querySelector('form[action="<?= base_url('admin/dashboard/profile/update') ?>"]');
        form.addEventListener('submit', function(e) {
            const password = document.querySelector('#password').value;
            const confirmPassword = document.querySelector('#confirmPassword').value;

            if (password !== confirmPassword) {
                e.preventDefault(); // Cegah submit form
                Swal.fire({
                    icon: 'error',
                    title: 'Password Tidak Cocok',
                    text: 'Password baru dan konfirmasi password tidak sesuai. Silakan coba lagi.',
                });
            }
        });
    });
</script>


<script src="<?= base_url('js/pelanggan/profile.js'); ?>"></script>
<?= $this->endSection(); ?>