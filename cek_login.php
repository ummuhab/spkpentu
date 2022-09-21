<?php
session_start();


include "config.php";

$username = $_POST["username"];
$password = $_POST["password"];

$login = mysqli_query($koneksi, "SELECT * FROM tb_user WHERE username = '$username' and pw = '$password'");

$cek = mysqli_num_rows($login);
// echo $cek;

if ($cek > 0) {
    $data = mysqli_fetch_assoc($login);
    if ($data['lvl'] == 'PANITIA PMB') {
        $_SESSION['username'] = $username;
        $_SESSION['pw'] = $password;
        header("location:admin/tb_mahasiswa/mahasiswa.php");
    } elseif ($data['lvl'] == 'BAAK') {
        $_SESSION['username'] = $username;
        $_SESSION['pw'] = $password;
        header("location:baak/tb_mahasiswa/mahasiswa.php");
    } elseif ($data['lvl'] == 'Keuangan') {
        $_SESSION['username'] = $username;
        $_SESSION['pw'] = $password;
        header("location:keuangan/tb_mahasiswa/mahasiswa.php");
    } else {
        header("location:index.php?pesan=gagal");
    }
} else {
    header("location:index.php?pesan=gagal");
}
