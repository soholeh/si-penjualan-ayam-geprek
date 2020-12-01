<?php
session_start();
//setting default timezone
date_default_timezone_set('Asia/Jakarta');
// koneksi
$koneksi = mysqli_connect('localhost', 'root', '', 'try');
if(mysqli_connect_errno()) {
    echo mysqli_connect_error();
}
// fungsi base_url
function base_url($url = null) {
    $base_url = "http://localhost/sbadmin";
    if ($url != null) {
        return $base_url."/".$url;
    } else {
        return $base_url;
    }
}
?>