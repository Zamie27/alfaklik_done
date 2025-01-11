<?= $this->extend('users/admin/template/index'); ?>

<?= $this->section('content'); ?>

<div class="container py-4">
    <h2 class="fw-bold mb-4">Laporan Penjualan</h2>

    <?php if (empty($orders)): ?>
        <p class="text-center text-muted">Belum ada pesanan selesai.</p>
    <?php else: ?>
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Nama Pelanggan</th>
                        <th>ID Order</th>
                        <th>Total</th>
                        <th>Tanggal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($orders as $index => $order): ?>
                        <tr>
                            <td><?= $index + 1 ?></td>
                            <td><?= esc($order['nama_lengkap']) ?></td>
                            <td><?= esc($order['id_orders']) ?></td>
                            <td>Rp <?= number_format($order['total'], 0, ',', '.') ?></td>
                            <td><?= date('d M Y, H:i', strtotime($order['created_at'])) ?></td>
                            <td>
                                <a href="<?= base_url('admin/detail-order/' . $order['id_orders']) ?>" class="btn btn-sm btn-primary">
                                    Lihat Detail
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</div>

<?= $this->endSection(); ?>