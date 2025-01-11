<?= $this->extend('users/admin/template/index'); ?>

<?= $this->section('content'); ?>

<div class="container mt-4">
    <div class="content flex-grow-1">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="mb-4">Dashboard</h1>
        </div>
        <div class="row g-3 mb-4">
            <!-- Banner Card -->
            <div class="col-md-3">
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        <h5 class="card-title">Banner</h5>
                        <p class="card-text fs-4"><?= esc($bannerCount) ?></p>
                        <i class="fas fa-image fs-2 text-primary"></i>
                    </div>
                </div>
            </div>
            <!-- Barang Card -->
            <div class="col-md-3">
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        <h5 class="card-title">Barang</h5>
                        <p class="card-text fs-4"><?= esc($barangCount) ?></p>
                        <i class="fas fa-box fs-2 text-success"></i>
                    </div>
                </div>
            </div>
            <!-- Pengguna Card -->
            <div class="col-md-3">
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        <h5 class="card-title">Pengguna</h5>
                        <p class="card-text fs-4"><?= esc($penggunaCount) ?></p>
                        <i class="fas fa-users fs-2 text-warning"></i>
                    </div>
                </div>
            </div>
            <!-- Transaksi Card -->
            <div class="col-md-3">
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        <h5 class="card-title">Transaksi</h5>
                        <p class="card-text fs-4"><?= esc($transaksiSelesaiCount) ?></p>
                        <i class="fas fa-receipt fs-2 text-danger"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container mt-4">
        <h2>Welcome, <?= session()->get('role') ?? 'Admin'; ?>!</h2>
        <!-- Konten tambahan jika diperlukan -->
    </div>
</div>

<?= $this->endSection(); ?>