<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Produk Rekomendasi</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet" />


    <!-- Style Css -->
    <style>
        .navbar-custom {
            background-color: #3a3a3a;
            /* Warna latar belakang navbar */
        }

        .navbar-custom .navbar-brand,
        .navbar-custom .nav-link {
            color: #fff;
        }

        .navbar-custom .nav-link:hover {
            color: #f0a500;
            /* Warna saat hover */
        }

        .search-bar {
            width: 250px;
            margin-left: auto;
        }

        .container-custom {
            max-width: 1200px;
            /* Lebar maksimal yang Anda inginkan */
            margin: 0 auto;
            /* Memastikan konten terpusat */
            padding-left: 20px;
            /* Menambahkan padding kiri */
            padding-right: 20px;
            /* Menambahkan padding kanan */
        }

        /* Tambahkan CSS untuk elemen tersembunyi */
        .hidden {
            display: none;
        }


        .discount-label {
            background-color: #ff4d4d;
            /* Warna merah untuk diskon */
            color: white;
            font-size: 12px;
            font-weight: bold;
            padding: 2px 8px;
            border-radius: 5px;
            position: absolute;
            top: 10px;
            right: 10px;
        }

        .price {
            font-size: 16px;
        }

        .price-original {
            text-decoration: line-through;
            color: #888;
            /* Warna abu-abu */
            font-size: 14px;
            margin-right: 5px;
        }

        .hidden {
            display: none;
        }
    </style>


</head>

<body>
    <!-- Navbar -->
    <nav class="bg-light p-3 shadow-sm sticky-top">
        <div class="container d-flex align-items-center justify-content-between">
            <!-- Logo -->
            <a class="navbar-brand d-flex align-items-center" href="#">
                <img src="<?= base_url(); ?>/img/logo.png" alt="Alfagift Logo" class="me-2" height="40" />
            </a>
            <div class="d-flex align-items-center">
                <!-- Login state elements -->
                <div class="dropdown">
                    <a href="#"
                        class="d-flex align-items-center link-dark text-decoration-none dropdown-toggle"
                        id="dropdownUser"
                        data-bs-toggle="dropdown"
                        aria-expanded="false">
                        <img src="<?= base_url(); ?><?= session()->get('foto_profil') ?? 'Guest'; ?>" alt="" width="32" height="32" class="rounded-circle me-2">
                        <strong id="user-name"><?= session()->get('nama_lengkap') ?? 'Guest'; ?></strong>
                    </a>
                    <ul class="dropdown-menu text-small shadow"
                        aria-labelledby="dropdownUser">
                        <li><a class="dropdown-item" href="#">Profile</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="<?= base_url(); ?>/logout">Logout</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <?= $this->renderSection('content'); ?>

    <!-- Footer start -->
    <footer class="bg-dark pb-5 pt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-4 text-light mb-4">
                    <h2 class="mb-3">Zamie</h2>
                    <h3 class="h5">Hubungi Kami</h3>
                    <p>zamie693@gmail.com</p>
                    <p>Jl. Raya Ahmad Yani</p>
                    <p>Subang</p>
                </div>
            </div>
            <div class="border-top border-secondary pt-4">
                <div class="d-flex justify-content-center mb-3">
                    <!-- YouTube -->
                    <a href="https://youtube.com/@zamie27" target="_blank" class="btn btn-outline-light btn-sm rounded-circle me-2">
                        <svg role="img" width="20" class="bi bi-youtube" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 25 25">
                            <path
                                d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z" />
                        </svg>
                    </a>

                    <!-- Instagram -->
                    <a href="https://instagram.com/zamie27_" target="_blank" class="btn btn-outline-light btn-sm rounded-circle me-2">
                        <i class="bi bi-instagram"></i>
                    </a>

                    <!-- LinkedIn -->
                    <a href="https://www.linkedin.com/in/muhammad-ridho-al-zamzami/" target="_blank" class="btn btn-outline-light btn-sm rounded-circle me-2">
                        <i class="bi bi-linkedin"></i>
                    </a>
                </div>
                <p class="text-center text-light small">
                    Dibuat dengan <span class="text-danger">❤</span> oleh
                    <a href="#" class="fw-bold text-primary">Zamie27</a>, menggunakan
                    <a href="#" class="fw-bold text-primary">Bootstrap CSS</a>.
                </p>
            </div>
        </div>
    </footer>
    <!-- Footer end -->

    <!-- js -->
    <script src="<?= base_url('js/pelanggan/index.js'); ?>"></script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <!-- js SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>



</body>

</html>