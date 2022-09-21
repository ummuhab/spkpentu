<?php
include "config.php";
$id = $_GET['id_prodi'];

$query = mysqli_query($koneksi, "DELETE FROM tb_prodi WHERE id_prodi = '$id'");

if ($query) {
    echo "<script> alert ('Data Berhasil Dihapus'); window.location='prodi.php'</script>";
} else {

    echo "<script> alert ('Data Gagal Dihapus'); window.location='prodi.php'</script>";
}
