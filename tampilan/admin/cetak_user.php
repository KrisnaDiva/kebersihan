<?php
require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/../../koneksi.php';

$koneksi = getKoneksi();

$sql = "SELECT users.*, konsumen.*
        FROM users
        INNER JOIN konsumen ON users.id = konsumen.user_id
        WHERE users.role = 'pencari'";
$statement = $koneksi->prepare($sql);
$statement->execute();
$results = $statement->fetchAll();
$html = "
<style>
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
<h1>Daftar User</h1>
<div class='tanggal-pencetakan'>Tanggal Cetak: " . date("d-m-Y") . "</div>
";

$html .= "
<table border='1'>
    <tr>
        <th>No</th>
         <th>Username</th>
         <th>Nama</th>
         <th>Alamat</th>
         <th>No HP</th>
         <th>Email</th>
    </tr>";
$no = 1;
foreach ($results as $result) {
    $html .= "
    <tr>
    <td>" . $no++ . "</td>
        <td>" . $result['username'] . "</td>
        <td>" . $result['nama'] . "</td>
        <td>" . $result['alamat'] . "</td>
        <td>" . $result['no_hp'] . "</td>
        <td>" . $result['email'] . "</td>
    </tr>";
}

$html .= "</table>";

$mpdf = new \Mpdf\Mpdf();

$mpdf->WriteHTML($html);

$mpdf->Output('Laporan Pengeluaran.pdf', 'I');
?>
