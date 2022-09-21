<?php
include "config.php";
$id = $_GET['id_subkriteria'];

function hapus($id)
{
    global $koneksi;
    mysqli_query($koneksi, "DELETE FROM tb_subkriteria WHERE id_subkriteria = '$id'");
    return mysqli_affected_rows($koneksi);
}


if (hapus($id) > 0) {
    echo "<script> alert ('Data Berhasil Dihapus'); document.location.href='subkriteria.php';</script>";
} else {

    echo "<script> alert ('Data Gagal Dihapus'); document.location.href='subkriteria.php';</script>";
}
