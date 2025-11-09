<?php
include "koneksi.php";
$result = mysqli_query($koneksi, "SELECT * FROM absensi ORDER BY id ASC");
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Absensi Kelas - SIK</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
body {
  background: #d6ecff;
  font-family: 'Poppins', sans-serif;
}

/* Sidebar */
.sidebar {
  position: fixed;
  top: 0;
  left: 0;
  height: 100%;
  width: 230px;
  background: #1e88e5;
  color: white;
  padding-top: 30px;
}
.sidebar h4 {
  text-align: center;
  font-weight: bold;
  margin-bottom: 40px;
}
.sidebar a {
  display: block;
  padding: 12px 25px;
  color: white;
  text-decoration: none;
  font-weight: 500;
  margin: 5px 0;
  transition: 0.3s;
}
.sidebar a:hover,
.sidebar a.active {
  background: #1565c0;
  border-radius: 8px;
}

/* Main content */
.main-content {
  margin-left: 250px;
  padding: 30px;
}

.container-content {
  background: white;
  border-radius: 15px;
  padding: 30px;
  box-shadow: 0 3px 10px rgba(0,0,0,0.1);
}

.badge-success { background-color: #4caf50; }
.badge-sick { background-color: rgba(255, 242, 4, 1)}
.badge-warning { background-color: #ffc107; color: #000; }
.badge-danger  { background-color: #f44336; }
</style>
</head>
<body>

<!-- Sidebar -->
<div class="sidebar">
  <h4>🎓 SIK</h4>
  <a href="dashboard.php">🏠 Dashboard</a>
  <a href="absensi.php" class="active">🗓️ Absensi</a>
  <a href="tugas.php">📝 Tugas</a>
  <a href="kas.php">💰 Kas Kelas</a>
  <a href="profil.php">👤 Profil</a>
  <a href="logout.php">🚪 Logout</a>
</div>

<!-- Main Content -->
<div class="main-content">
  <h3 class="mb-4">📅 Absensi Kelas</h3>

  <div class="container-content">
    <div class="d-flex justify-content-between mb-3">
      <a href="absensi_tambah.php" class="btn btn-success">+ Absen Hari Ini</a>
      <a href="#" class="btn btn-primary">📤 Export Excel</a>
    </div>

    <table class="table table-bordered table-hover text-center align-middle">
      <thead class="table-primary">
        <tr>
          <th>No</th>
          <th>Nama Siswa</th>
          <th>NIS</th>
          <th>Tanggal</th>
          <th>Status</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php 
        $no = 1;
        while($row = mysqli_fetch_assoc($result)): ?>
        <tr>
          <td><?= $no++ ?></td>
          <td><?= $row['nama_siswa'] ?></td>
          <td><?= $row['nis'] ?></td>
          <td><?= $row['tanggal'] ?></td>
          <td>
            <?php if($row['status']=="Hadir") echo '<span class="badge badge-success">Hadir</span>'; ?>
            <?php if($row['status']=="Sakit") echo '<span class="bagde badge-sick">Sakit</span>'; ?>
            <?php if($row['status']=="Izin") echo '<span class="badge badge-warning">Izin</span>'; ?>
            <?php if($row['status']=="Alpha") echo '<span class="badge badge-danger">Alpha</span>'; ?>
          </td>
          <td>
            <a href="absensi_edit.php?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm">✏️</a>
            <a href="absensi_hapus.php?id=<?= $row['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Hapus data ini?')">🗑️</a>
          </td>
        </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
  </div>
</div>

</body>
</html>
