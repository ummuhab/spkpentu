<?php
include "config.php";


function edit($data)
{
    $koneksi = mysqli_connect("localhost", "root", "", "spkpentu");
    $id_subkriteria = $_POST['id_subkriteria'];
    $nama_subkriteria = $_POST['nama_subkriteria'];
    $id_kriteria = $_POST['id_kriteria'];
    $nilai_kriteria = $_POST['nilai_kriteria'];

    $query = "UPDATE tb_subkriteria set nama_subkriteria='$nama_subkriteria', id_kriteria= '$id_kriteria', nilai_kriteria='$nilai_kriteria' WHERE id_subkriteria='$id_subkriteria'";
    mysqli_query($koneksi, $query);
    return mysqli_affected_rows($koneksi);
}

if (isset($_POST['edit'])) {
    if (edit($_POST) > 0) {
        echo "
		<script>
			alert('Data Berhasil Diedit');
			document.location.href = 'subkriteria.php';
		</script>
	";
    } else {
        echo "
		<script>
			alert('Data Gagal Diedit');
			document.location.href = 'subkriteria.php';
		</script>
		";
    }
}
