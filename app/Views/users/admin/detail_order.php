<?= $this->extend('users/admin/template/index'); ?>

<?= $this->section('content'); ?>

<div class="container py-4">
    <h2 class="fw-bold mb-4">Detail Order</h2>

    <div class="card mb-4">
        <div class="card-body">
            <h5>Informasi Order</h5>
            <ul>
                <li><strong>ID Order:</strong> <?= esc($order['id_orders']) ?></li>
                <li><strong>Nama Pelanggan:</strong> <?= esc($order['nama_lengkap']) ?></li>
                <li><strong>Alamat Pengiriman:</strong> <?= esc($order['alamat_pengiriman']) ?></li>
                <li><strong>Total:</strong> Rp <?= number_format($order['total'], 0, ',', '.') ?></li>
                <li><strong>Tanggal:</strong> <?= date('d M Y, H:i', strtotime($order['created_at'])) ?></li>
            </ul>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <h5>Daftar Produk</h5>
            <ul class="list-group">
                <?php foreach ($items as $item): ?>
                    <li class="list-group-item d-flex align-items-center">
                        <img src="<?= base_url($item['gambar_barang']) ?>" alt="<?= esc($item['nama_barang']) ?>" class="me-3" style="width: 50px; height: 50px; object-fit: cover;">
                        <div>
                            <p class="mb-0"><?= esc($item['nama_barang']) ?></p>
                            <small>Jumlah: <?= $item['quantity'] ?> | Subtotal: Rp <?= number_format($item['subtotal'], 0, ',', '.') ?></small>
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>

    <div class="text-center my-4">
        <a href="<?= base_url('admin/laporan-penjualan') ?>" class="btn btn-secondary">Kembali ke Laporan</a>
    </div>
</div>

<?= $this->endSection(); ?>