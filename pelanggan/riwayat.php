<?php $title = "Riwayat Belanja";
include_once('../header.php'); ?>
<?php 
if (!isset($_SESSION["pelanggan"]) OR empty($_SESSION["pelanggan"])) {
    echo "<script>alert('Silahkan login dulu!');</script>";
    echo "<script>location='../auth_/login.php';</script>";
    exit();
}
?>

                <div class="col-md-9 ml-auto p-2 pt-4">
                    <div class="card border-primary">
                        <div class="card-header text-center font-weight-bold border-primary bg-primary">
                            <i class="fas fa-history mr-1"></i>
                            Riwayat Belanja <?= $_SESSION["pelanggan"]["nama"]?>
                        </div>
                        <div class="card-body">
                            <table class="table table-responsive-sm table-bordered" id="riwayat">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal</th>
                                        <th>Status</th>
                                        <th>Total</th>
                                        <th>Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $no = 1;
                                        $id_pelanggan = $_SESSION["pelanggan"]['id_user'];

                                        $sql = mysqli_query($koneksi, "SELECT * FROM penjualan WHERE id_user = '$id_pelanggan'");

                                        while($row = mysqli_fetch_assoc($sql)) {
                                    ?>
                                    <tr>
                                        <td><?= $no; ?>.</td>
                                        <td><?= date("d F Y", strtotime($row["tanggal_penjualan"]));?></td>
                                        <td><?php if ($row['status_penjualan']=='Pending'): ?>
                                            <span class="badge badge-secondary small"><?= $row['status_penjualan'];?></span>
                                            <?php endif ?>
                                            <?php if ($row['status_penjualan']=='Confirmed'): ?>
                                            <span class="badge badge-success small"><?= $row['status_penjualan'];?></span>
                                            <?php endif ?>
                                            <?php if ($row['status_penjualan']=='Lunas'): ?>
                                            <span class="badge badge-primary small"><?= $row['status_penjualan'];?></span>
                                            <?php endif ?>
                                            <?php if ($row['status_penjualan']=='Batal'): ?>
                                            <span class="badge badge-danger small"><?= $row['status_penjualan'];?></span>
                                            <?php endif ?>
                                            </br>
                                            <?php if (!empty($row['resi_pengiriman'])): ?>
                                            Resi : <?= $row['resi_pengiriman']; ?>
                                            <?php endif ?>
                                        </td>
                                        <td>Rp. <?= number_format($row['total_penjualan']);?></td>
                                        <td>
                                            <a href="nota.php?id=<?= $row["id_penjualan"]; ?>" class="btn btn-success"><i class="fas fa-file-invoice"></i></a>
                                            <?php if ($row['status_penjualan']!=="Lunas") :?>
                                            <a href="pembayaran.php?id=<?= $row["id_penjualan"]; ?>" class="btn btn-primary"><i class="fas fa-paper-plane"></i></a>
                                            <?php else: ?>
                                            <a href="lihat_pembayaran.php?id=<?= $row["id_penjualan"];?>" class="btn btn-warning"><i class="fas fa-eye"></i></a>
                                            <?php endif ?>
                                            <?php if ($row['status_penjualan']=="Confirmed"): ?>
                                            <a href="lihat_pembayaran.php?id=<?= $row["id_penjualan"];?>" class="btn btn-warning"><i class="fas fa-eye"></i></a>
                                            <?php endif ?>
                                        </td>
                                    </tr>
                                    <?php $no ++; ?>
                                    <?php } ?>
                                </tbody>
                            </table>                        
                        </div>
                    </div>
                </div>


<?php include_once('../footer.php'); ?>

        <script type="text/javascript" charset="utf8">
            $(document).ready( function () {
                $('#riwayat').DataTable(
                    {
                        "pageLength": 4,
                        responsive: true,
                        select: true
                    }
                    );
            } );
        </script>