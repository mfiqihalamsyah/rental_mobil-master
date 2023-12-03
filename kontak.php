<?php
/*
  | Source Code Aplikasi Rental Mobil PHP & MySQL
  | 
  | @package   : rental_mobil
  | @file	   : kontak.php 
  | @author    : faqoy@gmail.com
  | 
  | 
  | 
  | 
 */
session_start();
require 'koneksi/koneksi.php';
include 'header.php';
?>

<!DOCTYPE html>
<html>

<head>
    <title>Kontak Kami</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
</head>

<body style="margin: 0;">
    <div>
        <section>
            <div class="container">
                <!-- about -->
                <div class="row justify-content-center">
                    <div class="col-lg-8 text-center">
                        <h2 class="display-4 fw-bolder"><span class="text-gradient d-inline">Kontak Kami</span></h2>
                        <p class="lead fw-light mb-4">Anda membutuhkan jasa rental / sewa mobil di Bekasi? Segera hubungi kami untuk melakukan reservasi!</p>
                        <div class="d-flex justify-content-center">
                            <a class="text-gradient me-3" href="https://api.whatsapp.com/send?phone=<?= $info_web->telp; ?>&text=Hello%20Rental Mobil,%20%20Saya%20ingin%20menanyakan%20tentang%20" target="_blank"><i class="bi bi-whatsapp fs-2 text-primary"></i></a>
                        </div>
                    </div>
                </div>

                <div class="row justify-content-center mt-5">
                    <div class="col-lg-6">
                        <div class="card h-100 w-100">
                            <div class="card-header">
                                Kontak Kami
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-4">Nama Rental</div>
                                    <div class="col-sm-8"><?= $info_web->nama_rental; ?></div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-sm-4">Telp</div>
                                    <div class="col-sm-8"><?= $info_web->telp; ?></div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-sm-4">Alamat</div>
                                    <div class="col-sm-8"><?= $info_web->alamat; ?></div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-sm-4">Email</div>
                                    <div class="col-sm-8"><?= $info_web->email; ?></div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-sm-4">No Rekening</div>
                                    <div class="col-sm-8"><?= $info_web->no_rek; ?></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 mt-4 mt-lg-0">
                        <div class="card h-100 w-100">
                            <div class="card-header">
                                Lokasi Kami
                            </div>
                            <div class="card-body">
                                <div class="embed-responsive embed-responsive-16by9" style="height: 250px;">
                                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2307.1514567538484!2d107.12583008162068!3d-6.379162127312723!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69996cde11d0ab%3A0x50eded0e9b5de491!2sMugi%20Lancar%20Transport!5e0!3m2!1sid!2sid!4v1692888903322!5m2!1sid!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>
    </div>
</body>

</html>

<?php include 'footer.php'; ?>