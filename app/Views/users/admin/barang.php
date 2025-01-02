<?= $this->extend('users/admin/template/index'); ?>

<?= $this->section('content'); ?>

<div class="container mt-4">
    <h2>Welcome, <?= session()->get('role') ?? 'Unknown'; ?>!</h2>
    <!-- Konten dashboard krew -->
</div>
<div class="container">

    katalog barang
</div>
<?= $this->endSection('content'); ?>