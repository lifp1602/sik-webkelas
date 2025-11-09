<?php
session_start();
include "koneksi.php";

// Cek apakah user login sebagai admin
if (!isset($_SESSION['role'])) {
    header("Location: index.php");
    exit;
}

// Ambil data tugas dari database
$result = mysqli_query($koneksi, "SELECT * FROM tugas ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>SIK - Data Tugas</title>
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

/* Card tugas */
.task-card {
  background: white;
  border-radius: 15px;
  box-shadow: 0 4px 10px rgba(0,0,0,0.1);
  padding: 20px;
  margin-bottom: 20px;
}
.deadline {
  background: #ffc107;
  color: #000;
  border-radius: 20px;
  padding: 4px 12px;
  font-weight: 600;
  font-size: 0.9rem;
}
.btn-kumpul {
  background-color: #4caf50;
  color: white;
  border-radius: 20px;
  padding: 5px 15px;
  text-decoration: none;
}
.btn-detail {
  background-color: #0288d1;
  color: white;
  border-radius: 20px;
  padding: 5px 15px;
  text-decoration: none;
}
</style>
</head>
<body>

<!-- Sidebar -->
<div class="sidebar">
  <h4>🎓 SIK</h4>
  <a href="dashboard.php">🏠 Dashboard</a>
  <a href="absensi.php">🗓️ Absensi</a>
  <a href="tugas.php" class="active">📝 Tugas</a>
  <a href="kas.php">💰 Kas Kelas</a>
  <a href="profil.php">👤 Profil</a>
  <a href="logout.php">🚪 Logout</a>
</div>

<!-- Main Content -->
<div class="main-content">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h3>📝 Tugas</h3>
    <?php if ($_SESSION['role'] == 'admin'): ?>
      <a href="tugas_tambah.php" class="btn btn-primary">+ Tambah Tugas</a>
    <?php endif; ?>
  </div>

  <div class="row">
    <?php while($row = mysqli_fetch_assoc($result)): ?>
      <div class="col-md-6 mb-4">
        <div class="task-card">
          <div class="d-flex justify-content-between align-items-center mb-2">
            <h5><strong><?= htmlspecialchars($row['judul']) ?></strong></h5>
            <span class="deadline">Deadline: <?= htmlspecialchars($row['deadline']) ?></span>
          </div>
          <p><?= htmlspecialchars($row['deskripsi']) ?></p>
          <p class="text-muted">Dikumpulkan: <?= htmlspecialchars($row['jumlah_dikumpul']) ?>/<?= htmlspecialchars($row['total_siswa']) ?> siswa</p>
          <div>
            <a href="#" class="btn-kumpul">📤 Kumpul</a>
            <a href="#" class="btn-detail">👁️ Detail</a>
          </div>
        </div>
      </div>
    <?php endwhile; ?>
  </div>
</div>

</body>
</html>
