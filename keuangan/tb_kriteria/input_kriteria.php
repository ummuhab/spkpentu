<?php
include "config.php";

function tambah($data)
{
    $koneksi = mysqli_connect("localhost", "root", "", "spkpentu");


    $nama_kriteria = $data['nama_kriteria'];
    $bobot_kriteria = $data['bobot_kriteria'];
    $keterangan = $data['keterangan'];
    // $periode = $data['periode'];
    $data_periode = mysqli_query($koneksi, " SELECT * from periode order by id_periode desc limit 1");
    $id_periode = mysqli_fetch_assoc($data_periode);

    $query = "insert INTO tb_kriteria (`nama_kriteria`,`bobot_kriteria`,`keterangan`,`id_periode`) VALUES ('$nama_kriteria', '$bobot_kriteria', '$keterangan','$id_periode[id_periode]')";
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
