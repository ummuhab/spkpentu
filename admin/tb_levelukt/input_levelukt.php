<?php
include "config.php";

function tambah($data)
{
	$koneksi = mysqli_connect("localhost", "root", "", "spkpentu");

	$nama = $data['nama_level'];
	$rentang = $data['rentang_level'];

	$query = "insert INTO tb_levelukt VALUES ('',' $nama', '$rentang')";
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
