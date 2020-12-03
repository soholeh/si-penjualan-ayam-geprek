<?php
require_once "admin/_config/config.php";
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title><?= $title?></title>
        <!-- Offline -->
        <link href="<?=base_url('admin/_assets/dist/css/styles.css')?>" rel="stylesheet" />
        <link href="<?=base_url('admin/_assets/dataTables/datatables.min.css')?>" rel="stylesheet" type="text/css" />
        <link href="<?=base_url('admin/_assets/dataTables/Responsive-2.2.6/css/responsive.bootstrap.min.css')?>" rel="stylesheet" type="text/css" />

        <!-- Online -->
<!--         <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" /> -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>

        <!-- ikon -->
        <link rel="icon" href="<?=base_url('admin/_assets/gejulog.jpg')?>" type="image/gif" sizes="16x16">
        <!-- Font-Awesome -->
        <script src="https://kit.fontawesome.com/b0297d4762.js" crossorigin="anonymous"></script>

    </head>
    <body>
        <div>
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
            <div class="container">
                <a class="navbar-brand" href="index.php"><i class="fas fa-drumstick-bite text-warning"></i> Ge-Ju <span class="sr-only">(current)</span></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="index.php">Beranda</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="daftar_menu.php">Daftar Menu</a>
                        </li>
                        <?php if (isset($_SESSION["pelanggan"])): ?>
                        <li class="nav-item mr-5">
                            <a class="nav-link" href="riwayat.php">Riwayat Belanja</a>
                        </li>
                        <!-- Selain itu belum login atau tidak ada session -->
                        <?php else: ?>
                        <li class="nav-item mr-5">
                            <a class="nav-link" href="info.php">Info Pembayaran</a>
                        </li>
                        <!-- Jika sudah login ada session pelanggan -->
                    </ul>
                    <?php endif ?>
                    <!-- Search -->
                    <form class="form-inline my-2 my-lg-0 mr-5" action="pencarian.php" method="get">
                        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="keyword">
                        <button class="btn btn-outline-warning my-2 my-sm-0" name="cari">Search</button>
                    </form>
                    <div class="dropdown float-right">
                    <!-- Jika sudah login ada session pelanggan -->
                    <?php if (isset($_SESSION["pelanggan"])): ?>
                        <a class="btn btn-primary float-right" href="logout.php">Logout <i class="fas fa-sign-out-alt"></i></a>
                    <!-- Selain itu belum login atau tidak ada session -->
                    <?php else: ?>
                        <button type="button" class="btn btn-primary dropdown-toggle" id="dropdownMenuOffset" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-offset="10,20">Login or Register</button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuOffset">
                            <a class="dropdown-item" href="login.php">Login <i class="fas fa-sign-in-alt"></i></a>
                                <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="daftar.php">Register</a>
                        </div>
                    <?php endif ?>
                    </div>        
                </div>
            </div>
        </nav>
        <!-- Akhir Navbar -->
        <!-- Kategori Menu -->
        <div class="row mt-5">
            <div class="col-md-3 bg-light">
                <ul class="list-group list-group-flush p-2 pt-4">
                    <li class="list-group-item bg-primary"><i class="fas fa-list"></i> Kategori Menu</li>
                    <li class="list-group-item"><a href="cemilan.php" class="text-dark"><i class="fas fa-pizza-slice"></i> Cemilan</a></li>
                    <li class="list-group-item"><a href="mkn_berat.php" class="text-dark"><i class="fas fa-utensils"></i>  Makanan Berat</a></li>
                    <li class="list-group-item"><a href="minuman.php" class="text-dark"><i class="fas fa-wine-glass-alt"></i>   Minuman</a></li>
                </ul>
                <!-- Keranjang -->
                <ul class="list-group list-group-flush p-2 pt-4">
                    <li class="list-group-item bg-primary"><i class="fas fa-cart-plus"></i> Keranjang Belanja</li>
                    <?php
                        if(isset($_SESSION['keranjang'])){
                                    $subtotal = 0;
                        foreach ($_SESSION['keranjang'] as $id_produk => $jumlah){
                            $sql = "SELECT * FROM produk WHERE id_produk='$id_produk'";
                            $result = mysqli_query($koneksi, $sql);
                            $row = mysqli_fetch_assoc($result);
                            if(isset($row)){
                                $total = $row["harga_produk"]*$jumlah;
                                $subtotal += $total;
                            }
                        }
                        echo '<li class="list-group-item border-primary"><a class="dropdown-item" href="keranjang.php"><i class="fas fa-money-check-alt text-success"></i> Rp. '.number_format($subtotal).'</a></li>';
                        }else {
                        echo '<li class="list-group-item border-primary"><a class="dropdown-item" href="keranjang.php"><i class="fas fa-money-check-alt text-success"></i> Rp. 0,00</a></li>';
                        }                
                    ?>
                    
                    <li class="list-group-item"><a class="dropdown-item" href="keranjang.php"><i class="fas fa-angle-right"></i> Lihat Detail</a></li>
                </ul>
            </div>