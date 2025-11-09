<?php
include "koneksi.php";
$id = $_GET['id'];
$data = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM absensi WHERE id='$id'"));

if (isset($_POST['update'])) {
  $nama = $_POST['nama_siswa'];
  $nis = $_POST['nis'];
  $tanggal = $_POST['tanggal'];
  $status = $_POST['status'];
  mysqli_query($koneksi, "UPDATE absensi SET 
    nama_siswa='$nama', nis='$nis', tanggal='$tanggal', status='$status'
    WHERE id='$id'");
  header("Location: absensi.php");
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Edit Absensi</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
  <h3>Edit Data Absensi</h3>
  <form method="POST">
    <div class="mb-3">
      <label>Nama Siswa</label>
      <input type="text" name="nama_siswa" class="form-control" value="<?= $data['nama_siswa'] ?>">
    </div>
    <div class="mb-3">
      <label>NIS</label>
      <input type="text" name="nis" class="form-control" value="<?= $data['nis'] ?>">
    </div>
    <div class="mb-3">
      <label>Tanggal</label>
      <input type="date" name="tanggal" class="form-control" value="<?= $data['tanggal'] ?>">
    </div>
    <div class="mb-3">
      <label>Status</label>
      <select name="status" class="form-control">
        <option value="Hadir" <?= $data['status']=='Hadir'?'selected':'' ?>>Hadir</option>
        <option value="Sakit" <?= $data['status']=='Sakit'?'selected':''?>>Sakit</option>
        <option value="Izin" <?= $data['status']=='Izin'?'selected':'' ?>>Izin</option>
        <option value="Alpha" <?= $data['status']=='Alpha'?'selected':'' ?>>Alpha</option>
      </select>
    </div>
    <button type="submit" name="update" class="btn btn-warning">Update</button>
    <a href="absensi.php" class="btn btn-secondary">Kembali</a>
  </form>
</div>
</body>
</html>
