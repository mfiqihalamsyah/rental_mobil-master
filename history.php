<?php
/*
  | Source Code Aplikasi Rental Mobil PHP & MySQL
  | 
  | @package   : rental_mobil
  | @file      : history.php 
  | @author    : faqoy@gmail.com
  | 
  | 
  | 
  | 
 */
session_start();
require 'koneksi/koneksi.php';
include 'header.php';

// Pastikan user sudah login
if (empty($_SESSION['USER'])) {
    echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.all.min.js"></script>';
    echo '
    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 1500,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener("mouseenter", Swal.stopTimer);
                toast.addEventListener("mouseleave", Swal.resumeTimer);
            },
        });
        
        Toast.fire({
            icon: "warning",
            title: "Harap Login !",
        }).then(() => {
            window.location.href = "login.php";
        });
    </script>';
    exit();
}

// Ambil user ID dari session
$user_id = $_SESSION['USER']['id_login'];

// Ambil data booking hanya untuk user yang bersangkutan
$hasil = $koneksi->query("SELECT mobil.merk, booking.* FROM booking JOIN mobil ON 
    booking.id_mobil=mobil.id_mobil WHERE booking.id_login = $user_id ORDER BY id_booking DESC")->fetchAll();
?>
<br>
<br>
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    Daftar Transaksi
                </div>
                <div class="card-body">
                    <table class="table table-striped table-bordered table-sm">
                        <thead>
                            <tr>
                                <th>No. </th>
                                <th>Kode Booking</th>
                                <th>Merk Mobil</th>
                                <th>Nama </th>
                                <th>Tanggal Sewa </th>
                                <th>Lama Sewa </th>
                                <th>Total Harga</th>
                                <th>Konfirmasi</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            foreach ($hasil as $isi) { ?>
                                <tr>
                                    <td><?php echo $no; ?></td>
                                    <td><?= $isi['kode_booking']; ?></td>
                                    <td><?= $isi['merk']; ?></td>
                                    <td><?= $isi['nama']; ?></td>
                                    <td><?= $isi['tanggal']; ?></td>
                                    <td><?= $isi['lama_sewa']; ?> hari</td>
                                    <td>Rp. <?= number_format($isi['total_harga']); ?></td>
                                    <td><?= $isi['konfirmasi_pembayaran']; ?></td>
                                    <td>
                                        <a class="btn btn-primary" href="bayar.php?id=<?= $isi['kode_booking']; ?>" role="button">Detail</a>
                                    </td>
                                </tr>
                            <?php $no++;
                            } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<br>

<br>

<br>


<?php include 'footer.php'; ?>