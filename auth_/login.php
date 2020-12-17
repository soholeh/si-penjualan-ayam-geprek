<?php $title = "Login Pelanggan";
include_once('../header.php'); ?>

                <div class="col-md-3 offset-md-3 p-2 pt-4">
                    <div class="card mb-4 border-primary">
                        <div class="card-header text-center font-weight-bold border-primary bg-primary">
                            <i class="fas fa-sign-in-alt mr-1"></i>
                            Login Pelanggan
                        </div>
                        <div class="card-body">                          
                          <form class="form-signin" method="post">
                            <label for="inputEmail" class="sr-only">Email</label>
                                <input type="email" name="email" id="inputEmail" class="form-control" placeholder="Email" required autofocus>
                            <label for="inputPassword" class="sr-only">Password</label>
                                <input type="password" name="pass" id="inputPassword" class="form-control mt-1" placeholder="Password" required>
                            <button class="btn btn-lg btn-primary btn-block mt-3" name="submit">Login</button>
                        </form>
                        </br>
                        <p class="text-center">Belum mendaftar? <a href="daftar.php" class="text-success">Daftar</a> sekarang.</p>
                        </div>
                    </div>
                </div>

<?php
  if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = sha1($_POST['pass']);
    
    $sql = "SELECT * FROM user WHERE email ='$email'
    AND password ='$password'";
    $result = mysqli_query($koneksi, $sql);
    $yangcocok = mysqli_num_rows($result);
    if ($yangcocok == 1) {
      $_SESSION['pelanggan']= mysqli_fetch_assoc($result);
      echo "<script>alert('Anda Berhasil Login');</script>";
      echo "<meta http-equiv='refresh' content='1;url=../pelanggan/checkout.php'>";
    } else {
      echo "<script>alert('Login Gagal');</script>";
      echo "<meta http-equiv='refresh' content='1;url=login.php'>";
    }
  }
  ?>

<?php include_once('../footer.php'); ?>

