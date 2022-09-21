<?php
include "config.php";

function tambah($data)
{
   
    $koneksi = mysqli_connect("localhost", "root", "", "spkpentu");

 
    $nama_subkriteria = $data['nama_subkriteria'];
    $id_kriteria = $data['id_kriteria'];
    $nilai_kriteria = $data['nilai_kriteria'];

    $query = "INSERT INTO tb_subkriteria ( nama_subkriteria, id_kriteria, nilai_kriteria) VALUES ('$nama_subkriteria', '$id_kriteria', '$nilai_kriteria')";
    mysqli_query($koneksi, $query);
    return mysqli_affected_rows($koneksi);
}

if (isset($_POST['tambah'])) {
    if (tambah($_POST) > 0) {
        echo "
		<script>
			alert('Data Berhasil Ditambahkan');
			document.location.href = 'subkriteria.php';
		</script>
	";
    } else {
        echo "
		<script>
			alert('Data Gagal Ditambahkan');
			document.location.href = 'subkriteria.php';
		</script>
		";
    }
}
