<?php $title = "Konfirmasi Pembayaran | Ge-Ju";
include_once('../_header.php'); ?>

            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h3 class="mt-3">Konfirmasi Pembayaran</h3>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item">
                                <a href="<?= base_url('admin/dashboard');?>"><i class="fas fa-home"></i> Home</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="data.php">Data Penjualan</a>
                            </li>
                            <li class="breadcrumb-item active">
                                Konfirmasi Pembayaran
                            </li>
                        </ol>
                        <?php
                            $id_penjualan = $_GET['id'];

                            $sql = mysqli_query($koneksi, "SELECT * FROM pembayaran WHERE id_penjualan = '$id_penjualan'");
                            $row = mysqli_fetch_assoc($sql);
                            $ambil = mysqli_query($koneksi, "SELECT * FROM penjualan WHERE id_penjualan = '$id_penjualan'");
                            $dapet = mysqli_fetch_assoc($ambil);
                            // echo "<pre>";
                            // echo print_r($row);
                            // echo print_r($dapet);
                            // echo "</pre>";

                        ?>

                        <!-- <pre><?php print_r($detail); ?></pre> -->
                        <div class="row">
                            <div class="col-xl-8">
                                <div class="card mb-4">
                                    <div class="card-header text-center">
                                        <i class="fas fa-image mr-1"></i>
                                        Foto Bukti
                                    </div>
                                    <div class="card-body">
                                        <center>
                                            <img src="../../pelanggan/bukti_pembayaran/<?= $row['bukti'];?>" class="img-fluid" alt="Responsive image">
                                        </center>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4">
                                <div class="card mb-4">
                                    <div class="card-header text-center">
                                        <i class="fas fa-money-check-alt text-success mr-1"></i>
                                        Data Pembayaran
                                    </div>
                                    <div class="card-body">
                                        <table class="table table-responsive-sm">
                                            <tr>
                                                <th>Nama</th>
                                                <td>: <?= $row['nama'];?></td>
                                            </tr>
                                            <tr>
                                                <th>Bank</th>
                                                <td>: <?= $row['bank'];?></td>
                                            </tr>
                                            <tr>
                                                <th>Jumlah</th>
                                                <td>: Rp. <?= number_format($row['jumlah']);?></td>
                                            </tr>
                                            <tr>
                                                <th>Tanggal</th>
                                                <td>: <?= date("d F Y", strtotime($row["tanggal"]));?></td>
                                            </tr>               
                                            <tr>
                                                <th>Resi</th>
                                                <td>: <?= $dapet['resi_pengiriman'];?></td>
                                            </tr>
                                            <tr>
                                                <th>Status</th>
                                                <td>: <?= $dapet['status_penjualan'];?></td>
                                            </tr>
                                        </table>
                                        <a href="data.php" class="btn btn-success float-right"><i class="fas fa-arrow-circle-left"></i> Kembali</a>
                                    </div>
                                </div>
                            </div>
                            <?php if (!isset($_SESSION["pemilik"])): ?>
                                
                                        <?php if ($dapet['status_penjualan'] !== "Lunas"): ?>
                            <div class="col-xl-4">
                                <div class="card mb-4">
                                    <div class="card-header text-center">
                                        <i class="fas fa-pen-alt mr-1"></i>
                                        Ubah Status Pembelian
                                    </div>
                                    <div class="card-body">
                                        <form action="" method="post">
                                            <div class="form-group">
                                                <select name="status" class="form-control" required autofocus>
                                                    <option disabled selected value="">Pilih Status</option>
                                                    <option value="Lunas">Lunas</option>
                                                    <option value="Batal">Batal</option>
                                                </select>
                                                <?php 
                                                     // mengambil data barang dengan kode paling besar
                                                    $query = mysqli_query($koneksi, "SELECT max(resi_pengiriman) as kode_terbesar FROM penjualan");
                                                    $data = mysqli_fetch_assoc($query);
                                                    $kode_resi = $data['kode_terbesar'];
                                                    // mengambil angka dari kode barang terbesar, menggunakan fungsi substr
                                                    // dan diubah ke integer dengan (int)
                                                    $urutan = (int) substr($kode_resi, 3, 3);
                                                 
                                                    // bilangan yang diambil ini ditambah 1 untuk menentukan nomor urut berikutnya
                                                    $urutan++;
                                                 
                                                    // membentuk kode barang baru
                                                    // perintah sprintf("%03s", $urutan); berguna untuk membuat string menjadi 3 karakter
                                                    // misalnya perintah sprintf("%03s", 15); maka akan menghasilkan '015'
                                                    // angka yang diambil tadi digabungkan dengan kode huruf yang kita inginkan, misalnya BRG 
                                                    $huruf = "RSI";
                                                    $kode_resi = $huruf . sprintf("%03s", $urutan);
                                                    // echo "<pre>";
                                                    // echo print_r($data);
                                                    // echo "</pre>";
                                                 ?>
                                                <label for="">No Resi Pengiriman</label>
                                                <input type="text" class="form-control" name="resi" value="<?= $kode_resi; ?>" readonly>
                                            </div>
                                            <button class="btn btn-primary btn-block" name="proses"><i class="fas fa-spinner mr-1"></i>Proses</button>
                                        </form>
                                        <?php endif ?>
                            <?php endif ?>
                                        <?php
                                        if (isset($_POST["proses"])) {
                                            $resi = $_POST["resi"];
                                            $status = $_POST["status"];
                                            if ($status == "Batal" ) {
                                                $resi = "Batal";

                                                $sql = mysqli_query($koneksi, "UPDATE penjualan SET resi_pengiriman = '$resi', status_penjualan = '$status'
                                                WHERE id_penjualan = '$id_penjualan'");

                                                echo "<script>alert('Data penjualan terupdate');</script>";
                                                echo "<script>location='data.php';</script>";
                                            } else {
                                                $sql = mysqli_query($koneksi, "UPDATE penjualan SET resi_pengiriman = '$resi', status_penjualan = '$status'
                                                WHERE id_penjualan = '$id_penjualan'");

                                                echo "<script>alert('Data penjualan terupdate');</script>";
                                                echo "<script>location='data.php';</script>";
                                            }
                                        }
                                        ?>
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



