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
    $ceknowperiode = mysqli_query($koneksi, "SELECT id_periode FROM periode order by id_periode  desc LIMIT 1");
    $per = mysqli_fetch_assoc($ceknowperiode)
    ?>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>PRINT HASIL</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">BAAK</a></li>
                <li class="breadcrumb-item active">Hasil Rekomendasi</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Berikut merupakan hasil akhir data UKT Mahasiswa di Politeknik Negeri Cilacap</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body ">
          <div class="row mb-2">
            <div class="col-12 col-md-6">
              <form action="print.php" method="get">
                <div class="row">
                  <div class="col-6">
                    <select class="custom-select rounded-0" name="periode" id="periode">
                      <?php


                      $data_periode = mysqli_query($koneksi, " SELECT * from periode order by id_periode desc");
                      while ($rows = mysqli_fetch_array($data_periode)) {
                      ?>
                        <option value="<?= $rows['id_periode']; ?>"><?php echo $rows['nama_periode']; ?></option>
                      <?php
                      }
                      ?>
                    </select>
                  </div>
                  <div class="col-6">
                    <button type="submit" class="btn btn-primary">FILTER</button>
                  </div>
                </div>
              </form>
            </div>
            <div class="col-12 col-md-6 text-right">
              <?php if (isset($_GET['periode'])) { ?>
                <a href="cetak.php?periode=<?= $_GET['periode'] ?>" class="btn btn-success "><i class="fas fa-print"></i><span> Print Data</span></a>
              <?php } else { ?>
                <a href="cetak.php" class="btn btn-success "><i class="fas fa-print"></i><span> Print Data</span></a>
              <?php } ?>
            </div>
          </div>

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
                  <center>Prodi</center>
                </th>
                <th>
                  <center>Golongan UKT</center>
                </th>
                <th>
                  <center>Nominal UKT</center>
                </th>
              </tr>
            </thead>
            <tbody>
              <?php
              include "config.php";

              if (isset($_GET['periode']) && $_GET['periode'] != '') {
                $data = mysqli_query($koneksi, "SELECT tb_mahasiswa.nama_mhs, tb_mahasiswa.NIM, tb_prodi.nama_prodi,v_hasilakhir.nilai_akhir,(SELECT tb_levelukt.nama_level   FROM tb_levelukt where tb_levelukt.id_periode=" . $_GET['periode'] . " AND tb_levelukt.rentang_level_awal <= v_hasilakhir.nilai_akhir AND tb_levelukt.rentang_level_akhir >=v_hasilakhir.nilai_akhir) as golongan_ukt, (SELECT tb_levelukt.ukt   FROM tb_levelukt where tb_levelukt.id_periode=" . $_GET['periode'] . " AND  tb_levelukt.rentang_level_awal <= v_hasilakhir.nilai_akhir AND tb_levelukt.rentang_level_akhir >=v_hasilakhir.nilai_akhir) as nominal_ukt  from tb_mahasiswa left join v_hasilakhir ON tb_mahasiswa.id_mhs=v_hasilakhir.id_mhs LEFT JOIN tb_prodi on tb_prodi.id_prodi=tb_mahasiswa.id_prodi where tb_mahasiswa.id_periode=" . $_GET['periode'] . " order by ABS(tb_mahasiswa.NIM) asc");
              } else {

                $data = mysqli_query($koneksi, "SELECT tb_mahasiswa.nama_mhs, tb_mahasiswa.NIM, tb_prodi.nama_prodi,v_hasilakhir.nilai_akhir,(SELECT tb_levelukt.nama_level   FROM tb_levelukt where tb_levelukt.id_periode=" . $per['id_periode'] . " AND tb_levelukt.rentang_level_awal <= v_hasilakhir.nilai_akhir AND tb_levelukt.rentang_level_akhir >=v_hasilakhir.nilai_akhir) as golongan_ukt, (SELECT tb_levelukt.ukt   FROM tb_levelukt where tb_levelukt.id_periode=" . $per['id_periode'] . " AND tb_levelukt.rentang_level_awal <= v_hasilakhir.nilai_akhir AND tb_levelukt.rentang_level_akhir >=v_hasilakhir.nilai_akhir) as nominal_ukt  from tb_mahasiswa left join v_hasilakhir ON tb_mahasiswa.id_mhs=v_hasilakhir.id_mhs LEFT JOIN tb_prodi on tb_prodi.id_prodi=tb_mahasiswa.id_prodi where tb_mahasiswa.id_periode=" . $per['id_periode'] . " order by ABS(tb_mahasiswa.NIM) asc");
              }
              while ($row = mysqli_fetch_array($data)) {
              ?>

                <tr>
                  <td>
                    <center>
                      <?php echo $row['NIM']; ?>
                    </center>
                  </td>
                  <td>
                    <center>
                      <?php echo $row['nama_mhs']; ?>
                    </center>
                  </td>
                  <td>
                    <center>
                      <?php echo $row['nama_prodi']; ?>
                    </center>
                  </td>
                  <td>
                    <center>
                      <?php echo $row['golongan_ukt'] ? $row['golongan_ukt'] : 'Belum didata'; ?>
                    </center>
                  </td>
                  <td>
                    <center>
                      <?php echo $row['nominal_ukt'] ? $row['nominal_ukt'] : 'Belum didata'; ?>
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

      });
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