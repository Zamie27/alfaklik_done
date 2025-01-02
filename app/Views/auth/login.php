<?= $this->extend('auth/template/index'); ?>

<?= $this->section('content'); ?>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-lg-4 col-md-6">
            <div class="card shadow-sm">
                <div class="card-body">
                    <div>
                        <h4 class="text-center mb-4 mt-2">Masuk</h4>
                        <p class="text-center">
                            Belum punya akun Alfastore?
                            <a href="<?= base_url('register') ?>" class="fw-bold text-decoration-none">Daftar</a>
                        </p>

                        <?php if (session()->getFlashdata('error')): ?>
                            <div class="alert alert-danger">
                                <?= session()->getFlashdata('error') ?>
                            </div>
                        <?php endif; ?>

                        <form id="loginForm" method="post" action="<?= base_url('auth/processLogin') ?>">
                            <div class="mb-3">
                                <label for="credential" class="form-label">Username/Email/Nomor Handphone</label>
                                <input type="text"
                                    class="form-control"
                                    name="identity"
                                    placeholder="Masukkan username, email atau nomor handphone"
                                    required />
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
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
                            <button type="submit" class="btn btn-danger w-100 mb-3">
                                Masuk
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>