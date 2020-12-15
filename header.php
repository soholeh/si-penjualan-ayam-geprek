<?php require_once "admin/_config/config.php" ?>

<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
        <!-- Add icon library -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="canonical" href="https://getbootstrap.com/docs/4.5/examples/sign-in/">
        <!-- Add custom CSS here -->
        <!-- <link href="admin/css/sb-admin.css" rel="stylesheet"> -->
        <!-- <link rel="stylesheet" href="admin/font-awesome/css/font-awesome.min.css"> -->
        <!-- Bootstrap core CSS -->
        <link href="<?= base_url('admin/_assets/dist/css/bootstrap.min.css'); ?>" rel="stylesheet">
        <!-- <link href="admin/css/bootstrap.css" rel="stylesheet"> -->
        <!-- Ikon -->
        <link rel="icon" href="<?= base_url('admin/_assets/gejulog.jpg'); ?>" type="image/gif" sizes="16x16">
        <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
            font-size: 3.5rem;
            }
        }
        </style>
        <!-- Font-Awesome -->
        <script src="https://kit.fontawesome.com/b0297d4762.js" crossorigin="anonymous"></script>
        <title><?= $title ?></title>
    </head>
    <body class="bg bg-light">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
            <div class="container">
                <a class="navbar-brand" href="<?= base_url('index.php');?>"><i class="fas fa-drumstick-bite text-warning"></i> Ge-Ju <span class="sr-only">(current)</span></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url('index.php');?>">Beranda</a>
                        </li>
                        <li class="nav-item">
                        <?php 
                            $menu = mysqli_query($koneksi,"SELECT * FROM menu WHERE stok_menu > 0");
                            $jumlah_menu = mysqli_num_rows($menu);
                        ?>
                            <a class="nav-link" href="<?= base_url('menu_makanan/daftar_menu.php');?>">Daftar Menu <span class="badge badge-light"><?= $jumlah_menu; ?></span></a>
                        </li>
                        <?php if (isset($_SESSION["pelanggan"])): ?>
                        <li class="nav-item mr-5">
                            <a class="nav-link" href="riwayat.php">Riwayat Belanja</a>
                        </li>
                        <!-- Selain itu belum login atau tidak ada session -->
                        <?php else: ?>
                        <li class="nav-item mr-5">
                            <a class="nav-link" href="<?= base_url('info.php');?>">Info Pembayaran</a>
                        </li>
                        <!-- Jika sudah login ada session pelanggan -->
                    </ul>
                    <?php endif ?>
                    <!-- Search -->
                    <form class="form-inline my-2 my-lg-0 mr-5" action="<?= base_url('menu_makanan/pencarian.php');?>" method="get">
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
        <div class="row mt-5 no-gutters">
            <div class="col-md-3">
                <ul class="list-group list-group-flush p-2 pt-4">
                    <div class="card">
                        <li class="list-group-item bg-primary"><i class="fas fa-list"></i> Kategori Menu</li>
                        <?php 
                            $cemilan = mysqli_query($koneksi,"SELECT * FROM menu LEFT JOIN kategori 
                            ON menu.id_kategori = kategori.id_kategori WHERE nama_kategori = 'Makanan Ringan' AND stok_menu > 0");
                            $jumlah_cemilan = mysqli_num_rows($cemilan);
                        ?>
                        <li class="list-group-item border-primary"><a href="<?= base_url('menu_makanan/cemilan.php');?>" class="text-dark"><i class="fas fa-pizza-slice"></i> Cemilan <span class="badge badge-info"><?= $jumlah_cemilan; ?></span></a></li>
                        <?php 
                            $makber = mysqli_query($koneksi,"SELECT * FROM menu LEFT JOIN kategori 
                            ON menu.id_kategori = kategori.id_kategori WHERE nama_kategori = 'Makanan Berat' AND stok_menu > 0");
                            $jumlah_makber = mysqli_num_rows($makber);
                        ?>
                        <li class="list-group-item border-primary"><a href="<?= base_url('menu_makanan/mkn_berat.php');?>" class="text-dark"><i class="fas fa-utensils"></i> Makanan Berat <span class="badge badge-info"><?= $jumlah_makber; ?></span></a></li>
                        <?php 
                            $minum = mysqli_query($koneksi,"SELECT * FROM menu LEFT JOIN kategori 
                            ON menu.id_kategori = kategori.id_kategori WHERE nama_kategori = 'Minuman' AND stok_menu > 0");
                            $jumlah_minum = mysqli_num_rows($minum);
                        ?>
                        <li class="list-group-item border-primary"><a href="<?= base_url('menu_makanan/minuman.php');?>" class="text-dark"><i class="fas fa-wine-glass-alt"></i> Minuman <span class="badge badge-info"><?= $jumlah_minum; ?></span></a></li>
                    </div>
                </ul>
                <!-- Keranjang -->
                <ul class="list-group list-group-flush p-2 pt-4">
                    <div class="card">   
                        <li class="list-group-item bg-primary"><i class="fas fa-cart-plus"></i> Keranjang Belanja</li>
                        <?php
                            if(isset($_SESSION['keranjang'])){
                                        $subtotal = 0;
                            foreach ($_SESSION['keranjang'] as $id_produk => $jumlah){
                                $sql = "SELECT * FROM menu WHERE id_menu='$id_menu'";
                                $result = mysqli_query($koneksi, $sql);
                                $row = mysqli_fetch_assoc($result);
                                if(isset($row)){
                                    $total = $row["harga_menu"]*$jumlah;
                                    $subtotal += $total;
                                }
                            }
                            echo '<li class="list-group-item border-primary"><a class="dropdown-item" href="keranjang.php"><i class="fas fa-money-check-alt text-success"></i><span class="badge badge-pill badge-success"> Rp. '.number_format($subtotal).'</span></a></li>';
                            }else {
                            echo '<li class="list-group-item border-primary"><a class="dropdown-item" href="keranjang.php"><i class="fas fa-money-check-alt text-success mr-1"></i><span class="badge badge-pill badge-success"> Rp. 0,00</span></a></li>';
                            }                
                        ?>
                        <li class="list-group-item border-primary"><a class="dropdown-item" href="keranjang.php"><i class="fas fa-search-dollar"></i> Lihat Detail</a></li>
                    </div>
                </ul>
            </div>