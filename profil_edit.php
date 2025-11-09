<?php
include "koneksi.php";
if (!isset($_SESSION['role'])) {
    header("Location: index.php");
    exit;
}
$id = $_GET['id'];
$q = mysqli_query($koneksi, "SELECT * FROM user WHERE id=$id");
$d = mysqli_fetch_assoc($q);

if (isset($_POST['update'])) {
  $nama = $_POST['nama'];
  $username = $_POST['username'];
  $email = $_POST['email'];
  $role = $_POST['role'];
  $foto = $d['foto'];

  if ($_FILES['foto']['name'] != "") {
    $foto = basename($_FILES['foto']['name']);
    move_uploaded_file($_FILES['foto']['tmp_name'], "upload_foto/" . $foto);
  }

  mysqli_query($koneksi, "UPDATE user SET nama_lengkap='$nama', username='$username', email='$email', role='$role', foto='$foto' WHERE id=$id");
  header("Location: profil.php");
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Edit Profil</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light p-4">
<div class="container bg-white p-4 rounded shadow" style="max-width:600px;">
  <h4>Edit User</h4>
  <form method="post" enctype="multipart/form-data">
    <div class="mb-3"><label>Nama Lengkap</label><input type="text" name="nama" class="form-control" value="<?= $d['nama_lengkap'] ?>" required></div>
    <div class="mb-3"><label>Username</label><input type="text" name="username" class="form-control" value="<?= $d['username'] ?>" required></div>
    <div class="mb-3"><label>Email</label><input type="email" name="email" class="form-control" value="<?= $d['email'] ?>" required></div>
    <div class="mb-3">
      <label>Role</label>
      <select name="role" class="form-select">
        <option value="admin" <?= $d['role']=='admin'?'selected':'' ?>>Admin</option>
        <option value="siswa" <?= $d['role']=='siswa'?'selected':'' ?>>Siswa</option>
      </select>
    </div>
    <div class="mb-3">
      <label>Foto</label><br>
      <img src="upload_foto/<?= $d['foto'] ?>" width="70" height="70" class="rounded mb-2"><br>
      <input type="file" name="foto" class="form-control">
    </div>
    <button name="update" class="btn btn-primary">Simpan Perubahan</button>
    <a href="profil.php" class="btn btn-secondary">Kembali</a>
  </form>
</div>
</body>
</html>
