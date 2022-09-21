<?php
include "config.php";

function tambah($data)
{
    $koneksi = mysqli_connect("localhost", "root", "", "spkpentu");

    $id_subkriteria = $data['id_subkriteria'];
    $nama_subkriteria = $data['nama_subkriteria'];
    $id_kriteria = $data['id_kriteria'];
    $nilai_kriteria = $data['nilai_kriteria'];

    // var_dump($id_subkriteria);
    // var_dump($nama_subkriteria);
    // var_dump($id_kriteria);
    // var_dump($nilai_kriteria);
    // die();

    $query = "INSERT INTO tb_subkriteria (id_subkriteria, nama_subkriteria, id_kriteria, nilai_kriteria) VALUES ('$id_subkriteria','$nama_subkriteria', '$id_kriteria', '$nilai_kriteria')";

    mysqli_query($koneksi, $query);
    // echo mysqli_error($koneksi);
    // die();
    return mysqli_affected_rows($koneksi);
}

if (isset($_POST['tambah'])) {
    if (tambah($_POST) > 0) {
        echo "
		<script>
			alert('Data Berhasil Ditambahkan');
			document.location.href = 'subkriteria1.php';
		</script>
	";
    } else {
        echo "
		<script>
			alert('Data Gagal Ditambahkan');
			document.location.href = 'subkriteria1.php';
		</script>
		";
    }
}
