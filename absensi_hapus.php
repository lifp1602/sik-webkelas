<?php
include "koneksi.php";
$id = $_GET['id'];
mysqli_query($koneksi, "DELETE FROM absensi WHERE id='$id'");
header("Location: absensi.php");
?>
