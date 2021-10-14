<?php
include "config.php";
$username = $_GET["username"];


function hapus($username)
{
    global $koneksi;
    mysqli_query($koneksi, "DELETE FROM tb_user WHERE username = '$username' ");
    return mysqli_affected_rows($koneksi);
}


if (hapus($username) > 0) {
    echo "<script> alert ('Data Berhasil Dihapus'); document.location.href='user.php';</script>";
} else {

    echo "<script> alert ('Data Gagal Dihapus'); document.location.href='user.php';</script>";
}
