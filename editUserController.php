<?php
include 'koneksi.php';

$id = $_POST['id'];
if (isset($id)) {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $sql = "UPDATE tbl_user SET username='$username', password='$password' WHERE id=$id";
    if ($koneksi->query($sql) === TRUE) {
        $_SESSION['success'] = "User deleted successfully!";
        header('Location: ../index.php');
    } else {
        $_SESSION['error'] = "Error deleting user: " . $koneksi->error;
        header('Location: ../index.php');
    }
}
$koneksi->close();
?>
