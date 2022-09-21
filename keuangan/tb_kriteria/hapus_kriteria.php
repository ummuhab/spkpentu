<?php
include "config.php";
$id = $_GET['id_kriteria'];

function hapus($id)
{
    global $koneksi;
    mysqli_query($koneksi, "DELETE FROM tb_kriteria WHERE id_kriteria = '$id'");
    return mysqli_affected_rows($koneksi);
}


if (hapus($id) > 0) {
    echo "<script> alert ('Data Berhasil Dihapus'); document.location.href='kriteria.php';</script>";
} else {

    echo "<script> alert ('Data Gagal Dihapus'); document.location.href='kriteria.php';</script>";
}
