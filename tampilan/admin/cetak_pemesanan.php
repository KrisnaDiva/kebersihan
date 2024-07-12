<?php
require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/../../koneksi.php';

$koneksi = getKoneksi();

$sql = "SELECT * FROM pemesanan";
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
<h1>Daftar Pemesanan</h1>
<div class='tanggal-pencetakan'>Tanggal Cetak: " . date("d-m-Y") . "</div>
";

$html .= "
<table border='1'>
    <tr>
       <th>No</th>
       <th>Nama Jasa</th>
       <th>Pembeli</th>
       <th>Tanggal Pesan</th>
       <th>Catatan</th>
       <th>Status</th>
    </tr>";
$no = 1;
foreach ($results as $result) {
    $sql = "SELECT * FROM jasa_layanan WHERE id = ?";
    $statement = $koneksi->prepare($sql);
    $statement->execute([$result['jasa_layanan_id']]);
    $jasa = $statement->fetch();

    $sql = "SELECT * FROM konsumen WHERE user_id = ?";
    $statement = $koneksi->prepare($sql);
    $statement->execute([$result['user_id']]);
    $konsumen = $statement->fetch();
    $html .= "
    <tr>
    <td>" . $no++ . "</td>
        <td>" . $jasa['nama_jasa'] . "</td>
        <td>" . $konsumen['nama'] . "</td>
        <td>" . $result['tanggal_pesan'] . "</td>
        <td>" . $result['catatan'] . "</td>
        <td>" . $result['status'] . "</td>
    </tr>";
}

$html .= "</table>";

$mpdf = new \Mpdf\Mpdf();

$mpdf->WriteHTML($html);

$mpdf->Output('Laporan Pengeluaran.pdf', 'I');
?>
