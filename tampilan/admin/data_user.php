<?php
$title = "Data User";
ob_start();
require_once __DIR__ . "/../../koneksi.php";
$koneksi = getKoneksi();
$sql = "SELECT users.*, konsumen.*
        FROM users
        INNER JOIN konsumen ON users.id = konsumen.user_id
        WHERE users.role = 'pencari'";
$statement = $koneksi->prepare($sql);
$statement->execute();
$results = $statement->fetchAll();
?>
    <div class="conatiner-fluid content-inner mt-n5 py-0">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">Data User</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="datatable" class="table table-striped" data-toggle="data-table">
                                <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Username</th>
                                    <th>Nama</th>
                                    <th>Alamat</th>
                                    <th>No HP</th>
                                    <th>Email</th>
                                    <th>Aksi</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $no=1 ?>
                                <?php foreach ($results as $result): ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= $result['username'] ?></td>
                                        <td><?= $result['nama'] ?></td>
                                        <td><?= $result['alamat'] ?></td>
                                        <td><?= $result['no_hp'] ?></td>
                                        <td><?= $result['email'] ?></td>
                                        <td>
                                            <a href="#" class="btn  btn-warning" data-bs-toggle="modal"
                                               data-bs-target="#editUserModal"
                                               data-id="<?= $result['user_id'] ?>"
                                               data-username="<?= $result['username'] ?>"
                                               data-nama="<?= $result['nama'] ?>"
                                               data-alamat="<?= $result['alamat'] ?>"
                                               data-no_hp="<?= $result['no_hp'] ?>"
                                               data-email="<?= $result['email'] ?>">Edit</a>
                                            <form method="POST" action="../../proses/hapus_user.php" style="display: inline-block">
                                                <input type="hidden" name="id" value="<?= $result['user_id'] ?>">
                                                <button class="btn btn-danger">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php include('edit_user.php')?>

<?php
$content = ob_get_clean();
include("template.php");
?>