<?php
/*
  | Source Code Aplikasi Rental Mobil PHP & MySQL
  | 
  | @package   : rental_mobil
  | @file	   : proses.php 
  | @author    : faqoy@gmail.com
  | 
  | 
  | 
  | 
 */
?>

<!DOCTYPE html>
<html>

<head>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.min.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.all.min.js"></script>
</head>

<body>
</body>

</html>

<?php
require '../../koneksi/koneksi.php';

if ($_GET['id'] == 'konfirmasi') {
  $data2[] = $_POST['status'];
  $data2[] = $_POST['id_booking'];
  $sql2 = "UPDATE `booking` SET `konfirmasi_pembayaran`= ? WHERE id_booking= ?";
  $row2 = $koneksi->prepare($sql2);
  $row2->execute($data2);

  echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
  echo '<script>
      Swal.fire({
          icon: "success",
          title: "Perubahan Status Sukses",
      }).then(() => {
          history.go(-1);
      });
  </script>';
}
