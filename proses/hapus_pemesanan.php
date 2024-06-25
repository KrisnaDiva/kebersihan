<?php
require_once __DIR__ . "/../koneksi.php";
$koneksi = getKoneksi();
$id = $_POST['id'];
$sql = "DELETE FROM pemesanan WHERE id = ?";
$statement = $koneksi->prepare($sql);
$statement->execute([$id]);
if ($statement->rowCount() > 0) {
    echo "<script type='text/javascript'>
            alert('Pemesanan berhasil dihapus.');
            window.location.href = '../tampilan/admin/data_pemesanan.php';
          </script>";
} else {
    echo "<script type='text/javascript'>
            alert('Pemesanan gagal dihapus.');
            window.location.href = '../tampilan/admin/data_pemesanan.php';
          </script>";
}