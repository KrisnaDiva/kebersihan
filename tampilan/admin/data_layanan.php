<?php
$title = "Data User";
ob_start();
require_once __DIR__ . "/../../koneksi.php";
$koneksi = getKoneksi();
$sql = "SELECT users.*, jasa_layanan.*
        FROM users
        INNER JOIN jasa_layanan ON users.id = jasa_layanan.user_id
        WHERE users.role = 'penyedia'";
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
                            <h4 class="card-title">Data Layanan</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="datatable" class="table table-striped" data-toggle="data-table">
                                <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Username</th>
                                    <th>Nama Jasa</th>
                                    <th>Foto</th>
                                    <th>Harga</th>
                                    <th>Alamat</th>
                                    <th>Kelurahan</th>
                                    <th>Kecamatan</th>
                                    <th>No HP</th>
                                    <th>Email</th>
                                    <th>Facebook</th>
                                    <th>Instagram</th>
                                    <th>Aksi</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $no=1 ?>
                                <?php foreach ($results as $result): ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= $result['username'] ?></td>
                                        <td><?= $result['nama_jasa'] ?></td>
                                        <td>
                                            <img src="../../gambar/<?= $result['foto'] ?>">
                                        </td>
                                        <td><?= $result['harga'] ?></td>
                                        <td><?= $result['alamat'] ?></td>
                                        <td><?= $result['kelurahan'] ?></td>
                                        <td><?= $result['kecamatan'] ?></td>
                                        <td><?= $result['no_hp'] ?></td>
                                        <td><?= $result['email'] ?></td>
                                        <td><?= $result['facebook'] ?></td>
                                        <td><?= $result['instagram'] ?></td>
                                        <td>
                                            <a href="#" class="btn  btn-warning" data-bs-toggle="modal"
                                               data-bs-target="#editLayananModal"
                                               data-id="<?= $result['user_id'] ?>"
                                               data-username="<?= $result['username'] ?>"
                                               data-nama_jasa="<?= $result['nama_jasa'] ?>"
                                               data-foto="<?= $result['foto'] ?>"
                                               data-harga="<?= $result['harga'] ?>"
                                                  data-alamat="<?= $result['alamat'] ?>"
                                                  data-kelurahan="<?= $result['kelurahan'] ?>"
                                                    data-kecamatan="<?= $result['kecamatan'] ?>"
                                               data-no_hp="<?= $result['no_hp'] ?>"
                                               data-email="<?= $result['email'] ?>"
                                               data-facebook="<?= $result['facebook'] ?>"
                                               data-instagram="<?= $result['instagram'] ?>">Edit</a>
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

<?php include('edit_layanan.php')?>
    <style>
        img {
            width: 300px;
            height: 150px;
            object-fit: cover;
        }
    </style>
<?php
$content = ob_get_clean();
include("template.php");
?>