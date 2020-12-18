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

$menu = mysqli_fetch_assoc($result);
$fotolama = $menu['foto_menu'];
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
                        <h1 class="mt-4">Menu</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item">
                                <a href="<?= base_url('admin/dashboard');?>"><i class="fas fa-home"></i> Home</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="<?= base_url('admin/menu');?>"> Data Menu</a>
                            </li>
                            <li class="breadcrumb-item active">
                                Ubah Data Menu
                            </li>
                        </ol>
                        <div class="row">
                            <div class="col-md-8 offset-md-2">
                            	<div class="card mb-4">
	                                <div class="card-header font-weight-bold">
	                                    <i class="fas fa-utensils mr-1"></i>
	                                    Ubah Data Menu
	                                </div>
	                                <div class="card-body">
	<?php
	    if (isset($_POST['ubah'])) {
	        $nama = $_POST['nama'];
	        $stok = $_POST['stok'];
	        $deskripsi = $_POST['deskripsi'];
	        $harga = $_POST['harga'];
	        $kategori = $_POST['id_kategori'];
	        $foto = $_FILES['foto']['name'];
	        $lokasi = $_FILES['foto']['tmp_name'];
	        // jika foto dirubah
	        if (!empty ($lokasi)) {
	            move_uploaded_file($lokasi, "foto_menu/".$foto);
	            unlink("foto_menu/$fotolama"); // menghapus foto lama

	            $sql = mysqli_query($koneksi,"UPDATE menu SET id_kategori='$kategori', nama_menu='$nama',
	            harga_menu='$harga', foto_menu='$foto',
	            deskripsi_menu='$deskripsi', stok_menu='$stok' WHERE id_menu='$_GET[id]'");
	        }
	        else {
	            $sql = mysqli_query($koneksi,"UPDATE menu SET id_kategori='$kategori', nama_menu='$nama',
	            harga_menu='$harga',
	            deskripsi_menu='$deskripsi', stok_menu='$stok' WHERE id_menu='$_GET[id]'");
	        }
	        echo "<div class='alert alert-info'>Data Menu telah diubah</div>";
	        echo "<meta http-equiv='refresh' content='1;url=data.php'>";
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
									        <input type="text" class="form-control" name="nama" value="<?= $menu['nama_menu']; ?>" required autofocus>
									    </div>
									    <div class="form-group">
									        <label class="font-weight-bold">Kategori</label>
									        <select name="id_kategori" class="form-control" required>
									            <option>-Pilih Kategori-</option>
									            <?php foreach ($datakategori as $key => $value):?>
									            <option value="<?= $value["id_kategori"] ?>" <?php if($menu["id_kategori"]==$value["id_kategori"]){ echo "selected"; } ?> >
									            <?= $value["nama_kategori"] ?>
									            </option>
									        	<?php endforeach ?>
									        </select>
									    </div>
									    <div class="form-group">
									        <label class="font-weight-bold">Harga (Rp)</label>
									        <input type="number" class="form-control" name="harga" value="<?= $menu['harga_menu']; ?>" required>
									    </div>
									    <div class="form-group">
									        <label class="font-weight-bold">Stok</label>
									        <input type="number" class="form-control" name="stok" value="<?= $menu['stok_menu']; ?>" required>
									    </div>
									    <div class="form-group">
									        <label class="font-weight-bold">Deskripsi</label>
									        <textarea class="form-control" name="deskripsi" required><?= $menu['deskripsi_menu']; ?></textarea>
									    </div>
									    <div class="form-group">
									        <img src="foto_menu/<?= $menu['foto_menu']; ?>" class="img-thumbnail" width="100" >
									    </div>
									    <div class="form-group">
									        <label class="font-weight-bold">Ganti Foto</label>
									        <input type="file" class="form-control-file mb-1" name="foto">
									    </div>
									    <button class="btn btn-primary" name="ubah">Ubah</button>
									</form>
		                            </div>
                        		</div>
                    		</div>
                		</div>
           			</div>
        		</main>


<?php include_once('../_footer.php'); ?>