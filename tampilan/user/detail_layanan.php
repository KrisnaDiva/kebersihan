<?php
$title = "Home";
ob_start();
session_start();
require_once __DIR__ . '/../../koneksi.php';
$koneksi = getKoneksi();

$sql = "SELECT * FROM jasa_layanan where id = ?";
$statement = $koneksi->prepare($sql);
$statement->execute([$_GET['id']]);
$jasa = $statement->fetch();
?>
    <section id="about" class="about section">

        <!-- Section Title -->
        <div class="container section-title aos-init aos-animate" data-aos="fade-up">
            <p><span>Detail</span> <span class="description-title">Layanan</span></p>
        </div><!-- End Section Title -->

        <div class="container">
            <div class="row gy-3">
                <div class="col-lg-6 aos-init aos-animate" data-aos="fade-up" data-aos-delay="100">
                    <img src="../../gambar/<?= $jasa['foto'] ?>" alt="" class="img-fluid">
                </div>

                <div class="col-lg-6 d-flex flex-column justify-content-center aos-init aos-animate" data-aos="fade-up"
                     data-aos-delay="200">
                    <div class="about-content ps-0 ps-lg-3">
                        <h2 style="font-weight: bold" class="mb-3"><?= $jasa['nama_jasa'] ?></h2>
                        <?php
                        $sql = "SELECT * FROM keterangan WHERE id = ?";
                        $statement = $koneksi->prepare($sql);
                        $statement->execute([$jasa['keterangan_id']]);
                        $keterangan = $statement->fetch();
                        ?>
                        <h4 style="text-transform: capitalize">layanan kami siap melayani anda dalam
                            <?= $keterangan['nama'] ?>
                        </h4>
                        <div class="mt-5 ">
                            <h5 class="mb-3">Alamat: <?= $jasa['alamat'] ?>, <?= $jasa['kelurahan'] ?>, <?= $jasa['kecamatan'] ?></h5>
                            <h5 class="mb-3">Harga: Rp <?= number_format($jasa['harga'], 2, ',', '.'); ?></h5>
                            <h5 class="mb-3">No HP: <?= $jasa['no_hp'] ?></h5>
                            <h5 class="mb-3">Email: <?= $jasa['email'] ?></h5>
                            <h5 class="mb-3">Facebook: <?= $jasa['facebook'] ?></h5>
                            <h5 class="mb-3">Instagram: <?= $jasa['instagram'] ?></h5>

                        </div>
                    </div>
                    <?php if($_SESSION['role'] == 'pencari') : ?>
                        <a href="#" class="btn btn-primary mt-5" data-bs-toggle="modal" data-bs-target="#pesanModal">Pesan</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>
    <!-- Modal -->
    <div class="modal fade" id="pesanModal" tabindex="-1" aria-labelledby="pesanModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="pesanModalLabel">Masukkan Catatan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="../../proses/simpan_pesanan.php?id=<?= $jasa['id'] ?>" method="post">
                        <div class="mb-3">
                            <label for="catatan" class="form-label">Catatan</label>
                            <textarea class="form-control" id="catatan" name="catatan" rows="3"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Konfirmasi Pesanan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <style>
        .about img {
            width: 100%;
            height: 500px;
            object-fit: cover;
        }
    </style>
<?php
$content = ob_get_clean();
include("template.php");
?>