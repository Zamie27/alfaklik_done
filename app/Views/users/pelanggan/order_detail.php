<?= $this->extend('users/pelanggan/template/index'); ?>

<?= $this->section('content'); ?>

<div class="container py-4">
    <h2 class="fw-bold mb-4">Detail Pesanan</h2>

    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <h5 class="fw-bold mb-3">Informasi Pesanan</h5>
            <p><strong>ID Pesanan:</strong> #<?= esc($order['id_orders']) ?></p>
            <p><strong>Status:</strong><span class="badge bg-primary"><?= ucfirst($order['status']) ?></p>
            <p><strong>Tanggal Pemesanan:</strong> <?= date('d M Y - H:i', strtotime($order['created_at'])) ?></p>
        </div>
    </div>

    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <h5 class="fw-bold mb-3">Informasi Pengiriman</h5>
            <p><strong>Nama Penerima:</strong> <?= esc($order['nama_lengkap']) ?></p>
            <p><strong>No. Telepon:</strong> <?= esc($order['no_telp']) ?></p>
            <p><strong>Email:</strong> <?= esc($order['email']) ?></p>
            <p><strong>Alamat:</strong> <?= esc($order['alamat_pengiriman']) ?></p>
        </div>
    </div>

    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <h5 class="fw-bold mb-3">Detail Barang</h5>
            <ul class="list-group">
                <?php foreach ($order['items'] as $item): ?>
                    <li class="list-group-item d-flex align-items-center">
                        <img src="<?= base_url($item['gambar_barang']) ?>" alt="<?= esc($item['nama_barang']) ?>"
                            class="rounded me-3" style="width: 70px; height: 70px; object-fit: cover;">
                        <div>
                            <p class="mb-0 fw-bold"><?= esc($item['nama_barang']) ?></p>
                            <p class="mb-0">Harga: Rp <?= number_format($item['harga_satuan'], 0, ',', '.') ?></p>
                            <p class="mb-0">Jumlah: <?= $item['quantity'] ?>x</p>
                            <p class="mb-0">Subtotal: Rp <?= number_format($item['subtotal'], 0, ',', '.') ?></p>
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <h5 class="fw-bold mb-3">Ringkasan</h5>
            <div class="d-flex justify-content-between">
                <span>Subtotal</span>
                <span>Rp <?= number_format($order['subtotal'], 0, ',', '.') ?></span>
            </div>
            <div class="d-flex justify-content-between">
                <span>Ongkos Kirim</span>
                <span>Rp <?= number_format($order['ongkir'], 0, ',', '.') ?></span>
            </div>
            <hr>
            <div class="d-flex justify-content-between fw-bold">
                <span>Total</span>
                <span>Rp <?= number_format($order['total'], 0, ',', '.') ?></span>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>