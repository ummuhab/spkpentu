<!-- import excel ke mysql -->
<!-- www.malasngoding.com -->

<?php
// menghubungkan dengan koneksi
include 'config.php';
// menghubungkan dengan library excel reader
include "excel_reader2.php";
?>

<?php
// upload file xls
$target = basename($_FILES['mahasiswa']['name']);
move_uploaded_file($_FILES['mahasiswa']['tmp_name'], $target);

// beri permisi agar file xls dapat di baca
chmod($_FILES['mahasiswa']['name'], 0777);

// mengambil isi file xls
$data = new Spreadsheet_Excel_Reader($_FILES['mahasiswa']['name'], false);
// menghitung jumlah baris data yang ada
$jumlah_baris = $data->rowcount($sheet_index = 0);

// jumlah default data yang berhasil di import
$berhasil = 0;
for ($i = 2; $i <= $jumlah_baris; $i++) {

    // menangkap data dan memasukkan ke variabel sesuai dengan kolumnya masing-masing
    $NIM                    = $data->val($i, 1);
    $nama_mhs               = $data->val($i, 2);
    $jk                     = $data->val($i, 3);
    $prodi                  = $data->val($i, 4);
    $jml_penghasilan_ortu   = $data->val($i, 5);
    $assets                 = $data->val($i, 6);
    $tanggungan             = $data->val($i, 7);
    $jarak_rumah            = $data->val($i, 8);
    $daya_listrik           = $data->val($i, 9);
    $sumber_air             = $data->val($i, 10);
    $jns_pekerjaan_ayah     = $data->val($i, 11);
    $jns_pekerjaan_ibu      = $data->val($i, 12);

    if (
        $NIM != "" && $nama_mhs != "" && $jk != "" && $prodi != "" && $jml_penghasilan_ortu != "" && $assets != " " && $tanggungan != "" && $jarak_rumah != "" && $daya_listrik != "" && $sumber_air != "" && $jns_pekerjaan_ayah != "" && $jns_pekerjaan_ibu != ""
    ) {
        // input data ke database (table data_mahasiswa)
        mysqli_query($koneksi, "INSERT into tb_mahasiswa values('$NIM','$nama_mhs', '$jk', '$prodi', '$jml_penghasilan_ortu',
        '$assets', '$tanggungan', '$jarak_rumah', '$daya_listrik','$sumber_air', '$jns_pekerjaan_ayah', '$jns_pekerjaan_ibu')");
        $berhasil++;
    }
}

// hapus kembali file .xls yang di upload tadi
unlink($_FILES['mahasiswa']['name']);

// alihkan halaman ke index.php
header("location:mahasiswa.php?berhasil=$berhasil");
?>

<?php
// menghubungkan dengan koneksi
include 'config.php';
// menghubungkan dengan library excel reader
include "excel_reader2.php";
?>