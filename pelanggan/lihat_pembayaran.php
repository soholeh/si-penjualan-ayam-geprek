<?php $title = "Lihat Pembayaran";
include_once('../header.php'); ?>
<?php
$id_pembelian = $_GET["id"];

$sql = mysqli_query($koneksi, "SELECT * FROM pembayaran 
LEFT JOIN penjualan
ON pembayaran.id_penjualan = penjualan.id_penjualan
WHERE penjualan.id_penjualan = '$id_pembelian'");
$row = mysqli_fetch_assoc($sql);

// echo "<pre>";
// print_r($row);
// echo "</pre>";
// jika blm ada data pembayaran
if (empty($row)) {
    echo "<script>alert('Belum ada data pembayaran');</script>";
    echo "<script>location='riwayat.php';</script>";
    exit();
}
// jika data pelanggan yang bayar tidak sesuai dengan yang login
// echo "<pre>";
// print_r($_SESSION);
// echo "</pre>";

if ($_SESSION["pelanggan"]['id_user']!==$row["id_user"]) {
    echo "<script>alert('Anda tidak berhak melihat pembayaran orang lain');</script>";
    echo "<script>location='riwayat.php';</script>";
    exit();
}
?>

                <div class="col-md-5 ml-auto p-2 pt-4">
                    <div class="card border-primary">
                        <div class="card-header text-center font-weight-bold border-primary bg-primary">
                            <i class="fas fa-image mr-1"></i>
                            Foto Bukti
                        </div>
                        <div class="card-body">
                            <img src="bukti_pembayaran/<?= $row["bukti"];?>" class="img-thumbnail">
                        </div>
                    </div>
                </div>

                <div class="col-md-4 ml-auto p-2 pt-4">
                    <div class="card border-primary">
                        <div class="card-header text-center font-weight-bold border-primary bg-primary">
                            <i class="fas fa-file-invoice-dollar mr-1"></i>
                            Data Pembayaran
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <tr>
                                    <th>Nama</th>
                                    <td><?= $row["nama"];?></td>
                                </tr>
                                <tr>
                                    <th>Bank</th>
                                    <td><?= $row["bank"];?></td>
                                </tr>
                                <tr>
                                    <th>Tanggal</th>
                                    <td><?= date("d F Y", strtotime($row["tanggal"]));?></td>
                                </tr>
                                <tr>
                                    <th>Jumlah</th>
                                    <td>Rp. <?= number_format($row["jumlah"]);?></td>
                                </tr>
                            </table>
                            <div class="col-md-5 float-right">                                   
                                <a href="riwayat.php" class="btn btn-success btn-block"><i class="fas fa-arrow-circle-left"></i> Kembali</a>
                            </div>
                        </div>
                    </div>
                </div>


<?php include_once('../footer.php'); ?>