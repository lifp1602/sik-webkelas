<?php include 'koneksi.php'; ?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Tambah Absensi</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light p-4">
  <div class="container">
    <div class="card shadow-lg">
      <div class="card-header bg-primary text-white">
        <h5>Tambah Absensi</h5>
      </div>
      <div class="card-body">
        <form action="absensi_simpan.php" method="post">
          <div class="mb-3">
            <label>Nama Siswa</label>
            <input type="text" name="nama_siswa" class="form-control" required>
          </div>
          <div class="mb-3">
            <label>NIS</label>
            <input type="text" name="nis" class="form-control" required>
          </div>
          <div class="mb-3">
            <label>Tanggal</label>
            <input type="date" name="tanggal" class="form-control" required>
          </div>
          <div class="mb-3">
            <label>Status</label>
            <select name="status" class="form-select" required>
              <option value="Hadir">Hadir</option>
              <option value="SAkit">Sakit</option>
              <option value="Izin">Izin</option>
              <option value="Alpha">Alpha</option>
            </select>
          </div>
          <button type="submit" class="btn btn-success">Simpan</button>
          <a href="absensi.php" class="btn btn-secondary">Kembali</a>
        </form>
      </div>
    </div>
  </div>
</body>
</html>
