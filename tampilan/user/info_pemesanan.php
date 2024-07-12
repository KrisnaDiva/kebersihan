<?php
require_once __DIR__ . '/../../middleware.php';
$title = "Home";
ob_start();
session_start();

auth();
user();
require_once __DIR__ . '/../../koneksi.php';
$koneksi = getKoneksi();
if ($_SESSION['role'] == 'pencari') {
    $sql = "SELECT * FROM pemesanan WHERE user_id = ?";
    $statement = $koneksi->prepare($sql);
    $statement->execute([$_SESSION['id']]);
    $pemesanan = $statement->fetchAll();
} else if ($_SESSION['role'] == 'penyedia') {
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
        <h6>Jika pesanan mu sudah diterima silahkan hubungi peyedia layanan</h6>
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
                                <?php if ($_SESSION['role'] == 'penyedia') : ?>
                                    <th scope="col">Nama Pemesan</th>
                                <?php else:; ?>
                                    <th scope="col">Nama Jasa</th>
                                    <th scope="col">Instagram</th>
                                    <th scope="col">Facebook</th>
                                <?php endif; ?>
                                <th scope="col">No HP</th>
                                <th scope="col">Harga</th>
                                <th scope="col">Tanggal Pemesanan</th>
                                <th scope="col">Catatan</th>
                                <th scope="col">Status</th>
                                <?php if ($_SESSION['role'] == 'penyedia') : ?>
                                    <th scope="col">Aksi</th>
                                <?php endif; ?>
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

                                if ($_SESSION['role'] == 'penyedia') {
                                    $sql = "SELECT * FROM users WHERE id = ?";
                                    $statement = $koneksi->prepare($sql);
                                    $statement->execute([$pemesan['user_id']]);
                                    $user = $statement->fetch();

                                    $sql = "SELECT * FROM konsumen WHERE user_id = ?";
                                    $statement = $koneksi->prepare($sql);
                                    $statement->execute([$pemesan['user_id']]);
                                    $konsumen = $statement->fetch();
                                }
                                ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <?php if ($_SESSION['role'] == 'penyedia') : ?>
                                        <td><?= $user['username'] ?></td>
                                        <td><?= $konsumen['no_hp'] ?></td>
                                    <?php else:; ?>
                                        <td><?= $jasa['nama_jasa'] ?></td>
                                        <td><?= $jasa['instagram'] ?></td>
                                        <td><?= $jasa['facebook'] ?></td>
                                        <td><?= $jasa['no_hp'] ?></td>
                                    <?php endif; ?>
                                    <td><?= $jasa['harga'] ?></td>
                                    <td><?= $pemesan['tanggal_pesan'] ?></td>
                                    <td><?= $pemesan['catatan'] ?></td>
                                    <td><?= $pemesan['status'] ?></td>
                                    <?php if ($_SESSION['role'] == 'penyedia' && $pemesan['status'] == 'pending') : ?>
                                        <td>
                                            <a href="../../proses/update_status_pemesanan.php?id=<?= $pemesan['id'] ?>&status=diterima"
                                               class="badge bg-success"><i class="fas fa-check"></i></a>
                                            <a href="../../proses/update_status_pemesanan.php?id=<?= $pemesan['id'] ?>&status=ditolak"
                                               class="badge bg-danger"><i class="fas fa-times"></i></a>
                                        </td>
                                    <?php endif; ?>
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
    $(document).ready(function () {
        $('#pemesananTable').DataTable();
    });
</script>

<?php
$content = ob_get_clean();
include("template.php");
?>
