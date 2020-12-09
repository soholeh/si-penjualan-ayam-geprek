<?php $title = "Daftar Makanan Berat";
include_once('layout/header.php'); ?>

            <div class="col-md-9 ml-auto p-2 pt-4">
                <h2 class="text-center font-weight-bold m-4">Daftar Makanan Berat</h2>
                <!-- Cards -->
                <div class="row p-2 pt-4 justify-content-center">

                    <?php   $sql = "SELECT * FROM menu LEFT JOIN kategori
                    ON menu.id_kategori = kategori.id_kategori WHERE nama_kategori = 'Makanan Berat' AND stok_menu > 0";
                            $result = mysqli_query($koneksi, $sql);

                    while ($row = mysqli_fetch_assoc($result)) { ?>
                    <div class="card mr-1 mb-5" style="width: 17rem;">
                        <img src="admin/menu/foto_menu/<?= $row['foto_menu'];?>" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title"><?= $row['nama_menu'];?></h5>
                            <p class="card-text">Rp. <?= number_format($row['harga_menu']);?></p>
                            <a href="detail.php?id=<?= $row['id_produk'];?>" class="btn btn-success mt-2">Detail</a>
                            <a href="beli.php?id=<?= $row['id_produk'];?>" class="btn btn-primary mt-2">Pesan</a>
                        </div>
                    </div>
                    <?php }?>
                </div>
            </div>

<?php include_once('layout/footer.php'); ?>