<?php
session_start();
include 'koneksi.php';
$id = $_GET['id'];
if (isset($id)) {
    $sql = "DELETE FROM tbl_user WHERE id=$id";

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
