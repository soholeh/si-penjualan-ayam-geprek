<?php $title = "Pencarian Menu";
include_once('layout/header.php'); ?>
<?php
$keyword = $_GET["keyword"];

$semuadata = array();
$sql = mysqli_query($koneksi, "SELECT * FROM menu WHERE nama_menu LIKE '%$keyword%'
OR deskripsi_menu LIKE '%$keyword%'");
while($row = mysqli_fetch_assoc($sql))
{
    $semuadata[]=$row;
}
// echo "<pre>";
// print_r($semuadata);
// echo "</pre>";
?>

<div class="col-md-9 ml-auto p-2 pt-4">
    <div class="container">
        <h2 class='text-center'>Hasil Pencarian : <?= $keyword;?></h2>
        <?php if (empty($semuadata)): ?>
            <div class="alert alert-danger">Menu <strong><?= $keyword;?></strong> tidak ditemukan.</div>
        <?php endif ?>
            <div class="row p-2 justify-content-center">
                <?php foreach ($semuadata as $key => $value): ?>
                    <div class="card mr-1 mb-5" style="width: 17rem;">
                        <img src="admin/menu/foto_menu/<?= $value['foto_menu'];?>" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title"><?= $value['nama_menu'];?></h5>
                            <p class="card-text">Rp. <?= number_format($value['harga_menu']);?></p>
                            <a href="detail.php?id=<?= $value['id_menu'];?>" class="btn btn-success mt-2">Detail</a>
                            <a href="beli.php?id=<?= $value['id_menu'];?>" class="btn btn-primary mt-2">Pesan</a>
                        </div>
                    </div>
                <?php endforeach ?>
            </div>
    </div>
</div>

<?php include_once('layout/footer.php'); ?>