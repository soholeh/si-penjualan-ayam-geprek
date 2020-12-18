<?php $title = "Daftar Pelanggan";
include_once('../header.php'); ?>

                <div class="col-md-3 offset-md-3 p-2 pt-4">
                    <div class="card mb-4 border-primary">
                        <div class="card-header text-center font-weight-bold border-primary bg-primary">
                            <i class="fas fa-user-circle mr-1"></i>
                            Daftar Pelanggan
                        </div>
                        <div class="card-body">                          
                          <form class="form-signin" method="post">
                            <label for="" class="sr-only">Nama</label>
                                <input type="text" name="nama" id="inputEmail" class="form-control mb-2" placeholder="Nama" required autofocus>
                            <label for="inputEmail" class="sr-only">Email</label>
                                <input type="email" name="email" class="form-control mb-2" placeholder="Email" required>
                            <label for="inputPassword" class="sr-only">Password</label>
                                <input type="password" name="password" id="pw" class="form-control mb-2" placeholder="Password" required>
                                <div class="form-group small">
                                    <input type="checkbox" onclick="lihatpw()"> Lihat Password
                                </div>
                            <label for="" class="sr-only">Alamat</label>
                            <textarea name="alamat" class="form-control mb-2" placeholder="Alamat"></textarea>
                            <label for="" class="sr-only">No. Telpon / WA</label>
                                <input type="text" name="telepon" class="form-control mb-2" placeholder="Nomor Telpon / WA" required>
                            <button class="btn btn-lg btn-success btn-block mt-3" name="daftar">Daftar</button>
                        </form>
                        </br>
                        <p class="text-center">Sudah mendaftar? <a href="login.php" class="text-info">Login</a> sekarang.</p>
                        <?php
                        if (isset($_POST["daftar"])) {
                            $nama = $_POST["nama"];
                            $email = $_POST["email"];
                            $password = sha1($_POST["password"]);
                            $alamat = $_POST["alamat"];
                            $telepon = $_POST["telepon"];

                            // validasi email

                            $sql = mysqli_query($koneksi, "SELECT * FROM user
                                WHERE email = '$email'");
                            
                            $cocok = mysqli_num_rows($sql);
                            if ($cocok == 1) {
                                echo "<script>alert('Anda Gagal Mendaftar Email telah digunakan');</script>";
                                echo "<script>location='daftar.php';</script>";
                            } else {
                                
                                $sql = mysqli_query($koneksi, "INSERT user
                                (nama,email,telephone,alamat,password,status)
                                VALUES('$nama','$email','$telepon','$alamat','$password','pelanggan')");

                                echo "<script>alert('Anda Berhasil Mendaftar, silahkan login');</script>";
                                echo "<script>location='login.php';</script>";
                            }
                            
                        }
                        ?>
                        </div>
                    </div>
                </div>

<?php include_once('../footer.php'); ?>

    <script>
    function lihatpw() {
      var x = document.getElementById("pw");
      if (x.type === "password") {
        x.type = "text";
      } else {
        x.type = "password";
      }
    }
    </script>