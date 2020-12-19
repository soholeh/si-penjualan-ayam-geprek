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

    $sql = mysqli_query($koneksi, "SELECT * FROM penjualan p LEFT JOIN user u ON
    p.id_user = u.id_user WHERE status_penjualan = '$status' AND tanggal_penjualan BETWEEN '$tglm' AND '$tgls'");

    while ($row = mysqli_fetch_assoc($sql)) {
        $semuadata[]=$row;
    }
$isi = "<center>";
    $isi .= "<h3 class='text-center'>Laporan Penjualan Per-Periode</h3>";
    $isi .= "<h5> Dari ".date("d F Y",strtotime($tglm))." hingga ".date("d F Y",strtotime($tgls))."</h5>";
    $isi .= "<table class='table table-responsive table-bordered' border='1'>";
    $isi .= "<thead>";
        $isi .= "<tr>
            <th>No</th>
            <th>Pelanggan</th>
            <th>Tanggal</th>
            <th>Jumlah</th>
            <th>Status</th>
        </tr>";
    $isi .= "</thead>";
    $isi .= "<tbody>";
        $total = 0;
        foreach ($semuadata as $key => $value):
        $total += $value["total_penjualan"];
        $nomor = $key+1;
        $isi .= "<tr>";
            $isi .= "<td>".$nomor.".</td>";
            $isi .= "<td>".$value["nama"]."</td>";
            $isi .= "<td>".date("d F Y", strtotime($value["tanggal_penjualan"]))."</td>";
            $isi .= "<td>Rp.".number_format($value["total_penjualan"])."</td>";
            $isi .= "<td>".$value["status_penjualan"]."</td>";
        $isi .= "</tr>";
        endforeach;
    $isi .= "</tbody>";
    $isi .= "<tfoot>";
    $isi .= "<tr>";
        $isi .= "<th colspan='3'>Total</th>";
        $isi .= "<th colspan='2'>Rp. ".number_format($total)."</th>";
    $isi .= "</tr>";
    $isi .= "</tfoot>";
$isi .= "</table>";
$isi .= "</center>";


$mpdf->WriteHTML($isi);
$mpdf->Output("laporan.pdf","I");