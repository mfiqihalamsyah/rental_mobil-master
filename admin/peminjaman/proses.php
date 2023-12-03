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
require '../../koneksi/koneksi.php';

if ($_GET['id'] == 'konfirmasi') {
  $data2[] = $_POST['status'];
  $data2[] = $_POST['id_mobil'];
  $sql2 = "UPDATE `mobil` SET `status`= ? WHERE id_mobil= ?";
  $row2 = $koneksi->prepare($sql2);
  $row2->execute($data2);

  echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
  echo '<script>
        Swal.fire({
            icon: "success",
            title: "Perubahan Status Mobil Sukses",
        }).then(() => {
            history.go(-1);
        });
    </script>';
}
