<?php
session_start();

include 'config.php';

$username = $_POST['username'];
$pw = $_POST['pw'];

$login = mysqli_query($koneksi, "SELECT * FROM tb_user WHERE username = '$username' AND pw= '$pw'");
$cek = mysqli_num_rows($login);

if ($cek > 0) {
    $data = mysqli_fetch_assoc($login);

    if ($data['lvl'] == 'TIM PMB') {
        $_SESSION['username'] = $username;
        $_SESSION['lvl'] == "TIM PMB";
        header("location:admin/tb_mahasiswa/mahasiswa.php");
    } else if ($data['lvl'] == 'BAAK') {
        $_SESSION['username'] = $username;
        $_SESSION['lvl'] == "BAAK";
        header("location:admin/tb_user/user.php");
    } else if ($data['lvl'] == 'Keuangan') {
        $_SESSION['username'] = $username;
        $_SESSION['lvl'] == "Keuangan";
        header("location:admin/tb_user/user.php");
    } else {
        header("location:login.php?pesan=gagal");
    }
} else {
    header("location:login.php?pesan=gagal");
}
