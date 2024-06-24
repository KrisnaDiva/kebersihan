<?php
require_once __DIR__ . "/../koneksi.php";

$koneksi = getKoneksi();
$id = $_POST['id'];
$username_baru = $_POST['username'];
try {
    $koneksi->beginTransaction();

    $sql = "SELECT username FROM users WHERE id = ?";
    $statement = $koneksi->prepare($sql);
    $statement->execute([$id]);
    $user = $statement->fetch();
    $username_lama = $user['username'];

    if ($username_baru !== $username_lama) {
        $sql = "SELECT COUNT(*) FROM users WHERE username = ?";
        $statement = $koneksi->prepare($sql);
        $statement->execute([$username_baru]);
        $count = $statement->fetchColumn();

        if ($count > 0) {
            throw new Exception("Username sudah digunakan");
        }

        $sql = "UPDATE users SET  username = ? WHERE id = ?";
        $statement = $koneksi->prepare($sql);
        $statement->execute([$username_baru, $id]);
    }
    $data = [
        'email' => $_POST['email'],
        'alamat' => $_POST['alamat'],
        'nama' => $_POST['nama'],
        'no_hp' => $_POST['no_hp'],
    ];
    $fields = implode('=?,', array_keys($data)) . '=?';
    $stmt = $koneksi->prepare("UPDATE konsumen SET $fields WHERE user_id = $id");
    $stmt->execute(array_values($data));

    $koneksi->commit();

    echo "<script type='text/javascript'>
            alert('Ubah data berhasil.');
            window.location.href = '../tampilan/admin/data_user.php';
          </script>";
} catch (Exception $e) {
    $koneksi->rollBack();

    echo "<script type='text/javascript'>
            alert('Data gagal diubah: " . $e->getMessage() . "');
            window.location.href = '../tampilan/admin/data_user.php';
          </script>";
}

$koneksi = null;
