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
        session_start();

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
                            <h1>HASIL PERHITUNGAN</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">BAAK</a></li>
                                <li class="breadcrumb-item active">Hasil Perhitungan</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>
            <!-- FILTER CARD -->
            <div class="card mr-2 ml-2 mb-2">
                <div class="card-header">
                    PERIODE
                </div>
                <div class="card-body">
                    <form action="perhitunganakhir.php" method="get">
                        <div class="row mb-2">
                            <div class="col-9  text-center">
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
                            <div class="col-3  text-center">
                                <button type="submit" class="btn btn-primary btn-block">FILTER</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- tabel perhitungan -->
            <div class="card mr-2 ml-2 mb-2">
                <div class="card-header">
                    <h3 class="card-title"> TABEL PERHITUNGAN UTILITY</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">

                    <table id="example1" class="table table-bordered table-striped">

                        <thead>
                            <?php
                            if (isset($_GET['periode'])) {
                                $datak = mysqli_query($koneksi, "select * from tb_kriteria where tb_kriteria.id_periode=$_GET[periode] order by ABS(tb_kriteria.id_kriteria) asc");
                            } else {
                                $ceknowperiode = mysqli_query($koneksi, "SELECT id_periode FROM periode order by id_periode  desc LIMIT 1");
                                $per = mysqli_fetch_assoc($ceknowperiode);
                                $datak = mysqli_query($koneksi, "select * from tb_kriteria where tb_kriteria.id_periode=$per[id_periode] order by ABS(tb_kriteria.id_kriteria) asc");
                            }
                            $rowk = mysqli_num_rows($datak);
                            ?>
                            <tr>
                                <th rowspan="2">
                                    <center>NIM</center>
                                </th>
                                <th rowspan="2">
                                    <center>Nama Mahasiswa</center>
                                </th>

                                <th colspan="<?php echo $rowk; ?>" style="vertical-align : middle;text-align:center;">Utility</th>
                            </tr>
                            <tr style="vertical-align : middle;text-align:center;" class="bg bg-secondary">
                                <?php
                                for ($n = 1; $n <= $rowk; $n++) {
                                    echo "<th>C{$n}</th>";
                                }
                                ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (isset($_GET['periode'])) {
                                $data = mysqli_query($koneksi, "select * from tb_mahasiswa where tb_mahasiswa.id_periode=$_GET[periode] order by abs(NIM) asc;");
                            } else {
                                $ceknowperiode = mysqli_query($koneksi, "SELECT id_periode FROM periode order by id_periode  desc LIMIT 1");
                                $per = mysqli_fetch_assoc($ceknowperiode);
                                $data = mysqli_query($koneksi, "select * from tb_mahasiswa where tb_mahasiswa.id_periode=$per[id_periode] order by abs(NIM) asc;");
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



                                <?php
                                $idalt = $row['id_mhs'];
                                //ambil nilai
                                $n = mysqli_query($koneksi, "select * from v_utility where v_utility.id_mhs='$idalt'");
                                $nnum = mysqli_num_rows($n);
                                if ($nnum > 0) {
                                    while ($d = mysqli_fetch_array($n)) {
                                        if ($d['utility'] != NULL) {
                                            echo "<td align='center'>$d[utility]</td>";
                                        } else {
                                            echo "<td>0.0000</td>";
                                        }
                                    }
                                    if ($rowk - $nnum > 0) {
                                        for ($i = 1; $i <= $rowk - $nnum; $i++) {
                                            echo "<td>kosong</td>";
                                        }
                                    }
                                } else {
                                    for ($n = 1; $n <= $rowk; $n++) {
                                        echo "<td>kosong</td>";
                                    }
                                }

                                echo "</tr>\n";
                            }
                                ?>


                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <div class="card mr-2 ml-2 mb-2">
                <div class="card-header">
                    <h3 class="card-title"> TABEL PERHITUNGAN HASIL AKHIR</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">

                    <table id="example2" class="table table-bordered table-striped">

                        <thead>

                            <tr>
                                <th rowspan="2">
                                    <center>NIM</center>
                                </th>
                                <th rowspan="2">
                                    <center>Nama Mahasiswa</center>
                                </th>

                                <th colspan="<?php echo $rowk; ?>" style="vertical-align : middle;text-align:center;">Hasil</th>
                                <th rowspan="2">
                                    <center>Nilai Akhir</center>
                                </th>
                                <th rowspan="2">
                                    <center>Kelompok UKT</center>
                                </th>
                            </tr>
                            <tr style="vertical-align : middle;text-align:center;" class="bg bg-secondary">
                                <?php
                                for ($n = 1; $n <= $rowk; $n++) {
                                    echo "<th>C{$n}</th>";
                                }
                                ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            if (isset($_GET['periode'])) {
                                $datam = mysqli_query($koneksi, "select * from tb_mahasiswa where tb_mahasiswa.id_periode=$_GET[periode] order by abs(NIM) asc;");
                            } else {
                                $ceknowperiode = mysqli_query($koneksi, "SELECT id_periode FROM periode order by id_periode  desc LIMIT 1");
                                $per = mysqli_fetch_assoc($ceknowperiode);
                                $datam = mysqli_query($koneksi, "select * from tb_mahasiswa where tb_mahasiswa.id_periode=$per[id_periode] order by abs(NIM) asc;");
                            }
                            while ($row = mysqli_fetch_array($datam)) {
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



                                <?php
                                $idalt = $row['id_mhs'];
                                //ambil nilai
                                $nhsil = mysqli_query($koneksi, "select * from v_hasil where v_hasil.id_mhs='$idalt'");
                                $nhasilnum = mysqli_num_rows($nhsil);
                                if ($nhasilnum > 0) {
                                    while ($dn = mysqli_fetch_assoc($nhsil)) {
                                        if ($dn['hasil'] != NULL) {
                                            echo "<td align='center'>$dn[hasil]</td>";
                                        } else {
                                            echo "<td>0.0000</td>";
                                        }
                                    }
                                    if ($rowk - $nhasilnum > 0) {
                                        for ($i = 1; $i <= $rowk - $nhasilnum; $i++) {
                                            echo "<td>kosong</td>";
                                        }
                                    }
                                } else {
                                    for ($n = 1; $n <= $rowk; $n++) {
                                        echo "<td align='center'>kosong</td>";
                                    }
                                }


                                $nakhir = mysqli_query($koneksi, "select * from v_hasilakhir where v_hasilakhir.id_mhs='$idalt' limit 1");
                                $dnakhir = mysqli_fetch_assoc($nakhir);
                                if ($dnakhir) {

                                    echo "<td align='center'>$dnakhir[nilai_akhir]</td>";
                                } else {

                                    echo "<td align='center'>Belum Ada Nilai</td>";
                                }

                                if ($dnakhir) {
                                    if (isset($_GET['periode'])) {
                                        $nlvlukt = mysqli_query($koneksi, "select * from tb_levelukt where tb_levelukt.rentang_level_awal <= '$dnakhir[nilai_akhir]' AND tb_levelukt.rentang_level_akhir >='$dnakhir[nilai_akhir]' AND tb_levelukt.id_periode='$_GET[periode]' limit 1");
                                        $dnlvlukt = mysqli_fetch_assoc($nlvlukt);
                                    } else {
                                        $ceknowperiodes = mysqli_query($koneksi, "SELECT id_periode FROM periode order by id_periode  desc LIMIT 1");
                                        $pers = mysqli_fetch_assoc($ceknowperiodes);
                                        $nlvlukt = mysqli_query($koneksi, "select * from tb_levelukt where tb_levelukt.rentang_level_awal <= '$dnakhir[nilai_akhir]' AND tb_levelukt.rentang_level_akhir >='$dnakhir[nilai_akhir]' AND tb_levelukt.id_periode='$pers[id_periode]' limit 1");
                                        $dnlvlukt = mysqli_fetch_assoc($nlvlukt);
                                    }

                                    if ($dnlvlukt) {

                                        echo "<td align='center'>$dnlvlukt[nama_level]</td>";
                                    }
                                } else {
                                    echo "<td align='center'>Belum Ada Nilai</td>";
                                }

                                echo "</tr>\n";
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
                "buttons": ["copy", "pdf", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            $('#example2').DataTable({
                "dom": 'Bfrtip',
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
                "buttons": ["copy", {
                    extend: 'pdfHtml5',
                    exportOptions: {
                        columns: [0, <?= $rowk + 2 ?>, <?= $rowk + 3 ?>]
                    }
                }, "colvis"]
            }).buttons().container().appendTo('#example2_wrapper .col-md-6:eq(0)');
        });
    </script>

</body>

</html>