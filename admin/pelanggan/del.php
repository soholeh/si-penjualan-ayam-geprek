<?php
require_once "../_config/config.php";
if (!isset($_SESSION['admin'])) {
    echo    "<script>
            alert('Anda Bukan Admin');
            location='../pelanggan/data.php';
        </script>";
        exit();
    } 
// menghapus data user berdasarkan id pada tabel user
$sql = mysqli_query($koneksi,"DELETE FROM user WHERE id_user = '$_GET[id]'");

echo "<script>alert('Data pelanggan terhapus');</script>";
echo "<script>location='data.php';</script>";
?>