<?= $this->extend('users/pelanggan/template/index'); ?>

<?= $this->section('content'); ?>

<div class="container py-5 text-center">
    <h1 class="fw-bold text-success">Pesanan Berhasil</h1>
    <p class="mt-3">Terima kasih telah memesan. Pesanan Anda telah kami terima.</p>
    <a href="<?= base_url('pelanggan/orders') ?>" class="btn btn-danger mt-4">Lihat Pesanan</a>
</div>

<?= $this->endSection(); ?>