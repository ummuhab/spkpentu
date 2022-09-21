<?php
include "config.php";


function edit($data)
{
    $koneksi = mysqli_connect("localhost", "root", "", "spkpentu");
    $id_kriteria = $_POST['id_kriteria'];
    $nama_kriteria = $_POST['nama_kriteria'];
    $bobot_kriteria = $_POST['bobot_kriteria'];
    $keterangan = $_POST['keterangan'];

    $query = "UPDATE tb_kriteria set nama_kriteria='$nama_kriteria', bobot_kriteria='$bobot_kriteria', keterangan='$keterangan' WHERE id_kriteria='$id_kriteria'";
    mysqli_query($koneksi, $query);
    return mysqli_affected_rows($koneksi);
}

if (isset($_POST['edit'])) {
    if (edit($_POST) > 0) {
        echo "
		<script>
			alert('Data Berhasil Diedit');
			document.location.href = 'kriteria.php';
		</script>
	";
    } else {
        echo "
		<script>
			alert('Data Gagal Diedit');
			document.location.href = 'kriteria.php';
		</script>
		";
    }
}
