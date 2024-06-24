<?php
$title = "Home";
ob_start();
session_start();
require_once __DIR__ . '/../../koneksi.php';
$koneksi = getKoneksi();
if($_SESSION['role'] == 'pencari') {
    $sql = "SELECT * FROM pemesanan WHERE user_id = ?";
    $statement = $koneksi->prepare($sql);
    $statement->execute([$_SESSION['id']]);
    $pemesanan = $statement->fetchAll();
}else if ($_SESSION['role'] == 'penyedia'){
    $sql = "SELECT * FROM jasa_layanan WHERE user_id = ?";
    $statement = $koneksi->prepare($sql);
    $statement->execute([$_SESSION['id']]);
    $jasa = $statement->fetch();
    $sql = "SELECT * FROM pemesanan WHERE jasa_layanan_id = ?";
    $statement = $koneksi->prepare($sql);
    $statement->execute([$jasa['id']]);
    $pemesanan = $statement->fetchAll();
}

?>

<section id="team" class="team section">

    <!-- Section Title -->
    <div class="container section-title aos-init aos-animate" data-aos="fade-up">
        <p><span>Riwayat</span> <span class="description-title">Pemesanan</span></p>
    </div><!-- End Section Title -->

    <div class="container">
        <div class="row gy-4">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <table id="pemesananTable" class="table table-bordered">
                            <thead>
                            <tr>
                                <th scope="col">No</th>
                                <?php if($_SESSION['role'] == 'penyedia') : ?>
                                <th scope="col">Nama Pemesan</th>
                                <?php else:; ?>
                                <th scope="col">Nama Jasa</th>
                                <?php endif; ?>
                                <th scope="col">Harga</th>
                                <th scope="col">Tanggal Pemesanan</th>
                                <th scope="col">Catatan</th>
                                <th scope="col">Status</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $no = 1; ?>
                            <?php foreach ($pemesanan as $pemesan): ?>
                            <?php
                            $sql = "SELECT * FROM jasa_layanan WHERE id = ?";
                            $statement = $koneksi->prepare($sql);
                            $statement->execute([$pemesan['jasa_layanan_id']]);
                            $jasa = $statement->fetch();

                            $sql = "SELECT * FROM users WHERE id = ?";
                            $statement = $koneksi->prepare($sql);
                            $statement->execute([$pemesan['user_id']]);
                            $user = $statement->fetch();
                            ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <?php if($_SESSION['role'] == 'penyedia') : ?>
                                    <td><?= $user['username'] ?></td>
                                    <?php else:; ?>
                                    <td><?= $jasa['nama_jasa'] ?></td>
                                    <?php endif; ?>
                                    <td><?= $jasa['harga'] ?></td>
                                    <td><?= $pemesan['tanggal_pesan'] ?></td>
                                    <td><?= $pemesan['catatan'] ?></td>
                                    <td><?= $pemesan['status'] ?></td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>

<script>
    $(document).ready(function() {
        $('#pemesananTable').DataTable();
    });
</script>

<?php
$content = ob_get_clean();
include("template.php");
?>
