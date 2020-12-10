<?php $title = "Ge-Ju";
include_once('header.php'); ?>
                    
        <!-- Slider -->
        <div class="col-md-9 ml-auto p-2 pt-4">
            <div class="card">
            <?php
            $result = mysqli_query($koneksi, "SELECT * FROM slider ORDER BY id_slider ASC");?>
            <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
                <div class="card border-primary">
                    
                    <ol class="carousel-indicators">
                    <?php
                    for($i=0; $i<$row = mysqli_num_rows($result);$i++){
                        echo '
                        <li data-target="#carouselExampleIndicators" data-slide-to="'.$i.'"';
                        if($i==0){echo'class="active"';}echo'></li>';
                    }?>
                    </ol>
                    <div class="carousel-inner">
                    <?php
                    if($row = mysqli_num_rows($result) > 0){
                        while ($row = mysqli_fetch_assoc($result)) {
                        if($row['id_slider'] == 1){
                        echo'<div class="carousel-item active">';}else{echo'<div class="carousel-item">';}
                        echo'
                            <img src="admin/slider/foto/'.$row['foto_slider'].'" class="d-block w-100">
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
                </div>         
            </div>
            </div>
        </div>

            <main>
                <div class="container-fluid">
                    <div class="row mt-3">
                        <div class="col-xl-12">
                            <div class="card mb-4 border-primary">
                                <div class="card-header text-center font-weight-bold border-primary bg-primary">
                                    <i class="fas fa-drumstick-bite mr-1 text-warning"></i>
                                    Menu Terbaru
                                </div>
                                <div class="card-body border-primary">
                                    <div  class="col-xl-12">
                                        <div class="row p-2 pt-4 justify-content-center">
                                            <?php   $sql = "SELECT * FROM menu ORDER BY id_menu DESC LIMIT 4";
                                                    $result = mysqli_query($koneksi, $sql);
                                            ?>
                                            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                                            <div class="card mr-3 ml-3 mb-4 border-primary" style="width: 17rem;">
                                                <img src="admin/menu/foto_menu/<?= $row['foto_menu'];?>" class="card-img-top" alt="...">
                                                <div class="card-body">
                                                    <h5 class="card-title"><?= $row['nama_menu'];?> <span class="badge badge-secondary small"> New!</span></h5>
                                                    <p class="card-text"><span class="badge badge-pill badge-success">Rp. <?= number_format($row['harga_menu']);?></span></p>
                                                    <a href="detail.php?id=<?= $row['id_menu'];?>" class="btn btn-primary mt-2 btn-block">Pesan <i class="fas fa-comment-dollar"></i></a>
                                                </div>
                                            </div>
                                            <?php }?>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer text-center small border-primary bg-primary">
                                    <?= date("l jS \of F Y h:i:s A"); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>

<?php include_once('footer.php'); ?>