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

    $sql = mysqli_query($koneksi, "SELECT nama_user, SUM(subharga) AS pendapatan FROM penjualan LEFT JOIN user ON penjualan.id_user = user.id_user LEFT JOIN detail_penjualan ON detail_penjualan.id_penjualan = penjualan.id_penjualan WHERE status_penjualan = '$status' AND tanggal_penjualan BETWEEN '$tglm' AND '$tgls' GROUP BY nama_user ORDER BY pendapatan DESC");

    while ($row = mysqli_fetch_assoc($sql)) {
        $semuadata[]=$row;
    }
$isi = "<center>";
    $isi .= "<h3 class='text-center'>Laporan Penjualan Per-Pelanggan</h3>";
    $isi .= "<h5> Dari ".date("d F Y",strtotime($tglm))." hingga ".date("d F Y",strtotime($tgls))."</h5>";
    $isi .= "<table class='table table-responsive table-bordered' border='1'>";
    $isi .= "<thead>";
        $isi .= "<tr>
            <th>No</th>
            <th>Nama</th>
            <th>Pendapatan</th>
        </tr>";
    $isi .= "</thead>";
    $isi .= "<tbody>";
            $ttl = 0;
            foreach ($semuadata as $key => $value):

            $ttl += $value["pendapatan"];

            $nomor = $key+1;
        $isi .= "<tr>";
            $isi .= "<td>".$nomor.".</td>";
            $isi .= "<td>".$value["nama_user"]."</td>";
            $isi .= "<td>Rp. ".number_format($value["pendapatan"])."</td>";
        $isi .= "</tr>";
        endforeach;
    $isi .= "</tbody>";
    $isi .= "<tfoot>";
    $isi .= "<tr>";
        $isi .= "<th colspan='2'>Total</th>";
        $isi .= "<th>Rp. ".number_format($ttl)."</th>";
    $isi .= "</tr>";
    $isi .= "</tfoot>";
$isi .= "</table>";
$isi .= "</center>";


$mpdf->WriteHTML($isi);
$mpdf->Output("laporan-perPelanggan.pdf","I");