<?= $this->extend('users/pelanggan/template/index'); ?>

<?= $this->section('content'); ?>

<div class="container py-4">
    <h2 class="fw-bold mb-4">Daftar Pesanan</h2>

    <div class="d-flex mb-3">
        <a href="?status=baru" class="btn btn-sm <?= $status == 'baru' ? 'btn-danger' : 'btn-secondary' ?> me-2">Baru</a>
        <a href="?status=diproses" class="btn btn-sm <?= $status == 'diproses' ? 'btn-danger' : 'btn-secondary' ?> me-2">Diproses</a>
        <a href="?status=dikirim" class="btn btn-sm <?= $status == 'dikirim' ? 'btn-danger' : 'btn-secondary' ?> me-2">Dikirim</a>
        <a href="?status=selesai" class="btn btn-sm <?= $status == 'selesai' ? 'btn-danger' : 'btn-secondary' ?> me-2">Selesai</a>
        <a href="?status=dibatalkan" class="btn btn-sm <?= $status == 'dibatalkan' ? 'btn-danger' : 'btn-secondary' ?>">Dibatalkan</a>
    </div>

    <?php if (empty($orders)): ?>
        <p class="text-center text-muted">Belum ada pesanan pada status ini.</p>
    <?php else: ?>
        <?php foreach ($orders as $order): ?>
            <div class="card mb-4 shadow-sm">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <p class="fw-bold mb-1"><?= esc($order['nama_lengkap']) ?></p>
                            <p class="text-muted mb-1">Pesanan #<?= esc($order['id_orders']) ?> - <?= ucfirst($order['status']) ?></p>
                            <ul class="list-unstyled">
                                <?php foreach ($order['items'] as $item): ?>
                                    <li class="d-flex align-items-center">
                                        <img src="<?= base_url($item['gambar_barang']) ?>" alt="<?= esc($item['nama_barang']) ?>" class="me-3" style="width: 50px; height: 50px; object-fit: cover;">
                                        <span><?= esc($item['nama_barang']) ?> (<?= $item['quantity'] ?>x)</span>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                        <div class="col-md-4 text-end">
                            <p class="text-muted mb-1">Total:</p>
                            <p class="fw-bold">Rp <?= number_format($order['total'], 0, ',', '.') ?></p>
                            <a href="<?= base_url('pelanggan/orders/detail/' . $order['id_orders']) ?>" class="btn btn-sm btn-outline-primary">Lihat Detail</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>

<?= $this->endSection(); ?>