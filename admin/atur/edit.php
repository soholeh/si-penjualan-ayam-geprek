<?php $title = "Pengaturan | Ge-Ju";
include_once('../_header.php'); ?>

            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h3 class="mt-3">Pengaturan</h3>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">
                                <a href="<?= base_url('admin/dashboard');?>"><i class="fas fa-home"></i> Home</a>
                            </li>
                            <li class="breadcrumb-item active">
                                Pengaturan
                            </li>
                        </ol>
                        <div class="row">
                            <div class="col-xl-3">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fas fa-lock mr-1"></i>
                                        Ubah Password
                                    </div>
                                    <div class="card-body">
                                        <form method="post">
                                            <div class="form-group">
                                                <label class="font-weight-bold">Password Lama</label>
                                                <input type="password" name="pass" class="form-control" required autofocus>
                                            </div>
                                            <div class="form-group">
                                                <label class="font-weight-bold">Password Baru</label>
                                                <input type="password" name="pass_baru" class="form-control" required>
                                            </div>
                                            <div class="form-group d-flex align-items-center justify-content-between mt-3 mb-2">
                                                <button class="btn btn-sm btn-primary btn-block" name="ubah">Ubah Password</button>
                                            </div>
<?php
    if (isset($_POST['ubah'])) {
        $pass = sha1($_POST['pass']);
        $pass_baru = sha1($_POST['pass_baru']);

        $id = $_SESSION["admin"]["id_user"];

        $data = mysqli_query($koneksi, "SELECT * FROM user WHERE id_user = '$id'");
        $dapet = mysqli_fetch_assoc($data);
        $inipw = $dapet['password'];

        if ($pass == $inipw) {
            $update = mysqli_query($koneksi, "UPDATE user SET password = '$pass_baru' WHERE id_user = '$id'");
            echo "<script>alert('Password telah diubah');</script>";
            echo "<script>location='edit.php';</script>";
        } else {
            echo "<div class='alert alert-danger'>Password tidak sesuai</div>";
        }
    }
?>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-7">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fas fa-user mr-1"></i>
                                        Data Admin
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-responsive table-bordered table-hover">
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
                                                    $sql = mysqli_query($koneksi, "SELECT * FROM user WHERE status = 'admin'"); 
                                                    $nomor = 1;
                                                    while($user = mysqli_fetch_assoc($sql)) {?>
                                                    <tr>
                                                        <td><?= $nomor; ?>.</td>
                                                        <td><?= $user['nama']; ?></td>
                                                        <td><?= $user['email']; ?></td>
                                                        <td><?= $user['telephone']; ?></td>
                                                        <td>
                                                            <a href="del.php?id=<?= $user['id_user']; ?>" class="btn btn-danger mb-1" onClick="return confirm('Yakin akan menghapus admin <?= $user['nama']; ?>?')"><i class="fas fa-eraser"></i></a>
                                                        </td>
                                                    </tr>
                                                    <?php 
                                                    $nomor ++;
                                                    } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-2">
                                <a href="add.php" class="btn btn-primary btn-block"><i class="fas fa-plus mr-1"></i>Tambah Admin</a>
                            </div>
                        </div>
                    </div>
                </main>

<?php include_once('../_footer.php'); ?>