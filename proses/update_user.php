<?php
require_once __DIR__ . "/../koneksi.php";

$koneksi = getKoneksi();
$id = $_POST['id'];

try {
    // Mulai transaksi
    $koneksi->beginTransaction();

    // Ambil username lama
    $stmt = $koneksi->prepare("SELECT username FROM users WHERE id = ?");
    $stmt->execute([$id]);
    $oldUsername = $stmt->fetchColumn();



    // Cek apakah username lama sama dengan baru
    if ($oldUsername != $_POST['username']) {

        // Update tabel users
        $sql = "UPDATE users SET username = ? WHERE id = ?";
        $stmt = $koneksi->prepare($sql);
        $stmt->execute([$_POST['username'], $id]);
    }

    // Cek apakah username baru sudah terdaftar

    // Update tabel konsumen
    $data = [
        'email' => $_POST['email'],
        'alamat' => $_POST['alamat'],
        'nama' => $_POST['nama'],
        'no_hp' => $_POST['no_hp'],
    ];
    $fields = implode('=?,', array_keys($data)) . '=?';
    $stmt = $koneksi->prepare("UPDATE konsumen SET $fields WHERE id = $id");
    $stmt->execute(array_values($data));

    // Jika semua query berhasil, commit transaksi
    $koneksi->commit();

    echo "<script type='text/javascript'>
            alert('Ubah data berhasil.');
            window.location.href = '../../view/anak.php';
          </script>";
} catch (Exception $e) {
    // Jika ada error, rollback transaksi
    $koneksi->rollBack();

    echo "<script type='text/javascript'>
            alert('Data gagal diubah: " . $e->getMessage() . "');
            window.location.href = '../../view/edit_anak.php?id=$id';
          </script>";
}

$koneksi = null;
?>