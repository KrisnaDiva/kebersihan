<?php
$title = "Home";
ob_start();
require_once __DIR__.'/../../koneksi.php';
$koneksi = getKoneksi();

$sql = "SELECT * FROM jasa_layanan";
$statement = $koneksi->prepare($sql);
$statement->execute();
$jasa_layanan = $statement->fetchAll();

?>
<section id="hero" class="hero section">
    <div class="container">
        <div class="row gy-4">
            <div class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center" data-aos="zoom-out">
                <h1>Pencari Jasa Layanan Kebersihan Rumah</h1>
                <p>Kecamatan Medan Polonia</p>
                <div class="d-flex">
                    <a href="#services" class="btn-get-started">Cari Layanan</a>
                </div>
            </div>
        </div>
    </div>
</section>
<section id="services" class="services section">
    <div class="container section-title" data-aos="fade-up">
        <p><span>Penyedia Jasa</span> <span class="description-title">Layanan</span></p>
    </div>
    <div class="container">
        <div class="row gy-4">
            <?php foreach ($jasa_layanan as $jasa): ?>
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="service-item position-relative">
                        <div class="member-img"  >
                            <img src="../../gambar/<?= $jasa['foto'] ?>" alt="" class="img-fluid">
                        </div>
                            <h3><?= $jasa['nama_jasa'] ?></h3>
                        <?php
                        $sql = "SELECT * FROM keterangan WHERE id = ?";
                        $statement = $koneksi->prepare($sql);
                        $statement->execute([$jasa['keterangan_id']]);
                        $keterangan = $statement->fetch();
                        ?>
                        <p style="text-transform: capitalize">layanan kami siap melayani anda dalam
                            <?= $keterangan['nama'] ?>
                        </p>
                        <a class="btn btn-primary w-100 mt-4">Detail</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<style>
    .service-item img {
        width: 100%;
        height: 200px;
        object-fit: cover;
    }
</style>
<?php
$content = ob_get_clean();
include("template.php");
?>

