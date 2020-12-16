<?php $title = "Detail Menu";
include_once('../header.php'); ?>
<?php
    $id_menu = $_GET["id"];

    $ambil = mysqli_query($koneksi, "SELECT * FROM menu WHERE id_menu='$id_menu'");
    $detail = mysqli_fetch_assoc($ambil);

    // echo "<pre>";
    // print_r($detail);
    // echo "</pre>";
?>

                <div class="col-md-5 ml-auto p-2 pt-4">
                    <div class="card mb-4 border-primary">
                        <div class="card-header text-center font-weight-bold border-primary bg-primary">
                            <i class="fas fa-image mr-1"></i>
                            Foto Menu
                        </div>
                            <img src="../admin/menu/foto_menu/<?= $detail['foto_menu'];?>" class="d-block w-100 img-responsive" height="345">
                    </div>
                </div>

                <div class="col-md-4 ml-auto p-2 pt-4">
                    <div class="card mb-4 border-primary">
                        <div class="card-header text-center font-weight-bold border-primary bg-primary">
                            <i class="fas fa-info-circle mr-1"></i>
                            Informasi
                        </div>
                            <div class="container">
                                <h2><?= $detail['nama_menu'];?></h2>
                                <h4>Rp . <?= number_format($detail['harga_menu']);?></h4>
                                <h5>Tersedia : <?= number_format($detail['stok_menu']);?></h5>
                                <p><?= $detail['deskripsi_menu'];?></p>
                                <form action="" method="post">
                                    <div class="form-gorup">
                                        <div class="input-group">
                                            <?php if ($detail['stok_menu'] == 0): ?>
                                            <div class="alert alert-info">Stok Habis</div>
                                            <?php else: ?>
                                            <input type="number" class="form-control mb-4" name="jumlah"
                                            max="<?= $detail['stok_menu'];?>" min="0" value="1">
                                            <div class="col-md-3 mb-4">
                                                <button class="btn btn-primary btn-block" name="pesan"><i class="fas fa-cart-arrow-down"></i></button>
                                            </div>   
                                            <?php endif ?>
                                        </div>
                                    </div>
                                </form>
                                <?php
                                error_reporting(0);
                                // jika tombol dipesan
                                if (isset($_POST["pesan"])) {
                                    
                                    $jumlah = $_POST["jumlah"];
                                    $_SESSION["keranjang"][$id_menu] += $jumlah;
                                    $query = mysqli_query($koneksi, "UPDATE menu SET stok_menu = stok_menu-$jumlah
                                        WHERE id_menu='$id_menu'");

                                    echo "<script>alert('Menu telah masuk ke keranjang belanja');</script>";
                                    echo "<script>location='../pelanggan/keranjang.php';</script>";
                                }
                                ?>
                            </div>
                    </div>
                </div>

<?php include_once('../footer.php'); ?>