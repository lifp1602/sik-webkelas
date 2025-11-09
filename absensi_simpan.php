<?php
// Hubungkan ke database
include 'koneksi.php';

// Ambil data dari form
$nama_siswa = $_POST['nama_siswa'];
$nis = $_POST['nis'];
$tanggal = $_POST['tanggal'];
$status = $_POST['status'];

// Simpan ke tabel absensi
$query = "INSERT INTO absensi (nama_siswa, nis, tanggal, status) 
          VALUES ('$nama_siswa', '$nis', '$tanggal', '$status')";

if (mysqli_query($koneksi, $query)) {
    // Jika berhasil, kembali ke halaman absensi
    header("Location: absensi.php?pesan=sukses");
} else {
    // Jika gagal, tampilkan pesan error
    echo "Gagal menyimpan data: " . mysqli_error($koneksi);
}

// Tutup koneksi
mysqli_close($koneksi);
?>
