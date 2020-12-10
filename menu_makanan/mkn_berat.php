<?php $title = "Daftar Makanan Berat";
include_once('../header.php'); ?>

                <div class="col-md-9 ml-auto p-2 pt-4">
                    <div class="card mb-4 border-primary">
                            <?php   
                            $sql = "SELECT * FROM menu LEFT JOIN kategori
                                    ON menu.id_kategori = kategori.id_kategori 
                                    WHERE nama_kategori = 'Makanan Berat' AND stok_menu > 0";
                            $dafmakber = mysqli_query($koneksi, $sql);
                            $jumlah_dafmakber = mysqli_num_rows($dafmakber); 
                            ?>
                        <div class="card-header text-center font-weight-bold border-primary bg-primary">
                            <i class="fas fa-utensils mr-1"></i>
                            Daftar Makanan Berat
                        </div>
                        
                        <!-- Cards -->
                        <div class="row p-2 pt-4 justify-content-center">

                            <?php while ($row = mysqli_fetch_assoc($dafmakber)) { ?>
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
                            (<?= $jumlah_dafmakber; ?>) Menu Tersedia 
                        </div>
                    </div>
                </div>

<?php include_once('../footer.php'); ?>