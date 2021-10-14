<?php
include "config.php";
$id = $_GET['id_level'];

$query = mysqli_query($koneksi, "DELETE FROM tb_levelukt WHERE id_level = '$id'");

if ($query) {
    echo "<script> alert ('Data Berhasil Dihapus'); window.location='levelukt.php'</script>";
} else {

    echo "<script> alert ('Data Gagal Dihapus'); window.location='levelukt.php'</script>";
}
