<?php
/*
  | Source Code Aplikasi Rental Mobil PHP & MySQL
  | 
  | @package   : rental_mobil
  | @file	   : booking.php 
  | @author    : faqoy@gmail.com
  | 
  | 
  | 
  | 
 */
require '../../koneksi/koneksi.php';
$title_web = 'Daftar Booking';
include '../header.php';
if (empty($_SESSION['USER'])) {
    session_start();
}
if (!empty($_GET['id'])) {
    $id = strip_tags($_GET['id']);
    $sql = "SELECT mobil.merk, booking.* FROM booking JOIN mobil ON 
                booking.id_mobil=mobil.id_mobil WHERE id_login = '$id' ORDER BY id_booking DESC";
} else {
    $sql = "SELECT mobil.merk, booking.* FROM booking JOIN mobil ON 
                booking.id_mobil=mobil.id_mobil ORDER BY id_booking DESC";
}
$hasil = $koneksi->query($sql)->fetchAll();
?>

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Daftar Booking</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= $url ?>admin/index.php">Home</a></li>
                <li class="breadcrumb-item active">Daftar Booking</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">

            <section class="container">
                <div class="card">
                    <div class="card-header text-white bg-primary mb-4">
                        <h5 class="card-title text-light">
                            Daftar Booking
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-sm">
                                <thead>
                                    <tr>
                                        <th>No. </th>
                                        <th>KTP</th>
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
                                            <td><img src="../../assets/ktp/<?php echo $isi['img_ktp']; ?>" width="70px"></td>
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
            </section>

        </div>
    </section>

</main>

<?php include '../footer.php'; ?>