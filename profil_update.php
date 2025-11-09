<?php
include 'koneksi.php';

$id = $_POST['id'];
$nama = $_POST['nama_lengkap'];
$username = $_POST['username'];
$email = $_POST['email'];

// Upload foto baru jika ada
if (!empty($_FILES['foto']['name'])) {
    $target_dir = "assets/img/";
    $file_name = basename($_FILES["foto"]["name"]);
    $target_file = $target_dir . $file_name;
    move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file);
    $foto_update = ", foto='$target_file'";
} else {
    $foto_update = "";
}

$query = "UPDATE profil_admin SET 
            nama_lengkap='$nama', 
            username='$username', 
            email='$email'
            $foto_update
          WHERE id='$id'";

if (mysqli_query($koneksi, $query)) {
    header("Location: profil.php?pesan=berhasil");
} else {
    echo "Gagal memperbarui profil: " . mysqli_error($koneksi);
}
?>
