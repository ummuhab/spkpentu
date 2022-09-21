<?php
include "config.php";

function tambah($data)
{
	// echo json_encode($data);
	$koneksi = mysqli_connect("localhost", "root", "", "spkpentu");

	$nama = $data['nama_level'];

	$data_periode = mysqli_query($koneksi, " SELECT * from periode order by id_periode desc limit 1");
	$id_periode = mysqli_fetch_assoc($data_periode);
	$rentang1 = $data['rentang_level1'];
	$rentang2 = $data['rentang_level2'];

	$ukt = $data['ukt'];

	$query = "INSERT INTO tb_levelukt (id_periode, nama_level, rentang_level_awal, rentang_level_akhir, ukt ) VALUES ('$id_periode[id_periode]',' $nama', '$rentang1', '$rentang2', '$ukt')";
	mysqli_query($koneksi, $query);
	return mysqli_affected_rows($koneksi);
}

if (isset($_POST['tambah'])) {
	if (tambah($_POST) > 0) {
		echo "
		<script>
			alert('Data Berhasil Ditambahkan');
			document.location.href = 'levelukt.php';
		</script>
	";
	} else {
		echo "
		<script>
			alert('Data Gagal Ditambahkan');
			document.location.href = 'levelukt.php';
		</script>
		";
	}
}
