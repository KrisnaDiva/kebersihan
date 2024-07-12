<?php
$title = "Home";
ob_start();
require_once __DIR__ . '/../../koneksi.php';
$koneksi = getKoneksi();

$sql = "SELECT * FROM jasa_layanan";
$conditions = [];
if (isset($_GET['kelurahan']) && $_GET['kelurahan'] != '') {
    $conditions[] = "kelurahan = :kelurahan";
}
if (isset($_GET['keterangan']) && $_GET['keterangan'] != '') {
    $conditions[] = "JSON_CONTAINS(keterangan, :keterangan)";
}
if (!empty($conditions)) {
    $sql .= " WHERE " . implode(' AND ', $conditions);
}
$statement = $koneksi->prepare($sql);
if (isset($_GET['kelurahan']) && $_GET['kelurahan'] != '') {
    $statement->bindParam(':kelurahan', $_GET['kelurahan']);
}
if (isset($_GET['keterangan']) && $_GET['keterangan'] != '') {
    $keteranganFilter = json_encode($_GET['keterangan']);
    $statement->bindParam(':keterangan', $keteranganFilter);
}
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
    <form method="GET" action="" class="row justify-content-center mb-5">
        <div class="col-md-3">
            <label for="kelurahan">Kelurahan</label>
            <select name="kelurahan" id="kelurahan" class="form-control" onchange="this.form.submit()">
                <option value="">Pilih Kelurahan</option>
                <?php
                $kelurahan = [
                    'Anggrung',
                    'Madras Hulu',
                    'Polonia',
                    'Sari Rejo',
                    'Suka Damai'
                ];

                foreach ($kelurahan as $row) {
                    echo "<option value=\"{$row}\" " . ($_GET['kelurahan'] == $row ? 'selected' : '') . ">{$row}</option>";
                }
                ?>
            </select>
        </div>

        <div class="col-md-3">
            <label for="keterangan">Jenis</label>
            <select name="keterangan" id="keterangan" class="form-control" onchange="this.form.submit()">
                <option value="">Pilih Jenis</option>
                <?php
                $sql = "SELECT DISTINCT nama FROM keterangan ORDER BY nama";
                $statement = $koneksi->prepare($sql);
                $statement->execute();
                $keterangan = $statement->fetchAll();
                foreach ($keterangan as $row) {
                    echo "<option value=\"{$row['nama']}\" " . ($_GET['keterangan'] == $row['nama'] ? 'selected' : '') . ">{$row['nama']}</option>";
                }
                ?>
            </select>
        </div>
    </form>
    <div class="container section-title" data-aos="fade-up">
        <p><span>Penyedia Jasa</span> <span class="description-title">Layanan</span></p>
    </div>
    <div class="container">
        <div class="row gy-4">
            <?php foreach ($jasa_layanan as $jasa): ?>
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="service-item position-relative">
                        <div class="member-img">
                            <img src="../../gambar/<?= $jasa['foto'] ?>" alt="" class="img-fluid">
                        </div>
                        <h3><?= htmlspecialchars($jasa['nama_jasa']) ?></h3>
                        <p style="text-transform: capitalize">layanan kami siap melayani anda dalam
                            <?php
                            $keteranganArray = json_decode($jasa['keterangan'], true);

                            if (is_array($keteranganArray)) {
                                $keterangan = implode(", ", $keteranganArray);
                            } else {
                                $keterangan = $jasa['keterangan'];
                            }
                            ?>
                            <?= htmlspecialchars($keterangan) ?>
                        </p>
                        <a class="btn btn-primary w-100 mt-4" href="detail_layanan.php?id=<?= $jasa['id'] ?>">Detail</a>
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
