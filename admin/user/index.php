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
require '../../koneksi/koneksi.php';
$title_web = 'Pelanggan';
include '../header.php';
if (empty($_SESSION['USER'])) {
    session_start();
}
?>

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Pelanggan</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= $url ?>admin/index.php">Home</a></li>
                <li class="breadcrumb-item active">Pelanggan</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">

            <div class="container">
                <div class="card">
                    <div class="card-header text-white bg-primary mb-4">
                        <h5 class="card-title pt-2 text-light">
                            Daftar Pelanggan
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-sm">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Pengguna</th>
                                        <th>Username</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    $sql = "SELECT * FROM login WHERE level = 'Pengguna' ORDER BY id_login DESC";
                                    $row = $koneksi->prepare($sql);
                                    $row->execute();
                                    $hasil = $row->fetchAll(PDO::FETCH_OBJ);
                                    foreach ($hasil as $r) {
                                    ?>
                                        <tr>
                                            <td><?= $no; ?></td>
                                            <td><?= $r->nama_pengguna; ?></td>
                                            <td><?= $r->username; ?></td>
                                            <td>
                                                <a href="<?php echo $url; ?>admin/booking/booking.php?id=<?= $r->id_login; ?>" class="btn btn-primary btn-sm">Detail Transaksi</a>
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
    </section>

</main>

<?php include '../footer.php'; ?>