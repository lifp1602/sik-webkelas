<?php
include "koneksi.php";
if (!isset($_SESSION['role'])) {
    header("Location: index.php");
    exit;
}
$id = $_GET['id'];
mysqli_query($koneksi, "DELETE FROM user WHERE id=$id");
header("Location: profil.php");
?>
