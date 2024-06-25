<?php
require_once __DIR__ . "/../koneksi.php";
$koneksi = getKoneksi();
$id = $_POST['id'];
$catatan = $_POST['catatan'];
$status = $_POST['status'];

$sql = "UPDATE pemesanan SET catatan = ?, status = ? WHERE id = ?";
$statement = $koneksi->prepare($sql);
$statement->execute([$catatan, $status, $id]);
if ($statement->rowCount() > 0) {
    echo "<script type='text/javascript'>
            alert('Pesanan berhasil diupdate.');
            window.location.href = '../tampilan/admin/data_pemesanan.php';
          </script>";
} else {
    echo "<script type='text/javascript'>
            alert('pesanan gagal diupdate.');
            window.location.href = '../tampilan/admin/data_pemesanan.php';
          </script>";
}