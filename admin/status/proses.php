<?php

require '../../koneksi/koneksi.php';
$title_web = 'status';
include '../header.php';

if ($_GET['aksi'] == 'edit') {

    $id = $_GET['id'];

    $data[] = $_POST['nama_pengguna'];
    $data[] = $_POST['username'];
    $data[] = $_POST['password'];
    $data[] = $_POST['level'];
    $data[] = $id;

    $sql = "UPDATE login SET nama_pengguna= ?, username=?, password=?, level=?
        WHERE id_login = ?";
    $row = $koneksi->prepare($sql);
    $row->execute($data);

    echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
    echo '<script>
          Swal.fire({
              icon: "success",
              title: "Perubahan Status Sukses",
          }).then(() => {
            window.location="status.php"
          });
      </script>';
}
