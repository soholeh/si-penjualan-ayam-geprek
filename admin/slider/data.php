<?php $title = "Slider | Ge-Ju";
include_once('../_header.php'); ?>

            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h3 class="mt-3">Slider</h3>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">
                                <a href="<?= base_url('admin/dashboard');?>"><i class="fas fa-home"></i> Home</a>
                            </li>
                            <li class="breadcrumb-item active">
                                Kelola Slider
                            </li>
                        </ol>
                        <div class="row">
                            <div class="col-xl-4">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fas fa-sliders-h mr-1"></i>
                                        Ubah Slider
                                    </div>
                                    <div class="card-body pb-0 mb-4">
                                    <table class="table table-responsive table-hover table-striped">
                                        <thead>
                                            <tr>
                                                <th>Urutan</th>
                                                <th>Foto</th>
                                                <?php if (isset($_SESSION["admin"])): ?>
                                                <th>Aksi</th>
                                                <?php endif ?>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $no = 1;
                                            $sql = "SELECT * FROM slider ORDER BY id_slider ASC";
                                            $result = mysqli_query($koneksi, $sql);

                                            while ($slider = mysqli_fetch_assoc($result)) { ?>
                                            <tr>
                                                <td>Slide <?= $no; ?></td>
                                                <td>
                                                    <img src="foto/<?= $slider['foto_slider'];?>" class="img-thumbnail" width="200">
                                                </td>
                                                <?php if (isset($_SESSION["admin"])): ?>                                                   
                                                <td>
                                                    <a href="edit.php?id=<?= $slider['id_slider'];?>" class="btn btn-warning"><i class="fas fa-pencil-alt"></i></a>
                                                </td>
                                                <?php endif ?>
                                            </tr>
                                            <?php $no ++; ?>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                            <!-- Slider -->
                            <div class="col-xl-8">
                                <div class="card mb-4">
                                    <div class="card-header text-center">
                                        <i class="fas fa-angle-left"></i><i class="fas fa-angle-right mr-1"></i>
                                            Preview
                                    </div>
                                    <div class="card-body pb-0">
                                    <?php
                                    $result = mysqli_query($koneksi, "SELECT * FROM slider ORDER BY id_slider ASC");?>
                                    <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
                                            <ol class="carousel-indicators">
                                            <?php
                                            for($i=0; $i<$slider = mysqli_num_rows($result);$i++){
                                                echo '
                                                <li data-target="#carouselExampleIndicators" data-slide-to="'.$i.'"';
                                                if($i==0){echo'class="active"';}echo'></li>';
                                            }?>
                                            </ol>
                                            <div class="carousel-inner">
                                            <?php
                                            if($slider = mysqli_num_rows($result) > 0){
                                                while ($slider = mysqli_fetch_assoc($result)) {
                                                if($slider['id_slider'] == 1){
                                                echo'<div class="carousel-item active">';}else{echo'<div class="carousel-item">';}
                                                echo'
                                                    <img src="foto/'.$slider['foto_slider'].'" class="d-block w-100">
                                                </div>';
                                            }}?>
                                            </div>
                                            <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
                                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                <span class="sr-only">Previous</span>
                                            </a>
                                            <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
                                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                <span class="sr-only">Next</span>
                                            </a>
                                        </div>
                                        <div class="alert alert-info small mt-1">Pastikan ukuran resolusi untuk foto slider <strong>1100x467 pixel</strong>.</div>         
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>


<?php include_once('../_footer.php'); ?>