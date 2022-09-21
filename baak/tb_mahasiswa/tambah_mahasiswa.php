<?php
require_once 'config.php';
?>
<?php
session_start();


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
        include "config.php";
        ?>


        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Tambah Data Mahasiswa</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">BAAK</a></li>
                                <li class="breadcrumb-item active">Form Tambah Data Mahasiswa</li>
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
                                <form action="input_mahasiswa.php" method="post" name="form1" id="form1">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="NIM">NIM</label>
                                            <input name="NIM" type="text" class="form-control" id="NIM" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1').replace(/^0[^.]/, '0');" placeholder="NIM" maxlength="10" required />
                                        </div>
                                        <div class="form-group">
                                            <label for="nama_mhs">Nama Mahasiswa</label>
                                            <input name="nama_mhs" type="text" class="form-control" id="nama_mhs" placeholder="Nama Mahasiswa" required />
                                        </div>

                                        <div class="form-group">
                                            <label>Jenis Kelamin</label>
                                            <select class="custom-select rounded-0" name="jk" id="jk" required="required">
                                                <option value="P"> Perempuan</option>
                                                <option value="L"> Laki - Laki</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Prodi</label>
                                            <select class="custom-select rounded-0" name="nama_prodi" id="nama_prodi" required="required">
                                                <?php

                                                $data = mysqli_query($koneksi, " SELECT * from tb_prodi
                                                          ");
                                                while ($row = mysqli_fetch_array($data)) {
                                                ?>
                                                    <option value="<?php echo $row['id_prodi']; ?>"><?php echo $row['nama_prodi']; ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>


                                        <div class="card-footer">
                                            <button type="submit" class="btn btn-primary pull-right">Simpan</button>
                                            <a href="mahasiswa.php" class="btn btn-success pull-right" style="margin-right:1%;">Batal</a>
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