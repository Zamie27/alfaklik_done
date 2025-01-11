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

<body class="mx-1 overflow-hidden">
    <!-- Navbar -->




    <!-- Sidebar -->
    <!-- Sidenav dan Konten -->
    <div class="d-flex" style="height: 100vh;">

        <!-- Sidebar -->
        <div class="bg-light p-3 d-flex flex-column" style="width: 240px; height: 100vh; flex-shrink: 0;">
            <!-- Logo -->
            <a class="navbar-brand d-flex align-items-center" href="#">
                <img src="<?= base_url(); ?>/img/logo.png" alt="Alfagift Logo" class="me-2" height="60" />
            </a>
            <hr>
            <ul class="nav nav-pills flex-column mb-auto" id="sidebarNav">
                <li>
                    <a href="<?= base_url(); ?>admin/dashboard" class="nav-link link-dark">
                        Dashboard
                    </a>
                </li>
                <li>
                    <a href="<?= base_url(); ?>admin/dashboard/banner" class="nav-link link-dark">
                        Banner
                    </a>
                </li>
                <li>
                    <a href="<?= base_url(); ?>admin/dashboard/barang" class="nav-link link-dark">
                        Barang
                    </a>
                </li>
                <li>
                    <a href="<?= base_url(); ?>admin/dashboard/akun" class="nav-link link-dark">
                        Akun
                    </a>
                </li>
                <li>
                    <a href="<?= base_url(); ?>admin/laporan-penjualan" class="nav-link link-dark">
                        Laporan Penjualan
                    </a>
                </li>
            </ul>
            <hr>
            <div class="dropdown">
                <a href="#"
                    class="d-flex align-items-center link-dark text-decoration-none dropdown-toggle"
                    id="dropdownUser"
                    data-bs-toggle="dropdown"
                    aria-expanded="false">
                    <img src="<?= base_url(); ?><?= session()->get('foto_profil') ?? 'Guest'; ?>" alt="" style="    object-fit: cover;" width="32" height="32" class="rounded-circle me-2">
                    <strong id="user-name"><?= session()->get('nama_lengkap') ?? 'Guest'; ?></strong>
                </a>
                <ul class="dropdown-menu text-small shadow"
                    aria-labelledby="dropdownUser">
                    <li><a class="dropdown-item" href="<?= base_url(); ?>admin/dashboard/profile">Profile</a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li><a class="dropdown-item" href="<?= base_url(); ?>/logout">Logout</a></li>
                </ul>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-grow-1 overflow-auto p-3" style="margin-top: 56px;">
            <!-- Main Content -->
            <?= $this->renderSection('content'); ?>
            <!-- Tambahkan lebih banyak konten untuk membuat area ini bisa di-scroll -->
        </div>
    </div>




    <!-- Footer start -->

    <!-- Footer end -->

    <!-- js -->
    <script src="<?= base_url('js/admin/index.js'); ?>"></script>
    <script src="<?= base_url('js/admin/sidenav.js'); ?>"></script>
    <script src="<?= base_url('js/admin/barang.js'); ?>"></script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <!-- js SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>



</body>

</html>