<?php
include "config.php";

function edit($data)
{
    $koneksi = mysqli_connect("localhost", "root", "", "spkpentu");
    $id = $data['id_periode'];
    $nama = $data['nama_periode'];


    $query = "UPDATE periode set nama_periode='$nama' WHERE id_periode='$id'";
    mysqli_query($koneksi, $query);
    return mysqli_affected_rows($koneksi);
}

if (isset($_POST['edit'])) {
    if (edit($_POST) > 0) {
        echo "
		<script>
			alert('Data Berhasil Diedit');
			document.location.href = 'periode.php';
		</script>
	";
    } else {
        echo "
		<script>
			alert('Data Gagal Diedit');
			document.location.href = 'periode.php';
		</script>
		";
    }
}
