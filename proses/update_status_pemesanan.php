<?php
require_once __DIR__ . "/../koneksi.php";
$koneksi = getKoneksi();
$id = $_GET['id'];
$status = $_GET['status'];

if($status == 'diterima') {
    $sql = "UPDATE pemesanan SET status = 'diterima' WHERE id = ?";
    $statement = $koneksi->prepare($sql);
    $statement->execute([$id]);
}else if ($status == 'ditolak') {
    $sql = "UPDATE pemesanan SET status = 'ditolak' WHERE id = ?";
    $statement = $koneksi->prepare($sql);
    $statement->execute([$id]);
}
if ($statement->rowCount() > 0) {
    echo "<script type='text/javascript'>
            alert('Pesanan berhasil $status.');
            window.location.href = '../tampilan/user/info_pemesanan.php';
          </script>";
} else {
    echo "<script type='text/javascript'>
            alert('pesanan gagal $status.');
            window.location.href = '../tampilan/user/info_pemesanan.php';
          </script>";
}
