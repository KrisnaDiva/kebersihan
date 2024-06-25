<?php
$title = "Data User";
ob_start();
require_once __DIR__ . "/../../koneksi.php";
$koneksi = getKoneksi();
$sql = "SELECT * FROM pemesanan";
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
                            <h4 class="card-title">Data Pemesanan</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="datatable" class="table table-striped" data-toggle="data-table">
                                <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Jasa</th>
                                    <th>Pembeli</th>
                                    <th>Tanggal Pesan</th>
                                    <th>Catatan</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $no = 1 ?>
                                <?php foreach ($results as $result): ?>
                                <?php
                                $sql = "SELECT * FROM jasa_layanan WHERE id = ?";
                                $statement = $koneksi->prepare($sql);
                                $statement->execute([$result['jasa_layanan_id']]);
                                $jasa = $statement->fetch();

                                $sql = "SELECT * FROM konsumen WHERE user_id = ?";
                                $statement = $koneksi->prepare($sql);
                                $statement->execute([$result['user_id']]);
                                $konsumen = $statement->fetch();

                                ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= $jasa['nama_jasa'] ?></td>
                                        <td><?= $konsumen['nama'] ?></td>
                                        <td><?= $result['tanggal_pesan'] ?></td>
                                        <td><?= $result['catatan'] ?></td>
                                        <td><?= $result['status'] ?></td>
                                        <td>

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
<?php
$content = ob_get_clean();
include("template.php");
?>