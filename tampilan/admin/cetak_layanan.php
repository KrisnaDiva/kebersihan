<?php
require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/../../koneksi.php';

$koneksi = getKoneksi();

$sql = "SELECT users.*, jasa_layanan.*
        FROM users
        INNER JOIN jasa_layanan ON users.id = jasa_layanan.user_id
        WHERE users.role = 'penyedia'";
$statement = $koneksi->prepare($sql);
$statement->execute();
$results = $statement->fetchAll();
$html = "
<style>
        img {
            width: 300px;
            height: 150px;
            object-fit: cover;
        }
    table {
        width: 100%;
        border-collapse: collapse;
    }
    td, th {
        font-size: 18px;
        text-align: center;
        padding: 8px;
    }

    .tanggal-pencetakan {
        position: absolute;
        top: 70px;
        right: 60px;
    }

</style>
<h1>Daftar Layanan</h1>
<div class='tanggal-pencetakan'>Tanggal Cetak: " . date("d-m-Y") . "</div>
";

$html .= "
<table border='1'>
    <tr>
        <th>No</th>
                                    <th>Username</th>
                                    <th>Nama Jasa</th>
                                    <th>Foto</th>
                                    <th>Harga</th>
                                    <th>No HP</th>
                                    <th>Email</th>
                                    <th>Facebook</th>
                                    <th>Instagram</th>
    </tr>";
$no = 1;
foreach ($results as $result) {
    $html .= "
    <tr>
    <td>" . $no++ . "</td>
        <td>" . $result['username'] . "</td>
        <td>" . $result['nama_jasa'] . "</td>
        <td>
            <img src='../../gambar/" . $result['foto'] . "'>
        </td>
        <td>" . $result['harga'] . "</td>
        <td>" . $result['no_hp'] . "</td>
        <td>" . $result['email'] . "</td>
        <td>" . $result['facebook'] . "</td>
        <td>" . $result['instagram'] . "</td>
    </tr>";
}

$html .= "</table>";

$mpdf = new \Mpdf\Mpdf();

$mpdf->WriteHTML($html);

$mpdf->Output('Laporan Pengeluaran.pdf', 'I');
?>
