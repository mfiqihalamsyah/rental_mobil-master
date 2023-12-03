<?php

require '../../koneksi/koneksi.php';
$title_web = 'Status';
include '../header.php';

?>

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Status</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= $url ?>admin/index.php">Home</a></li>
                <li class="breadcrumb-item active">Status</li>
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
                        <div class="table-responsive">

                            <table class="table table-bordered table-sm">

                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Pengguna</th>
                                        <th>Username</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php
                                    $no = 1;
                                    $sql = "SELECT * FROM login ORDER BY id_login DESC";
                                    $row = $koneksi->prepare($sql);
                                    $row->execute();
                                    $hasil = $row->fetchAll(PDO::FETCH_OBJ);
                                    ?>
                                    <?php foreach ($hasil as $r) : ?>
                                        <tr>
                                            <td><?= $no; ?></td>
                                            <td><?= $r->nama_pengguna; ?></td>
                                            <td><?= $r->username; ?></td>
                                            <td><?= $r->level == 'admin' ? 'admin' : 'pengguna' ?></td>
                                            <td><a href="edit-status.php?id=<?= $r->id_login ?>">Ubah Status</a></td>
                                        </tr>
                                        <?php $no++ ?>
                                    <?php endforeach; ?>
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