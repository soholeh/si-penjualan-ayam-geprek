<?php $title = "Laporan Penjualan Per-Menu | Ge-Ju";
include_once('../_header.php');

$semuadata = array();
$tgl = array();
$tot = array();
$tglm = "-";
$tgls = "-";
$status = "";
if (isset($_POST["kirim"])) {
    $tglm = $_POST["tglm"];
    $tgls = $_POST["tgls"];
    $status = $_POST["status"];

    $sql = mysqli_query($koneksi, "SELECT * FROM penjualan p LEFT JOIN user u ON
    p.id_user = u.id_user WHERE status_penjualan = '$status' AND tanggal_penjualan BETWEEN '$tglm' AND '$tgls'");

    while ($row = mysqli_fetch_assoc($sql)) {
        $semuadata[]=$row;
        $tgl[]=date("d F Y", strtotime($row["tanggal_penjualan"]));
        $tot[]=intval($row["total_penjualan"]);
    }

    // echo "<pre>";
    // print_r($semuadata);
    // echo "</pre>";
}
?>

            <div id="layoutSidenav_content">
                <?php 
                    if (!isset($_SESSION['pemilik'])) {
                        echo    "<script>
                                alert('Anda Bukan Pemilik');
                                location='../dashboard';
                            </script>";
                        } 
                     ?>
                <main>
                    <div class="container-fluid">
                        <h3 class="mt-3">Laporan Penjualan Per-Periode</h3>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">
                                <a href="<?= base_url('admin/dashboard');?>"><i class="fas fa-home"></i> Home</a>
                            </li>
                            <li class="breadcrumb-item active">
                                Laporan Penjualan Per-Periode
                            </li>
                        </ol>
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="card mb-4">
                                    <div class="card-header text-center">
                                        <i class="fas fa-calendar-alt mr-1"></i>
                                        Laporan Penjulan Per-Periode dari <strong><?= $tglm;?></strong> sd. <strong><?= $tgls;?></strong>.
                                    </div>
                                    <div class="card-body">
                                        <div  class="col-xl-12">
                                            <form action="" method="post">
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="">Tanggal Mulai</label>
                                                            <input type="date" class="form-control" name="tglm" value="<?= $tglm;?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="">Tanggal Selesai</label>
                                                            <input type="date" class="form-control" name="tgls" value="<?= $tgls;?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="">Status</label>
                                                            <select name="status" class="form-control">
                                                                <option disabled selected value="">Pilih Status</option>
                                                                <option value="Pending" <?= $status == "Pending"?"selected":""; ?>>Pending</option>
                                                                <option value="Confirmed" <?= $status == "Confirmed"?"selected":""; ?>>Confirmed</option>
                                                                <option value="Lunas" <?= $status == "Lunas"?"selected":""; ?>>Lunas</option>
                                                                <option value="Batal" <?= $status == "Batal"?"selected":""; ?>>Batal</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label class="hide">&nbsp;</label>
                                                            <button class="btn btn-primary btn-block" name="kirim">Tampilkan</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                            <div class="table-responsive">
                                                <table class="table table-responsive-sm table-bordered" id="tabel_per_periode">
                                                    <thead>
                                                        <tr>
                                                            <th>No</th>
                                                            <th>Pelanggan</th>
                                                            <th>Tanggal</th>
                                                            <th>Jumlah</th>
                                                            <th>Status</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php $total = 0; ?>
                                                        <?php foreach ($semuadata as $key => $value):?>
                                                        <?php $total += $value["total_penjualan"]; ?>
                                                        <tr>
                                                            <td><?= $key+1;?></td>
                                                            <td><?= $value["nama"];?></td>
                                                            <td><?= date("d F Y", strtotime($value["tanggal_penjualan"]));?></td>
                                                            <td>Rp. <?= number_format($value["total_penjualan"]);?></td>
                                                            <td><?= $value["status_penjualan"];?></td>
                                                        </tr>
                                                        <?php endforeach ?>
                                                    </tbody>
                                                    <tfoot>
                                                        <th class="text-center" colspan="3">Total</th>
                                                        <th colspan="2">Rp. <?= number_format($total);?></th>
                                                    </tfoot>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <a href="download_laporan_period.php?tglm=<?= $tglm; ?>&tgls=<?= $tgls; ?>&status=<?= $status; ?>" class="float-left">
                                            <i class="fa fa-file"></i> 
                                                Download PDF
                                        </a>
                                        <a href="cetak.php?tglm=<?= $tglm; ?>&tgls=<?= $tgls; ?>&status=<?= $status; ?>" class="float-right" target="_BLANK">
                                            <i class="fa fa-print"></i> 
                                                Cetak Laporan
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-12">
                                <div class="card mb-4">
                                    <div class="card-header text-center">
                                        <i class="fas fa-chart-line mr-1"></i>
                                        Grafik Garis
                                    </div>
                                    <div class="card-body">
                                        <div  class="col-xl-12" id="per_periode">
                                    
                                        </div>
                                    </div>
                                    <div class="card-footer text-center small">
                                        <?= date("l jS \of F Y h:i:s A"); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>

<?php include_once('../_footer.php'); ?>

        <!-- <script type="text/javascript" charset="utf8">
            $(document).ready( function () {
                $('#tabel_per_periode').DataTable(
                    {
                        "pageLength": 10,
                        responsive: false,
                        select: true
                    }
                    );
            } );
        </script> -->

            <script src="../_assets/highcharts/highcharts.js"></script>
            <script src="../_assets/highcharts/exporting.js"></script>
            <script src="../_assets/highcharts/export-data.js"></script>
            <script src="../_assets/highcharts/accessibility.js"></script>
            <script type="text/javascript">
            Highcharts.chart('per_periode', {
            chart: {
                type: 'area'
            },
            title: {
                text: 'Grafik Penjualan Per-Periode dari <strong><?= $tglm;?></strong> sd. <strong><?= $tgls;?></strong>.'
            },
            subtitle: {
                text: 'Source: Ge-Ju.com'
            },
            xAxis: {
                categories: <?=json_encode($tgl); ?>,
                tickmarkPlacement: 'on',
                title: {
                    enabled: false
                }
            },
            yAxis: {
                title: {
                    text: 'Ribu Rupiah'
                },
                labels: {
                    formatter: function () {
                        return this.value;
                    }
                }
            },
            tooltip: {
                split: true,
                valueSuffix: ' Ribu Rupiah'
            },
            plotOptions: {
                area: {
                    stacking: 'normal',
                    lineColor: '#666666',
                    lineWidth: 1,
                    marker: {
                        lineWidth: 1,
                        lineColor: '#666666'
                    }
                }
            },
            series: [{
                name: 'Total',
                data: <?=json_encode($tot); ?>
            }]
        });
        </script>