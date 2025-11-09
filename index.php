<?php
session_start();
include "koneksi.php";

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    $query = mysqli_query($koneksi, "SELECT * FROM users WHERE username='$username' AND password='$password' AND role='$role'");
    if (mysqli_num_rows($query) > 0) {
        $_SESSION['username'] = $username;
        $_SESSION['role'] = $role;
        header("Location: dashboard.php");
    } else {
        echo "<script>alert('Login gagal!');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Sistem Informasi Kelas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to right, #c9e9ff, #d5ecff);
            height: 100vh;
        }
        .login-card {
            width: 400px;
            margin: 100px auto;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
        }
        .header {
            background-color: #2196f3;
            color: white;
            text-align: center;
            padding: 15px;
            border-radius: 15px 15px 0 0;
        }
    </style>
</head>
<body>
<div class="card login-card">
    <div class="header"><h4>🎓 Sistem Informasi Kelas</h4></div>
    <div class="card-body">
        <form method="POST">
            <label>Username/NIS</label>
            <input type="text" name="username" class="form-control mb-3" required>
            <label>Password</label>
            <input type="password" name="password" class="form-control mb-3" required>
            <label>Pilih Role</label>
            <select name="role" class="form-control mb-4" required>
                <option value="">-- Pilih Role --</option>
                <option value="admin">Admin</option>
                <option value="siswa">Siswa</option>
            </select>
            <button type="submit" name="login" class="btn btn-primary w-100">
                <i class="bi bi-box-arrow-in-right"></i> Login
            </button>
        </form>
        <div class="text-center mt-3 text-muted">
        </div>
    </div>
</div>
</body>
</html>
