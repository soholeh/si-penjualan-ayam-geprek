<?php $title = "Menu | Ge-Ju";
include_once('../_header.php'); ?>

            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h3 class="mt-3">Menu</h3>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">
                                <a href="<?= base_url('admin/dashboard');?>"><i class="fas fa-home"></i> Home</a>
                            </li>
                            <li class="breadcrumb-item active">
                                Data Menu
                            </li>
                        </ol>
                        <div class="card">
                          <div class="card-body">
                        <div class="row">
<!--                             <?php 
                                $data = mysqli_query($koneksi,"SELECT * FROM menu LEFT JOIN kategori 
                                ON menu.id_kategori = kategori.id_kategori");
                                $jumlah_data = mysqli_num_rows($data);
                             ?> -->
                            <div class="col-xl-auto offset-xl-1">
                                <div class="col-md-3 mb-3">
                                    <a href="add.php" class="btn btn-primary btn-block"><i class="fas fa-plus"></i> Tambah Menu</a>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-responsive-sm table-bordered table-hover" id="menu">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Kategori</th>
                                                <th>Nama</th>
                                                <th>Harga</th>
                                                <th>Berat</th>
                                                <th>Foto</th>
                                                <th>Stok</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            // $batas = 10;
                                            // $halaman = isset($_GET['halaman'])?(int)$_GET['halaman'] : 1;
                                            // $halaman_awal = ($halaman>1) ? ($halaman * $batas) - $batas : 0; 

                                            // $previous = $halaman - 1;
                                            // $next = $halaman + 1;

                                            // $total_halaman = ceil($jumlah_data / $batas);

                                            // $sql = "SELECT * FROM menu LEFT JOIN kategori 
                                            // ON menu.id_kategori = kategori.id_kategori LIMIT $halaman_awal, $batas";
                                            // $nomor = $halaman_awal+1;

                                            $sql = "SELECT * FROM menu LEFT JOIN kategori 
                                            ON menu.id_kategori = kategori.id_kategori";
                                            $nomor = 1;

                                            $result = mysqli_query($koneksi, $sql);
                                            while ($row = mysqli_fetch_assoc($result)) { ?>
                                            <tr>
                                                <td><?= $nomor; ?>.</td>
                                                <td><?= $row['nama_kategori'];?></td>
                                                <td><?= $row['nama_menu'];?></td>
                                                <td>Rp. <?= number_format($row['harga_menu']);?></td>
                                                <td><?= $row['berat_menu'];?> gr</td>
                                                <td>
                                                    <img src="foto_menu/<?= $row['foto_menu'];?>" width="100px">
                                                </td>
                                                <td><?= $row['stok_menu'];?></td>
                                                <td>
                                                    <a href="edit.php?id=<?= $row['id_menu'];?>" class="btn btn-warning mb-1"><i class="fas fa-pencil-alt"></i></a>
                                                    <a href="del.php?id=<?= $row['id_menu'];?>" class="btn btn-danger mb-1" onClick="return confirm('Yakin akan menghapus menu <?= $row['nama_menu']; ?>?')"><i class="fas fa-eraser"></i></a>
                                                </td>
                                            </tr>
                                            <?php $nomor ++; ?>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- <div class="row justify-content-between">
                                    <div class="col-md-3 mb-2">
                                        Jumlah data : <strong><?= $jumlah_data; ?></strong>
                                    </div>
                                    <div class="col-md-auto">
                                        <nav>
                                            <ul class="pagination float-right">
                                                <li class="page-item">
                                                    <a class="page-link" <?php if($halaman > 1){ echo "href='?halaman=$previous'"; } ?>>Previous</a>
                                                </li>
                                                <?php 
                                                for($x=1;$x<=$total_halaman;$x++){
                                                    ?> 
                                                    <li <?php if($_GET['halaman']==$x){ echo "class='page-item active'"; } ?> class="page-item"><a class="page-link" href="?halaman=<?= $x ?>"><?= $x; ?></a></li>
                                                    <?php
                                                }
                                                ?>              
                                                <li class="page-item">
                                                    <a  class="page-link" <?php if($halaman < $total_halaman) { echo "href='?halaman=$next'"; } ?>>Next</a>
                                                </li>
                                            </ul>
                                        </nav>
                                    </div>
                                </div> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>

<?php include_once('../_footer.php'); ?>
        <script type="text/javascript" charset="utf8">
            $(document).ready( function () {
                $('#menu').DataTable(
                    {
                        "pageLength": 4,
                        responsive: true,
                        select: true
                    }
                    );
            } );
        </script>