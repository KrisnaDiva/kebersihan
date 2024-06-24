<?php
require_once __DIR__ . "/../koneksi.php";
$koneksi = getKoneksi();
$role = $_POST['role'];

$username = $_POST['username'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

try {
    $koneksi->beginTransaction();

    $stmt = $koneksi->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    if ($stmt->fetch()) {
        throw new Exception('Username sudah terdaftar.');
    }

    $stmt = $koneksi->prepare("INSERT INTO users (username, password, role) VALUES (?, ?, ?)");
    $stmt->execute([$username, $password, $role]);

    if ($role == 'penyedia') {
        $data = [
            'nama_jasa' => $_POST['nama_jasa'],
            'keterangan_id' => $_POST['keterangan_id'],
            'harga' => $_POST['harga'],
            'alamat' => $_POST['alamat'],
            'kelurahan' => $_POST['kelurahan'],
            'kecamatan' => $_POST['kecamatan'],
            'no_hp' => $_POST['no_hp'],
            'email' => $_POST['email'],
            'facebook' => $_POST['facebook'],
            'instagram' => $_POST['instagram'],
            'user_id' => $koneksi->lastInsertId(),
        ];

        $target_dir = '../gambar/';
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true);
        }

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
                $new_filename = uniqid('jasa_layanan', true) . ".$ext";
                move_uploaded_file($_FILES['foto']['tmp_name'], $target_dir . $new_filename);
                $data['foto'] = $new_filename;
            }
        }

        $fields = implode(',', array_keys($data));
        $placeholders = str_repeat('?,', count($data) - 1) . '?';
        $stmt = $koneksi->prepare("INSERT INTO jasa_layanan ($fields) VALUES ($placeholders)");
    } else if ($role == 'pencari') {
        $data = [
            'nama' => $_POST['nama'],
            'no_hp' => $_POST['no_hp_pencari'],
            'email' => $_POST['email_pencari'],
            'alamat' => $_POST['alamat_pencari'],
            'user_id' => $koneksi->lastInsertId(),
        ];
        $fields = implode(',', array_keys($data));
        $placeholders = str_repeat('?,', count($data) - 1) . '?';
        $stmt = $koneksi->prepare("INSERT INTO konsumen ($fields) VALUES ($placeholders)");
    }
    if ($stmt->execute(array_values($data))) {
        $koneksi->commit();
        echo "<script type='text/javascript'>
            alert('Registrasi Berhasil.');
            window.location.href = '../tampilan/login.php';
          </script>";
    }
} catch (Exception $e) {
    $koneksi->rollBack();

    $errorMessage = $e->getMessage();
    echo "<script type='text/javascript'>
        alert('Registrasi gagal $errorMessage');
            window.location.href = '../tampilan/register.php';
          </script>";
}