<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil data dari form
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    // Validasi data
    if (empty($username) || empty($password)) {
        $_SESSION['error'] = 'Username dan password wajib diisi';
        header('Location: ../register.php');
        exit();
    }
    // Cek apakah username sudah ada
    $checkUser = $koneksi->prepare("SELECT * FROM tbl_user WHERE username = ?");
    $checkUser->bind_param('s', $username);
    $checkUser->execute();
    $result = $checkUser->get_result();

    if ($result->num_rows > 0) {
        // Username sudah terdaftar
        $_SESSION['error'] = 'Username sudah digunakan';
        header('Location: ../index.php');
        exit();
    } else {
        // Hash password
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        // Insert data ke tbl_user
        $insertUser = $koneksi->prepare("INSERT INTO tbl_user (username, password) VALUES (?, ?)");
        $insertUser->bind_param('ss', $username, $hashedPassword);

        if ($insertUser->execute()) {
            $_SESSION['success'] = 'Registrasi berhasil';
            header('Location: ../index.php');
            exit();
        } else {
            $_SESSION['error'] = 'Gagal mendaftarkan user';
            header('Location: ../index.php');
            exit();
        }
    }
}
?>
