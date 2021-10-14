<?php
include "config.php";

function edit($data)
{
	$koneksi = mysqli_connect("localhost", "root", "", "spkpentu");
	$id_level = $data['id_level'];
	$nama = $data['nama_level'];
	$rentang = $data['rentang_level'];

	$query = "UPDATE tb_levelukt set nama_level='$nama', rentang_level='$rentang' WHERE id_level='$id_level'";
	mysqli_query($koneksi, $query);
	return mysqli_affected_rows($koneksi);
}

if (isset($_POST['edit'])) {
	if (edit($_POST) > 0) {
		echo "
		<script>
			alert('Data Berhasil Diedit');
			document.location.href = 'levelukt.php';
		</script>
	";
	} else {
		echo "
		<script>
			alert('Data Gagal Diedit');
			document.location.href = 'levelukt.php';
		</script>
		";
	}
}
