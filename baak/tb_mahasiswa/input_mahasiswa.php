<?php
include "../../config.php";

$NIM = $_POST['NIM'];
$nama_mhs = $_POST['nama_mhs']; //kiri bebas, kanan yg ada di name
$jk = $_POST['jk'];
$nama_prodi = $_POST['nama_prodi'];
// $periode = $_POST['periode'];
$data_periode = mysqli_query($koneksi, " SELECT * from periode order by id_periode desc limit 1");
$id_periode = mysqli_fetch_assoc($data_periode);

$cek = mysqli_num_rows(mysqli_query($koneksi, "select * from tb_mahasiswa where nim = '$NIM'"));

if ($cek > 0) {
	echo "
		<script>
			alert('Data Sudah Tersedia');
			document.location.href = 'mahasiswa.php'
		</script>
		";
} else {
	$query = "INSERT INTO tb_mahasiswa (nim, id_periode, nama_mhs, jk, id_prodi) VALUES ('$NIM','$id_periode[id_periode]','$nama_mhs', '$jk', '$nama_prodi')";
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
}
