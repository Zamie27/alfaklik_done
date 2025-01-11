<?= $this->extend('users/krew/template/index'); ?>

<?= $this->section('content'); ?>
<div class="dashboard-wrapper">
    <div class="container">
        <!-- Header Section -->
        <div class="bg-danger text-white p-3">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="mb-1">Selamat Datang</h6>
                    <h4 class="mb-1"><?= session()->get('nama_lengkap') ?? 'Guest'; ?></h4>
                    <p class="mb-2">
                        <i class="fas fa-user"></i> <?= session()->get('role') ?? 'Unknown'; ?>
                    </p>
                    <div class="badge bg-warning text-dark">
                        Lokasi: <strong>Ciasem Def</strong>
                    </div>
                </div>
                <?php
                $db = \Config\Database::connect();
                $builder = $db->table('pengguna');
                $user = $builder->select('foto_profil')->where('id_pengguna', session()->get('id_pengguna'))->get()->getRowArray();
                $fotoProfil = $user['foto_profil'] ?? 'img/default-profile.png';
                ?>

                <img src="<?= base_url($fotoProfil); ?>"
                    alt="Profile Picture"
                    width="50"
                    height="50"
                    class="rounded-circle rounded-profile me-2">
            </div>
        </div>

        <!-- Main Content -->
        <div class="container my-4">
            <!-- Scrollable Cards Section -->
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-5 g-3">
                <div class="col">
                    <a href="<?= base_url('krew/orders?status=baru') ?>" class="text-decoration-none">
                        <div class="card text-center h-100">
                            <div class="card-body py-5">
                                <h5 class="card-title">Pesanan Baru</h5>
                                <p class="card-text"><?= esc($counts['baru'] ?? 0) ?></p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col">
                    <a href="<?= base_url('krew/orders?status=diproses') ?>" class="text-decoration-none">
                        <div class="card text-center h-100">
                            <div class="card-body py-5">
                                <h5 class="card-title">Pesanan Diproses</h5>
                                <p class="card-text"><?= esc($counts['diproses'] ?? 0) ?></p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col">
                    <a href="<?= base_url('krew/orders?status=dikirim') ?>" class="text-decoration-none">
                        <div class="card text-center h-100">
                            <div class="card-body py-5">
                                <h5 class="card-title">Pesanan Dikirim</h5>
                                <p class="card-text"><?= esc($counts['dikirim'] ?? 0) ?></p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col">
                    <a href="<?= base_url('krew/orders?status=selesai') ?>" class="text-decoration-none">
                        <div class="card text-center h-100">
                            <div class="card-body py-5">
                                <h5 class="card-title">Pesanan Selesai</h5>
                                <p class="card-text"><?= esc($counts['selesai'] ?? 0) ?></p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col">
                    <a href="<?= base_url('krew/orders?status=dibatalkan') ?>" class="text-decoration-none">
                        <div class="card text-center h-100">
                            <div class="card-body py-5">
                                <h5 class="card-title">Pesanan Dibatalkan</h5>
                                <p class="card-text"><?= esc($counts['dibatalkan'] ?? 0) ?></p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>