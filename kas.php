<?php
session_start();
$is_admin = isset($_SESSION['role']) && $_SESSION['role'] == 'admin';
include "koneksi.php";

// Hitung total
$total_masuk = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT SUM(jumlah) as total FROM kas WHERE jenis='Masuk'"))['total'] ?? 0;
$total_keluar = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT SUM(jumlah) as total FROM kas WHERE jenis='Keluar'"))['total'] ?? 0;
$total_saldo = $total_masuk - $total_keluar;

$result = mysqli_query($koneksi, "SELECT * FROM kas ORDER BY tanggal DESC");
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Kas Kelas</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
body { background-color: #d6ecff; font-family: 'Poppins', sans-serif; }
.sidebar {
  height: 100vh;
  width: 230px;
  position: fixed;
  left: 0; top: 0;
  background-color: #0d6efd;
  color: white;
  padding: 20px;
}
.sidebar h4 { font-size: 18px; margin-bottom: 30px; }
.sidebar a {
  display: block;
  color: white;
  padding: 10px;
  margin-bottom: 10px;
  border-radius: 10px;
  text-decoration: none;
}
.sidebar a:hover, .sidebar a.active {
  background-color: #1a73e8;
}
.main {
  margin-left: 250px;
  padding: 30px;
}
.card-box {
  border-radius: 15px;
  padding: 20px;
  text-align: center;
  color: white;
}
.table-container {
  background: white;
  border-radius: 15px;
  padding: 20px;
  margin-top: 20px;
  box-shadow: 0 3px 10px rgba(0,0,0,0.1);
}
.btn-sm { border-radius: 10px; }
</style>
</head>
<body>

<!-- Sidebar -->
<div class="sidebar">
  <h4>🎓 SIK</h4>
  <p>Admin Dashboard</p>
  <a href="dashboard.php">🏠 Dashboard</a>
  <a href="absensi.php">🗓️ Absensi</a>
  <a href="tugas.php">📚 Tugas</a>
  <a href="kas.php" class="active">💰 Kas Kelas</a>
  <a href="profil.php">👤 Profil</a>
  <a href="logout.php">🚪 Logout</a>
</div>

<!-- Main -->
<div class="main">
  <h3>💰 Kas Kelas</h3>

  <div class="row mt-3">
    <div class="col-md-4">
      <div class="card-box bg-success">
        <h5>Total Saldo Kas</h5>
        <h3>Rp <?= number_format($total_saldo,0,',','.') ?></h3>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card-box bg-primary">
        <h5>Total Pemasukan</h5>
        <h3>Rp <?= number_format($total_masuk,0,',','.') ?></h3>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card-box bg-danger">
        <h5>Total Pengeluaran</h5>
        <h3>Rp <?= number_format($total_keluar,0,',','.') ?></h3>
      </div>
    </div>
  </div>

  <div class="d-flex justify-content-between mt-4">
    <a href="kas_tambah.php" class="btn btn-success">+ Tambah Transaksi</a>
    <a href="#" class="btn btn-primary">📤 Export Excel</a>
  </div>

  <div class="table-container mt-3">
    <table class="table table-bordered table-hover text-center">
      <thead class="table-primary">
        <tr>
          <th>No</th>
          <th>Tanggal</th>
          <th>Nama Siswa</th>
          <th>Keterangan</th>
          <th>Jenis</th>
          <th>Jumlah</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
      <?php $no=1; while($row=mysqli_fetch_assoc($result)): ?>
        <tr>
          <td><?= $no++ ?></td>
          <td><?= $row['tanggal'] ?></td>
          <td><?= $row['nama_siswa'] ?></td>
          <td><?= $row['keterangan'] ?></td>
          <td>
            <?php if($row['jenis']=='Masuk'): ?>
              <span class="badge bg-success">Masuk</span>
            <?php else: ?>
              <span class="badge bg-danger">Keluar</span>
            <?php endif; ?>
          </td>
          <td>
            <?php if($row['jenis']=='Masuk'): ?>
              <span class="text-success">+Rp <?= number_format($row['jumlah'],0,',','.') ?></span>
            <?php else: ?>
              <span class="text-danger">-Rp <?= number_format($row['jumlah'],0,',','.') ?></span>
            <?php endif; ?>
          </td>
          <td>
            <a href="kas_edit.php?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm">✏️</a>
            <a href="kas_hapus.php?id=<?= $row['id'] ?>" onclick="return confirm('Hapus data ini?')" class="btn btn-danger btn-sm">🗑️</a>
          </td>
        </tr>
      <?php endwhile; ?>
      </tbody>
    </table>
  </div>
</div>

</body>
</html>
