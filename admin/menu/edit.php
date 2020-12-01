<?php $title = "Ubah Menu | Ge-Ju";
include_once('../_header.php'); 
$datakategori = array();
$sql = mysqli_query($koneksi, "SELECT * FROM kategori");
while ($kate = mysqli_fetch_assoc($sql)) {
    $datakategori[] = $kate;
}

// echo "<pre>";
// print_r($datakategori);
// echo "</pre>";
$sql = "SELECT * FROM menu WHERE id_menu='$_GET[id]'";
$result = mysqli_query($koneksi, $sql);

$row = mysqli_fetch_assoc($result);
$fotolama = $row['foto_menu'];
?>

            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h1 class="mt-4">Menu</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">
                                <a href="<?= base_url('admin/dashboard');?>"><i class="fas fa-home"></i> Home</a>
                            </li>
                            <li class="breadcrumb-item active">
                                Ubah Data Menu
                            </li>
                        </ol>
                        <div class="card">
                        	<div class="card-body">
		                        <div class="row">
		                            <div class="col-md-8 offset-md-2">
				                        <div class="row justify-content-between">
		                                    <div class="col-md-4">
		                                    	<h4>Ubah Menu</h4>
		                                    </div>
		                                    <div class="col-md-3 mb-3">
		                                        <a href="data.php?halaman=1" class="btn btn-success float-right"><i class="fas fa-arrow-circle-left"></i> Kembali</a>
		                                    </div>
		                                </div>
										<form action="" method="post" enctype="multipart/form-data">
										    <div class="form-group">
										        <label class="font-weight-bold">Nama</label>
										        <input type="text" class="form-control" name="nama" value="<?= $row['nama_menu']; ?>"required autofocus>
										    </div>
										    <div class="form-group">
										        <label class="font-weight-bold">Kategori</label>
										        <select name="id_kategori" class="form-control" required>
										            <option>-Pilih Kategori-</option>
										            <?php foreach ($datakategori as $key => $value):?>
										            <option value="<?= $value["id_kategori"] ?>" <?php if($row["id_kategori"]==$value["id_kategori"]){ echo "selected"; } ?> >
										            <?= $value["nama_kategori"] ?>
										            </option>
										        	<?php endforeach ?>
										        </select>
										    </div>
										    <div class="form-group">
										        <label class="font-weight-bold">Harga (Rp)</label>
										        <input type="number" class="form-control" name="harga" value="<?= $row['harga_menu']; ?>" required>
										    </div>
										    <div class="form-group">
										        <label class="font-weight-bold">Berat (Gr)</label>
										        <input type="number" class="form-control" name="berat" value="<?= $row['berat_menu']; ?>" required>
										    </div>
										    <div class="form-group">
										        <label class="font-weight-bold">Stok</label>
										        <input type="number" class="form-control" name="stok" value="<?= $row['stok_menu']; ?>" required>
										    </div>
										    <div class="form-group">
										        <label class="font-weight-bold">Deskripsi</label>
										        <textarea class="form-control" name="deskripsi" required><?= $row['deskripsi_menu']; ?></textarea>
										    </div>
										    <div class="form-group">
										        <img src="foto_menu/<?= $row['foto_menu']; ?>" class="img-thumbnail" width="100" >
										    </div>
										    <div class="form-group">
										        <label class="font-weight-bold">Ganti Foto</label>
										        <input type="file" class="form-control-file mb-1" name="foto">
										    </div>
										    <button class="btn btn-primary" name="ubah">Ubah</button>
										</form>
<?php
    if (isset($_POST['ubah'])) {
        $nama = $_POST['nama'];
        $stok = $_POST['stok'];
        $deskripsi = $_POST['deskripsi'];
        $harga = $_POST['harga'];
        $berat = $_POST['berat'];
        $kategori = $_POST['id_kategori'];
        $foto = $_FILES['foto']['name'];
        $lokasi = $_FILES['foto']['tmp_name'];
        // jika foto dirubah
        if (!empty ($lokasi)) {
            move_uploaded_file($lokasi, "foto_menu/".$foto);
            unlink("foto_menu/$fotolama"); // menghapus foto lama

            $sql = mysqli_query($koneksi,"UPDATE menu SET id_kategori='$kategori', nama_menu='$nama',
            harga_menu='$harga', berat_menu='$berat', foto_menu='$foto',
            deskripsi_menu='$deskripsi', stok_menu='$stok' WHERE id_menu='$_GET[id]'");
        }
        else {
            $sql = mysqli_query($koneksi,"UPDATE menu SET id_kategori='$kategori', nama_menu='$nama',
            harga_menu='$harga', berat_menu='$berat',
            deskripsi_menu='$deskripsi', stok_menu='$stok' WHERE id_menu='$_GET[id]'");
        }
        echo "<script>alert('Data Menu telah diubah');</script>";
        echo "<script>location='data.php?halaman=1';</script>";
    }
?>

		                            </div>
                        		</div>
                    		</div>
                		</div>
           			</div>
        		</main>


<?php include_once('../_footer.php'); ?>