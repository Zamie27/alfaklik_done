<?= $this->extend('errors/template/index'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <div class="row justify-content-center align-items-center min-vh-100">
        <div class="col-md-6 text-center">
            <div class="card shadow-sm">
                <div class="card-body p-5">
                    <h1 class="display-1 text-danger fw-bold">404</h1>
                    <h2 class="h4 mb-3">Halaman Tidak Ditemukan</h2>
                    <p class="text-muted mb-4">
                        Maaf, halaman yang Anda cari tidak tersedia atau telah dipindahkan.
                    </p>
                    <a href="<?= base_url(
                                    session()->get('role') == 'admin' ? 'admin/dashboard' : (session()->get('role') == 'krew' ? 'krew/dashboard' : (session()->get('role') == 'pelanggan' ? 'pelanggan/dashboard' : ''))
                                ) ?>" class="btn btn-primary px-4">
                        Kembali ke Dashboard
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>