<?php

require '../../koneksi/koneksi.php';
$title_web = 'Status';
include '../header.php';

$id = $_GET['id'];

$sql = "SELECT * FROM login WHERE id_login = ?";
$row = $koneksi->prepare($sql);
$row->execute(array($id));

$user = $row->fetch();

?>

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Edit Status</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= $url ?>admin/index.php">Home</a></li>
                <li class="breadcrumb-item"><a href="<?= $url ?>admin/status/status.php">Status</a></li>
                <li class="breadcrumb-item active">Edit Status</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">

            <div class="container">
                <div class="card">
                    <div class="card-header text-white bg-primary mb-4">
                        <h5 class="card-title pt-2 text-light">
                            Ubah Status
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="container">
                            <form action="proses.php?aksi=edit&id=<?= $id; ?>" method="post">
                                <div class="row">

                                    <div class="col-sm-9">

                                        <div class="form-group row">
                                            <label class="col-sm-3">Nama Pengguna</label>
                                            <input type="text" class="form-control col-sm-9" value="<?= $user['nama_pengguna']; ?>" name="nama_pengguna">
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-3">Username</label>
                                            <input type="text" class="form-control col-sm-9" value="<?= $user['username']; ?>" name="username">
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-3">Password</label>
                                            <input type="text" class="form-control col-sm-9" value="<?= $user['password']; ?>" name="password" readonly="readonly">
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-3">Status</label>
                                            <select id="level" name="level">
                                                <option hidden><?= $user['level']; ?></option>
                                                <option value="admin">Admin</option>
                                                <option value="pengguna">Pengguna</option>
                                            </select>
                                        </div>

                                    </div>
                                </div>
                                <button class="btn btn-primary" type="submit" name="submit">Simpan</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <?php ?>