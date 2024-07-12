<?php
$title = "Home";
ob_start();
session_start();
require_once __DIR__ . '/../../koneksi.php';
$koneksi = getKoneksi();

$sql = "SELECT * FROM jasa_layanan WHERE id = ?";
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
                <img src="../../gambar/<?= htmlspecialchars($jasa['foto']) ?>" alt="" class="img-fluid">
            </div>

            <div class="col-lg-6 d-flex flex-column justify-content-center aos-init aos-animate" data-aos="fade-up"
                 data-aos-delay="200">
                <div class="about-content ps-0 ps-lg-3">
                    <h2 style="font-weight: bold" class="mb-3"><?= htmlspecialchars($jasa['nama_jasa']) ?></h2>
                    <h4 style="text-transform: capitalize">layanan kami siap melayani anda dalam
                        <?php
                        $keteranganArray = json_decode($jasa['keterangan'], true);

                        if (is_array($keteranganArray)) {
                            $keterangan = implode(", ", $keteranganArray);
                        } else {
                            $keterangan = htmlspecialchars($jasa['keterangan']);
                        }
                        ?>
                        <?= htmlspecialchars($keterangan) ?>
                    </h4>
                    <div class="mt-5">
                        <h5 class="mb-3">Alamat: <?= htmlspecialchars($jasa['alamat']) ?>
                            , <?= htmlspecialchars($jasa['kelurahan']) ?>
                            , <?= htmlspecialchars($jasa['kecamatan']) ?></h5>
                        <?php
                        $hargaArray = json_decode($jasa['harga'], true);

                        if (is_array($hargaArray)) {
                            $hargaArray = array_map('floatval', $hargaArray);
                            $hargaTerendah = min($hargaArray);
                            $hargaTertinggi = max($hargaArray);
                            $hargaFormatted = 'Rp ' . number_format($hargaTerendah, 2, ',', '.') . ' - Rp ' . number_format($hargaTertinggi, 2, ',', '.');
                        } else {
                            $hargaFormatted = 'Rp ' . number_format(floatval($jasa['harga']), 2, ',', '.');
                        }
                        ?>
                        <h5 class="mb-3">Harga: <?= htmlspecialchars($hargaFormatted) ?></h5>
                        <h5 class="mb-3">No HP: <?= htmlspecialchars($jasa['no_hp']) ?></h5>
                        <h5 class="mb-3">Email: <?= htmlspecialchars($jasa['email']) ?></h5>
                        <h5 class="mb-3">Facebook: <?= htmlspecialchars($jasa['facebook']) ?></h5>
                        <h5 class="mb-3">Instagram: <?= htmlspecialchars($jasa['instagram']) ?></h5>
                    </div>
                </div>
                <?php if (!isset($_SESSION['role'])) : ?>
                    <a href="../login.php" class="btn btn-primary mt-5">Login untuk memesan</a>
                <?php else: ?>
                    <?php if ($_SESSION['role'] == 'pencari') : ?>
                        <a href="#" class="btn btn-primary mt-5" data-bs-toggle="modal" data-bs-target="#pesanModal">Pesan</a>
                    <?php endif; ?>
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
                <form action="../../proses/simpan_pesanan.php?id=<?= htmlspecialchars($jasa['id']) ?>" method="post">
                    <div class="mb-3">
                        <label for="pilihanLayanan" class="form-label">Pilih Layanan</label>
                        <select class="form-select" id="pilihanLayanan" name="pilihanLayanan" onchange="updateHarga()">
                            <option value="">Pilih Layanan</option>
                            <?php
                            if (is_array($keteranganArray) && is_array($hargaArray) && count($keteranganArray) == count($hargaArray)) {
                                foreach ($keteranganArray as $index => $layanan) {
                                    echo "<option value='" . htmlspecialchars($layanan) . "' data-harga='" . floatval($hargaArray[$index]) . "'>" . htmlspecialchars($layanan) . "</option>";
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="hargaLayanan" class="form-label">Harga</label>
                        <input type="text" class="form-control" id="hargaLayananDisplay" readonly>
                        <input type="hidden" id="hargaLayanan" name="hargaLayanan">
                    </div>
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
<script>
    function updateHarga() {
        const select = document.getElementById('pilihanLayanan');
        const hargaInput = document.getElementById('hargaLayanan');
        const hargaDisplay = document.getElementById('hargaLayananDisplay');
        const selectedOption = select.options[select.selectedIndex];
        const hargaValue = selectedOption.getAttribute('data-harga');
        const layananText = selectedOption.text.toLowerCase();

        if (hargaValue) {
            let satuan = '';
            if (layananText.startsWith('kebersihan')) {
                satuan = '/meter persegi';
            } else if (layananText.startsWith('cuci')) {
                satuan = '/kilogram';
            }
            const hargaFormatted = new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(parseFloat(hargaValue));
            hargaDisplay.value = hargaFormatted + satuan;
            hargaInput.value = hargaValue;
        } else {
            hargaDisplay.value = '';
            hargaInput.value = '';
        }
    }
</script>
<?php
$content = ob_get_clean();
include("template.php");
?>
