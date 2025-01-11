<?= $this->extend('users/krew/template/index'); ?>

<?= $this->section('content'); ?>

<div class="container py-4">
    <h2 class="fw-bold mb-4">Detail Pesanan</h2>

    <div class="card shadow mb-4">
        <div class="card-body">
            <h5 class="card-title">Pesanan #<?= esc($order['id_orders']) ?></h5>
            <p><strong>Status:</strong> <span class="badge bg-primary"><?= ucfirst($order['status']) ?></p>
            <p><strong>Nama Pemesan:</strong> <?= esc($order['nama_lengkap']) ?></p>
            <p><strong>Alamat Pengiriman:</strong> <?= esc($order['alamat_pengiriman']) ?></p>
            <hr>
            <h5>Detail Barang</h5>
            <ul class="list-group mb-4">
                <?php foreach ($order['items'] as $item): ?>
                    <li class="list-group-item d-flex align-items-center">
                        <img src="<?= base_url($item['gambar_barang']) ?>" alt="<?= esc($item['nama_barang']) ?>" class="me-3" style="width: 50px; height: 50px; object-fit: cover;">
                        <div>
                            <p class="mb-0 fw-bold"><?= esc($item['nama_barang']) ?></p>
                            <small>Jumlah: <?= $item['quantity'] ?> | Harga: Rp <?= number_format($item['harga_satuan'], 0, ',', '.') ?></small>
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>
            <p><strong>Total:</strong> Rp <?= number_format($order['total'], 0, ',', '.') ?></p>
        </div>
    </div>

    <!-- Tombol Aksi berdasarkan Status -->
    <?php if ($order['status'] == 'baru'): ?>
        <div class="text-end">
            <a href="<?= base_url('krew/orders/process/' . $order['id_orders']) ?>" class="btn btn-primary me-2">Proses Pesanan</a>
            <a href="<?= base_url('krew/orders/cancel/' . $order['id_orders']) ?>" class="btn btn-danger">Batalkan Pesanan</a>
        </div>
    <?php elseif ($order['status'] == 'diproses'): ?>
        <div class="text-end">
            <a href="<?= base_url('krew/orders/ship/' . $order['id_orders']) ?>" class="btn btn-primary">Kirim Pesanan</a>
        </div>
    <?php elseif ($order['status'] == 'dikirim'): ?>
        <div class="text-end">
            <a href="<?= base_url('krew/orders/complete/' . $order['id_orders']) ?>" class="btn btn-success">Selesaikan Pesanan</a>
        </div>
    <?php endif; ?>

    <!-- Tombol Kembali ke Daftar Pesanan -->
    <div class="text-center my-4">
        <a href="<?= base_url('krew/orders') ?>" class="btn btn-secondary">Kembali ke Daftar Pesanan</a>
    </div>
</div>

<?= $this->endSection(); ?>