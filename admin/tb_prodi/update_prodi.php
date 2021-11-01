<?php
include "config.php";

function edit($data)
{
    $koneksi = mysqli_connect("localhost", "root", "", "spkpentu");
    $id_prodi = $data['id_prodi'];
    $nama = $data['nama_prodi'];


    $query = "UPDATE tb_prodi set nama_prodi='$nama' WHERE id_prodi='$id_prodi'";
    mysqli_query($koneksi, $query);
    return mysqli_affected_rows($koneksi);
}

if (isset($_POST['edit'])) {
    if (edit($_POST) > 0) {
        echo "
		<script>
			alert('Data Berhasil Diedit');
			document.location.href = 'prodi.php';
		</script>
	";
    } else {
        echo "
		<script>
			alert('Data Gagal Diedit');
			document.location.href = 'prodi.php';
		</script>
		";
    }
}
