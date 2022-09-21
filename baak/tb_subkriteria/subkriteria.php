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
              <h1>DATA SUBKRITERIA</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">BAAK</a></li>
                <li class="breadcrumb-item active">Data Sub Kriteria</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Berikut merupakan data Sub Kriteria SPK Penentuan UKT</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <div class="row">
            <div class="col-12">
              <form action="subkriteria.php" method="get">
                <div class="row">
                  <div class="col-9">
                    <select class="custom-select rounded-0" name="periode" id="periode" required="required">
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
                    <button type="submit" class="btn btn-primary btn-block">FILTER</button>
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
                  <center>ID Sub Kriteria</center>
                </th>
                <th>
                  <center>Nama SubKriteria</center>
                </th>
                <th>
                  <center>Nama Kriteria</center>
                </th>
                <th>
                  <center>Nilai Kriteria</center>
                </th>
              </tr>
            </thead>
            <tbody>
              <?php
              if (isset($_GET['periode'])) {
                $data = mysqli_query($koneksi, " select
                    tb_subkriteria.id_subkriteria,
                    tb_subkriteria.nama_subkriteria,
                    tb_subkriteria.id_kriteria,
                    tb_subkriteria.nilai_kriteria,
                    tb_kriteria.nama_kriteria
  
                from tb_subkriteria join tb_kriteria on tb_kriteria.id_kriteria=tb_subkriteria.id_kriteria where tb_kriteria.id_periode=" . $_GET['periode']);
              } else {
                $ceknowperiode = mysqli_query($koneksi, "SELECT id_periode FROM periode order by id_periode  desc LIMIT 1");
                $per = mysqli_fetch_assoc($ceknowperiode);
                $data = mysqli_query($koneksi, " select
                    tb_subkriteria.id_subkriteria,
                    tb_subkriteria.nama_subkriteria,
                    tb_subkriteria.id_kriteria,
                    tb_subkriteria.nilai_kriteria,
                    tb_kriteria.nama_kriteria
  
                from tb_subkriteria join tb_kriteria on tb_kriteria.id_kriteria=tb_subkriteria.id_kriteria where tb_kriteria.id_periode=" . $per['id_periode']);
              }

              while ($row = mysqli_fetch_array($data)) {
              ?>

                <tr>
                  <td>
                    <center>
                      <?php echo $row['id_subkriteria']; ?>
                    </center>
                  </td>
                  <td>
                    <center>
                      <?php echo $row['nama_subkriteria']; ?>
                    </center>
                  </td>
                  <td>
                    <center>
                      <?php echo $row['nama_kriteria']; ?>
                    </center>
                  </td>
                  <td>
                    <center>
                      <?php echo $row['nilai_kriteria']; ?>
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

    <!-- modal tambah -->

    <?php
    $query = mysqli_query($koneksi, "SELECT * FROM tb_subkriteria order by id_subkriteria desc");
    $row = mysqli_fetch_array($query);
    // $totalrow = mysqli_num_rows($query);

    // if ($totalrow > 0) {
    //   $id_terakhir = substr($row['id_subkriteria'], -3);
    //   $nourut = $id_terakhir + 1;
    //   if($nourut < 10){
    //     $isiid = "K-" . "00" . $nourut;
    //   }elseif($nourut < 100){
    //     $isiid = "K-" . "0" . $nourut;
    //   }else{
    //     $isiid = "K-"  . $nourut;
    //   }
    // } else if ($totalrow == 0) {
    //   $nourut = 1;
    //   $isiid = "K-" . "00" . $nourut;
    // }
    //  else if ($totalrow == 0) {
    //   $no = 1;
    //   $isiid = "SK-00" . $no;
    //   // $nourut = 1;
    //   // $isiid = "SK-" .  $nourut;
    // }


    ?>

  </div>
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