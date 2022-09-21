<?php
include "config.php";

function edit($data)
{
	$koneksi = mysqli_connect("localhost", "root", "", "spkpentu");
	$id_level = $data['id_level'];
	$nama = $data['nama_level'];
	// $periode = $data['periode'];
	$rentang1 = $data['rentang_level1'];
	$rentang2 = $data['rentang_level2'];

	$ukt = $data['ukt'];

	$query = "UPDATE tb_levelukt set nama_level='$nama', rentang_level_awal='$rentang1',rentang_level_akhir='$rentang2', ukt='$ukt' WHERE id_level='$id_level' ";
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
