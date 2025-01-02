<?= $this->extend('users/krew/template/index'); ?>

<?= $this->section('content'); ?>

<div class="container ">


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
            <img
                src="https://storage.googleapis.com/a1aa/image/tQ6XAGmjccIyGNlLmzmqpM7JyYOaJxfBFTMZRxSBGjpAtWAKA.jpg"
                alt="Delivery Illustration"
                class="rounded-circle"
                style="height: 50px; width: 50px" />
        </div>
    </div>

    <!-- Main Content -->
    <div class="container my-4">
        <!-- Pesanan Card -->
        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <h5 class="card-title">Pesanan</h5>
                <button class="btn btn-outline-primary w-100 mb-3">
                    Scan Pesanan Self-Service <i class="fas fa-qrcode"></i>
                </button>
                <div class="border rounded p-3 bg-light">
                    <h5 class="text-primary">Status Pengajuan POD</h5>
                    <p class="mb-2">Pesanan Siap</p>
                    <ul>
                        <li>0 Pesanan menunggu approval</li>
                        <li>0 Pesanan direject</li>
                    </ul>
                    <p class="mb-2">Dalam Pengiriman</p>
                    <ul>
                        <li>0 Pesanan menunggu approval</li>
                        <li>0 Pesanan direject</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Scrollable Cards Section -->
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-5 g-3">
            <div class="col">
                <div class="card text-center h-100">
                    <div class="card-body">
                        <img
                            src="https://storage.googleapis.com/a1aa/image/TbGbzMW29zpnGViHaBeBV5nPZ1Qa11OA2JOqkGs2QPFBtWAKA.jpg"
                            alt="New Orders"
                            class="mb-2 img-fluid"
                            style="height: 50px; width: 50px;" />
                        <h5 class="card-title">Pesanan Baru</h5>
                        <p class="card-text">4</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card text-center h-100">
                    <div class="card-body">
                        <img
                            src="https://storage.googleapis.com/a1aa/image/1Zw3zke0eWuVP0O67LVrmSXZ3heHdrrqnoRNBRhW5Zgen1CQB.jpg"
                            alt="Packing"
                            class="mb-2 img-fluid"
                            style="height: 50px; width: 50px;" />
                        <h5 class="card-title">Packing</h5>
                        <p class="card-text">0</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card text-center h-100">
                    <div class="card-body">
                        <img
                            src="https://storage.googleapis.com/a1aa/image/4bUAyoGUzTqzBRxp5hWO6qQBN9LZTTHYfUkhdhmHaUMCtWAKA.jpg"
                            alt="Ready Orders"
                            class="mb-2 img-fluid"
                            style="height: 50px; width: 50px;" />
                        <h5 class="card-title">Pesanan Siap</h5>
                        <p class="card-text">0</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card text-center h-100">
                    <div class="card-body">
                        <img
                            src="https://storage.googleapis.com/a1aa/image/4bUAyoGUzTqzBRxp5hWO6qQBN9LZTTHYfUkhdhmHaUMCtWAKA.jpg"
                            alt="Orders In Delivery"
                            class="mb-2 img-fluid"
                            style="height: 50px; width: 50px;" />
                        <h5 class="card-title">Pesanan Dikirim</h5>
                        <p class="card-text">0</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card text-center h-100">
                    <div class="card-body">
                        <img
                            src="https://storage.googleapis.com/a1aa/image/4bUAyoGUzTqzBRxp5hWO6qQBN9LZTTHYfUkhdhmHaUMCtWAKA.jpg"
                            alt="Completed Orders"
                            class="mb-2 img-fluid"
                            style="height: 50px; width: 50px;" />
                        <h5 class="card-title">Pesanan Selesai</h5>
                        <p class="card-text">0</p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<?= $this->endSection('content'); ?>