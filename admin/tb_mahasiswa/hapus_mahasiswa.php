<?php
include "config.php";
$NIM = $_GET['NIM'];

$query = mysqli_query($koneksi, "DELETE FROM tb_mahasiswa WHERE NIM = '$NIM'");

if ($query) {
    echo "<script> alert ('Data Berhasil Dihapus'); window.location='mahasiswa.php'</script>";
} else {

    echo "<script> alert ('Data Gagal Dihapus'); window.location='mahasiswa.php'</script>";
}
