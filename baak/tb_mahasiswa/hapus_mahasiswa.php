<?php
include "config.php";
$id_mhs = $_GET['id_mhs'];

$query = mysqli_query($koneksi, "DELETE FROM tb_mahasiswa WHERE id_mhs = '$id_mhs'");

if ($query) {
    echo "<script> alert ('Data Berhasil Dihapus'); window.location='mahasiswa.php'</script>";
} else {

    echo "<script> alert ('Data Gagal Dihapus'); window.location='mahasiswa.php'</script>";
}
