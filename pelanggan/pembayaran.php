<?php $title = "Konfirmasi Pembayaran";
include_once('../header.php'); ?>
<?php 
if (!isset($_SESSION["pelanggan"]) OR empty($_SESSION["pelanggan"])) {
    echo "<script>alert('Silahkan login dulu!');</script>";
    echo "<script>location='login.php';</script>";
    exit();
}

// mendapatkan id_pembelian dari url
$idpem = $_GET["id"];
$sql = mysqli_query($koneksi, "SELECT * FROM penjualan WHERE id_penjualan = '$idpem'");
$detpem = mysqli_fetch_assoc($sql);

// mendapatkan id_pelanggan yg beli
$id_pelanggan_beli = $detpem["id_user"];

// mendapatkan id_pelanggan yg login
$id_pelanggan_login = $_SESSION["pelanggan"]["id_user"];

// mendapatkan status_pembelian pelanggan
$status_pembelian = $detpem["status_penjualan"];

$status = "Confirmed";

if ($id_pelanggan_beli !== $id_pelanggan_login) {
    echo "<script>alert('Jangan nakal ya!');</script>";
    echo "<script>location='riwayat.php';</script>";
    exit();
}
if ($status_pembelian == $status) {
    echo "<script>alert('Anda telah mengirim bukti pembayaran, mohon menunggu konfirmasi');</script>";
    echo "<script>location='riwayat.php';</script>";
    exit();
}
?>

            <div class="col-md-5 offset-md-2 p-2 pt-4">
                <div class="card border-primary">
                    <div class="card-header text-center font-weight-bold border-primary bg-primary">
                        <i class="fas fa-money-check-alt mr-1"></i>
                        Konfirmasi Pembayaran
                    </div>
                    <div class="card-body">
                        <div class="alert alert-info">Total tagihan Anda <strong>Rp. <?= number_format($detpem["total_penjualan"]); ?></strong></div>
                            <form action="prosespemby.php?id=<?= $idpem;?>" method="post" enctype="multipart/form-data" class="small">
                                <div class="form-group">
                                    <label for="">Nama Penyetor</label>
                                    <input type="text" class="form-control" name="nama" required autofocus>
                                </div>
                                <div class="form-group">
                                    <label for="">Bank</label>
                                    <input type="text" class="form-control" name="bank" required>
                                </div>
                                <div class="form-group">
                                    <label for="">Jumlah Pembayaran (Rp)</label>
                                    <input type="number" class="form-control" name="jumlah" min="1" value="<?= $detpem['total_penjualan']; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="">Foto Bukti</label>
                                    <input type="file" class="form-control" name="bukti" required>
                                </div>
                                <button class="btn btn-primary" type="submit"><i class="fas fa-paper-plane"></i> Kirim</button>
                                <a href="riwayat.php" class="btn btn-success float-right"><i class="fas fa-arrow-circle-left"></i> Kembali</a> 
                            </form>                      
                        </div>
                    </div>
                </div>
            </div>

<?php include_once('../footer.php'); ?>
