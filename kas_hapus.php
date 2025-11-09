<?php
session_start();
if ($_SESSION['role'] != 'admin') header("Location: kas.php");
include "koneksi.php";
$id = $_GET['id'];
mysqli_query($koneksi, "DELETE FROM kas WHERE id='$id'");
echo "<script>alert('Data kas berhasil dihapus!');window.location='kas.php';</script>";
?>
