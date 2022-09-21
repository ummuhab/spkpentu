<?php
// Load file koneksi.php
require_once 'config.php';

require '../../vendor/autoload.php';
session_start();

// Include librari PhpSpreadsheet
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

if(isset($_POST['import'])){ // Jika user mengklik tombol Import
  $nama_file_baru = $_POST['namafile'];
    $path = 'tmp/' . $nama_file_baru; // Set tempat menyimpan file tersebut dimana

    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
    $spreadsheet = $reader->load($path); // Load file yang tadi diupload ke folder tmp
    $sheet = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);

  $numrow = 1;
  foreach($sheet as $row){
    // Ambil data pada excel sesuai Kolom
    $nim = $row['A']; // Ambil data NIS
    $nama = $row['B']; // Ambil data nama
    $jenis_kelamin = $row['C']; // Ambil data jenis kelamin
    $prodi = $row['D']; // Ambil data telepon

    // Cek jika semua data tidak diisi
    if($nim == "" && $nama == "" && $jenis_kelamin == "" && $prodi == "" )
      continue; // Lewat data pada baris ini (masuk ke looping selanjutnya / baris selanjutnya)

    // Cek $numrow apakah lebih dari 1
    // Artinya karena baris pertama adalah nama-nama kolom
    // Jadi dilewat saja, tidak usah diimport
    if($numrow > 1){
      // Buat query Insert
      $data_periode = mysqli_query($koneksi, " SELECT * from periode order by id_periode desc limit 1");
      $id_periode = mysqli_fetch_assoc($data_periode);
      $data_prodi = mysqli_query($koneksi, " SELECT * from tb_prodi where nama_prodi='$prodi'  limit 1");
      $id_prodi = mysqli_fetch_assoc($data_prodi);
      $query = "INSERT INTO tb_mahasiswa(nim, id_periode, nama_mhs, jk, id_prodi) VALUES('$nim','$id_periode[id_periode]','$nama', '$jenis_kelamin', '$id_prodi[id_prodi]')";;

      // Eksekusi $query
      mysqli_query($koneksi, $query);
    }

    $numrow++; // Tambah 1 setiap kali looping
  }

    unlink($path); // Hapus file excel yg telah diupload, ini agar tidak terjadi penumpukan file
}

echo "
		<script>
			alert('Data Berhasil Ditambahkan');
			document.location.href = 'mahasiswa.php'
		</script>
	"; // Redirect ke halaman awal