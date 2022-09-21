<?php
include "config.php";

function tambah($data)
{
    $koneksi = mysqli_connect("localhost", "root", "", "spkpentu");

    $nama = $data['nama_prodi'];


    $query = "insert INTO tb_prodi VALUES ('','$nama')";
    mysqli_query($koneksi, $query);
    return mysqli_affected_rows($koneksi);
}

if (isset($_POST['tambah'])) {
    if (tambah($_POST) > 0) {
        echo "
		<script>
			alert('Data Berhasil Ditambahkan');
			document.location.href = 'prodi.php';
		</script>
	";
    } else {
        echo "
		<script>
			alert('Data Gagal Ditambahkan');
			document.location.href = 'prodi.php';
		</script>
		";
    }
}
