<?php $title = "Grafik | Ge-Ju";
include_once('../_header.php'); ?>

            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h3 class="mt-3">Grafik</h3>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">
                                <a href="<?= base_url('admin/dashboard');?>"><i class="fas fa-home"></i> Home</a>
                            </li>
                            <li class="breadcrumb-item active">
                                Grafik Menu
                            </li>
                        </ol>
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="card mb-4">
                                    <div class="card-header text-center">
                                        <i class="fas fa-chart-bar mr-1"></i>
                                        Grafik Batang
                                    </div>
                                    <div class="card-body">
                                        <div  class="col-xl-12" id="data_menu">
                                    
                                        </div>
                                    </div>
                                    <div class="card-footer text-center small">
                                        <?= date("l jS \of F Y h:i:s A"); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-12">
<?php

$menu = array();
$stok = array();

        $sql = mysqli_query($koneksi, "SELECT * FROM menu");

        while ($row = mysqli_fetch_assoc($sql)) {
            $menu[]=$row["nama_menu"];
            $stok[]=intval($row["stok_menu"]);
        }

?>
                            <script src="../_assets/highcharts/highcharts.js"></script>
                            <script src="../_assets/highcharts/exporting.js"></script>
                            <script src="../_assets/highcharts/export-data.js"></script>
                            <script src="../_assets/highcharts/accessibility.js"></script>
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
                            </div>
                        </div>
                    </div>
                </main>

<?php include_once('../_footer.php'); ?>