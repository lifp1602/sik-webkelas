<?php
session_start();
if (!isset($_SESSION['username'])) header("Location: index.php");
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Dashboard</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<style>
body {
    background: linear-gradient(to right, #c9e9ff, #d5ecff);
}
.sidebar {
    background: #1e88e5;
    color: white;
    height: 100vh;
    position: fixed;
    width: 250px;
    padding-top: 20px;
}
.sidebar a {
    display: block;
    color: white;
    padding: 12px 20px;
    text-decoration: none;
    margin: 5px 0;
}
.sidebar a:hover {
    background: #1565c0;
    border-radius: 8px;
}
.content {
    margin-left: 270px;
    padding: 20px;
}
.card {
    border-radius: 15px;
    box-shadow: 0 3px 10px rgba(0,0,0,0.1);
}
</style>
</head>
<body>
<div class="sidebar">
    <h4 class="text-center">🎓 SIK</h4>
    <p class="text-center mb-4"><?= ucfirst($_SESSION['role']) ?> Dashboard</p>
    <a href="#">🏠 Dashboard</a>
    <a href="absensi.php">📅 Absensi</a>
    <a href="tugas.php">📝 Tugas</a>
    <a href="kas.php">💰 Kas Kelas</a>
    <a href="profil.php">👤 Profil</a>
    <a href="logout.php">🚪 Logout</a>
</div>

<div class="content">
    <h2>Dashboard</h2>
    <div class="row mt-4">
        <div class="col-md-3">
            <div class="card text-center p-3">
                <h4 class="text-primary">36</h4>
                <p>Total Siswa</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center p-3">
                <h4 class="text-success">35</h4>
                <p>Hadir Hari Ini</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center p-3">
                <h4 class="text-warning">5</h4>
                <p>Total Tugas</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center p-3">
                <h4 class="text-info">Rp 200.000</h4>
                <p>Saldo Kas</p>
            </div>
        </div>
    </div>

    <div class="row mt-5">
        <div class="col-md-6">
            <div class="card p-3">
                <h5>📈 Grafik Kehadiran</h5>
                <canvas id="grafikHadir"></canvas>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card p-3">
                <h5>💹 Grafik Kas</h5>
                <canvas id="grafikKas"></canvas>
            </div>
        </div>
    </div>
</div>

<script>
const hadirCtx = document.getElementById('grafikHadir');
new Chart(hadirCtx, {
    type: 'line',
    data: {
        labels: ['Sen', 'Sel', 'Rab', 'Kam', 'Jum'],
        datasets: [{
            label: 'Kehadiran',
            data: [23, 25, 22, 24, 20],
            borderColor: 'blue',
            tension: 0.3,
            fill: false
        }]
    }
});

const kasCtx = document.getElementById('grafikKas');
new Chart(kasCtx, {
    type: 'doughnut',
    data: {
        labels: ['Terpakai', 'Sisa'],
        datasets: [{
            data: [100000, 200000],
            backgroundColor: ['#f44336', '#4caf50']
        }]
    }
});
</script>
</body>
</html>
