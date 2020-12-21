<?php $title = "Laporan Penjualan Per-Menu | Ge-Ju";
include_once('../_header.php');

$semuadata = array();
$menu = array();
$tot = array();
$tglm = "-";
$tgls = "-";
$status = "";
if (isset($_POST["kirim"])) {
    $tglm = $_POST["tglm"];
    $tgls = $_POST["tgls"];
    $status = $_POST["status"];

    $sql = mysqli_query($koneksi, "SELECT nama, harga, SUM(jumlah) AS terjual FROM penjualan LEFT JOIN detail_penjualan ON detail_penjualan.id_penjualan = penjualan.id_penjualan WHERE status_penjualan = '$status' AND tanggal_penjualan BETWEEN '$tglm' AND '$tgls' GROUP BY nama");

    while ($row = mysqli_fetch_assoc($sql)) {
        $semuadata[] = $row;
        $menu[] = $row['nama'];
        $tot[] = intval($row['terjual']);
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
                        <h3 class="mt-3">Laporan Penjualan Per-Menu</h3>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">
                                <a href="<?= base_url('admin/dashboard');?>"><i class="fas fa-home"></i> Home</a>
                            </li>
                            <li class="breadcrumb-item active">
                                Laporan Penjualan Per-Permenu
                            </li>
                        </ol>
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="card mb-4">
                                    <div class="card-header text-center">
                                        <i class="fas fa-calendar-alt mr-1"></i>
                                        Laporan Penjulan Per-Menu dari <strong><?= $tglm;?></strong> sd. <strong><?= $tgls;?></strong>.
                                    </div>
                                    <div class="card-body">
                                        <div  class="col-xl-12">
                                            <form action="" method="post">
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="">Tanggal Mulai</label>
                                                            <input type="date" class="form-control" name="tglm" value="<?= $tglm;?>" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="">Tanggal Selesai</label>
                                                            <input type="date" class="form-control" name="tgls" value="<?= $tgls;?>" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="">Status</label>
                                                            <select name="status" class="form-control" required>
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
                                                <table class="table table-responsive-sm table-bordered" id="tabel_per_menu">
                                                    <thead>
                                                        <tr>
                                                            <th>No</th>
                                                            <th>Nama</th>
                                                            <th>Harga</th>
                                                            <th class="text-center">Terjual</th>
                                                            <th>Total</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php $total = 0;
                                                        $ttl = 0; ?>
                                                        <?php foreach ($semuadata as $key => $value):?>
                                                        <?php $sub = $value["harga"]*$value["terjual"];
                                                        $ttl += $value["terjual"];
                                                        $total += $sub;
                                                         ?>
                                                        <tr>
                                                            <td><?= $key+1;?></td>
                                                            <td><?= $value["nama"];?></td>
                                                            <td>Rp. <?= number_format($value["harga"]);?></td>
                                                            <td class="text-center"><?= $value["terjual"];?></td>
                                                            <td>Rp. <?= number_format($sub);?></td>
                                                        </tr>
                                                        <?php endforeach ?>
                                                    </tbody>
                                                    <tfoot>
                                                        <th class="text-center" colspan="3">Total</th>
                                                        <th class="text-center"><?= $ttl; ?></th>
                                                        <th>Rp. <?= number_format($total);?></th>
                                                    </tfoot>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <a href="download_laporan_permenu.php?tglm=<?= $tglm; ?>&tgls=<?= $tgls; ?>&status=<?= $status; ?>" class="float-left">
                                            <i class="fa fa-file"></i> 
                                                Download PDF
                                        </a>
                                        <a href="cetak_permenu.php?tglm=<?= $tglm; ?>&tgls=<?= $tgls; ?>&status=<?= $status; ?>" class="float-right" target="_BLANK">
                                            <i class="fa fa-print"></i> 
                                                Cetak Laporan
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <?php if (isset($_POST["kirim"])): ?> 
                                <div class="col-xl-12">
                                    <div class="card mb-4">
                                        <div class="card-header text-center">
                                            <i class="fas fa-chart-bar mr-1"></i>
                                            Grafik Batang
                                        </div>
                                        <div class="card-body">
                                            <div  class="col-xl-12" id="per_menu">
                                        
                                            </div>
                                        </div>
                                        <div class="card-footer text-center small">
                                            <?= date("l jS \of F Y h:i:s A"); ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endif ?>
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
                var chart = Highcharts.chart('per_menu', {

                title: {
                    text: 'Grafik Penjualan Per-Menu'
                },

                subtitle: {
                    text: 'Dari <?= date("d F Y", strtotime($tglm));?> sd. <?= date("d F Y", strtotime($tgls));?>'
                },

                xAxis: {
                    categories: <?=json_encode($menu);?>
                },

                series: [{
                    type: 'column',
                    colorByPoint: true,
                    data: <?=json_encode($tot)?>,
                    showInLegend: false
                }]

                });
            </script>