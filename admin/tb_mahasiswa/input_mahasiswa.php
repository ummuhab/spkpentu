<?php
include "config.php";

$NIM = $_POST['NIM'];
$nama_mhs = $_POST['nama_mhs'];
$jk = $_POST['jk'];
$nama_prodi = $_POST['nama_prodi'];
$nama_kriteria = $_POST['nama_kriteria'];
$nama_subkriteria = $_POST['nama_subkriteria'];


$query = "INSERT INTO tb_mahasiswa VALUES ('$NIM','$nama_mhs', '$jk', '$nama_prodi', '$nama_kriteria',
    '$nama_subkriteria')";
mysqli_query($koneksi, $query);


if ($query) {
	echo "
		<script>
			alert('Data Berhasil Ditambahkan');
			document.location.href = 'mahasiswa.php'
		</script>
	";
} else {
	echo "
		<script>
			alert('Data Gagal Ditambahkan');
			document.location.href = 'mahasiswa.php'
		</script>
		";
}
