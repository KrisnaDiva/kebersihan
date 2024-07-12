<?php
require_once __DIR__ . "/../koneksi.php";
require_once __DIR__ . '/../middleware.php';
guest();

$koneksi = getKoneksi();

$sql = "SELECT * FROM keterangan";
$statement = $koneksi->prepare($sql);
$statement->execute();
$keterangan = $statement->fetchAll();

?>
<!doctype html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Register</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="../admin/assets/images/favicon.ico"/>

    <!-- Library / Plugin Css Build -->
    <link rel="stylesheet" href="../admin/assets/css/core/libs.min.css"/>


    <!-- Hope Ui Design System Css -->
    <link rel="stylesheet" href="../admin/assets/css/hope-ui.min.css?v=2.0.0"/>

    <!-- Custom Css -->
    <link rel="stylesheet" href="../admin/assets/css/custom.min.css?v=2.0.0"/>

    <!-- Dark Css -->
    <link rel="stylesheet" href="../admin/assets/css/dark.min.css"/>

    <!-- Customizer Css -->
    <link rel="stylesheet" href="../admin/assets/css/customizer.min.css"/>

    <!-- RTL Css -->
    <link rel="stylesheet" href="../admin/assets/css/rtl.min.css"/>

</head>
<body class=" " data-bs-spy="scroll" data-bs-target="#elements-section" data-bs-offset="0" tabindex="0">
<!-- loader Start -->
<div id="loading">
    <div class="loader simple-loader">
        <div class="loader-body"></div>
    </div>
</div>
<!-- loader END -->

<div class="wrapper">
    <section class="login-content">
        <div class="row m-0 align-items-center bg-white">
            <div class="col-md-5 d-md-block d-none bg-primary p-0 mt-n1 ">
                <img src="../admin/assets/images/auth/05.png" class="img-fluid gradient-main animated-scaleX"
                     alt="images">
            </div>
            <div class="col-md-7">
                <div class="row justify-content-center">
                    <div class="col-md-10">
                        <div class="card card-transparent  shadow-none d-flex justify-content-center mb-0">
                            <div class="card-body">
                                <h2 class="mb-2 text-center">Register</h2>
                                <p class="text-center">Buat akunmu untuk bergabung bersama kami.</p>
                                <form action="../proses/register.php" enctype="multipart/form-data" method="post">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="username" class="form-label">Username</label>
                                                <input required type="text" name="username" class="form-control"
                                                       id="username">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="password" class="form-label">Password</label>
                                                <input required type="password" name="password" class="form-control"
                                                       id="password"
                                                       placeholder=" ">
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for="role" class="form-label">Mendaftar sebagai</label>
                                                <select class="form-select" id="role" name="role" required>
                                                    <option value="">Pilih</option>
                                                    <option value="pencari">Pencari Jasa Layanan</option>
                                                    <option value="penyedia">Penyedia Jasa Layanan</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div id="penyediaFields" class="row justify-content-center"
                                             style="display: none;">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="nama_jasa" class="form-label">Nama Jasa</label>
                                                    <input type="text" class="form-control" name="nama_jasa"
                                                           id="nama_jasa">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="keterangan_id" class="form-label">Keterangan</label>
                                                    <select class="form-control" name="keterangan_id"
                                                            id="keterangan_id">
                                                        <option value="">Pilih Keterangan</option>
                                                        <?php foreach ($keterangan as $item): ?>
                                                            <option value="<?= $item['id'] ?>"><?= $item['nama'] ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="harga" class="form-label">Harga</label>
                                                    <input type="number" class="form-control" name="harga" id="harga">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="foto" class="form-label">Foto</label>
                                                    <input type="file" class="form-control" name="foto" id="foto"
                                                           accept="image/*">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="kecamatan" class="form-label">Kecamatan</label>
                                                    <input type="text" class="form-control" name="kecamatan" id="kecamatan" value="Medan Polonia" readonly>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="kelurahan" class="form-label">Kelurahan</label>
                                                    <select class="form-control" name="kelurahan" id="kelurahan">
                                                        <option value="">Pilih Kelurahan</option>
                                                        <option value="Anggrung">Anggrung</option>
                                                        <option value="Madras Hulu">Madras Hulu</option>
                                                        <option value="Polonia">Polonia</option>
                                                        <option value="Sari Rejo">Sari Rejo</option>
                                                        <option value="Suka Damai">Suka Damai</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label for="alamat" class="form-label">Alamat</label>
                                                    <input type="text" class="form-control" name="alamat" id="alamat">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="no_hp" class="form-label">No HP</label>
                                                    <input type="number" class="form-control" name="no_hp" id="no_hp">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="email" class="form-label">Email</label>
                                                    <input type="email" class="form-control" name="email" id="email">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="facebook" class="form-label">Facebook</label>
                                                    <input type="text" class="form-control" name="facebook"
                                                           id="facebook">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="instagram" class="form-label">Instagram</label>
                                                    <input type="text" class="form-control" name="instagram"
                                                           id="instagram">
                                                </div>
                                            </div>
                                        </div>

                                        <div id="pencariFields" class="row justify-content-center"
                                             style="display: none;">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="nama" class="form-label">Nama</label>
                                                    <input type="text" class="form-control" name="nama" id="nama">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="no_hp_pencari" class="form-label">No HP</label>
                                                    <input type="number" class="form-control" name="no_hp_pencari"
                                                           id="no_hp_pencari">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="alamat_pencari" class="form-label">Alamat</label>
                                                    <input type="text" class="form-control" name="alamat_pencari" id="alamat_pencari">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="email_pencari" class="form-label">Email</label>
                                                    <input type="email" class="form-control" name="email_pencari"
                                                           id="email_pencari">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-center">
                                        <button type="submit" class="btn btn-primary">Register</button>
                                    </div>
                                    <p class="mt-3 text-center">
                                        Sudah punya akun? <a href="login.php" class="text-underline">Login</a>
                                    </p>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<script>
    document.getElementById('role').addEventListener('change', function () {
        var role = this.value;
        var penyediaFields = document.getElementById('penyediaFields');
        var pencariFields = document.getElementById('pencariFields');

        var penyediaInputs = penyediaFields.querySelectorAll('input, select');
        var pencariInputs = pencariFields.querySelectorAll('input, select');

        if (role === 'penyedia') {
            penyediaFields.style.display = 'flex';
            pencariFields.style.display = 'none';

            penyediaInputs.forEach(input => input.required = true);
            pencariInputs.forEach(input => input.required = false);
        } else if (role === 'pencari') {
            penyediaFields.style.display = 'none';
            pencariFields.style.display = 'flex';

            penyediaInputs.forEach(input => input.required = false);
            pencariInputs.forEach(input => input.required = true);
        } else {
            penyediaFields.style.display = 'none';
            pencariFields.style.display = 'none';

            penyediaInputs.forEach(input => input.required = false);
            pencariInputs.forEach(input => input.required = false);
        }
    });
</script>
<!-- Library Bundle Script -->
<script src="../admin/assets/js/core/libs.min.js"></script>

<!-- External Library Bundle Script -->
<script src="../admin/assets/js/core/external.min.js"></script>

<!-- Widgetchart Script -->
<script src="../admin/assets/js/charts/widgetcharts.js"></script>

<!-- mapchart Script -->
<script src="../admin/assets/js/charts/vectore-chart.js"></script>
<script src="../admin/assets/js/charts/dashboard.js"></script>

<!-- fslightbox Script -->
<script src="../admin/assets/js/plugins/fslightbox.js"></script>

<!-- Settings Script -->
<script src="../admin/assets/js/plugins/setting.js"></script>

<!-- Slider-tab Script -->
<script src="../admin/assets/js/plugins/slider-tabs.js"></script>

<!-- Form Wizard Script -->
<script src="../admin/assets/js/plugins/form-wizard.js"></script>

<!-- AOS Animation Plugin-->

<!-- App Script -->
<script src="../admin/assets/js/hope-ui.js" defer></script>

</body>
</html>