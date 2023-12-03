<?php
/*
  | Source Code Aplikasi Rental Mobil PHP & MySQL
  | 
  | @package   : rental_mobil
  | @file	   : mobil.php 
  | @author    : faqoy@gmail.com
  | 
  | 
  | 
  | 
 */
require '../../koneksi/koneksi.php';
$title_web = 'Daftar Mobil';
include '../header.php';
if (empty($_SESSION['USER'])) {
    session_start();
}
?>

<main id="main" class="main">
    <div class="pagetitle">
        <h1>Daftar Mobil</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= $url ?>admin/index.php">Home</a></li>
                <li class="breadcrumb-item active">Daftar Mobil</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">
            <div class="container">
                <div class="card">
                    <div class="card-header text-white bg-primary">
                        <h4 class="card-title text-white">
                            Daftar Mobil <br><br>
                            <a class="btn btn-light" href="tambah.php">Tambah Mobil</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive"><br>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Gambar</th>
                                        <th>Merk Mobil</th>
                                        <th>No Plat</th>
                                        <th>Harga</th>
                                        <th>Status</th>
                                        <th>Deskripsi</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql = "SELECT * FROM mobil ORDER BY id_mobil ASC";
                                    $row = $koneksi->prepare($sql);
                                    $row->execute();
                                    $hasil = $row->fetchAll();
                                    $no = 1;

                                    foreach ($hasil as $isi) {
                                    ?>
                                        <tr>
                                            <td><?php echo $no; ?></td>
                                            <td><img src="../../assets/image/<?php echo $isi['gambar']; ?>" class="img-fluid" style="width:200px;"></td>
                                            <td><?php echo $isi['merk']; ?></td>
                                            <td><?php echo $isi['no_plat']; ?></td>
                                            <td><?php echo $isi['harga']; ?></td>
                                            <td><?php echo $isi['status']; ?></td>
                                            <td><?php echo $isi['deskripsi']; ?></td>
                                            <td>
                                                <a class="btn btn-primary btn-sm" href="edit.php?id=<?php echo $isi['id_mobil']; ?>" role="button">Edit</a>
                                                <a class="btn btn-danger  btn-sm" href="#" role="button" onclick="hapusMobil(<?php echo $isi['id_mobil']; ?>, '<?php echo $isi['gambar']; ?>')">Hapus</a>
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

<!-- SweetAlert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function hapusMobil(id, gambar) {
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false
        })

        swalWithBootstrapButtons.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No, cancel!',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                // Lakukan proses penghapusan di sini
                $.ajax({
                    url: 'proses.php?aksi=hapus&id=' + id + '&gambar=' + gambar,
                    type: 'GET',
                    success: function(response) {
                        swalWithBootstrapButtons.fire(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success'
                        ).then(() => {
                            window.location.href = 'mobil.php';
                        });
                    }
                });
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                swalWithBootstrapButtons.fire(
                    'Cancelled',
                    'Your imaginary file is safe :)',
                    'error'
                )
            }
        })
    }
</script>