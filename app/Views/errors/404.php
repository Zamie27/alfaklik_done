<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Page Not Found</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
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
                        <a href="<?= base_url() ?>" class="btn btn-primary px-4">
                            Kembali ke Beranda
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>