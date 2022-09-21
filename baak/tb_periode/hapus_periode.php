<?php
include "config.php";
$id = $_GET['id_periode'];

$query = mysqli_query($koneksi, "DELETE FROM periode WHERE id_periode = '$id'");

if ($query) {
    echo "<script> alert ('Data Berhasil Dihapus'); window.location='periode.php'</script>";
} else {

    echo "<script> alert ('Data Gagal Dihapus'); window.location='periode.php'</script>";
}
