<?php
/*
  | Source Code Aplikasi Rental Mobil PHP & MySQL
  | 
  | @package   : rental_mobil
  | @file	   : index.php 
  | @author    : faqoy@gmail.com
  | 
  | 
  | 
  | 
 */
require '../koneksi/koneksi.php';
$title_web = 'Dashboard';
include 'header.php';
if (empty($_SESSION['USER'])) {
    session_start();
}
if (!empty($_POST['nama_rental'])) {
    $data[] =  htmlspecialchars($_POST["nama_rental"]);
    $data[] =  htmlspecialchars($_POST["telp"]);
    $data[] =  htmlspecialchars($_POST["alamat"]);
    $data[] =  htmlspecialchars($_POST["email"]);
    $data[] =  htmlspecialchars($_POST["no_rek"]);
    $data[] =  1;
    $sql = "UPDATE infoweb SET nama_rental = ?, telp = ?, alamat = ?, email = ?, no_rek = ?  WHERE id = ? ";
    $row = $koneksi->prepare($sql);
    $row->execute($data);
    echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
    echo '<script>
        Swal.fire({
            icon: "success",
            title: "Success",
            text: "Update Data Info Website Berhasil !",
        }).then(() => {
            window.location.href = "index.php";
        });
    </script>';
    exit;
}

if (!empty($_POST['nama_pengguna'])) {
    $data[] =  htmlspecialchars($_POST["nama_pengguna"]);
    $data[] =  htmlspecialchars($_POST["username"]);
    $data[] =  md5($_POST["password"]);
    $data[] =  $_SESSION['USER']['id_login'];
    $sql = "UPDATE login SET nama_pengguna = ?, username = ?, password = ? WHERE id_login = ? ";
    $row = $koneksi->prepare($sql);
    $row->execute($data);
    echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
    echo '<script>
        Swal.fire({
            icon: "success",
            title: "Success",
            text: "Update Data Profil Berhasil !",
        }).then(() => {
            window.location.href = "index.php";
        });
    </script>';
    exit;
}

if (!empty($_POST['title'])) {
    $data[] =  htmlspecialchars($_POST["title"]);
    $data[] =  htmlspecialchars($_POST["subtitle"]);
    $data[] =  htmlspecialchars($_POST["prom"]);
    $data[] =  1;
    $sql = "UPDATE landingpage SET title = ?, subtitle = ?, prom = ? WHERE id = ? ";
    $row = $koneksi->prepare($sql);
    $row->execute($data);
    echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
    echo '<script>
        Swal.fire({
            icon: "success",
            title: "Success",
            text: "Update Halaman Utama Website Berhasil !",
        }).then(() => {
            window.location.href = "index.php";
        });
    </script>';
    exit;
}

?>

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= $url ?>admin/index.php">Home</a></li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">

            <!-- Left side columns -->
            <div class="col-lg-12">
                <div class="row">

                    <!-- Sales Card -->
                    <div class="col-xxl-4 col-md-6">
                        <div class="card info-card sales-card">
                            <div class="card-body">
                                <h5 class="card-title">Daftar Mobil</h5>

                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="ri-car-fill"></i>
                                    </div>
                                    <div class="ps-3">
                                        <?php $sql = mysqli_query($con, "SELECT count(1) FROM mobil"); ?>
                                        <?php $row =  mysqli_fetch_array($sql) ?>
                                        <?php $total =  $row[0] ?>
                                        <h6><?= $total ?></h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- End Sales Card -->

                    <!-- Revenue Card -->
                    <div class="col-xxl-4 col-md-6">
                        <div class="card info-card revenue-card">
                            <div class="card-body">
                                <h5 class="card-title">Daftar Booking</h5>

                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-currency-dollar"></i>
                                    </div>
                                    <div class="ps-3">
                                        <?php $sql = mysqli_query($con, "SELECT count(1) FROM booking"); ?>
                                        <?php $row =  mysqli_fetch_array($sql) ?>
                                        <?php $total =  $row[0] ?>
                                        <h6><?= $total ?></h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- End Revenue Card -->

                    <!-- Customers Card -->
                    <div class="col-xxl-4 col-xl-12">

                        <div class="card info-card customers-card">
                            <div class="card-body">
                                <h5 class="card-title">Pelanggan</h5>

                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-people"></i>
                                    </div>
                                    <div class="ps-3">
                                        <?php $sql = mysqli_query($con, "SELECT count(1) FROM login WHERE level = 'pengguna'"); ?>
                                        <?php $row =  mysqli_fetch_array($sql) ?>
                                        <?php $total =  $row[0] ?>
                                        <h6><?= $total ?></h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Customers Card -->

                </div>
            </div>

        </div>
    </section>

    <section class="section dashboard">
        <div class="row">
            <div class="container">
                <div class="row">

                    <div class="col-sm-6">
                        <div class="card">
                            <div class="card-header">
                                Profil Admin
                            </div>
                            <div class="card-body">
                                <form action="" method="post">
                                    <?php
                                    $id =  $_SESSION["USER"]["id_login"];
                                    $sql = "SELECT * FROM login WHERE id_login = ?";
                                    $row = $koneksi->prepare($sql);
                                    $row->execute(array($id));
                                    $edit_profil = $row->fetch(PDO::FETCH_OBJ);
                                    ?>
                                    <div class="form-group">
                                        <label for="">Nama Pengguna</label>
                                        <input type="text" class="form-control" value="<?= $edit_profil->nama_pengguna; ?>" name="nama_pengguna" id="nama_pengguna" placeholder="" />
                                    </div>
                                    <div class="form-group">
                                        <label for="">Username</label>
                                        <input type="text" required class="form-control" value="<?= $edit_profil->username; ?>" name="username" id="username" placeholder="" />
                                    </div>
                                    <div class="form-group">
                                        <label for="">Password</label>
                                        <input type="password" required class="form-control" value="" name="password" id="password" placeholder="" />
                                    </div><br>
                                    <button type="submit" class="btn btn-primary">
                                        Simpan
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="card">
                            <div class="card-header">
                                Halaman Utama
                            </div>
                            <div class="card-body">
                                <form action="" method="post">
                                    <?php
                                    $sql = "SELECT * FROM landingpage WHERE id = 1";
                                    $row = $koneksi->prepare($sql);
                                    $row->execute();
                                    $edit = $row->fetch(PDO::FETCH_OBJ);
                                    ?>
                                    <div class="form-group">
                                        <label for="">Judul</label>
                                        <input type="text" class="form-control" value="<?= $edit->title; ?>" name="title" id="nama_pengguna" />
                                    </div>
                                    <div class="form-group">
                                        <label for="">Sub Judul</label>
                                        <input type="text" class="form-control" value="<?= $edit->subtitle; ?>" name="subtitle" id="username" />
                                    </div>
                                    <div class="form-group">
                                        <label for="">Teks Promosi</label>
                                        <input type="text" class="form-control" value="<?= $edit->prom; ?>" name="prom" id="password" />
                                    </div><br>
                                    <button type="submit" class="btn btn-primary">
                                        Simpan
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-header">
                                Info Website
                            </div>
                            <div class="card-body">
                                <form action="" method="post">
                                    <?php
                                    $sql = "SELECT * FROM infoweb WHERE id = 1";
                                    $row = $koneksi->prepare($sql);
                                    $row->execute();
                                    $edit = $row->fetch(PDO::FETCH_OBJ);
                                    ?>
                                    <div class="form-group">
                                        <label for="">Nama rental</label>
                                        <input type="text" class="form-control" value="<?= $edit->nama_rental; ?>" name="nama_rental" id="nama_rental" placeholder="" />
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="">Email</label>
                                                <input type="text" class="form-control" value="<?= $edit->email; ?>" name="email" id="email" placeholder="" />
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="">Telp</label>
                                                <input type="text" class="form-control" value="<?= $edit->telp; ?>" name="telp" id="telp" placeholder="" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Alamat</label>
                                        <textarea class="form-control" name="alamat" id="alamat" placeholder=""><?= $edit->alamat; ?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="">No rek</label>
                                        <textarea class="form-control" name="no_rek" id="no_rek" placeholder=""><?= $edit->no_rek; ?></textarea>
                                    </div><br>
                                    <button type="submit" class="btn btn-primary">
                                        Simpan
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

</main>

<!-- alert https://sweetalert2.github.io/ -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?php include 'footer.php'; ?>