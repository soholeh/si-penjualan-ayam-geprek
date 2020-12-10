<?php $title = "Pencarian Menu";
include_once('../header.php'); ?>
<?php
$keyword = $_GET["keyword"];

$semuadata = array();
$sql = mysqli_query($koneksi, "SELECT * FROM menu WHERE nama_menu LIKE '%$keyword%'
OR deskripsi_menu LIKE '%$keyword%'");
$jumlah_pencarian = mysqli_num_rows($sql);
while($row = mysqli_fetch_assoc($sql))
{
    $semuadata[]=$row;
}
// echo "<pre>";
// print_r($semuadata);
// echo "</pre>";
?>

                <div class="col-md-9 ml-auto p-2 pt-4">
                    <div class="card mb-4 border-primary">
                        <div class="card-header text-center font-weight-bold border-primary bg-primary">
                            <i class="fas fa-search mr-1"></i>
                            Hasil Pencarian : <?= $keyword;?>
                        </div>
                        <!-- Cards -->
                        <div class="row p-2 pt-4 justify-content-center">
                        <?php if (empty($semuadata)): ?>
                            <div class="alert alert-danger">Menu <strong><?= $keyword;?></strong> tidak ditemukan.</div>
                        <?php endif ?>
                            <?php foreach ($semuadata as $key => $value): ?>
                            <div class="card mr-3 ml-3 mb-4 border-primary" style="width: 17rem;">
                                <img src="../admin/menu/foto_menu/<?= $value['foto_menu'];?>" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title"><?= $value['nama_menu'];?></h5>
                                    <p class="card-text"><span class="badge badge-pill badge-success">Rp. <?= number_format($value['harga_menu']);?></span></p>
                                    <a href="detail.php?id=<?= $value['id_menu'];?>" class="btn btn-primary mt-2 btn-block">Pesan <i class="fas fa-comment-dollar"></i></a>
                                </div>
                            </div>
                            <?php endforeach ?>
                        </div>

                        <div class="card-footer text-center small border-primary bg-primary font-weight-bold">
                            <?php if (empty($semuadata)): ?>
                                Menu Tidak Tersedia
                            <?php else: ?>
                                (<?= $jumlah_pencarian; ?>) Menu Tersedia 
                            <?php endif ?>
                        </div>
                    </div>
                </div>

<?php include_once('../footer.php'); ?>