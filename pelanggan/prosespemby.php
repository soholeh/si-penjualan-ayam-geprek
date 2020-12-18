<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
include('../admin/_config/config.php');
include('../admin/_assets/phpmailer/src/Exception.php');
include('../admin/_assets/phpmailer/src/PHPMailer.php');
include('../admin/_assets/phpmailer/src/SMTP.php');
$idpembelian = $_GET["id"];

            $namabukti = $_FILES["bukti"]["name"];
            $lokasibukti = $_FILES["bukti"]["tmp_name"];
            $namafix = date("YmdHis").$namabukti;
            move_uploaded_file($lokasibukti, "bukti_pembayaran/$namafix");

            $nama = $_POST["nama"];
            $bank = $_POST["bank"];
            $jumlah = $_POST["jumlah"];
            $tanggal = date("Y-m-d");

            $sql = mysqli_query($koneksi, "SELECT * FROM pembayaran WHERE id_penjualan = '$idpembelian'");
                  $dapet = mysqli_fetch_assoc($sql);
                  $idbyr = $dapet['id_pembayaran'];

            if (empty($idbyr)) {
                  // simpan pembayaran
                  $sql = mysqli_query($koneksi, "INSERT INTO pembayaran(id_penjualan,nama,bank,jumlah,tanggal,bukti)
                  VALUES ('$idpembelian','$nama','$bank','$jumlah','$tanggal','$namafix')");

                  // update status pembelian
                  $query = mysqli_query($koneksi, "UPDATE penjualan SET status_penjualan = 'Confirmed'
                  WHERE id_penjualan = '$idpembelian'");
                  
                  echo "<script>alert('Terimakasih telah mengirimkan bukti pembayaran anda');</script>";
                  echo "<script>location='riwayat.php';</script>"; 
            }
            else {
                  // update pembayaran
                  $sql = mysqli_query($koneksi, "UPDATE pembayaran SET id_penjualan = '$idpembelian', nama = '$nama', bank = '$bank', jumlah = '$jumlah', tanggal = '$tanggal', bukti = '$namafix' WHERE id_pembayaran = '$idbyr'");

                  // update status pembelian
                  $query = mysqli_query($koneksi, "UPDATE penjualan SET status_penjualan = 'Confirmed'
                  WHERE id_penjualan = '$idpembelian'");
                  $query2 = mysqli_query($koneksi, "UPDATE penjualan SET resi_pengiriman = 'Menunggu'
                  WHERE id_penjualan = '$idpembelian'");
                  
                  echo "<script>alert('Terimakasih telah mengirimkan bukti pembayaran anda');</script>";
                  echo "<script>location='riwayat.php';</script>"; 
            }

            if (($query)) {
                  $sql = mysqli_query($koneksi, "SELECT * FROM user WHERE status = 'admin'");
                  // $admin = mysqli_fetch_assoc($sql);

                  while ($admin = mysqli_fetch_assoc($sql)) {
                        $email_pengirim = 'friedchickengeju@gmail.com'; // Email pengirim nantinya
                        $nama_pengirim = 'Admin.Ge-Ju'; 
                        $email_penerima = $admin["email"];
                        $subjek = 'Pesanan Baru dari Pelanggan!';
                        $pesan = 'Terdapat pesanan baru dari pelanggan '.$nama.' cek sekarang juga! http://localhost/geju/admin/auth/login.php';

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
                        $mail->isHTML(true);
                        $mail->Subject = $subjek;
                        $mail->Body = $pesan;

                        $send = $mail->send();
                        }
                  }
        ?>