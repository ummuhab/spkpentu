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
</head>

<body class="hold-transition sidebar-mini">
  <div class="wrapper">
    <?php
    require_once 'config.php';
    include '../../AdminLTE/header.php';
    include '../../AdminLTE/sidebar.php';
    ?>f
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>DATA MAHASISWA</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Data User</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Berikut merupakan data MAHASISWA di Politeknik Negeri Cilacap</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">

          <form method="post" enctype="multipart/form-data" action="upload_aksi.php">
            <div class="form-group">
              <h5>IMPORT DATA</h5>
              Pilih File:
              <input name="mahasiswa" type="file" required="required">
              <input name="upload" type="submit" value="Import">
            </div>
          </form>


          <a href="tambah_mahasiswa.php" class="btn btn-success pull-right"><i class="fas fa-plus"></i><span> Tambah Data</span></a>
          <br></br>
          <table id="example1" class="table table-bordered table-striped">

            <thead>
              <tr>
                <th>
                  <center>NIM</center>
                </th>
                <th>
                  <center>Nama Mahasiswa</center>
                </th>
                <th>
                  <center>Jenis Kelamin</center>
                </th>
                <th>
                  <center>Prodi</center>
                </th>
                <th>
                  <center>Jumlah Penghasilan Orang Tua</center>
                </th>
                <th>
                  <center>Jumlah Assets</center>
                </th>
                <th>
                  <center>Tanggungan</center>
                </th>
                <th>
                  <center>Jarak Rumah</center>
                </th>
                <th>
                  <center>Daya Listrik</center>
                </th>
                <th>
                  <center>Sumber Air</center>
                </th>
                <th>
                  <center>Jenis Pekerjaan Ayah</center>
                </th>
                <th>
                  <center>Jenis Pekerjaan Ibu</center>
                </th>
                <th>
                  <center>Aksi</center>
                </th>

              </tr>
            </thead>
            <tbody>
              <?php
              include "config.php";
              $data = mysqli_query($koneksi, " select
                                                               *
                                                          from tb_mahasiswa
                                                          ");
              while ($row = mysqli_fetch_array($data)) {
              ?>

                <tr>
                  <td>
                    <?php echo $row['NIM']; ?>
                  </td>
                  <td>
                    <?php echo $row['nama_mhs']; ?>
                  </td>
                  <td>
                    <?php echo $row['jk']; ?>
                  </td>
                  <td>
                    <?php echo $row['prodi']; ?>
                  </td>
                  <td>
                    <?php echo $row['jml_penghasilan_ortu']; ?>
                  </td>
                  <td>
                    <?php echo $row['assets']; ?>
                  </td>
                  <td>
                    <?php echo $row['tanggungan']; ?>
                  </td>
                  <td>
                    <?php echo $row['jarak_rumah']; ?>
                  </td>
                  <td>
                    <?php echo $row['daya_listrik']; ?>
                  </td>
                  <td>
                    <?php echo $row['sumber_air']; ?>
                  </td>
                  <td>
                    <?php echo $row['jns_pekerjaan_ayah']; ?>
                  </td>
                  <td>
                    <?php echo $row['jns_pekerjaan_ibu']; ?>
                  </td>
                  <td>
                    <div class="w3-dropdown-hover">

                      <div class="w3-dropdown-content w3-bar-block w3-card-4">
                        <center>
                          <a href='hapus_mahasiswa.php?NIM=<?php echo $row['NIM'];  ?>' class="btn btn-danger"> <i class="fas fa-trash"></i>
                            Hapus
                          </a>
                        </center>
                      </div>
                    </div>
                  </td>
                </tr>

              <?php
              }
              ?>
            </tbody>
          </table>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
    <!-- /.content-wrapper -->

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