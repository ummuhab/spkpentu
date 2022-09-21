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
                            <h1>DATA PRODI</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Keuangan</a></li>
                                <li class="breadcrumb-item active">Data Prodi</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Berikut merupakan data program studi di Politeknik Negeri Cilacap</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">

                    <table id="example1" class="table table-bordered table-striped">

                        <thead>
                            <tr>
                                <th>
                                    <center>ID Prodi</center>
                                </th>
                                <th>
                                    <center>Nama Prodi</center>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            include "config.php";
                            $data = mysqli_query($koneksi, " select
                                                              *
                                                          from tb_prodi
                                                          ");
                            while ($row = mysqli_fetch_array($data)) {
                            ?>

                                <tr>
                                    <td>
                                        <center>
                                            <?php echo $row['id_prodi']; ?>
                                        </center>
                                    </td>
                                    <td>
                                        <center>
                                            <?php echo $row['nama_prodi']; ?>
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