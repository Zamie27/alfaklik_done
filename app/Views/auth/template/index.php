<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Register Form</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet" />

</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm sticky-top">
        <div class="container">
            <!-- Logo -->
            <a class="navbar-brand d-flex align-items-center" href="#">
                <img src="<?= base_url(); ?>/img/logo.png" alt="Alfagift Logo" class="me-2" height="40" />
            </a>
            <!-- Search Bar -->
            <!-- <div class="input-group mx-lg-5 flex-grow-1">
                <input type="text" class="form-control" placeholder="Temukan produk favoritmu disini" />
                <button class="btn btn-danger">
                    <i class="bi bi-search"></i>
                </button>
            </div> -->
            <!-- Icons and Links -->
            <div class="d-flex align-items-center">
                <a href="<?= url_to('login') ?>" class="btn btn-light border-0 me-2">
                    <i class="bi bi-bell"></i>
                </a>
                <a href="<?= url_to('login') ?>" class="btn btn-light border-0 me-4">
                    <i class="bi bi-cart"></i>
                </a>
                <a href="<?= url_to('register') ?>" class="btn btn-link text-danger me-3">
                    Daftar
                </a>
                <a href="<?= url_to('login') ?>" class="btn btn-link text-secondary">Masuk</a>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <?= $this->renderSection('content'); ?>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <!-- Sweetalert JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- External JS -->
    <script src="<?= base_url(); ?>/js/auth.js"></script>
</body>

</html>