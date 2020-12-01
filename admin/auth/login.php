<?php require_once "../_config/config.php"; ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Login | Ge-Ju</title>
        <!-- ikon -->
        <link rel="icon" href="../_assets/gejulog.jpg" type="image/gif" sizes="16x16">
        <link href="<?=base_url('admin/_assets/dist/css/styles.css')?>" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body style="background-image: url(../_assets/bg_snow.jpg);" class="width-100 height-100">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row mt-5">
                            <div class="col-lg-12 text-center mt-5">
                                <img class="rounded-circle img-thumbnail" src="../_assets/gejulog.jpg" alt="" width="100" height="100">
                            </div>
                            <div class="col-lg-4 offset-lg-4">
                                <div class="card shadow-lg border-0 rounded-lg mt-4">
                                    <div class="card-header text-center bg-transparent">                                   
                                        <h3 class="text-center font-weight-bolt">Login Ge-Ju</h3>
                                    </div>
                                    <div class="card-body">
                                        <form method="post">
                                            <div class="form-group">
                                                <label class="sr-only">Email</label>
                                                <div class="input-group mb-2 mr-sm-2">
                                                    <div class="input-group-prepend">
                                                    <div class="input-group-text"><i class="fas fa-envelope"></i></div>
                                                    </div>
                                                    <input type="email" class="form-control" placeholder="Email" name='email' required autofocus>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="sr-only">Password</label>
                                                <div class="input-group mb-2 mr-sm-2">
                                                    <div class="input-group-prepend">
                                                    <div class="input-group-text"><i class="fas fa-lock"></i></div>
                                                    </div>
                                                    <input type="password" class="form-control" placeholder="Password" name="pass" required>
                                                </div>
                                            </div>
                                            <div class="form-group d-flex align-items-center justify-content-between mt-3 mb-0">
                                                <button class="btn btn-lg btn-primary btn-block" name="login">Login</button>
                                            </div>
                                        </form>
                                        <?php
                                        if (isset($_POST['login'])) {
                                            $email = $_POST['email'];
                                            $password = sha1($_POST['pass']);
                                            
                                            $sql = "SELECT * FROM user WHERE email ='$email' AND password ='$password' AND status ='admin'";
                                            $result = mysqli_query($koneksi, $sql);
                                            $yangcocok = mysqli_num_rows($result);
                                            if ($yangcocok == 1) {
                                            $_SESSION['admin']= mysqli_fetch_assoc($result);
                                            echo    "<script>
                                                        alert('Anda Berhasil Login');
                                                        location='../dashboard';
                                                    </script>";

                                            } else { ?>
                                            </br>
                                            <div class="alert alert-danger alert-dismissable" role="alert">
                                                <a href="#" class="close" data-dismiss="alert" arial-label="close">&times;</a>
                                                    <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                                                <strong>Login gagal</strong> Email atau Password salah. 
                                            </div>
                                            <?php
                                            }
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            <div id="layoutAuthentication_footer">
                <footer class="py-4 bg-transparent mt-auto">
                    <div class="container-fluid">
                        <div class="d-flex align-items-center justify-content-center small">
                            <div class="text-dark"><strong>Copyright &copy; Ge-Ju 2020</strong></div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="<?=base_url('admin/_assets/dist/js/scripts.js')?>"></script>
    </body>
</html>
