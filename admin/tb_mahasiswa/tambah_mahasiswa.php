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
                            <h1>Tambah Data Mahasiswa</h1>
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
                                <form action="input_mahasiswa.php" method="post" name="form1" id="form1">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="NIM">NIM</label>
                                            <input name="NIM" type="text" class="form-control" id="NIM" placeholder="NIM" required />
                                        </div>
                                        <div class="form-group">
                                            <label for="nama_mhs">Nama Mahasiswa</label>
                                            <input name="nama_mhs" type="text" class="form-control" id="nama_mhs" placeholder="nama_mhs" required />
                                        </div>
                                        <div class="form-group">
                                            <label>Jenis Kelamin</label>
                                            <select class="custom-select rounded-0" name="jk" id="jk" required="required">
                                                <option>--Pilih Salah Satu---</option>
                                                <option>P</option>
                                                <option>L</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Prodi</label>
                                            <select class="custom-select rounded-0" name="prodi" id="prodi" required="required">
                                                <option>--Pilih Salah Satu---</option>
                                                <option>D3 TE</option>
                                                <option>D3 TL</option>
                                                <option>D3 TI</option>
                                                <option>D3 TM</option>
                                                <option>D4 TPPL</option>
                                                <option>D4 PPA</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="jml_penghasilan_ortu">Jumlah Penghasilan Orang Tua</label>
                                            <input name="jml_penghasilan_ortu" type="text" class="form-control" id="jml_penghasilan_ortu" placeholder="jml_penghasilan_ortu" required />
                                        </div>
                                        <div class="form-group">
                                            <label for="assets">Jumlah Assets</label>
                                            <input name="assets" type="text" class="form-control" id="assets" placeholder="assets" required />
                                        </div>
                                        <div class="form-group">
                                            <label for="tanggungan">Tanggungan</label>
                                            <input name="tanggungan" type="text" class="form-control" id="tanggungan" placeholder="tanggungan" required="required">
                                        </div>
                                        <div class="form-group">
                                            <label for="jarak_rumah">Jarak Rumah</label>
                                            <input name="jarak_rumah" type="text" class="form-control" id="jarak_rumah" placeholder="jarak_rumah" required="required">
                                        </div>
                                        <div class="form-group">
                                            <label>Daya lsitrik</label>
                                            <select class="custom-select rounded-0" name="daya_listrik" id="daya_listrik" required="required">
                                                <option>--Pilih Salah Satu---</option>
                                                <option>450 W</option>
                                                <option>900 W</option>
                                                <option>>=1300 W</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Sumber Air</label>
                                            <select class="custom-select rounded-0" name="sumber_air" id="sumber_air" required="required">
                                                <option>--Pilih Salah Satu---</option>
                                                <option>Sumur Galian</option>
                                                <option>Sumur Pompa</option>
                                                <option>Air PAM</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Jenis Pekerjaan Ayah</label>
                                            <select class="custom-select rounded-0" name="jns_pekerjaan_ayah" id="jns_pekerjaan_ayah" required="required">
                                                <option>--Pilih Salah Satu---</option>
                                                <option>Tidak Bekerja</option>
                                                <option>Pegawai Tidak Tetap : Nelayan, Petani/Peternak, Pedagang, dsb</option>
                                                <option>Pegawai Tetap : ASN, Pegawai BUMN BUMD, Swasta, dsb</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Jenis Pekerjaan Ibu</label>
                                            <select class="custom-select rounded-0" name="jns_pekerjaan_ibu" id="jns_pekerjaan_ibu" required="required">
                                                <option>--Pilih Salah Satu---</option>
                                                <option>Tidak Bekerja</option>
                                                <option>Pegawai Tidak Tetap : Nelayan, Petani/Peternak, Pedagang, dsb</option>
                                                <option>Pegawai Tetap : ASN, Pegawai BUMN BUMD, Swasta, dsb</option>
                                            </select>
                                        </div>
                                        <div class="card-footer">
                                            <button type="submit" class="btn btn-primary pull-right">Simpan</button>
                                            <a href="mahasiswa.php" class="btn btn-success pull-right" style="margin-right:1%;">Batal</a>
                                        </div>
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