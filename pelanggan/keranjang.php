<?php $title = "Keranjang Belanja";
include_once('../header.php'); 

// echo "</br>";
// echo "</br>";
// echo "</br>";
// echo "<pre>";
// print_r($_SESSION['keranjang']);
// echo "</pre>";
if (empty($_SESSION["keranjang"]) OR !isset($_SESSION["keranjang"])) {
    echo "<script>alert('Keranjang anda masih kosong, silahkan belanja dulu');</script>";
    echo "<script>location='../index.php';</script>";
}
?>

                <div class="col-md-9 ml-auto p-2 pt-4">
                    <div class="card border-primary">
                        <div class="card-header text-center font-weight-bold border-primary bg-primary">
                            <i class="fas fa-shopping-cart mr-1"></i>
                            Keranjang Belanja Anda
                        </div>
                        <div class="table-responsive">
                            <table class="table table-responsive-sm table-hover table-condensed table-bordered mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-center">Menu</th>
                                        <th class="text-left">Details</th>
                                        <th class="text-center">QTY</th>
                                        <th class="text-right">Total</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php $subtotal = 0; ?>
                                    <?php foreach ($_SESSION['keranjang'] as $id_menu => $jumlah): ?>
                                        <?php   $sql = "SELECT * FROM menu WHERE id_menu='$id_menu'";
                                                $result = mysqli_query($koneksi, $sql);
                                                $row = mysqli_fetch_assoc($result);
                                                $total = $row["harga_menu"]*$jumlah;
                                                $subtotal += $total;
                                        ?>
                                    <tr>
                                        <td class="text-center"><img src="../admin/menu/foto_menu/<?= $row['foto_menu'];?>" style="width: 5rem;"></td>
                                        <td><?= $row['nama_menu'];?> </br>Rp. <?= number_format($row['harga_menu']);?></td>
                                        <td class="text-center"><?= $jumlah;?></td>
                                        <td class="text-right">Rp. <?= number_format($total);?></td>
                                        <td class="text-center">
                                            <a href="hapus_keranjang.php?id=<?= $id_menu?>&jumlah=<?= $jumlah; ?>" class="btn btn-default" onClick="return confirm('Yakin akan menghapus menu <?= $row['nama_menu']; ?> dari keranjang?')"><i class="fas fa-trash-alt"></i></a>
                                        </td>
                                    </tr>
                                    <?php endforeach ?>
                                    <tr class="bg-primary font-weight-bold">
                                        <td class="text-center" colspan="2">Sub Total</td>
                                        <td colspan="2" class="text-right">Rp. <?= number_format($subtotal);?></td>
                                        <td></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer">
                            <a href="../index.php" class="btn btn-success float-left"><i class="fas fa-cart-plus"></i> Lanjut Belanja</a>
                            <a href="checkout.php" class="btn btn-primary float-right"><i class="fas fa-shopping-basket"></i> Checkout</a>
                        </div>
                    </div>
                </div>

<?php include_once('../footer.php'); ?>
