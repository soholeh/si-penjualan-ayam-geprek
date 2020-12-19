<?php
require_once "../_config/config.php";
require_once '../vendor/autoload.php';


// echo "<pre>";
// print_r($_GET);
// echo "</pre>";

	$tglm = $_GET["tglm"];
    $tgls = $_GET["tgls"];
    $status = $_GET["status"];
    $semuadata = array();

    $sql = mysqli_query($koneksi, "SELECT * FROM penjualan p LEFT JOIN user u ON
    p.id_user = u.id_user WHERE status_penjualan = '$status' AND tanggal_penjualan BETWEEN '$tglm' AND '$tgls'");

    while ($row = mysqli_fetch_assoc($sql)) {
        $semuadata[]=$row;
    }
 ?>
 <!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Ge-Ju</title>

    <!-- Bootstrap core CSS -->
    <link href="../_assets/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Add custom CSS here -->
    <link href="../_assets/dist/css/sb-admin.css" rel="stylesheet">
    <!-- ikon -->
    <link rel="icon" href="../_assets/gejulog.jpg" type="image/gif" sizes="16x16">
  </head>

  <body>
		<div class="container">    	
		  	<h3 class="text-center">Laporan Penjualan Per-Periode</h3>
		    <h5 class="text-center">Dari <?= date("d F Y",strtotime($tglm)); ?> hingga <?= date("d F Y",strtotime($tgls)); ?>.</h5> </br>
			    <div class="table-responsive justify-content-center">
					<table class="table table-responsive-sm table-bordered">
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
					        <th colspan="3" class="text-center">Total</th>
					        <th colspan="2">Rp. <?= number_format($total);?></th>
					    </tfoot>
					</table>
			    </div>
		    </div>
			<!-- JavaScript -->
		    <script src="../js/jquery-1.10.2.js"></script>
		    <script src="../js/bootstrap.js"></script>
			<script>
			        window.print();
			</script>


  </body>
</html>
