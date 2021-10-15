<?php
require_once 'config.php';
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
  <!-- Theme style -->
  <link rel="stylesheet" href="../../AdminLTE/dist/css/adminlte.min.css">
</head>

<body class="hold-transition sidebar-mini">
  <div class="wrapper">

    <?php
    include '../../AdminLTE/header.php';
    include '../../AdminLTE/sidebar.php';
    ?>


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Tambah Data User</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">General Form</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <!-- left column -->
            <div class="col-md-6">
              <!-- general form elements -->
              <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">Lengkapi data di bawah ini!</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form action="input_user.php" method="post" name="form1" id="form1">
                  <div class="card-body">
                    <div class="form-group">
                      <label for="username">Username</label>
                      <input name="username" type="text" class="form-control" id="username" placeholder="username" required />
                    </div>
                    <div class="form-group">
                      <label for="pw">Password</label>
                      <input name="pw" type="text" class="form-control" id="pw" placeholder="pw" required="required">
                    </div>
                    <div class="form-group">
                      <label for="lvl">User Level</label>
                      <select class="custom-select rounded-0" name="lvl" id="lvl" required="required">
                        <option>--Pilih Salah Satu---</option>
                        <option value="TIM PMB">TIM PMB</option>
                        <option value="BAAK">BAAK</option>
                        <option value="Keuangan">Keuangan</option>
                      </select>
                    </div>


                    <div class="card-footer">
                      <button type="submit" class="btn btn-primary pull-right">Simpan</button>
                      <a href="user.php" class="btn btn-success pull-right" style="margin-right:1%;">Batal</a>
                    </div>
                </form>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

    <!-- jQuery -->
    <script src="../../AdminLTE/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="../../AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- bs-custom-file-input -->
    <script src="../../AdminLTE/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../../AdminLTE/dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="../../AdminLTE/dist/js/demo.js"></script>
    <!-- Page specific script -->
    <script>
      $(function() {
        bsCustomFileInput.init();
      });
    </script>
</body>

</html>