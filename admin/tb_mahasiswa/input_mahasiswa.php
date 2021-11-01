<?php
include "config.php";

$NIM = $_POST['NIM'];
$nama_mhs = $_POST['nama_mhs'];
$jk = $_POST['jk'];
$nama_prodi = $_POST['nama_prodi'];
$jml_penghasilan_ortu = $_POST['jml_penghasilan_ortu'];
$assets = $_POST['assets'];
$tanggungan = $_POST['tanggungan'];
$jarak_rumah = $_POST['jarak_rumah'];
$daya_listrik = $_POST['daya_listrik'];
$sumber_air = $_POST['sumber_air'];
$jns_pekerjaan_ayah = $_POST['jns_pekerjaan_ayah'];
$jns_pekerjaan_ibu = $_POST['jns_pekerjaan_ibu'];

$query = "INSERT INTO tb_mahasiswa VALUES ('$NIM','$nama_mhs', '$jk', '$nama_prodi', '$jml_penghasilan_ortu',
    '$assets', '$tanggungan', '$jarak_rumah', '$daya_listrik',
    '$sumber_air', '$jns_pekerjaan_ayah', '$jns_pekerjaan_ibu')";
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
