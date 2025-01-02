<?= $this->extend('auth/template/index'); ?>

<?= $this->section('content'); ?>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-lg-4 col-md-6">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h4 class="text-center mb-4 mt-2">Daftar</h4>
                    <p class="text-center">
                        Sudah punya akun Alfastore?
                        <a href="<?= base_url('auth/login'); ?>" class="fw-bold text-decoration-none">Masuk</a>
                    </p>

                    <?php if (session()->has('errors')): ?>
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                <?php foreach (session('errors') as $error): ?>
                                    <li><?= esc($error) ?></li>
                                <?php endforeach ?>
                            </ul>
                        </div>
                    <?php endif ?>

                    <form action="<?= base_url('auth/processRegister') ?>" method="post">
                        <div class="mb-3">
                            <label class="form-label">Nama Lengkap</label>
                            <input type="tel"
                                class="form-control"
                                name="nama_lengkap"
                                placeholder="Masukkan nomor handphone"
                                value="<?= old('nama_lengkap') ?>"
                                required />
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Username</label>
                            <input type="text"
                                class="form-control"
                                name="username"
                                placeholder="Masukkan username"
                                value="<?= old('username') ?>"
                                required />
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email"
                                class="form-control"
                                name="email"
                                placeholder="Masukkan email"
                                value="<?= old('email') ?>"
                                required />
                        </div>
                        <div class="mb-3">
                            <label class="form-label">No. Handphone</label>
                            <input type="tel"
                                class="form-control"
                                name="no_telp"
                                placeholder="Masukkan nomor handphone"
                                value="<?= old('no_telp') ?>"

                                required />
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <div class="input-group">
                                <input type="password"
                                    class="form-control"
                                    name="password"
                                    placeholder="Masukkan password"
                                    required />
                                <button class="btn btn-outline-secondary toggle-password" type="button">
                                    <i class="bi bi-eye-slash"></i>
                                </button>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-danger w-100">
                            Daftar
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>