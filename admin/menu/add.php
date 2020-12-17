<?php $title = "Tambah Menu | Ge-Ju";
include_once('../_header.php');
$datakategori = array();
$sql = mysqli_query($koneksi, "SELECT * FROM kategori");
while ($row = mysqli_fetch_assoc($sql)) {
    $datakategori[] = $row;
}

// echo "<pre>";
// print_r($datakategori);
// echo "</pre>";
?>

            <div id="layoutSidenav_content">
                <main>
                    <?php 
                    if (!isset($_SESSION['admin'])) {
                        echo    "<script>
                                alert('Anda Bukan Admin');
                                location='../menu/data.php';
                            </script>";
                        } 
                     ?>
                    <div class="container-fluid">
                        <h3 class="mt-4">Menu</h3>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item">
                                <a href="<?= base_url('admin/dashboard');?>"><i class="fas fa-home"></i> Home</a>
                            </li>
                            <li class="breadcrumb-item active">
                                <a href="<?= base_url('admin/menu');?>"> Data Menu</a>
                            </li>
                            <li class="breadcrumb-item active">
                                Tambah Menu Baru
                            </li>
                        </ol>

                        <div class="row">
                            <div class="col-md-8 offset-md-2">
                            	<div class="card mb-4">
                                <div class="card-header font-weight-bold">
                                    <i class="fas fa-utensils mr-1"></i>
                                    Tambah Menu Baru
                                </div>
                                <div class="card-body">
<?php
    if (isset($_POST['save'])) 
    {
        $nama = $_POST['nama'];
        $kategori = $_POST['id_kategori'];
        $deskripsi = $_POST['deskripsi'];
        $harga = $_POST['harga'];
        $stok = $_POST['stok'];
        $foto = $_FILES['foto']['name'];
        $lokasi = $_FILES['foto']['tmp_name'];
        move_uploaded_file($lokasi, "foto_menu/".$foto);
        $sql = mysqli_query($koneksi, "INSERT INTO menu
            (nama_menu,harga_menu,foto_menu,deskripsi_menu,stok_menu,id_kategori)
            VALUES('$nama','$harga','$foto','$deskripsi','$stok','$kategori')");

        echo "<div class='alert alert-info'>Data Tersimpan</div>";
        echo "<meta http-equiv='refresh' content='1;url=data.php'>";
    }
?>
		                        <div class="row justify-content-between">
                                    <div class="col-md-4">
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <a href="data.php?halaman=1" class="btn btn-success float-right"><i class="fas fa-arrow-circle-left"></i> Kembali</a>
                                    </div>
                                </div>
								<form action="" method="post" enctype="multipart/form-data">
								    <div class="form-group">
								        <label class="font-weight-bold">Nama</label>
								        <input type="text" class="form-control" name="nama" required autofocus>
								    </div>
								    <div class="form-group">
								        <label class="font-weight-bold">Kategori</label>
								        <select name="id_kategori" class="form-control" required>
								            <option>-Pilih Kategori-</option>
								            <?php foreach ($datakategori as $key => $value):?>
								            <option value="<?= $value["id_kategori"] ?>"><?= $value["nama_kategori"] ?></option>
								            <?php endforeach ?>
								        </select>
								    </div>
								    <div class="form-group">
								        <label class="font-weight-bold">Harga (Rp)</label>
								        <input type="number" class="form-control" name="harga" required>
								    </div>
								    <div class="form-group">
								        <label class="font-weight-bold">Stok</label>
								        <input type="number" class="form-control" name="stok" required>
								    </div>
								    <div class="form-group">
								        <label class="font-weight-bold">Deskripsi</label>
								        <textarea class="form-control" name="deskripsi" required></textarea>
								    </div>
								    <div class="form-group">
								        <label class="font-weight-bold">Foto</label>
								        <input type="file" class="form-control-file mb-1" name="foto" required>
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