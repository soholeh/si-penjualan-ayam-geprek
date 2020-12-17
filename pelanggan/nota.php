<?php $title = "Nota Pelanggan";
include_once('../header.php'); ?>

                <div class="col-md-9 ml-auto p-2 pt-4">
                    <div class="card border-primary">
                        <div class="card-header text-center font-weight-bold border-primary bg-primary">
                            <i class="fas fa-file-invoice mr-1"></i>
                            Nota
                        </div>
                        <div class="card-body">
                            <?php
                            $ambil = mysqli_query($koneksi, "SELECT * FROM penjualan JOIN user
                                ON penjualan.id_user = user.id_user
                                WHERE penjualan.id_penjualan = '$_GET[id]'");
                            $detail = mysqli_fetch_assoc($ambil);
                            ?>

                            <?php 
                            $idpelangganygbeli = $detail["id_user"];

                            $idpelangganyglogin = $_SESSION["pelanggan"]["id_user"];

                            if ($idpelangganygbeli !== $idpelangganyglogin) {
                                echo "<script>alert('Jangan nakal ya');</script>";
                                echo "<script>location='riwayat.php';</script>";
                                exit();
                            }
                            ?>


                            <div class="row">
                                <div class="col-md-4">
                                <h3>Pembelian</h3>
                                    <strong>No. Pembelian : <?= $detail['id_penjualan'];?></strong></br>
                                    Tanggal : <?= date("d F Y", strtotime($detail["tanggal_penjualan"]));?> </br>
                                    Total : Rp. <?= number_format($detail['total_penjualan']);?>
                                </div>
                                <div class="col-md-4">
                                <h3>Pelanggan</h3>
                                    <strong><?= $detail['nama'];?></strong></br>
                                    <p>
                                        <?= $detail['telephone'];?></br>
                                        <?= $detail['email'];?>
                                    </p>
                                </div>
                                <div class="col-md-4">
                                <h3>Pengiriman</h3>
                                    <strong>Jarak : <?= $detail['jarak'];?></strong></br>
                                    Ongkos Kirim : Rp. <?= number_format($detail['tarif']);?></br>
                                    Alamat : <?= $detail['alamat_pengiriman'];?>
                                </div>
                            </div>
                            <table class="table table-responsive-sm table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Menu</th>
                                        <th>Harga</th>
                                        <th>Jumlah</th>
                                        <th>Sub Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; ?>
                                    <?php $ambil = mysqli_query($koneksi, "SELECT * FROM detail_penjualan WHERE id_penjualan='$_GET[id]'"); 
                                                                    ?>
                                    <?php while ($pecah = mysqli_fetch_assoc($ambil)) { ?>
                                    <tr>
                                        <td><?= $no; ?></td>
                                        <td><?= $pecah['nama'];?></td>
                                        <td>Rp. <?= number_format($pecah['harga']);?></td>
                                        <td><?= $pecah['jumlah'];?></td>
                                        <td>Rp. <?= number_format($pecah['subharga']);?></td>
                                    </tr>
                                    <?php $no ++; ?>
                                    <?php } ?>
                                </tbody>
                            </table>
                            <div class="alert alert-info">
                                <p>
                                    Silahkan melakukan pembayaran Rp. <?= number_format($detail['total_penjualan']);?>
                                    ke </br>
                                    <strong>BANK BNI 134-001089-3278 AN. Haryadi</strong>
                                </p>
                            </div>
                            <?php if ($detail['status_penjualan']=='Pending'): ?>
                                <div class="col-md-5">
                                    <a href="riwayat.php" class="btn btn-primary btn-block"><i class="fas fa-paper-plane"></i> Konfirmasi Pembayaran</a>
                                </div>
                            <?php else: ?>
                                <div class="col-md-3">                                   
                                    <a href="riwayat.php" class="btn btn-success btn-block"><i class="fas fa-arrow-circle-left"></i> Kembali</a>
                                </div>
                            <?php endif ?>
                        </div>
                    </div>
                </div>

<?php include_once('../footer.php'); ?>