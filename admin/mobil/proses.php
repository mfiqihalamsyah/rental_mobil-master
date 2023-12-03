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
$title_web = 'Tambah Mobil';
include '../header.php';
if (empty($_SESSION['USER'])) {
    session_start();
}

if ($_GET['aksi'] == 'tambah') {
    $dir = '../../assets/image/';
    $tmp_name = $_FILES['gambar']['tmp_name'];
    $temp = explode(".", $_FILES["gambar"]["name"]);
    $newfilename = round(microtime(true)) . '.' . end($temp);
    $target_path = $dir . basename($newfilename);
    $allowedImageType = array("image/gif",   "image/JPG",   "image/jpeg",   "image/pjpeg",   "image/png",   "image/x-png");

    if ($_FILES['gambar']["error"] > 0) {
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
                icon: "error",
                title: "Harap Upload Gambar !",
            }).then(() => {
                history.go(-1);
            });
        </script>';
        exit();
    } elseif (!in_array($_FILES['gambar']["type"], $allowedImageType)) {
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
                title: "Hanya dapat mengunggah JPG, PNG & GIF",
            }).then(() => {
                history.go(-1);
            });
        </script>';
        exit();
    } elseif (round($_FILES['gambar']["size"] / 1024) > 4096) {
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
                title: "Besar Gambar tidak boleh lebih dari 4MB !",
            }).then(() => {
                history.go(-1);
            });
        </script>';
        exit();
    } else {
        if (move_uploaded_file($tmp_name, $target_path)) {
            $data[] = $_POST['no_plat'];
            $data[] = $_POST['merk'];
            $data[] = $_POST['harga'];
            $data[] = $_POST['deskripsi'];
            $data[] = $_POST['status'];
            $data[] = $newfilename;

            $sql = "INSERT INTO `mobil`(`no_plat`, `merk`, `harga`, `deskripsi`, `status`, `gambar`) 
                VALUES (?,?,?,?,?,?)";
            $row = $koneksi->prepare($sql);
            $row->execute($data);
            echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
            echo '<script>
                Swal.fire({
                    icon: "success",
                    title: "Sukses Tambah Produk",
                }).then(() => {
                    window.location = "mobil.php";
                });
            </script>';
        } else {
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
                    icon: "error",
                    title: "Harap Upload Gambar !",
                }).then(() => {
                    history.go(-1);
                });
            </script>';
        }
    }
}

if ($_GET['aksi'] == 'edit') {
    $dir = '../../assets/image/';
    $tmp_name = $_FILES['gambar']['tmp_name'];
    $temp = explode(".", $_FILES["gambar"]["name"]);
    $newfilename = round(microtime(true)) . '.' . end($temp);
    $target_path = $dir . basename($newfilename);
    $allowedImageType = array("image/gif",   "image/JPG",   "image/jpeg",   "image/pjpeg",   "image/png",   "image/x-png");

    $gambar = $_POST['gambar_cek'];

    $id = $_GET['id'];

    $data[] = $_POST['no_plat'];
    $data[] = $_POST['merk'];
    $data[] = $_POST['harga'];
    $data[] = $_POST['deskripsi'];
    $data[] = $_POST['status'];
    if ($_FILES['gambar']["size"] > 0) {
        if ($_FILES['gambar']["error"] > 0) {
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
                    icon: "error",
                    title: "Harap Upload Gambar !",
                }).then(() => {
                    history.go(-1);
                });
            </script>';
            exit();
        } elseif (!in_array($_FILES['gambar']["type"], $allowedImageType)) {
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
                    title: "Hanya dapat mengunggah JPG, PNG & GIF",
                }).then(() => {
                    history.go(-1);
                });
            </script>';
            exit();
        } elseif (round($_FILES['gambar']["size"] / 1024) > 4096) {
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
                    title: "Besar Gambar tidak boleh lebih dari 4MB !",
                }).then(() => {
                    history.go(-1);
                });
            </script>';
            exit();
        } else {
            if (move_uploaded_file($tmp_name, $target_path)) {
                if (file_exists('../../assets/image/' . $gambar)) {
                    unlink('../../assets/image/' . $gambar);
                }
                $data[] = $newfilename;
            } else {
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
                        icon: "error",
                        title: "Harap Upload Gambar !",
                    }).then(() => {
                        history.go(-1);
                    });
                </script>';
                exit();
            }
        }
    } else {
        $data[] = $_POST['gambar_cek'];
    }
    $data[] = $id;
    $sql = "UPDATE mobil SET no_plat= ?, merk=?, harga=?, deskripsi=?, status=?, gambar=?
        WHERE id_mobil = ?";
    $row = $koneksi->prepare($sql);
    $row->execute($data);
    echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
    echo '<script>
        Swal.fire({
            icon: "success",
            title: "Sukses Edit Produk",
        }).then(() => {
            window.location = "mobil.php";
        });
    </script>';
}

if (!empty($_GET['aksi'] == 'hapus')) {
    $id = $_GET['id'];
    $gambar = $_GET['gambar'];

    unlink('../../assets/image/' . $gambar);

    $sql = "DELETE FROM mobil WHERE id_mobil = ?";
    $row = $koneksi->prepare($sql);
    $row->execute(array($id));

    echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
    echo '<script>
        Swal.fire({
            icon: "success",
            title: "Sukses Hapus Produk",
        }).then(() => {
            window.location = "mobil.php";
        });
    </script>';
}
