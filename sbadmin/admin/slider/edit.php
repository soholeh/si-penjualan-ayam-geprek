<?php $title = "Ubah Slider | Ge-Ju";
include_once('../_header.php'); 

$sql = "SELECT * FROM slider WHERE id ='$_GET[id]'";
$result = mysqli_query($koneksi, $sql);

$row = mysqli_fetch_assoc($result);
$fotolama = $row['foto'];
?>

            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h3 class="mt-4">Slider</h3>
                        <ol class="breadcrumb mb-3">
                            <li class="breadcrumb-item active">
                                <a href="<?= base_url('admin/dashboard');?>"><i class="fas fa-home"></i> Home</a>
                            </li>
                            <li class="breadcrumb-item active">
                                Ubah Data Slider
                            </li>
                        </ol>
                        <div class="card">
                        	<div class="card-body">
		                        <div class="row">
		                            <div class="col-md-8 offset-md-2">
				                        <div class="row justify-content-between">
		                                    <div class="col-md-4">
		                                    	<h4>Ubah Slider</h4>
		                                    </div>
		                                    <div class="col-md-3 mb-3">
		                                        <a href="data.php?halaman=1" class="btn btn-success float-right"><i class="fas fa-arrow-circle-left"></i> Kembali</a>
		                                    </div>
		                                </div>
										<form action="" method="post" enctype="multipart/form-data">
								            <div class="form-group">
								                <img src="foto/<?= $row['foto']; ?>" class="img-thumbnail">
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
<?php
    if (isset($_POST['ubah'])) {

        $foto = $_FILES['foto']['name'];
        $lokasi = $_FILES['foto']['tmp_name'];
        // jika foto dirubah
        if (!empty ($lokasi)) {
            move_uploaded_file($lokasi, "foto/".$foto);
            unlink("foto/$fotolama"); // menghapus foto lama

            $sql = mysqli_query($koneksi,"UPDATE slider SET foto='$foto'
            WHERE id='$_GET[id]'");
        }
        
        echo "<script>alert('Foto Slider telah diubah');</script>";
        echo "<script>location='data.php';</script>";
    }
?>

		                            </div>
                        		</div>
                    		</div>
                		</div>
           			</div>
        		</main>


<?php include_once('../_footer.php'); ?>