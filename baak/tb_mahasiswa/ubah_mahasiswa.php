<?php
include "config.php";

$id_mhs = $_POST['id_mhs'];
$NIM = $_POST['NIM'];
$nama_mhs = $_POST['nama_mhs'];
$jk = $_POST['jk'];
$nama_prodi = $_POST['nama_prodi'];

$query = "UPDATE tb_mahasiswa set nim='$NIM', nama_mhs='$nama_mhs', jk='$jk', id_prodi='$nama_prodi'  where id_mhs='$id_mhs' ";
mysqli_query($koneksi, $query);


if ($query) {
	echo "
		<script>
			alert('Data Berhasil Diubah');
			document.location.href = 'mahasiswa.php'
		</script>
	";
} else {
	echo "
		<script>
			alert('Data Gagal Diubah');
			document.location.href = 'mahasiswa.php'
		</script>
		";
}
