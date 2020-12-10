<?php $title = "Daftar Menu";
include_once('../header.php'); ?>
            
                <div class="col-md-9 ml-auto p-2 pt-4">
                    <div class="card mb-4 border-primary">
                            <?php   
                            $sql = "SELECT * FROM menu WHERE stok_menu > 0";
                            $dafmenu = mysqli_query($koneksi, $sql);
                            $jumlah_dafmenu = mysqli_num_rows($dafmenu); 
                            ?>
                        <div class="card-header text-center font-weight-bold border-primary bg-primary">
                            <i class="fas fa-drumstick-bite mr-1"></i>
                            Daftar Semua Menu
                        </div>
                        
                        <!-- Cards -->
                        <div class="row p-2 pt-4 justify-content-center">

                            <?php while ($row = mysqli_fetch_assoc($dafmenu)) { ?>
                            <div class="card mr-3 ml-3 mb-4 border-primary" style="width: 17rem;">
                                <img src="../admin/menu/foto_menu/<?= $row['foto_menu'];?>" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title"><?= $row['nama_menu'];?></h5>
                                    <p class="card-text"><span class="badge badge-pill badge-success">Rp. <?= number_format($row['harga_menu']);?></span></p>
                                    <a href="detail.php?id=<?= $row['id_menu'];?>" class="btn btn-primary mt-2 btn-block">Pesan <i class="fas fa-comment-dollar"></i></a>
                                </div>
                            </div>
                            <?php }?>
                        </div>

                        <div class="card-footer text-center small border-primary bg-primary font-weight-bold">
                            (<?= $jumlah_dafmenu; ?>) Menu Tersedia 
                        </div>
                    </div>
                </div>

<?php include_once('../footer.php'); ?>