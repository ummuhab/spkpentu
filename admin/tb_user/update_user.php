<?php
include "config.php";

function edit($data)
{
	$koneksi = mysqli_connect("localhost", "root", "", "spkpentu");

	$u = $data['username'];
	$pw = $data['pw'];
	$lvl = $data['lvl'];

	$query = "UPDATE tb_user set pw='$pw', lvl='$lvl' WHERE username='$u'";
	mysqli_query($koneksi, $query);
	return mysqli_affected_rows($koneksi);
}

if (isset($_POST['edit'])) {
	if (edit($_POST) > 0) {
		echo "
		<script>
			alert('Data Berhasil Diedit');
			document.location.href = 'user.php';
		</script>
	";
	} else {
		echo "
		<script>
			alert('Data Gagal Diedit');
			document.location.href = 'user.php';
		</script>
		";
	}
}
