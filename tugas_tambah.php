<?php
session_start();
include "koneksi.php";

// Pastikan hanya admin yang bisa mengakses
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: index.php");
    exit;
}

// Jika tombol simpan ditekan
if (isset($_POST['simpan'])) {
    $judul = mysqli_real_escape_string($koneksi, $_POST['judul']);
    $deskripsi = mysqli_real_escape_string($koneksi, $_POST['deskripsi']);
    $deadline = $_POST['deadline'];
    $total_siswa = $_POST['total_siswa'];

    $query = "INSERT INTO tugas (judul, deskripsi, deadline, total_siswa, jumlah_dikumpul)
              VALUES ('$judul', '$deskripsi', '$deadline', '$total_siswa', 0)";
    
    if (mysqli_query($koneksi, $query)) {
        echo "<script>alert('Tugas berhasil ditambahkan!'); window.location='tugas.php';</script>";
    } else {
        echo "<script>alert('Gagal menambah tugas: " . mysqli_error($koneksi) . "');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Tambah Tugas</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
body {
  background: #d6ecff;
  font-family: 'Poppins', sans-serif;
}
.container {
  max-width: 600px;
  background: white;
  border-radius: 15px;
  padding: 30px;
  margin-top: 80px;
  box-shadow: 0 4px 10px rgba(0,0,0,0.1);
}
.btn-primary {
  background-color: #1e88e5;
  border: none;
}
.btn-primary:hover {
  background-color: #1565c0;
}
</style>
</head>
<body>

<div class="container">
  <h3 class="text-center mb-4">Tambah Tugas Baru</h3>
  <form method="post">
    <div class="mb-3">
      <label for="judul" class="form-label">Judul Tugas</label>
      <input type="text" class="form-control" id="judul" name="judul" required>
    </div>
    <div class="mb-3">
      <label for="deskripsi" class="form-label">Deskripsi Tugas</label>
      <textarea class="form-control" id="deskripsi" name="deskripsi" rows="4" required></textarea>
    </div>
    <div class="mb-3">
      <label for="deadline" class="form-label">Deadline</label>
      <input type="date" class="form-control" id="deadline" name="deadline" required>
    </div>
    <div class="mb-3">
      <label for="total_siswa" class="form-label">Jumlah Siswa (Total)</label>
      <input type="number" class="form-control" id="total_siswa" name="total_siswa" value="25" required>
    </div>
    <div class="d-flex justify-content-between">
      <a href="tugas.php" class="btn btn-secondary">⬅ Kembali</a>
      <button type="submit" name="simpan" class="btn btn-primary">💾 Simpan</button>
    </div>
  </form>
</div>

</body>
</html>
