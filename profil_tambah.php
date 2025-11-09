<?php
include "koneksi.php";
if (!isset($_SESSION['role'])) {
    header("Location: index.php");
    exit;
}
if (isset($_POST['simpan'])) {
  $nama = $_POST['nama'];
  $username = $_POST['username'];
  $password = $_POST['password'];
  $email = $_POST['email'];
  $role = $_POST['role'];
  $foto = "default.png";
  $tgl = date("Y-m-d");

  if ($_FILES['foto']['name'] != "") {
    $foto = basename($_FILES['foto']['name']);
    move_uploaded_file($_FILES['foto']['tmp_name'], "upload_foto/" . $foto);
  }

  mysqli_query($koneksi, "INSERT INTO user VALUES (NULL,'$nama','$username','$password','$role','$email','$tgl','$foto')");
  header("Location: profil.php");
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Tambah User</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light p-4">
<div class="container bg-white p-4 rounded shadow" style="max-width:600px;">
  <h4>Tambah User</h4>
  <form method="post" enctype="multipart/form-data">
    <div class="mb-3"><label>Nama Lengkap</label><input type="text" name="nama" class="form-control" required></div>
    <div class="mb-3"><label>Username</label><input type="text" name="username" class="form-control" required></div>
    <div class="mb-3"><label>Password</label><input type="password" name="password" class="form-control" required></div>
    <div class="mb-3"><label>Email</label><input type="email" name="email" class="form-control" required></div>
    <div class="mb-3">
      <label>Role</label>
      <select name="role" class="form-select">
        <option value="admin">Admin</option>
        <option value="siswa">Siswa</option>
      </select>
    </div>
    <div class="mb-3"><label>Foto</label><input type="file" name="foto" class="form-control"></div>
    <button name="simpan" class="btn btn-primary">Simpan</button>
    <a href="profil.php" class="btn btn-secondary">Kembali</a>
  </form>
</div>
</body>
</html>
