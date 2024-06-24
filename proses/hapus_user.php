<?php

require_once __DIR__ . "/../koneksi.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];

    $koneksi = getKoneksi();

    $sql = "DELETE FROM users WHERE id = ?";
    $statement = $koneksi->prepare($sql);
    $statement->execute([$id]);

    if ($statement->rowCount() > 0) {
        echo "<script type='text/javascript'>
            alert('User berhasil dihapus.');
            window.location.href = '../tampilan/admin/data_user.php';
        </script>";
    } else {
        echo "<script type='text/javascript'>
            alert('User gagal dihapus');
            window.location.href = '../tampilan/admin/data_user.php';
        </script>";
    }
}
$koneksi = null;