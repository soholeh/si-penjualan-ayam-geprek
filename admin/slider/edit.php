<?php $title = "Ubah Slider | Ge-Ju";
include_once('../_header.php'); 

$sql = "SELECT * FROM slider WHERE id_slider = '$_GET[id]'";
$result = mysqli_query($koneksi, $sql);

$slider = mysqli_fetch_assoc($result);
$fotolama = $slider['foto_slider'];
?>

            <div id="layoutSidenav_content">
                <main>
                    <?php 
                    if (!isset($_SESSION['admin'])) {
                        echo    "<script>
                                alert('Anda Bukan Admin');
                                location='../slider/data.php';
                            </script>";
                        } 
                     ?>
                    <div class="container-fluid">
                        <h3 class="mt-4">Slider</h3>
                        <ol class="breadcrumb mb-3">
                            <li class="breadcrumb-item active">
                                <a href="<?= base_url('admin/dashboard');?>"><i class="fas fa-home"></i> Home</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="<?= base_url('admin/pelanggan');?>"> Kelola Slider</a>
                            </li>
                            <li class="breadcrumb-item active">
                                Ubah Data Slider
                            </li>
                        </ol>

                        <div class="row">
                            <div class="col-md-8 offset-md-2">
                                <div class="card mb-4">
                                    <div class="card-header font-weight-bold">
                                        <i class="fas fa-sliders-h mr-1"></i>
                                        Ubah Slider
                                    </div>
                                    <div class="card-body">
<?php
    if (isset($_POST['ubah'])) {

        $foto = $_FILES['foto']['name'];
        $lokasi = $_FILES['foto']['tmp_name'];
        $fotofix = date("YmdHis").$foto;

        // jika foto dirubah
        if (!empty ($lokasi)) {
            move_uploaded_file($lokasi, "foto/".$fotofix);
            unlink("foto/$fotolama"); // menghapus foto lama

            $sql = mysqli_query($koneksi,"UPDATE slider SET foto_slider = '$fotofix'
            WHERE id_slider = '$_GET[id]'");
        }
        
        echo "<div class='alert alert-info'>Data Dirubah</div>";
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
							                <img src="foto/<?= $slider['foto_slider']; ?>" class="img-thumbnail">
							            </div>
							            <div class="form-group">
							                <label class="font-weight-bold">Ganti Foto</label>
							                <input type="file" name="foto" class="form-control-file">
							                <div class="alert alert-info mt-1 font-weight-bold">Pastikan Resolusi Foto 1100x467 pixel.</div>
							            </div>
                                        <div class="col-md-3">
							                <button class="btn btn-primary btn-block" name="ubah">Ubah</button>
                                        </div>
						        	</form>
		                            </div>
                        		</div>
                    		</div>
                		</div>
           			</div>
        		</main>


<?php include_once('../_footer.php'); ?>