<?php $title = "Pelanggan | Ge-Ju";
include_once('../_header.php'); ?>

            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h3 class="mt-3">Pelanggan</h3>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">
                                <a href="<?= base_url('admin/dashboard');?>"><i class="fas fa-home"></i> Home</a>
                            </li>
                            <li class="breadcrumb-item active">
                                Data Pelanggan
                            </li>
                        </ol>
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-xl-auto offset-xl-1">
                                        <div class="col-md-5 mb-3">
                                            <a href="add.php" class="btn btn-primary btn-block"><i class="fas fa-plus"></i> Tambah Pelanggan</a>
                                        </div>
                                        <div class="table-responsive">
                                        <table class="table table-responsive-sm table-bordered table-hover" id="pelanggan">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Nama</th>
                                                    <th>Email</th>
                                                    <th>Telepon</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
                                                // $data = mysqli_query($koneksi, "SELECT * FROM user WHERE status = 'pelanggan'");
                                                // $jumlah_data = mysqli_num_rows($data);

                                                // $batas = 4;
                                                // $halaman = isset($_GET['halaman'])?(int)$_GET['halaman'] : 1;
                                                // $halaman_awal = ($halaman>1) ? ($halaman * $batas) - $batas : 0;

                                                // $previous = $halaman - 1;
                                                // $next = $halaman + 1;

                                                // $total_halaman = ceil($jumlah_data / $batas);

                                                // $sql = mysqli_query($koneksi,"SELECT * FROM user WHERE status = 'pelanggan' LIMIT $halaman_awal, $batas");

                                                // $nomor = $halaman_awal + 1;
                                                $sql = mysqli_query($koneksi,"SELECT * FROM user WHERE status = 'pelanggan'");

                                                $nomor = 1;

                                                while ($user = mysqli_fetch_assoc($sql)) { ?>
                                                <tr>
                                                    <td><?= $nomor; ?>.</td>
                                                    <td><?= $user['nama']; ?></td>
                                                    <td><?= $user['email']; ?></td>
                                                    <td><?= $user['telephone']; ?></td>
                                                    <td>
                                                        <a href="edit.php?id=<?= $user['id_user']; ?>" class="btn btn-warning mb-1"><i class="fas fa-pencil-alt"></i></a>
                                                        <a href="del.php?id=<?= $user['id_user']; ?>" class="btn btn-danger mb-1" onClick="return confirm('Yakin akan menghapus pelanggan <?= $user['nama']; ?>?')"><i class="fas fa-eraser"></i></a>
                                                    </td>
                                                </tr>
                                                <?php 
                                                $nomor ++;
                                                } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                        <!-- <div class="row justify-content-between">
                                            <div class="col-md-4 mb-2">
                                                Jumlah data : <strong><?= $jumlah_data; ?></strong>
                                            </div>
                                            <div class="col-md-auto">
                                                <nav>
                                                    <ul class="pagination float-right">
                                                        <li class="page-item">
                                                            <a class="page-link" <?php if($halaman > 1){ echo "href='?halaman=$previous'";} ?>>Previous</a>
                                                        </li>
                                                        <?php 
                                                        for ($i=1; $i <=$total_halaman ; $i++) { ?>
                                                            <li <?php if($_GET['halaman']==$i){echo "class='page-item active'"; } ?> class="page-item"><a class="page-link" href="?halaman=<?= $i; ?>"><?= $i; ?></a></li>
                                                        <?php } ?>
                                                        <li class="page-item">
                                                            <a class="page-link" <?php if($halaman < $total_halaman) {echo "href='?halaman=$next'";} ?>>Next</a>   
                                                        </li>
                                                    </ul>
                                                </nav>
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
                $('#pelanggan').DataTable(
                    {
                        "pageLength": 5,
                        responsive: true,
                        select: true
                    }
                    );
            } );
        </script>