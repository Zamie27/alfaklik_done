<?= $this->extend('users/admin/template/index'); ?>

<?= $this->section('content'); ?>

<div class="container mt-1">
    <div class="content flex-grow-1">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="mb-4">Dashboard</h1>
        </div>
        <div class="row g-3 mb-4">
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body text-center">
                        <h5 class="card-title">Barang</h5>
                        <p class="card-text">1</p>
                        <i class="fas fa-calendar-alt"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body text-center">
                        <h5 class="card-title">Pengguna</h5>
                        <p class="card-text">1</p>
                        <i class="fas fa-calendar-alt"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body text-center">
                        <h5 class="card-title">Transaksi</h5>
                        <p class="card-text">1</p>
                        <i class="fas fa-calendar-alt"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body text-center">
                        <h5 class="card-title">Kategori</h5>
                        <p class="card-text">0</p>
                        <i class="fas fa-calendar-alt"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container mt-4">
        <h2>Welcome, <?= session()->get('role') ?? 'Unknown'; ?>!</h2>
        <!-- Konten dashboard krew -->
    </div>
    <div class="container">
        <div class="card-body">
            <p><strong>Name:</strong> <?= session()->get('nama_lengkap') ?? 'Guest'; ?></p>
            <p><strong>Role:</strong> <?= session()->get('role') ?? 'Unknown'; ?></p>
        </div>
    </div>
    <?= $this->endSection('content'); ?>