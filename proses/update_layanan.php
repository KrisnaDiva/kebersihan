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
    $target_dir = '../gambar/';
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0777, true);
    }
    $data = [
        'nama_jasa' => $_POST['nama_jasa'],
        'harga' => $_POST['harga'],
        'alamat' => $_POST['alamat'],
        'kelurahan' => $_POST['kelurahan'],
        'kecamatan' => $_POST['kecamatan'],
        'no_hp' => $_POST['no_hp'],
        'email' => $_POST['email'],
        'facebook' => $_POST['facebook'],
        'instagram' => $_POST['instagram'],
    ];
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
        $ekstensi = array('png', 'jpg', 'jpeg', 'gif');
        $filename = $_FILES['foto']['name'];
        $ukuran = $_FILES['foto']['size'];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);

        if (!in_array($ext, $ekstensi)) {
            throw new Exception("Ekstensi gambar tidak diperbolehkan");
        } else if ($ukuran > 1044070) {
            throw new Exception("Ukuran gambar terlalu besar");
        } else {
            $sql = "SELECT foto FROM jasa_layanan WHERE user_id = ?";
            $statement = $koneksi->prepare($sql);
            $statement->execute([$id]);
            $result = $statement->fetch();
            $old_filename = $result['foto'];

            if ($old_filename && file_exists($target_dir . $old_filename)) {
                unlink($target_dir . $old_filename);
            }

            $new_filename = uniqid('jasa_layanan', true) . ".$ext";
            move_uploaded_file($_FILES['foto']['tmp_name'], $target_dir . $new_filename);
            $data['foto'] = $new_filename;
        }
    }

    $fields = implode('=?,', array_keys($data)) . '=?';
    $stmt = $koneksi->prepare("UPDATE jasa_layanan SET $fields WHERE user_id = $id");
    $stmt->execute(array_values($data));

    $koneksi->commit();

    echo "<script type='text/javascript'>
            alert('Ubah data berhasil.');
            window.location.href = '../tampilan/admin/data_layanan.php';
          </script>";
} catch (Exception $e) {
    $koneksi->rollBack();

    echo "<script type='text/javascript'>
            alert('Data gagal diubah: " . $e->getMessage() . "');
            window.location.href = '../tampilan/admin/data_layanan.php';
          </script>";
}

$koneksi = null;
