<?php $title = "Tambah Pelanggan | Ge-Ju";
include_once('../_header.php');
?>

            <div id="layoutSidenav_content">
                <main>
                    <?php 
                    if (!isset($_SESSION['admin'])) {
                        echo    "<script>
                                alert('Anda Bukan Admin');
                                location='../pelanggan/data.php';
                            </script>";
                        } 
                     ?>
                    <div class="container-fluid">
                        <h3 class="mt-4">Pelanggan</h3>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item">
                                <a href="<?= base_url('admin/dashboard');?>"><i class="fas fa-home"></i> Home</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="<?= base_url('admin/pelanggan');?>"> Data Pelanggan</a>
                            </li>
                            <li class="breadcrumb-item active">
                                Tambah Pelanggan Baru
                            </li>
                        </ol>
                        <div class="row">
                            <div class="col-md-8 offset-md-2">
                                <div class="card mb-4">
                                    <div class="card-header font-weight-bold">
                                        <i class="fas fa-users mr-1"></i>
                                        Tambah Pelanggan Baru
                                    </div>
                                    <div class="card-body">
<?php
    if (isset($_POST['save'])) 
    {
        $nama = $_POST['nama'];
        $email = $_POST['email'];
        $telp = $_POST['telephone'];
        $pass = sha1($_POST['pass']);
        $pass_kor = sha1($_POST['pass_kor']);
        $alamat = $_POST['alamat'];
    if ($pass == $pass_kor) {
        $sql = mysqli_query($koneksi, "INSERT INTO user
            (nama,email,telephone,alamat,password,status)
            VALUES('$nama','$email','$telp','$alamat','$pass','pelanggan')");

        echo "<div class='alert alert-info'>Data Tersimpan</div>";
        echo "<meta http-equiv='refresh' content='1;url=data.php'>";
    } else {
    	echo "<div class='alert alert-danger'>Password tidak sesuai.</div>";
    }
    }
?>
				                        <div class="row justify-content-between">
		                                    <div class="col-md-4"></div>
		                                    <div class="col-md-3 mb-3">
		                                        <a href="data.php" class="btn btn-success float-right"><i class="fas fa-arrow-circle-left"></i> Kembali</a>
		                                    </div>
		                                </div>
										<form action="" method="post" enctype="multipart/form-data">
										    <div class="form-group">
										        <label class="font-weight-bold">Nama</label>
										        <input type="text" class="form-control" name="nama" required autofocus>
										    </div>
										    <div class="form-group">
										        <label class="font-weight-bold">Email</label>
										        <input type="eamail" class="form-control" name="email" required>
										    </div>
										    <div class="form-group">
										        <label class="font-weight-bold">Telephone / WA</label>
										        <input type="number" class="form-control" name="telephone" required>
										    </div>
										    <div class="form-group">
										        <label class="font-weight-bold">Password</label>
										        <input type="password" class="form-control" name="pass" id="pw" required>
										    </div>
										    <div class="form-group">
										    	<input type="checkbox" onclick="lihatpw()"> Lihat Password
										    </div>
										    <div class="form-group">
										        <label class="font-weight-bold">Konfirmasi Password</label>
										        <input type="password" class="form-control" name="pass_kor" id="pwk" required>
										    </div>
										    <div class="form-group">
										    	<input type="checkbox" onclick="lihatpwk()"> Lihat Password
										    </div>
										    <div class="form-group">
										        <label class="font-weight-bold">Alamat</label>
										        <textarea class="form-control" name="alamat" required></textarea>
										    </div>
										    <button class="btn btn-primary" name="save">Simpan</button>
										</form>
		                            </div>
                        		</div>
                    		</div>
                		</div>
           			</div>
        		</main>


<?php include_once('../_footer.php'); ?>
<script>
function lihatpw() {
  var x = document.getElementById("pw");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
function lihatpwk() {
  var x = document.getElementById("pwk");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
</script>