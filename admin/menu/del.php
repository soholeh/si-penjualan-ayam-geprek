<?php
require_once "../_config/config.php";
// mendapatkan menu yg dipilih berdasarkan id_menu dari url
$sql = "SELECT * FROM menu WHERE id_menu='$_GET[id]'";
$result = mysqli_query($koneksi, $sql);

$row = mysqli_fetch_assoc($result);
$foto_menu = $row['foto_menu'];
// menghapus foto dari folder
if (file_exists("foto_menu/$foto_menu")) 
{
    unlink("foto_menu/$foto_menu"); 
}
// menghapus data menu berdasarkan id pada tabel menu
$sql = mysqli_query($koneksi,"DELETE FROM menu WHERE id_menu='$_GET[id]'");

echo "<script>alert('Menu terhapus');</script>";
echo "<script>location='data.php';</script>";
?>