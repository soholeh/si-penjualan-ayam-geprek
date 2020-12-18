<?php $title = "Detail Penjualan | Ge-Ju";
include_once('../_header.php'); ?>

            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h3 class="mt-3">Detail Penjualan</h3>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item">
                                <a href="<?= base_url('admin/dashboard');?>"><i class="fas fa-home"></i> Home</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="data.php">Data Penjualan</a>
                            </li>
                            <li class="breadcrumb-item active">
                                Detail Penjualan
                            </li>
                        </ol>
                            <?php
                            $ambil = mysqli_query($koneksi, "SELECT * FROM penjualan JOIN user
                                ON penjualan.id_user = user.id_user
                                WHERE penjualan.id_penjualan = '$_GET[id]'");
                            $detail = mysqli_fetch_assoc($ambil);
                            ?>

                        <!-- <pre><?php print_r($detail); ?></pre> -->
                        <div class="col-xl-12">
                            <div class="card mb-4">
                                <div class="card-header text-center">
                                    <i class="fas fa-user-tag mr-1"></i>
                                    Detail Pembelian Pelanggan
                                </div>
                                <div class="card-body">
                                    <div class="row ml-auto">
                                        <div class="col-xl-4">
                                            <h3>Pembelian</h3>
                                            <p>
                                                Tanggal : <?= date("d F Y", strtotime($detail["tanggal_penjualan"]));?> </br>
                                                Total : Rp. <?= number_format($detail['total_penjualan']);?> </br>
                                                Status : <?= $detail['status_penjualan'];?> </br>
                                                Resi : <?= $detail['resi_pengiriman']; ?>
                                            </p>
                                        </div>
                                        <div class="col-xl-4">
                                            <h3>Pelanggan</h3>
                                            <strong><?= $detail['nama'];?></strong></br>
                                            <p>
                                                <?= $detail['telephone'];?> </br>
                                                <?= $detail['email'];?>
                                            </p>
                                        </div>
                                        <div class="col-xl-4">
                                            <h3>Pengiriman</h3>
                                            <strong>Jarak : <?= $detail['jarak'];?></strong></br>
                                            <p>
                                                Tarif : Rp. <?= number_format($detail['tarif']);?> </br>
                                                Alamat : <?= $detail['alamat_pengiriman'];?>
                                            </p>
                                        </div>
                                    </div>
                                    
                                    <div class="col-xl-12">
                                        <table class="table table-responsive-sm table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Nama Menu</th>
                                                    <th>Harga</th>
                                                    <th class="text-center">Jumlah</th>
                                                    <th>Subtotal</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $no = 1; ?>
                                                <?php $ambil = mysqli_query($koneksi, "SELECT * FROM detail_penjualan JOIN menu 
                                                                                ON detail_penjualan.id_menu = menu.id_menu
                                                                                WHERE detail_penjualan.id_penjualan='$_GET[id]'"); ?>
                                                <?php while ($pecah = mysqli_fetch_assoc($ambil)) { ?>
                                                <tr>
                                                    <td><?= $no; ?></td>
                                                    <td><?= $pecah['nama_menu'];?></td>
                                                    <td>Rp. <?= number_format($pecah['harga_menu']);?></td>
                                                    <td class="text-center"><?= $pecah['jumlah'];?></td>
                                                    <td>
                                                        Rp. <?= number_format($pecah['harga_menu'] * $pecah['jumlah']);?>
                                                    </td>
                                                </tr>
                                                <?php $no ++; ?>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                        <a href="data.php" class="btn btn-success float-right"><i class="fas fa-arrow-circle-left"></i> Kembali</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>

<?php include_once('../_footer.php'); ?>

        <script type="text/javascript" charset="utf8">
            $(document).ready( function () {
                $('#detail').DataTable(
                    {
                        "pageLength": 4,
                        responsive: true,
                        select: true
                    }
                    );
            } );
        </script>



