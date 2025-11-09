<?php
session_start();
include "koneksi.php";

// contoh login session
if (!isset($_SESSION['role'])) {
    header("Location: index.php");
    exit;
} 

$query = mysqli_query($koneksi, "SELECT * FROM user ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Profil User</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
body { background: #eaf4ff; font-family: 'Poppins', sans-serif; }
.sidebar {
  width: 230px; height: 100vh; position: fixed; background: #0d6efd; color: #fff; padding: 20px;
}
.sidebar a { color: #fff; display: block; text-decoration: none; padding: 10px; border-radius: 8px; }
.sidebar a:hover, .sidebar a.active { background: rgba(255,255,255,0.2); }
.content { margin-left: 250px; padding: 30px; }
.card { border-radius: 15px; box-shadow: 0 3px 8px rgba(0,0,0,0.1); }
</style>
</head>
<body>

<!-- Sidebar -->
<div class="sidebar">
  <h5>🎓 SIK</h5>
  <small>Admin Dashboard</small>
  <hr>
  <a href="dashboard.php">🏠 Dashboard</a>
  <a href="absensi.php">📅 Absensi</a>
  <a href="tugas.php">📝 Tugas</a>
  <a href="kas.php">💰 Kas Kelas</a>
  <a href="profil.php" class="active">👤 Profil</a>
  <a href="logout.php">🚪 Logout</a>
</div>

<!-- Konten -->
<div class="content">
  <h3 class="mb-4">👤 Data Profil User</h3>
  <?php if ($_SESSION['role'] == 'admin'): ?>
  <a href="profil_tambah.php" class="btn btn-primary mb-3">+ Tambah User</a>
  <?php endif; ?>

  <div class="card p-3">
    <table class="table table-hover align-middle">
      <thead class="table-primary">
        <tr>
          <th>No</th>
          <th>Foto</th>
          <th>Nama Lengkap</th>
          <th>Username</th>
          <th>Email</th>
          <th>Role</th>
          <th>Bergabung</th>
          <?php if ($_SESSION['role'] == 'admin'): ?><th>Aksi</th><?php endif; ?>
        </tr>
      </thead>
      <tbody>
        <?php 
        $no = 1;
        while ($row = mysqli_fetch_assoc($query)): ?>
        <tr>
          <td><?= $no++ ?></td>
          <td><img src="upload_foto/<?= $row['foto'] ?>" width="50" height="50" style="border-radius:50%;"></td>
          <td><?= $row['nama_lengkap'] ?></td>
          <td><?= $row['username'] ?></td>
          <td><?= $row['email'] ?></td>
          <td><?= ucfirst($row['role']) ?></td>
          <td><?= date('d M Y', strtotime($row['tanggal_bergabung'])) ?></td>
          <?php if ($_SESSION['role'] == 'admin'): ?>
          <td>
            <a href="profil_edit.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-warning">✏️</a>
            <a href="profil_hapus.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus user ini?')">🗑️</a>
          </td>
          <?php endif; ?>
        </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
  </div>
</div>
</body>
</html>
