<?php
/*
  | Source Code Aplikasi Rental Mobil PHP & MySQL
  | 
  | @package   : rental_mobil
  | @file      : konfirmasi.php 
  | @author    : faqoy@gmail.com
  | 
  | 
  | 
  | 
 */
session_start();
require 'koneksi/koneksi.php';
include 'header.php';
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
$kode_booking = $_GET['id'];
$hasil = $koneksi->query("SELECT * FROM booking WHERE kode_booking = '$kode_booking'")->fetch();

$id = $hasil['id_mobil'];
$isi = $koneksi->query("SELECT * FROM mobil WHERE id_mobil = '$id'")->fetch();

// WhatsApp API Link
$whatsappNumber = $info_web->telp; // Replace this with your WhatsApp number

// Auto-generate WhatsApp message
$message = "Halo, saya ingin melakukan konfirmasi pembayaran dengan \n";
$message .= "kode booking: " . $hasil['kode_booking'] . " \n";
$message .= "No KTP: " . $hasil['ktp'] . " \n";
$message .= "Atas Nama: " . $hasil['nama'] . " \n";
$message .= "No Telepon: " . $hasil['no_tlp'] . " \n";
$message .= "Tanggal Sewa: " . $hasil['tanggal'] . " \n";
$message .= "Harga: Rp. " . number_format($hasil['total_harga']) . " \n";

$message = urlencode($message);
$whatsappLink = "https://api.whatsapp.com/send?phone=$whatsappNumber&text=$message";
?>
<br>
<br>
<div class="container">
    <div class="row">
        <div class="col-sm-4">
            <div class="card">
                <div class="card-body text-center">
                    <h5>Pembayaran Dapat Melalui :</h5>
                    <hr />
                    <p><?= $info_web->no_rek; ?></p>
                </div>
            </div>
            <br />
            <div class="card">
                <div class="card-body" style="background:#ddd">
                    <h5 class="card-title"><?= $isi['merk']; ?></h5>
                </div>
                <ul class="list-group list-group-flush">

                    <?php if ($isi['status'] == 'Tersedia') { ?>

                        <li class="list-group-item bg-primary text-white">
                            <i class="fa fa-check"></i> Available
                        </li>

                    <?php } else { ?>

                        <li class="list-group-item bg-danger text-white">
                            <i class="fa fa-close"></i> Not Available
                        </li>

                    <?php } ?>


                    <li class="list-group-item bg-info text-white"><i class="fa fa-check"></i> Free Snack & Drinks</li>
                    <li class="list-group-item bg-dark text-white">
                        <i class="fa fa-money"></i> Rp. <?= number_format($isi['harga']); ?>/ day
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-sm-8">
            <div class="card">
                <div class="card-body">
                    <form method="post" action="koneksi/proses.php?id=konfirmasi" enctype="multipart/form-data" id="konfirmasiForm">
                        <table class="table">
                            <tr>
                                <td>Kode Booking </td>
                                <td> :</td>
                                <td><?= $hasil['kode_booking']; ?></td>
                            </tr>
                            <tr>
                                <td>No Rekening </td>
                                <td> :</td>
                                <td><input type="text" name="no_rekening" required class="form-control"></td>
                            </tr>
                            <tr>
                                <td>Atas Nama </td>
                                <td> :</td>
                                <td><input type="text" name="nama" required class="form-control"></td>
                            </tr>
                            <tr>
                                <td>Nominal Transfer </td>
                                <td> :</td>
                                <td><input value="<?= $hasil['total_harga']; ?>" type="text" name="nominal" required class="form-control"></td>
                            </tr>
                            <tr>
                                <td>Bukti Pembayaran </td>
                                <td> :</td>
                                <td><input type="file" accept="image/*" class="form-control col-sm-12" name="bukti"> </td>
                            </tr>
                            <tr>
                                <td>Tanggal Transfer</td>
                                <td> :</td>
                                <td><input type="date" name="tgl" required class="form-control"></td>
                            </tr>
                            <tr>
                                <td>Total yg Harus di Bayar </td>
                                <td> :</td>
                                <td>Rp. <?= number_format($hasil['total_harga']); ?></td>
                            </tr>


                        </table>
                        <input type="hidden" name="id_booking" value="<?= $hasil['id_booking']; ?>">
                        <button type="submit" class="btn btn-primary float-right" id="kirimButton" onclick="validateForm()">Kirim</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<br>
<br>
<br>

<?php include 'footer.php'; ?>

<script>
    function openWhatsApp() {
        var url = '<?= $whatsappLink; ?>';
        var newWindow = window.open(url, '_blank');
        newWindow.opener = null;
    }

    function validateForm() {
        var noRekening = document.getElementsByName('no_rekening')[0].value.trim();
        var nama = document.getElementsByName('nama')[0].value.trim();
        var nominal = document.getElementsByName('nominal')[0].value.trim();
        var bukti = document.getElementsByName('bukti')[0].value.trim();
        var tanggal = document.getElementsByName('tgl')[0].value.trim();

        if (noRekening === '' || nama === '' || nominal === '' || bukti === '' || tanggal === '') {
            return false;
        }

        openWhatsApp();
        return true;
    }
</script>