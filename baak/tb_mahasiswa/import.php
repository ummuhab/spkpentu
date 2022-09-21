<?php
// Load file autoload.php
require '../../vendor/autoload.php';
session_start();

// Include librari PhpSpreadsheet
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SPK Penentuan UKT</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../AdminLTE/plugins/fontawesome-free/css/all.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="../../AdminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../../AdminLTE/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="../../AdminLTE/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../AdminLTE/dist/css/adminlte.min.css">
  <!-- Load File jquery.min.js yang ada difolder js -->
  <script src="../../AdminLTE/dist/js/jquery/jquery.min.js"></script>

  <script>
    $(document).ready(function() {
      // Sembunyikan alert validasi kosong
      $("#kosong").hide();
    });
  </script>
</head>

<body>
  <div class="wrapper">
    <?php
    require_once 'config.php';
    include '../../AdminLTE/header.php';
    include '../sidebar.php';
    ?>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>IMPORT MAHASISWA</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">BAAK</a></li>
                <li class="breadcrumb-item active">Import Mahasiswa</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Form Import Mahasiswa</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">

          <form method="post" action="import.php" enctype="multipart/form-data">
            <a class="btn btn-danger btn-sm" href="mahasiswa.php">Kembali</a> |
            <a class="btn btn-success btn-sm" href="import_mahasiswa.xlsx">Download Format</a>
            <br><br>
            Upload File Excel
            <div class="input-group">
              <div class="custom-file">
                <input type="file" name="file" id="file" class="form-control">
              </div>
            </div>

            <button type="submit" class="btn btn-primary mt-2" name="preview">Preview</button>
          </form>



        </div>
      </div>
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Preview Data</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <?php
          // Jika user telah mengklik tombol Preview
          if (isset($_POST['preview'])) {
            $tgl_sekarang = date('YmdHis'); // Ini akan mengambil waktu sekarang dengan format yyyymmddHHiiss
            $nama_file_baru = 'data' . $tgl_sekarang . '.xlsx';

            // Cek apakah terdapat file data.xlsx pada folder tmp
            if (is_file('tmp/' . $nama_file_baru)) // Jika file tersebut ada
              unlink('tmp/' . $nama_file_baru); // Hapus file tersebut

            $ext = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION); // Ambil ekstensi filenya apa
            $tmp_file = $_FILES['file']['tmp_name'];

            // Cek apakah file yang diupload adalah file Excel 2007 (.xlsx)
            if ($ext == "xlsx") {
              // Upload file yang dipilih ke folder tmp
              // dan rename file tersebut menjadi data{tglsekarang}.xlsx
              // {tglsekarang} diganti jadi tanggal sekarang dengan format yyyymmddHHiiss
              // Contoh nama file setelah di rename : data20210814192500.xlsx
              move_uploaded_file($tmp_file, 'tmp/' . $nama_file_baru);

              $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
              $spreadsheet = $reader->load('tmp/' . $nama_file_baru); // Load file yang tadi diupload ke folder tmp
              $sheet = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);

              // Buat sebuah tag form untuk proses import data ke database
              echo "<form method='post' action='input_import.php'>";

              // Disini kita buat input type hidden yg isinya adalah nama file excel yg diupload
              // ini tujuannya agar ketika import, kita memilih file yang tepat (sesuai yg diupload)
              echo "<input type='hidden' name='namafile' value='" . $nama_file_baru . "'>";

              // Buat sebuah div untuk alert validasi kosong / salah format
              echo "<div id='kosong' style='color: red;margin-bottom: 10px;'>
              Ada <span id='jumlah_kosong'></span> data yang belum diisi / salah format.
                      </div>";


              echo "<table class='table table-bordered mt-2' border='1' cellpadding='5'>
                <tr>
                  <th colspan='5' class='text-center'>Preview Data</th>
                </tr>
                <tr>
                  <th>NIM</th>
                  <th>Nama</th>
                  <th>Jenis Kelamin</th>
                  <th>Nama Prodi</th>
                </tr>";

              $numrow = 1;
              $kosong = 0;
              foreach ($sheet as $row) { // Lakukan perulangan dari data yang ada di excel
                // Ambil data pada excel sesuai Kolom
                $nim = $row['A']; // Ambil data nim
                $nama = $row['B']; // Ambil data nama
                $jenis_kelamin = $row['C']; // Ambil data jenis kelamin
                $prodi = $row['D']; // Ambil data prodi


                // Cek jika semua data tidak diisi
                if ($nim == "" && $nama == "" && $jenis_kelamin == "" && $prodi == "")
                  continue; // Lewat data pada baris ini (masuk ke looping selanjutnya / baris selanjutnya)

                // Cek $numrow apakah lebih dari 1
                // Artinya karena baris pertama adalah nama-nama kolom
                // Jadi dilewat saja, tidak usah diimport
                if ($numrow > 1) {
                  // Validasi apakah semua data telah diisi
                  $nim_td = (!empty($nim)) ? "" : " style='background: #E07171;'"; // Jika NIS kosong, beri warna merah
                  $nama_td = (!empty($nama)) ? "" : " style='background: #E07171;'"; // Jika Nama kosong, beri warna merah
                  $jk_td = (!empty($jenis_kelamin)) ? "" : " style='background: #E07171;'"; // Jika Jenis Kelamin kosong, beri warna merah
                  $prodi_td = (!empty($prodi)) ? "" : " style='background: #E07171;'"; // Jika Telepon kosong, beri warna merah


                  // Jika salah satu data ada yang kosong
                  if ($nim == "" or $nama == "" or $jenis_kelamin == "" or $prodi == "") {
                    $kosong++; // Tambah 1 variabel $kosong
                  }
                  if ($jenis_kelamin == 'P') {
                  } elseif ($jenis_kelamin == 'L') {
                  } else {
                    $jk_td = " style='background: #E07171;'";
                    $kosong++;
                  }
                  if (strlen($nim) > 10) {
                    $nim_td = " style='background: #E07171;'";
                    $kosong++;
                  }

                  if (!preg_match("/^[0-9]*$/", $nim)) {
                    $nim_td = " style='background: #E07171;'";
                    $kosong++;
                  }
                  // $data_periode = mysqli_query($koneksi, " SELECT * from periode order by id_periode desc limit 1");
                  // $id_periode = mysqli_fetch_assoc($data_periode);
                  // $cek = mysqli_num_rows(mysqli_query($koneksi, "select * from tb_mahasiswa where nim = '$nim'"));
                  // if($cek>0) {
                  //   $nim_td = " style='background: #E07171;'";
                  //   $kosong++;
                  // }
                  if (strlen($nama) > 50) {
                    $nama_td = " style='background: #E07171;'";
                    $kosong++;
                  }
                  $cek_prodi = mysqli_query($koneksi, "SELECT * FROM tb_prodi WHERE nama_prodi='$prodi'");
                  $cek_prodi_row = mysqli_num_rows($cek_prodi);
                  if ($cek_prodi_row < 1) {
                    $prodi_td = " style='background: #E07171;' ";
                    $kosong++;
                  }

                  echo "<tr>";
                  echo "<td" . $nim_td . ">" . $nim . "</td>";
                  echo "<td" . $nama_td . ">" . $nama . "</td>";
                  echo "<td" . $jk_td . ">" . $jenis_kelamin . "</td>";
                  echo "<td" . $prodi_td . ">" . $prodi . "</td>";
                  echo "</tr>";
                }

                $numrow++; // Tambah 1 setiap kali looping
              }

              echo "</table>";

              // Cek apakah variabel kosong lebih dari 0
              // Jika lebih dari 0, berarti ada data yang masih kosong atau tidak sesuai
              if ($kosong > 0) {
          ?>
                <script>
                  $(document).ready(function() {
                    // Ubah isi dari tag span dengan id jumlah_kosong dengan isi dari variabel kosong
                    $("#jumlah_kosong").html('<?php echo $kosong; ?>');

                    $("#kosong").show(); // Munculkan alert validasi kosong
                  });
                </script>
          <?php
              } else { // Jika semua data sudah diisi
                echo "<hr>";

                // Buat sebuah tombol untuk mengimport data ke database
                echo "<button class='btn btn-primary' type='submit' name='import'>Import</button>";
              }

              echo "</form>";
            } else { // Jika file yang diupload bukan File Excel 2007 (.xlsx)
              // Munculkan pesan validasi
              echo "<div style='color: red;margin-bottom: 10px;'>
                Hanya File Excel 2007 (.xlsx) yang diperbolehkan
                      </div>";
            }
          }
          ?>
        </div>
      </div>
    </div>

    <?php
    include '../../AdminLTE/footer.php';
    ?>


  </div>

  <!-- jQuery -->
  <script src="../../AdminLTE/plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="../../AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- DataTables  & Plugins -->
  <script src="../../AdminLTE/plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="../../AdminLTE/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="../../AdminLTE/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="../../AdminLTE/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
  <script src="../../AdminLTE/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
  <script src="../../AdminLTE/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
  <script src="../../AdminLTE/plugins/jszip/jszip.min.js"></script>
  <script src="../../AdminLTE/plugins/pdfmake/pdfmake.min.js"></script>
  <script src="../../AdminLTE/plugins/pdfmake/vfs_fonts.js"></script>
  <script src="../../AdminLTE/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
  <script src="../../AdminLTE/plugins/datatables-buttons/js/buttons.print.min.js"></script>
  <script src="../../AdminLTE/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
  <!-- AdminLTE App -->
  <script src="../../AdminLTE/dist/js/adminlte.min.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="../../AdminLTE/dist/js/demo.js"></script>
  <!-- Page specific script -->
  <script>
    $(function() {
      $("#example1").DataTable({
        "responsive": true,
        "lengthChange": false,
        "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
      $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
      });
    });
  </script>
</body>

</html>