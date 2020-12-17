<?php $title = "Checkout";
include_once('../header.php'); 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
include('../admin/_assets/phpmailer/src/Exception.php');
include('../admin/_assets/phpmailer/src/PHPMailer.php');
include('../admin/_assets/phpmailer/src/SMTP.php');
?>
<?php
if (!isset($_SESSION['pelanggan'])) {
    echo "<script>alert('Anda harus login');</script>";
    echo "<script>location='../auth_/login.php';</script>";
    header('location:../auth_/login.php');
    exit();
}
if (empty($_SESSION["keranjang"]) OR !isset($_SESSION["keranjang"])) {
    echo "<script>alert('Keranjang anda masih kosong, silahkan belanja dulu');</script>";
    echo "<script>location='riwayat.php';</script>";
}
?>

                <div class="col-md-9 ml-auto p-2 pt-4">
                    <div class="card border-primary">
                        <div class="card-header text-center font-weight-bold border-primary bg-primary">
                            <i class="fas fa-shopping-cart mr-1"></i>
                            Keranjang Belanja Anda
                        </div>
                            <div class="container">
                            <table class="table table-responsive-sm table-hover table-condensed">
                                <thead>
                                    <tr>
                                        <th>Menu</th>
                                        <th>Details</th>
                                        <th>QTY</th>
                                        <th>Total</th>
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
                                        <td><img src="../admin/menu/foto_menu/<?= $row['foto_menu'];?>" style="width: 5rem;"></td>
                                        <td><?= $row['nama_menu'];?> </br>Rp. <?= number_format($row['harga_menu']);?></td>
                                        <td><?= $jumlah;?></td>
                                        <td><?= number_format($total);?></td>
                                    </tr>
                                    <?php endforeach ?>
                                </tbody>
                                <tfoot>
                                    <tr class="bg-primary">
                                        <th colspan="3">Total Belanja</th>
                                        <th>Rp. <?= number_format($subtotal);?></th>
                                    </tr>
                                </tfoot>
                            </table>
                                <form action="" method="post">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input class="form-control" type="text" placeholder="<?= $_SESSION["pelanggan"]['nama'];?>" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input class="form-control" type="text" placeholder="<?= $_SESSION["pelanggan"]['telephone'];?>" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <select name="id_ongkir" class="custom-select" required>
                                                <option value="">Pilih Ongkir</option>
                                                <?php
                                                $sql = "SELECT * FROM ongkir";
                                                $result = mysqli_query($koneksi, $sql);
                                                while ($ongkir = mysqli_fetch_assoc($result)) {
                                                ?>
                                                <option value="<?= $ongkir['id_ongkir']; ?>">
                                                    <?= $ongkir['jarak'];?> - Rp. <?= number_format($ongkir['tarif']);?> 
                                                </option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="">Alamat Lengkap Pengiriman</label>
                                    <textarea name="alamat_pengiriman" class="form-control" placeholder="Masukan alamat lengkap pengiriman anda" required></textarea>
                                </div>
                                    <button class="btn btn-primary mb-3" name="checkout"><i class="fas fa-shopping-basket"></i> Checkout</button>                           
                                    <a href="keranjang.php" class="btn btn-success float-right"><i class="fas fa-arrow-circle-left"></i> Kembali</a>                  
                                </form>
                            </div>
                    </div>
                </div>


        <!-- <pre><?php print_r($_SESSION['pelanggan'])?></pre>
 -->
<?php include_once('../footer.php'); ?>

                <p hidden>
                <?php
                if (isset($_POST['checkout'])) {
                    $id = $_SESSION["pelanggan"]["id_user"];
                    $id_ongkir = $_POST["id_ongkir"];
                    $tanggal_penjualan = date("Y-m-d");
                    $alamat_pengiriman = $_POST['alamat_pengiriman'];

                    $sql = "SELECT * FROM ongkir WHERE id_ongkir='$id_ongkir'";
                    $result = mysqli_query($koneksi, $sql);
                    $aryongkir = mysqli_fetch_assoc($result);
                    $jarak = $aryongkir['jarak'];
                    $tarif = $aryongkir['tarif'];

                    $total_penjualan = $subtotal + $tarif;

                    $sql = mysqli_query($koneksi, "INSERT INTO penjualan
                    (id_user,id_ongkir,tanggal_penjualan,total_penjualan,jarak,tarif,alamat_pengiriman)
                    VALUES('$id','$id_ongkir','$tanggal_penjualan','$total_penjualan','$jarak','$tarif','$alamat_pengiriman')");

                    // mendapatkan id_penjualan barusan
                    $id_penjualan_barusan = mysqli_insert_id($koneksi);

                    foreach ($_SESSION["keranjang"] as $id_menu => $jumlah) {

                        $sql = "SELECT * FROM menu WHERE id_menu='$id_menu'";
                        $result = mysqli_query($koneksi, $sql);
                        $permenu = mysqli_fetch_assoc($result);

                        $nama = $permenu['nama_menu'];
                        $harga = $permenu['harga_menu'];

                        $subharga = $permenu['harga_menu']*$jumlah;

                        $sql = mysqli_query($koneksi, "INSERT INTO detail_penjualan
                        (id_penjualan, id_menu, nama, harga, subharga, jumlah)
                        VALUES('$id_penjualan_barusan','$id_menu','$nama','$harga','$subharga','$jumlah')");

                        $query = mysqli_query($koneksi, "UPDATE menu SET stok_menu = stok_menu-$jumlah
                        WHERE id_menu='$id_menu'");
                }
                if (($query)) {
                    $email_pengirim = 'friedchickengeju@gmail.com'; // Email pengirim nantinya
                    $nama_pengirim = 'Admin.Ge-Ju'; 
                    $email_penerima = $_SESSION["pelanggan"]["email"];
                    $subjek = 'Konfirmasi Pembayaran!';
                    $pesan = 'Silahkan Melakukan konfirmasi pembayaran dengan mengirimkan bukti pembayaran anda! http://localhost/geju/pelanggan/riwayat.php';

                    $mail = new PHPMailer;
                    $mail->isSMTP();

                    $mail->Host = 'smtp.gmail.com';
                    $mail->Username = $email_pengirim;
                    $mail->Password = 'vqgltuabcjinfrle';
                    $mail->Port = 465;
                    $mail->SMTPAuth = true;
                    $mail->SMTPSecure = 'ssl';
                    $mail->SMTPDebug = 2;



                    $mail->setFrom($email_pengirim, $email_pengirim);
                    $mail->addAddress($email_penerima);
                    $mail->isHTML(false);
                    $mail->Subject = $subjek;
                    $mail->Body = $pesan;

                    $send = $mail->send();
                }
                    
                    // mengkosongkan keranjang
                    unset($_SESSION["keranjang"]);
                    
                    echo "<script>alert('Pembelian Berhasil');</script>";
                    echo "<script>location='nota.php?id=$id_penjualan_barusan';</script>";
                }
                ?>
                </p>