<?php
session_start();
if ($_SESSION['role'] != 'admin') header("Location: kas.php");
include "koneksi.php";
$id = $_GET['id'];
$data = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM kas WHERE id='$id'"));

if(isset($_POST['update'])){
  $tanggal = $_POST['tanggal'];
  $nama = $_POST['nama_siswa'];
  $keterangan = $_POST['keterangan'];
  $jenis = $_POST['jenis'];
  $jumlah = $_POST['jumlah'];

  mysqli_query($koneksi, "UPDATE kas SET tanggal='$tanggal', nama_siswa='$nama', keterangan='$keterangan', jenis='$jenis', jumlah='$jumlah' WHERE id='$id'");
  echo "<script>alert('Data kas berhasil diperbarui!');window.location='kas.php';</script>";
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Edit Kas</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
body { background: #d6ecff; font-family: 'Poppins', sans-serif; }
.container {
  max-width: 600px;
  background: white;
  border-radius: 15px;
  padding: 30px;
  margin-top: 80px;
  box-shadow: 0 4px 10px rgba(0,0,0,0.1);
}
</style>
</head>
<body>

<div class="container">
  <h3 class="text-center mb-4">Edit Transaksi Kas</h3>
  <form method="post">
    <div class="mb-3">
      <label>Tanggal</label>
      <input type="date" name="tanggal" value="<?= $data['tanggal'] ?>" class="form-control" required>
    </div>
    <div class="mb-3">
      <label>Nama Siswa</label>
      <input type="text" name="nama_siswa" value="<?= $data['nama_siswa'] ?>" class="form-control">
    </div>
    <div class="mb-3">
      <label>Keterangan</label>
      <input type="text" name="keterangan" value="<?= $data['keterangan'] ?>" class="form-control" required>
    </div>
    <div class="mb-3">
      <label>Jenis</label>
      <select name="jenis" class="form-select">
        <option value="Masuk" <?= $data['jenis']=='Masuk'?'selected':'' ?>>Masuk</option>
        <option value="Keluar" <?= $data['jenis']=='Keluar'?'selected':'' ?>>Keluar</option>
      </select>
    </div>
    <div class="mb-3">
      <label>Jumlah (Rp)</label>
      <input type="number" name="jumlah" value="<?= $data['jumlah'] ?>" class="form-control" required>
    </div>
    <div class="d-flex justify-content-between">
      <a href="kas.php" class="btn btn-secondary">⬅ Kembali</a>
      <button type="submit" name="update" class="btn btn-primary">💾 Simpan</button>
    </div>
  </form>
</div>

</body>
</html>
