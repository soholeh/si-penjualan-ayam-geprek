<?php $title = "Ge-Ju";
include_once('layout/header.php'); ?>
                    
            <!-- Slider -->
            <div class="col-md-9 ml-auto p-2 pt-4">
            <div class="card">
            <?php
            $result = mysqli_query($koneksi, "SELECT * FROM slider ORDER BY id_slider ASC");?>
            <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
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

                <h4 class="text-center font-weight-bold m-4">Menu Terbaru</h4>
                <!-- Cards -->
                <div class="row p-2 pt-4 justify-content-center">

                    <?php   $sql = "SELECT * FROM menu ORDER BY id_menu DESC LIMIT 3";
                            $result = mysqli_query($koneksi, $sql);
                    ?>
                    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                    <div class="card mr-1 mb-5" style="width: 17rem;">
                        <img src="admin/menu/foto_menu/<?= $row['foto_menu'];?>" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title"><?= $row['nama_menu'];?></h5>
                            <p class="card-text">Rp. <?= number_format($row['harga_menu']);?></p>
                            <a href="detail.php?id=<?= $row['id_menu'];?>" class="btn btn-success mt-2">Detail</a>
                            <a href="beli.php?id=<?= $row['id_menu'];?>" class="btn btn-primary mt-2">Pesan</a>
                        </div>
                    </div>
                    <?php }?>

                </div>
            </div>

<?php include_once('layout/footer.php'); ?>