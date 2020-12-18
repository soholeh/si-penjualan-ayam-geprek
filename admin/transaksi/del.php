<?php
require_once "../_config/config.php";
if (!isset($_SESSION['admin'])) {
    echo    "<script>
            alert('Anda Bukan Admin');
            location='../transaksi/data.php';
        </script>";
        exit();
    } 

// menghapus data penjualan berdasarkan id pada tabel penjualan
$sql = mysqli_query($koneksi,"DELETE FROM penjualan WHERE id_penjualan = '$_GET[id]'");

echo "<script>alert('Data penjualan terhapus');</script>";
echo "<script>location='data.php';</script>";
?>