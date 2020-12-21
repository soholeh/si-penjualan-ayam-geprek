<?php
require_once "../_config/config.php";
require_once '../vendor/autoload.php';

$mpdf = new \Mpdf\Mpdf();


// echo "<pre>";
// print_r($_GET);
// echo "</pre>";

	$tglm = $_GET["tglm"];
    $tgls = $_GET["tgls"];
    $status = $_GET["status"];
    $semuadata = array();

    $sql = mysqli_query($koneksi, "SELECT nama, harga, SUM(jumlah) AS terjual FROM penjualan LEFT JOIN detail_penjualan ON detail_penjualan.id_penjualan = penjualan.id_penjualan WHERE status_penjualan = '$status' AND tanggal_penjualan BETWEEN '$tglm' AND '$tgls' GROUP BY nama");

    while ($row = mysqli_fetch_assoc($sql)) {
        $semuadata[]=$row;
    }
$isi = "<center>";
    $isi .= "<h3 class='text-center'>Laporan Penjualan Per-Menu</h3>";
    $isi .= "<h5> Dari ".date("d F Y",strtotime($tglm))." hingga ".date("d F Y",strtotime($tgls))."</h5>";
    $isi .= "<table class='table table-responsive table-bordered' border='1'>";
    $isi .= "<thead>";
        $isi .= "<tr>
            <th>No</th>
            <th>Nama</th>
            <th>Harga</th>
            <th>Terjual</th>
            <th>Total</th>
        </tr>";
    $isi .= "</thead>";
    $isi .= "<tbody>";
			$total = 0;
            $ttl = 0;
            foreach ($semuadata as $key => $value):
            $sub = $value["harga"]*$value["terjual"];
            $ttl += $value["terjual"];
            $total += $sub;
            $nomor = $key+1;
        $isi .= "<tr>";
            $isi .= "<td>".$nomor.".</td>";
            $isi .= "<td>".$value["nama"]."</td>";
            $isi .= "<td>".$value["harga"]."</td>";
            $isi .= "<td>".$value["terjual"]."</td>";
            $isi .= "<td>Rp. ".number_format($sub)."</td>";
        $isi .= "</tr>";
        endforeach;
    $isi .= "</tbody>";
    $isi .= "<tfoot>";
    $isi .= "<tr>";
        $isi .= "<th colspan='3'>Total</th>";
        $isi .= "<th>".$ttl."</th>";
        $isi .= "<th colspan='2'>Rp. ".number_format($total)."</th>";
    $isi .= "</tr>";
    $isi .= "</tfoot>";
$isi .= "</table>";
$isi .= "</center>";


$mpdf->WriteHTML($isi);
$mpdf->Output("laporan-permenu.pdf","I");