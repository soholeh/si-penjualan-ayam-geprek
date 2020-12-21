<?php $title = "Dashboard | Ge-Ju";
include_once('../_header.php'); 

if (isset($_SESSION['admin']) OR ($_SESSION['pemilik'])) { ?>

    <!-- <pre><?php print_r($_SESSION);?></pre> -->
    <?php if (isset($_SESSION["admin"])): ?>
    <?php 
    $nama = $_SESSION["admin"]["nama_user"];
    $email = $_SESSION["admin"]["email"];
    $status = $_SESSION["admin"]["status"];
     ?>
    <?php else: ?>
    <?php 
    $nama = $_SESSION["pemilik"]["nama_user"];
    $email = $_SESSION["pemilik"]["email"];
    $status = $_SESSION["pemilik"]["status"];
     ?>
    <?php endif ?>

            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h3 class="mt-3">Dashboard</h3>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Control Panel</li>
                        </ol>
                        <div class="row">
                            <div class="col-xl-4">
                                <div class="card bg-primary text-white mb-4">
                                    <div class="card-body">
                                        <?php 
                                            $menu = mysqli_query($koneksi,"SELECT * FROM menu LEFT JOIN kategori 
                                            ON menu.id_kategori = kategori.id_kategori");
                                            $jumlah_menu = mysqli_num_rows($menu);
                                         ?>
                                    <h1><?= $jumlah_menu; ?> <i class="fas fa-utensils text-secondary float-right fa-2x"></i></h1>
                                        Jumlah Menu
                                    </div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="<?=base_url('admin/menu/data.php') ?>">Lihat Detail</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4">
                                <div class="card bg-warning text-white mb-4">
                                    <div class="card-body">
                                        <?php 
                                            $user = mysqli_query($koneksi,"SELECT * FROM user WHERE status = 'pelanggan'");
                                            $jumlah_user = mysqli_num_rows($user);
                                         ?>
                                    <h1><?= $jumlah_user; ?> <i class="fas fa-users text-secondary float-right fa-2x"></i></h1>
                                        Jumlah Pelanggan
                                    </div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="<?=base_url('admin/pelanggan/data.php') ?>">Lihat Detail</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4">
                                <div class="card bg-success text-white mb-4">
                                    <div class="card-body">
                                        <?php 
                                            $penjualan = mysqli_query($koneksi,"SELECT * FROM penjualan");
                                            $jumlah_penjualan = mysqli_num_rows($penjualan);
                                         ?>
                                    <h1><?= $jumlah_penjualan; ?> <i class="fas fa-retweet text-secondary float-right fa-2x"></i></h1>
                                        Jumlah Penjualan
                                    </div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="<?=base_url('admin/transaksi/data.php') ?>">Lihat Detail</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-12">
                                <div class="card mb-4">
                                    <div class="card-header text-center">
                                        <i class="fas fa-chart-bar mr-1"></i>
                                        Cek Jumlah Stok Menu pada Grafik Batang
                                    </div>
                                    <div class="card-body">
                                        <div  class="col-xl-12" id="data_menu">
                                    
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-responsive-sm bg-white border-primary">
                                        <thead class="table-info">
                                            <tr>
                                                <th colspan="2"><i class="fas fa-sign-in-alt mr-1"></i>Detail Login</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th scope="row">Nama : </th>
                                                <td><?= $nama; ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Email : </th>
                                                <td class="text-info"><?= $email; ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Status : </th>
                                                <td class="text-success"><?= $status; ?></td>
                                            </tr>
                                        </tbody>
                                        <tfoot class="table-info">
                                            <tr>
                                                <td colspan="2" class="small"><?= date("l jS \of F Y h:i:s A"); ?></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>

<?php include_once('../_footer.php'); ?>
                            <?php

                            $menu = array();
                            $stok = array();

                                    $sql = mysqli_query($koneksi, "SELECT * FROM menu");

                                    while ($row = mysqli_fetch_assoc($sql)) {
                                        $menu[]=$row["nama_menu"];
                                        $stok[]=intval($row["stok_menu"]);
                                    }

                            ?>
                            <script src="<?= base_url('admin/_assets/highcharts/highcharts.js');?>"></script>
                            <script src="<?= base_url('admin/_assets/highcharts/exporting.js');?>"></script>
                            <script src="<?= base_url('admin/_assets/highcharts/export-data.js');?>"></script>
                            <script src="<?= base_url('admin/_assets/highcharts/accessibility.js');?>"></script>
                            <script type="text/javascript">
                                var chart = Highcharts.chart('data_menu', {

                                title: {
                                    text: 'Grafik Jumlah Stok Menu'
                                },

                                subtitle: {
                                    text: 'Ge-Ju'
                                },

                                xAxis: {
                                    categories: <?=json_encode($menu);?>
                                },

                                series: [{
                                    type: 'column',
                                    colorByPoint: true,
                                    data: <?=json_encode($stok)?>,
                                    showInLegend: false
                                }]

                                });
                            </script>

<?php 
} else {
    header("location: ../auth/login.php");
}
?>