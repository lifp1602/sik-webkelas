<?php
session_start();
if ($_SESSION['role'] != 'admin') header("Location: kas.php");
include "koneksi.php";
if(isset($_POST['simpan'])){
  $tanggal = $_POST['tanggal'];
  $nama = $_POST['nama_siswa'];
  $keterangan = $_POST['keterangan'];
  $jenis = $_POST['jenis'];
  $jumlah = $_POST['jumlah'];
  
  mysqli_query($koneksi, "INSERT INTO kas VALUES(NULL, '$tanggal', '$nama', '$keterangan', '$jenis', '$jumlah')");
  echo "<script>alert('Transaksi berhasil ditambahkan!');window.location='kas.php';</script>";
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Tambah Kas</title>
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
  <h3 class="text-center mb-4">Tambah Transaksi Kas</h3>
  <form method="post">
    <div class="mb-3">
      <label>Tanggal</label>
      <input type="date" name="tanggal" class="form-control" required>
    </div>
    <div class="mb-3">
      <label>Nama Siswa (opsional)</label>
      <input type="text" name="nama_siswa" class="form-control">
    </div>
    <div class="mb-3">
      <label>Keterangan</label>
      <input type="text" name="keterangan" class="form-control" required>
    </div>
    <div class="mb-3">
      <label>Jenis</label>
      <select name="jenis" class="form-select" required>
        <option value="Masuk">Masuk</option>
        <option value="Keluar">Keluar</option>
      </select>
    </div>
    <div class="mb-3">
      <label>Jumlah (Rp)</label>
      <input type="number" name="jumlah" class="form-control" required>
    </div>
    <div class="d-flex justify-content-between">
      <a href="kas.php" class="btn btn-secondary">⬅ Kembali</a>
      <button type="submit" name="simpan" class="btn btn-success">💾 Simpan</button>
    </div>
  </form>
</div>

</body>
</html>
