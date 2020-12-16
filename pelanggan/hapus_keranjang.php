<?php include_once('../admin/_config/config.php');
$id_menu = $_GET["id"];
$jumlah = $_GET["jumlah"];

$query = mysqli_query($koneksi, "UPDATE menu SET stok_menu = stok_menu+$jumlah
                        WHERE id_menu='$id_menu'");
unset($_SESSION["keranjang"][$id_menu]);

echo "<script>alert('Menu berhasil dihapus dari keranjang');</script>";
echo "<script>location='keranjang.php';</script>";
?>