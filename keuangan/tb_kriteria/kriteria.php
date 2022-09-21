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
              <h1>DATA KRITERIA</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Keuangan</a></li>
                <li class="breadcrumb-item active">Data Kriteria</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Berikut merupakan data Kriteria SPK Penentuan UKT</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <div class="row">
            <div class="col-12 col-md-6">
              <form action="kriteria.php" method="get">
                <div class="row">
                  <div class="col-6">
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
                  <div class="col-6">
                    <button type="submit" class="btn btn-primary">FILTER</button>
                  </div>
                </div>
              </form>
            </div>
            <div class="col-12 col-md-6 text-right">
              <a data-toggle="modal" data-target="#modal-tambah" class="btn btn-success pull-right"><i class="fas fa-plus"></i><span> Tambah Data</span></a>
            </div>
          </div>
          <div class="modal fade" id="modal-tambah">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title">Tambah Data Kriteria</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <form method="post" action="input_kriteria.php">
                    <!-- <div class="form-row"> -->

                    <!-- <div class="form-group">
                            <label>Periode</label>
                            <select class="custom-select rounded-0" name="periode" id="periode" required="required">
                                <option value="">--Pilih Salah Satu---</option>
                                <?php

                                $data_periode = mysqli_query($koneksi, " SELECT * from periode
                                          ");
                                while ($rows = mysqli_fetch_array($data_periode)) {
                                ?>
                                    <option value="<?php echo $rows['id_periode']; ?>"><?php echo $rows['nama_periode']; ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div> -->

                    <div class="form-group">
                      <label>Nama kriteria</label>
                      <input name="nama_kriteria" type="text" class="form-control" id="nama_kriteria" required />
                    </div>

                    <div class="form-group">
                      <label for="bobot_kriteria">Bobot kriteria</label>
                      <input name="bobot_kriteria" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1').replace(/^0[^.]/, '0');" type="text" class="form-control" id="bobot_kriteria" required />
                    </div>



                    <div class="form-group">
                      <label>Keterangan</label>
                      <select class="custom-select rounded-0" name="keterangan" id="keterangan" required="required">

                        <option>Benefit</option>
                        <option>Cost</option>
                      </select>
                    </div>
                    <!-- </div> -->



                    <div class="modal-footer justify-content-between">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                      <button type="tambah" class="btn btn-primary" id="tambah" name="tambah">Simpan</button>
                    </div>
                  </form>
                </div>
                <!-- /.modal-content -->
              </div>
              <!-- /.modal-dialog -->
            </div>
            <!-- /.modal -->
          </div>
          <br></br>
          <table id="example1" class="table table-bordered table-striped">

            <thead>
              <tr>
                <th>
                  <center>ID Kriteria</center>
                </th>
                <th>
                  <center>Nama Kriteria</center>
                </th>
                <th>
                  <center>Bobot Kriteria</center>
                </th>
                <th>
                  <center>Bobot Relatif</center>
                </th>
                <th>
                  <center>Keterangan</center>
                </th>

                <th>
                  <center>Aksi</center>
                </th>
              </tr>
            </thead>
            <tbody>
              <?php

              // $sqljumlah = "SELECT SUM(bobot_kriteria) FROM tb_kriteria";
              // $queryjumlah = mysqli_query($koneksi, $sqljumlah);
              // $jumlah0 = mysqli_fetch_array($queryjumlah);
              // $jumlah = $jumlah0[0];

              // CREATE view v_hitung_kriteria SELECT k.id_kriteria, k.bobot_kriteria, t.total , (k.bobot_kriteria / t.total) AS bobot_relatif FROM tb_kriteria AS k, v_totalbobot as t


              if (isset($_GET['periode'])) {
                $sql = "SELECT * FROM v_kriteria where v_kriteria.id_periode=" . $_GET['periode'];
              } else {
                $ceknowperiode = mysqli_query($koneksi, "SELECT id_periode FROM periode order by id_periode  desc LIMIT 1");
                $per = mysqli_fetch_assoc($ceknowperiode);
                $sql = "SELECT * FROM v_kriteria where v_kriteria.id_periode=" . $per['id_periode'];
              }
              $query = mysqli_query($koneksi, $sql);

              while ($barisbobot = mysqli_fetch_assoc($query)) {

              ?>

                <tr>
                  <td><?= $barisbobot['id_kriteria'] ?></td>
                  <td><?= $barisbobot['nama_kriteria'] ?></td>
                  <td class="text-right"><?= $barisbobot['bobot_kriteria'] ?></td>
                  <td class="text-right"><?= $barisbobot['bobot_relatif'] ?></td>
                  <td><?= $barisbobot['keterangan'] ?></td>

                  <td>
                    <center> <a data-toggle="modal" data-target="#modal_edit<?php echo $barisbobot['id_kriteria']; ?>" class="btn btn-primary"><i class="fas fa-edit"></i>Edit
                      </a>
                      <a onclick="return confirm('Apakah kamu yakin ingin menghapus data?')" href='hapus_kriteria.php?id_kriteria=<?php echo $barisbobot['id_kriteria'];  ?>' class="btn btn-danger"> <i class="fas fa-trash"></i>
                        Hapus
                      </a>

                    </center>
                  </td>


                </tr>

                <!-- modal edit -->
                <div class="modal fade" id="modal_edit<?php echo $barisbobot['id_kriteria']; ?>">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h4 class="modal-title">Edit Data Kriteria</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <form method="POST" action="update_kriteria.php">
                          <input name="id_kriteria" type="hidden" class="form-control" id="id_kriteria" value="<?php echo $barisbobot['id_kriteria']; ?>" required />
                          <div class="form-group">
                            <label>Nama kriteria</label>
                            <input name="nama_kriteria" type="text" class="form-control" id="nama_kriteria" placeholder="nama_kriteria" value="<?php echo $barisbobot['nama_kriteria']; ?>" required />
                          </div>

                          <div class="form-group">
                            <label for="bobot_kriteria">Bobot kriteria</label>
                            <input name="bobot_kriteria" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1').replace(/^0[^.]/, '0');" type="text" class="form-control" id="bobot_kriteria" placeholder="bobot_kriteria" value="<?php echo $barisbobot['bobot_kriteria']; ?>" required />
                          </div>

                          <div class="form-group">
                            <label>Keterangan</label>
                            <select class="custom-select rounded-0" name="keterangan" id="keterangan" required="required">
                              <option <?= $barisbobot['keterangan'] == 'Benefit' ? 'selected' : ''; ?>>Benefit</option>
                              <option <?= $barisbobot['keterangan'] == 'Cost' ? 'selected' : ''; ?>>Cost</option>
                            </select>
                          </div>
                          <!-- 
                          <div class="form-group">
                            <label for="bobot_relatif">Bobot Relatif</label>
                            <input name="bobot_relatif" type="text" class="form-control" id="bobot_relatif" value="<?= $barisbobot['bobot_kriteria'] / $jumlah ?>" readonly />
                          </div> -->


                      </div>

                      <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                        <button type="edit" id="edit" class="btn btn-primary" name="edit">Simpan Perubahan</button>
                      </div>
                      </form>
                    </div>
                    <!-- /.modal-content -->
                  </div>
                  <!-- /.modal-dialog -->
                </div>
                <!-- /.modal -->

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