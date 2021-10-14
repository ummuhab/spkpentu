<?php
session_start();

include "config.php";
if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $pw = $_POST['pw'];

    $login = mysqli_query($koneksi, "SELECT * FROM tb_user WHERE username = '$username' AND pw = '$pw'");
    $cek = mysqli_num_rows($login);

    if ($cek > 0) {
        $data = mysqli_fetch_assoc($login);

        if ($data['lvl'] == 'TIM PMB') {
            $_SESSION['username'] = $username;
            $_SESSION['pw'] = $pw;
            header("location:admin/tb_mahasiswa/mahasiswa.php");
        } elseif ($data['lvl'] == 'BAAK') {
            $_SESSION['username'] = $username;
            $_SESSION['pw'] = $pw;
            header("location:admin/tb_mahasiswa/mahasiswa.php");
        } elseif ($data['lvl'] == 'Keuangan') {
            $_SESSION['username'] = $username;
            $_SESSION['pw'] = $pw;
            header("location:admin/tb_mahasiswa/mahasiswa.php");
        } else {
            header("location:index.php?pesan=gagal");
        }
    } else {
        header("location:index.php?pesan=gagal");
    }
}
