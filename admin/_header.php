<?php require_once "_config/config.php";
if (isset($_SESSION['admin']) OR ($_SESSION['pemilik'])) { ?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title><?= $title?></title>
        <link href="<?= base_url('admin/_assets/dist/css/styles.css'); ?>" rel="stylesheet" />
        <link href="<?=base_url('admin/_assets/dataTables/Responsive-2.2.6/css/responsive.bootstrap.min.css')?>" rel="stylesheet" type="text/css" />
        <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
        <link href="<?=base_url('admin/_assets/dataTables/datatables.css')?>" rel="stylesheet" type="text/css" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
        <!-- ikon -->
        <link rel="icon" href="<?=base_url('admin/_assets/gejulog.jpg')?>" type="image/gif" sizes="16x16">

    </head>
    <body class="sb-nav-fixed bg-light">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <a class="navbar-brand" href="<?=base_url('admin/dashboard/index.php')?>/"><i class="fas fa-drumstick-bite text-warning"></i> Ge-Ju</a>
            <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
<!--                 <div class="input-group">
                    <input class="form-control" type="text" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2" />
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="button"><i class="fas fa-search"></i></button>
                    </div>
                </div> -->
            </form>
            <!-- Navbar-->
            <ul class="navbar-nav ml-auto ml-md-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="userDropdown" href="<?= base_url('admin/auth/logout.php');?>" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="<?= base_url('admin/atur/edit.php');?>"><i class="fas fa-cogs"></i> Pengaturan</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="<?= base_url('admin/auth/logout.php');?>" onClick="return confirm('Yakin keluar dari Ge-Ju?')"><i class="fas fa-sign-out-alt"></i>&nbsp; Logout</a>
                    </div>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Navigasi Utama</div>
                            <a class="nav-link" href="<?= base_url('admin/dashboard');?>">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt mr-1"></i></div>
                                Dashboard
                            </a>
                            <a class="nav-link" href="<?= base_url('admin/menu/data.php');?>">
                                <div class="sb-nav-link-icon"><i class="fas fa-utensils mr-2"></i></div>
                                Data Menu
                            </a>
                            <a class="nav-link" href="<?= base_url('admin/pelanggan/data.php');?>">
                                <div class="sb-nav-link-icon"><i class="fas fa-users mr-1"></i></div>
                                Data Pelanggan
                            </a>
                            <a class="nav-link" href="<?= base_url('admin/transaksi/data.php');?>">
                                <div class="sb-nav-link-icon"><i class="fas fa-retweet mr-1"></i></div>
                                Transaksi / Pesanan
                            </a>
                            <?php if (isset($_SESSION["pemilik"])): ?>
                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-file-alt mr-2"></i>&nbsp;</div>
                                Laporan Penjualan
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="<?= base_url('admin/laporan/per_periode.php');?>">
                                        <div class="sb-nav-link-icon"><i class="fas fa-calendar-alt mr-2"></i></div>
                                        Per-Periode
                                    </a>
                                    <a class="nav-link" href="<?= base_url('admin/laporan/per_menu.php');?>">
                                        <div class="sb-nav-link-icon"><i class="fas fa-utensils mr-2"></i></div>
                                        Per-Menu
                                    </a>
                                    <a class="nav-link" href="<?= base_url('admin/laporan/per_pelanggan.php');?>">
                                        <div class="sb-nav-link-icon"><i class="fas fa-users mr-1"></i></div>
                                        Per-Pelanggan
                                    </a>
                                </nav>
                            </div>
                            <?php endif ?>

                            <!-- <a class="nav-link" href="<?= base_url('admin/grafik/data.php');?>">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-bar mr-2"></i></div>
                                Grafik Stok Menu
                            </a> -->
                            <?php if (isset($_SESSION["admin"])): ?>
                                <a class="nav-link" href="<?= base_url('admin/slider/data.php');?>">
                                    <div class="sb-nav-link-icon"><i class="fas fa-angle-left"></i><i class="fas fa-angle-right mr-2"></i></div>
                                    Kelola Slider
                                </a>
                            <?php endif ?>
                            <!-- <a class="nav-link" href="<?= base_url('admin/atur/edit.php');?>">
                                <div class="sb-nav-link-icon"><i class="fas fa-cogs mr-1"></i></div>
                                Pengaturan
                            </a>
                            <a class="nav-link" href="<?= base_url('admin/auth/logout.php');?>" onClick="return confirm('Yakin keluar dari Ge-Ju?')">
                                <div class="sb-nav-link-icon"><i class="fas fa-sign-out-alt mr-2"></i></div>
                                Logout
                            </a> -->
                    </div>
                    <div class="sb-sidenav-footer fixed-bottom">
                        <div class="small">Logged in as:</div>
                        <?php if (isset($_SESSION["admin"])): ?>
                        <?= $_SESSION["admin"]["nama_user"];?>
                        <?php endif ?>
                        <?php if (isset($_SESSION["pemilik"])): ?>
                        <?= $_SESSION["pemilik"]["nama_user"];?>
                        <?php endif ?>
                    </div>
                </nav>
            </div>
<?php 
} else {
    header("location: ../auth/login.php");
}
?>
