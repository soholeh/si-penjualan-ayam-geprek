<?php
require_once "../_config/config.php";

unset($_SESSION['admin']);
echo "<script>window.location='".base_url('admin/auth/login.php')."';</script>";
?> 