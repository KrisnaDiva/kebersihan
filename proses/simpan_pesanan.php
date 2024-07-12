<?php
require_once __DIR__ . "/../koneksi.php";
session_start();
$koneksi = getKoneksi();
$id = $_GET['id'];
$sql = "INSERT INTO pemesanan (jasa_layanan_id, user_id, layanan, harga, tanggal_pesan, catatan) VALUES (?, ?, ?, ?, ?, ?)";
$statement = $koneksi->prepare($sql);
$tanggalSekarang = date("Y-m-d");
$statement->execute([$id, $_SESSION['id'], $_POST['pilihanLayanan'], $_POST['hargaLayanan'], $tanggalSekarang, $_POST['catatan']]);
if ($statement->rowCount() > 0) {
    echo "<script type='text/javascript'>
            alert('Pemesanan berhasil.');
            window.location.href = '../tampilan/user/info_pemesanan.php';
          </script>";
} else {
    echo "<script type='text/javascript'>
            alert('Pemesanan gagal.');
            window.location.href = '../tampilan/user/detail_layanan.php?id=$id';
          </script>";
}
