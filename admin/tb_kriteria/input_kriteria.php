<?php
include "config.php";

function tambah($data)
{
    $koneksi = mysqli_connect("localhost", "root", "", "spkpentu");

    $id_kriteria = $data['id_kriteria'];
    $nama_kriteria = $data['nama_kriteria'];
    $bobot_kriteria = $data['bobot_kriteria'];
    $keterangan = $data['keterangan'];

    $query = "insert INTO tb_kriteria VALUES ('$id_kriteria','$nama_kriteria', '$bobot_kriteria', '$keterangan')";
    mysqli_query($koneksi, $query);
    return mysqli_affected_rows($koneksi);
}

if (isset($_POST['tambah'])) {
    if (tambah($_POST) > 0) {
        echo "
		<script>
			alert('Data Berhasil Ditambahkan');
			document.location.href = 'kriteria.php';
		</script>
	";
    } else {
        echo "
		<script>
			alert('Data Gagal Ditambahkan');
			document.location.href = 'kriteria.php';
		</script>
		";
    }
}
