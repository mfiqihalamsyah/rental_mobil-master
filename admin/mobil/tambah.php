<?php
/*
  | Source Code Aplikasi Rental Mobil PHP & MySQL
  | 
  | @package   : rental_mobil
  | @file	   : tambah.php 
  | @author    : faqoy@gmail.com
  | 
  | 
  | 
  | 
 */
require '../../koneksi/koneksi.php';
$title_web = 'Tambah Mobil';
include '../header.php';
if (empty($_SESSION['USER'])) {
    session_start();
}
?>

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Tambah Mobil</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= $url ?>admin/index.php">Home</a></li>
                <li class="breadcrumb-item active"><a href="<?= $url ?>admin/mobil/mobil.php">Daftar Mobil</a></li>
                <li class="breadcrumb-item active">Tambah Mobil</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">

            <div class="container">
                <div class="card">
                    <div class="card-header text-white bg-primary">
                        <h4 class="card-title">
                            Tambah Mobil
                            <div class="float-right">
                                <a class="btn btn-warning" href="mobil.php" role="button">Kembali</a>
                            </div>
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="container">
                            <form method="post" action="proses.php?aksi=tambah" enctype="multipart/form-data">
                                <div class="row">

                                    <div class="col-sm-6">

                                        <div class="form-group row">
                                            <label class="col-sm-3">No Plat</label>
                                            <input type="text" class="form-control col-sm-9" name="no_plat" placeholder="Isi No Plat">
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-3">Merk Mobil</label>
                                            <input type="text" class="form-control col-sm-9" name="merk" placeholder="Isi Merk">
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-3">Harga</label>
                                            <input type="text" class="form-control col-sm-9" name="harga" placeholder="Isi Harga">
                                        </div>

                                    </div>

                                    <div class="col-sm-6">

                                        <div class="form-group row">
                                            <label class="col-sm-3">Deskripsi</label>
                                            <input type="text" class="form-control col-sm-9" name="deskripsi" placeholder="Isi Deskripsi">
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-3">Status</label>
                                            <select class="form-control col-sm-9" name="status">
                                                <option value="" disabled selected>Pilih Status</option>
                                                <option>Tersedia</option>
                                                <option>Tidak Tersedia</option>
                                            </select>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-3">Gambar</label>
                                            <input type="file" accept="image/*" class="form-control col-sm-9" name="gambar" placeholder="Isi Gambar">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="float-right">
                                    <button class="btn btn-primary" role="button" type="submit">
                                        Simpan
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>

</main>

<?php include '../footer.php'; ?>