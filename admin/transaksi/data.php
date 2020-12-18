<?php $title = "Penjualan | Ge-Ju";
include_once('../_header.php'); ?>

            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h3 class="mt-3">Penjualan</h3>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">
                                <a href="<?= base_url('admin/dashboard');?>"><i class="fas fa-home"></i> Home</a>
                            </li>
                            <li class="breadcrumb-item active">
                                Data Penjualan
                            </li>
                        </ol>
                        <div class="row">
                            <div class="col-xl-10 offset-xl-1">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fas fa-retweet mr-1"></i>
                                        Data Penjualan
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-responsive table-bordered" id="penjualan">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Nama Pelanggan</th>
                                                        <th>Tanggal</th>
                                                        <th>Status</th>
                                                        <th>Total</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php 
                                                    $no = 1;
                                                    $sql = mysqli_query($koneksi, "SELECT * FROM penjualan LEFT JOIN user ON penjualan.id_user = user.id_user ORDER BY status_penjualan");
                                                    while ($pecah = mysqli_fetch_assoc($sql)) { ?>
                                                    <tr>
                                                        <td><?= $no; ?></td>
                                                        <td><?= $pecah['nama'];?></td>
                                                        <td><?= date("d F Y", strtotime($pecah["tanggal_penjualan"]));?></td>
                                                        <td class="text-center">
                                                            <?php if ($pecah['status_penjualan']=='Pending'): ?>
                                                            <span class="badge badge-secondary small"><?= $pecah['status_penjualan'];?></span>
                                                            <?php endif ?>
                                                            <?php if ($pecah['status_penjualan']=='Confirmed'): ?>
                                                            <span class="badge badge-success small"><?= $pecah['status_penjualan'];?></span>
                                                            <?php endif ?>
                                                            <?php if ($pecah['status_penjualan']=='Lunas'): ?>
                                                            <span class="badge badge-primary small"><?= $pecah['status_penjualan'];?></span>
                                                            <?php endif ?>
                                                            <?php if ($pecah['status_penjualan']=='Batal'): ?>
                                                            <span class="badge badge-danger small"><?= $pecah['status_penjualan'];?></span>
                                                            <?php endif ?>
                                                        </td>
                                                        <td>Rp. <?= number_format($pecah['total_penjualan']); ?></td>
                                                        <td>
                                                            <a href="detail.php?id=<?= $pecah['id_penjualan']; ?>" class="btn btn-info"><i class="fas fa-info-circle"></i></a>
                                                            <a href="del.php?id=<?= $pecah['id_penjualan'];?>" class="btn btn-danger" onClick="return confirm('Yakin akan menghapus penjualan <?= $pecah['nama']; ?>?')"><i class="fas fa-eraser"></i></a>
                                                            <?php if ($pecah['status_penjualan'] !== "Pending"): ?>
                                                            <a href="confirm.php?id=<?= $pecah['id_penjualan']; ?>" class="btn btn-success"><i class="fas fa-search-dollar"></i></a>
                                                            <?php endif ?>
                                                        </td>
                                                    </tr>
                                                    <?php 
                                                    $no ++;
                                                    } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>

<?php include_once('../_footer.php'); ?>

        <script type="text/javascript" charset="utf8">
            $(document).ready( function () {
                $('#penjualan').DataTable(
                    {
                        "pageLength": 10,
                        responsive: true,
                        select: true
                    }
                    );
            } );
        </script>