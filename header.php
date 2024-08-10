<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title><?= $info_web->nama_rental; ?></title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/assets2/assets/favicon.ico" />
    <!-- Custom Google font-->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@100;200;300;400;500;600;700;800;900&amp;display=swap" rel="stylesheet" />
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="assets/assets2/css/styles.css" rel="stylesheet" />

    <!-- Sweetalert -->
    <link rel="stylesheet" type="text/css" href="assets/swal/sweetalert.css">
    <script type="text/javascript" src="assets/swal/sweetalert.min.js"></script>
    <script src="assets/js/jquery-2.2.1.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css" rel="stylesheet">
    <link rel="stylesheet" href="sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>

    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="assets/css/font-awesome.css">
</head>

<body class="d-flex flex-column h-100">
    <main class="flex-shrink-0">
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-light bg-white py-3">
            <div class="container px-5">
                <a class="navbar-brand" href="index.php"><span class="fw-bolder text-primary"><?= $info_web->nama_rental; ?></span></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0 small fw-bolder">
                        <li class="nav-item"><a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a></li>
                        <li class="nav-item"><a class="nav-link" href="index.php#produk">Daftar Mobil</a></li>
                        <li class="nav-item"><a class="nav-link" href="kontak.php">Tentang Kami</a></li>
                        <?php if (empty($_SESSION['USER'])) { ?>
                            <li class="nav-item"><a class="nav-link" href="login.php">Login</a></li>
                        <?php } ?>
                        <?php if (!empty($_SESSION['USER'])) { ?>
                            <li class="nav-item">
                                <a class="nav-link" href="history.php">History</a>
                            </li>
                            <li class="nav-item active">
                                <a class="nav-link" href="<?= $_SESSION['USER']['level'] == 'admin' ? $url . 'admin/index.php' : 'profil.php' ?>" style="color:blue">Profil</a>
                            </li>
                        <?php } ?>
                    </ul>
                    <?php if (!empty($_SESSION['USER'])) { ?>
                        <ul class="navbar-nav my-2 my-lg-0">
                            <li class="nav-item">
                                <a class="nav-link" href="<?= $_SESSION['USER']['level'] == 'admin' ? $url . 'admin/index.php' : 'profil.php' ?>">
                                    <i class="fa fa-user"> </i> Hallo, <?php echo $_SESSION['USER']['nama_pengguna']; ?>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" onclick="return confirm('Apakah anda ingin logout ?');" href="<?php echo $url; ?>admin/logout.php">Logout</a>
                            </li>
                        </ul>
                    <?php } ?>
                </div>
            </div>
        </nav>