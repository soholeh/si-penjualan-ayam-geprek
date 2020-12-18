<?php
session_start();
unset($_SESSION['keranjang']);
unset($_SESSION['pelanggan']);
echo "<script>alert('Anda telah logout');</script>";
echo "<script>location='../index.php';</script>";
?>