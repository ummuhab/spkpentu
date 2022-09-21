<!DOCTYPE html>
<html lang="en">
<?php
session_start();
?>

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
    include '../sidebar.php';
    
    ?>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>DATA GOLONGAN UKT</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">BAAK</a></li>
                <li class="breadcrumb-item active">Data Golongan UKT</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Berikut merupakan data golongan UKT di Politeknik Negeri Cilacap</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <div class="row">
            <div class="col-12 ">
              <form action="" method="get">
                <div class="row">
                  <div class="col-9">
                    <select class="custom-select " name="periode" id="periode" required="required">
                      <?php

                      $data_periode = mysqli_query($koneksi, " SELECT * from periode order by id_periode desc");
                      while ($rows = mysqli_fetch_array($data_periode)) {
                      ?>
                        <option value="<?php echo $rows['id_periode']; ?>"><?php echo $rows['nama_periode']; ?></option>
                      <?php
                      }
                      ?>
                    </select>
                  </div>
                  <div class="col-3">
                    <button type="submit" class="btn btn-primary btn-block">Filter</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
          <br></br>
          <table id="example1" class="table table-bordered table-striped">

            <thead>
              <tr>
                <th>
                  <center>ID Level</center>
                </th>
                <th>
                  <center>Nama Periode</center>
                </th>
                <th>
                  <center>Nama Level</center>
                </th>
                <th>
                  <center>Rentang Level</center>
                </th>
              </tr>
            </thead>
            <tbody>
              <?php
              include "config.php";
              if (isset($_GET['periode'])) {
                $id_periode = $_GET['periode'];
                $data = mysqli_query($koneksi, " select * from tb_levelukt join periode on tb_levelukt.id_periode=periode.id_periode where periode.id_periode='$id_periode'");
              } else {
                $ceknowperiode = mysqli_query($koneksi, "SELECT id_periode FROM periode order by id_periode  desc LIMIT 1");
                $per = mysqli_fetch_assoc($ceknowperiode);
                $id_periode = $per['id_periode'];
                $data = mysqli_query($koneksi, " select * from tb_levelukt join periode on tb_levelukt.id_periode=periode.id_periode where periode.id_periode='$id_periode'");
              }
              while ($row = mysqli_fetch_array($data)) {
              ?>

                <tr>
                  <td>
                    <center>
                      <?php echo $row['id_level']; ?>
                    </center>
                  </td>
                  <td>
                    <center>
                      <?php echo $row['nama_periode']; ?>
                    </center>
                  </td>
                  <td>
                    <center>
                      <?php echo $row['nama_level']; ?>
                    </center>
                  </td>
                  <td>
                    <center>
                      <?php echo $row['rentang_level_awal'] . ' - ' . $row['rentang_level_akhir']; ?>
                    </center>
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
      }).container().appendTo('#example1_wrapper .col-md-6:eq(0)');
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