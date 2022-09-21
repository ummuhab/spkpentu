<?php
include "config.php";

function tambah($data)
{
    $koneksi = mysqli_connect("localhost", "root", "", "spkpentu");

    $nama = $data['nama_periode'];


    $query = "insert INTO periode (nama_periode) VALUES ('$nama')";
    mysqli_query($koneksi, $query);
    return mysqli_affected_rows($koneksi);
}

if (isset($_POST['tambah'])) {
    if (tambah($_POST) > 0) {
        echo "
		<script>
			alert('Data Berhasil Ditambahkan');
			document.location.href = 'periode.php';
		</script>
	";
    } else {
        echo "
		<script>
			alert('Data Gagal Ditambahkan');
			document.location.href = 'periode.php';
		</script>
		";
    }
}
