<?php
session_start();
include "config.php";

$update = (isset($_GET['action']) and $_GET['action'] == 'update') ? true : false;
if ($update) {
	$sqlnya = mysqli_query($koneksi, "SELECT tb_nilaikriteriamhs.*, tb_subkriteria.nilai_kriteria, tb_subkriteria.nama_subkriteria, tb_kriteria.id_periode,tb_kriteria.id_kriteria FROM tb_kriteria  left join  tb_nilaikriteriamhs on tb_kriteria.id_kriteria=tb_nilaikriteriamhs.id_kriteria left join tb_subkriteria on tb_kriteria.id_kriteria=tb_subkriteria.id_kriteria WHERE tb_nilaikriteriamhs.id_mhs='$_GET[key]' and tb_kriteria.id_periode='$_GET[search]' GROUP by tb_kriteria.id_kriteria order by tb_kriteria.id_kriteria asc");

	// $rownya = mysqli_fetch_array($sqlnya);
	$rownya = mysqli_fetch_all($sqlnya, MYSQLI_ASSOC);
	// while ($rownya = mysqli_fetch_array($sqlnya)) {

	// }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" and isset($_POST["save"])) {

	if ($update) {
		$koneksi->query("DELETE tb_nilaikriteriamhs.*  FROM tb_nilaikriteriamhs  join tb_kriteria on tb_kriteria.id_kriteria=tb_nilaikriteriamhs.id_kriteria WHERE id_mhs='$_GET[key]' and tb_kriteria.id_periode='$_GET[search]'");
		$allNilai = $_POST["nilai"];


		$query = "INSERT INTO tb_nilaikriteriamhs VALUES ";
		foreach ($allNilai as $id_kriteria => $nilai) {
			if ($nilai != '') {
				$query = "INSERT INTO tb_nilaikriteriamhs VALUES (NULL, '$_POST[id_mhs]', '$id_kriteria',  $nilai)";
				mysqli_query($koneksi, $query);
			}
		}
		// echo $query;
		// var_dump($query);
		// die();
		// $sql = rtrim($query, ',');
		// mysqli_query($koneksi, $query);
		// $validasi = true;
		$_POST["nilai"] = [];
		echo "
			<script>
				alert('Data Berhasil Ditambahkan');
				document.location.href = 'nilaikriteriamhs1.php';
			</script>
		";
	} else {
		// var_dump($_POST['nilai']['K-001']);
		// die();
		$allNilai = $_POST["nilai"];

		foreach ($allNilai as $id_kriteria => $nilai) {
			if ($nilai != '') {
				$query = "INSERT INTO tb_nilaikriteriamhs VALUES (NULL, '$_POST[id_mhs]', '$id_kriteria',  $nilai)";
				mysqli_query($koneksi, $query);
			}
		}

		$_POST["nilai"] = [];
		echo "
			<script>
				alert('Data Berhasil Ditambahkan');
				document.location.href = 'nilaikriteriamhs1.php';
			</script>
		";
	}
}

if (isset($_GET['action']) and $_GET['action'] == 'delete') {
	$koneksi->query("DELETE tb_nilaikriteriamhs.*  FROM tb_nilaikriteriamhs INNER join tb_kriteria on tb_kriteria.id_kriteria=tb_nilaikriteriamhs.id_kriteria WHERE id_mhs='$_GET[key]' and tb_kriteria.id_periode='$_GET[key2]'");
	echo
	"<script>
                alert('Berhasil!', 'nilaikriteriamhs1.php')
                </script>
                ";
}
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
		$per = mysqli_fetch_assoc($ceknowperiode);
		?>

		<div class="content-wrapper">
			<!-- Content Header (Page header) -->
			<section class="content-header">
				<div class="container-fluid">
					<div class="row mb-2">
						<div class="col-sm-6">
							<h1 class="text-uppercase">Data Nilai Kriteria Mahasiswa</h1>

						</div>

					</div>
				</div><!-- /.container-fluid -->
			</section>
			<!-- Main content -->
			<section class="content">

				<div class="container-fluid">
					<div class="row">
						<div class="col-12">
							<div class="card" style=" margin: 0 auto">
								<div class="card-header">
									Tambah Data
								</div>

								<div class="card-body">
									<form action="<?= $_SERVER["REQUEST_URI"] ?>" method="get">
										<?php if (isset($_GET['search'])) : ?>
											<a href="?" class="btn btn-danger ">Kembali</a>
										<?php else : ?>
											<div class="form-group">
												<label for="periode">Periode</label>
												<select class="custom-select rounded-0" name="search" id="periode" required="required">
													<?php


													$data_periode = mysqli_query($koneksi, " SELECT * from periode order by id_periode desc");
													while ($rows = mysqli_fetch_array($data_periode)) {
													?>
														<option value="<?php echo $rows['id_periode']; ?>"><?php echo $rows['nama_periode']; ?></option>
													<?php
													}
													?>
												</select>
												<button type="submit" id="simpan" class="mt-2 btn btn-info" ?> Tambah Data Nilai Kriteria Mahasiswa </button>
											</div>
										<?php endif; ?>

									</form>

									<?php if (isset($_GET['search']) && $_GET['search']) : ?>
										<form action="<?= $_SERVER["REQUEST_URI"] ?>" method="post">
											<div class="form-group">
												<?php
												$cekoperiode = mysqli_query($koneksi, "SELECT nama_periode FROM periode where id_periode=" . $_GET['search'] . " order by id_periode   desc LIMIT 1");
												$per2 = mysqli_fetch_assoc($cekoperiode);
												?>
												<label for="periode">Periode <?= $per2['nama_periode'] ?></label>
												<input class="form-control" type="text" value="<?= $per2['nama_periode'] ?>" readonly>
												<input name="periode" type="hidden" value="<?= $_GET['search'] ?>">
											</div>
											<div class="form-group">
												<label for="mahasiswa">Mahasiswa</label>
												<select class="form-control" name="id_mhs" <?= !isset($_GET["key"]) ? '' : 'readonly' ?>>
													<?php
													if (isset($_GET['action']) and $_GET['action'] == 'update' and isset($_GET['search']) and $_GET['search'] != null) {
														$sql = $koneksi->query("SELECT * FROM tb_mahasiswa where id_periode=" . $_GET['search']);
													} else {

														$sql = $koneksi->query("SELECT * FROM tb_mahasiswa where id_periode=" . $_GET['search'] . " AND id_mhs NOT IN
																				(SELECT id_mhs FROM tb_nilaikriteriamhs where id_periode=" . $_GET['search'] . ")");
													}

													while ($data = $sql->fetch_assoc()) : ?>
														<option value="<?= $data["id_mhs"] ?>" <?= (!$update && !isset($_GET["key"])) ? "" : (($_GET["key"] != $data["id_mhs"]) ? "" : ' selected="selected"') ?>><?= $data["NIM"] ?> | <?= $data["nama_mhs"] ?></option>
													<?php endwhile; ?>
												</select>
											</div>
											<?php $zi = 0;
											$q = $koneksi->query("SELECT * FROM tb_kriteria where  id_periode=$_GET[search] order by ABS(id_kriteria) asc");
											while ($r = $q->fetch_assoc()) : ?>
												<div class="form-group">
													<label for="nilai"><?= ucfirst($r["nama_kriteria"]) ?></label>
													<div class="cell colspan2">
														<div class="input-control select full-size">
															<select class="form-control" name="nilai[<?= $r["id_kriteria"] ?>]" id="nilai">
																<option value="">---</option>
																<?php $sql = $koneksi->query("SELECT * from tb_subkriteria where id_kriteria='" . $r['id_kriteria'] . "'");
																while ($data = $sql->fetch_assoc()) : ?>
																	<option value="<?= $data["id_subkriteria"] ?>" class="<?= $data["id_kriteria"] ?>" <?= (!$update) ? "" : (!empty($rownya[$zi]) ? (($rownya[$zi]["id_subkriteria"] != $data["id_subkriteria"]) ? "" : ' selected="selected"') : "") ?>><?= $data["nama_subkriteria"] ?></option>
																<?php endwhile; ?>
															</select>
														</div>
													</div>
												<?php $zi++;
											endwhile; ?>
												<input type="hidden" name="save" value="true">
												<button type="submit" id="simpan" class="mt-2 btn btn-info" ?> Simpan </button>
										</form>
									<?php endif; ?>
								</div>
							</div>
						</div>
						<div class="col-12">
							<div class="card mt-2">
								<div class="card-header">
									Berikut merupakan data nilai kriteria mahasiswa
								</div>

								<div class="card-body">
									<form action="nilaikriteriamhs1.php" method="get">
										<div class="row mb-2">
											<div class="col-9  text-center">
												<select class="custom-select rounded-0" name="periode" id="periode" required="required">

													<?php


													$data_periode = mysqli_query($koneksi, " SELECT * from periode order by id_periode desc");
													while ($rows = mysqli_fetch_array($data_periode)) {
													?>
														<option value="<?php echo $rows['id_periode']; ?>" <?= isset($_GET['periode']) ? $_GET['periode'] == $rows['id_periode'] ? 'selected' : '' : '' ?>><?php echo $rows['nama_periode']; ?></option>
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
									<table id="example1" class="table table-bordered">

										<thead class="text text-justify">
											<tr>
												<?php
												include "config.php";
												if (isset($_GET['periode'])) {
													$data = mysqli_query($koneksi, "select * from tb_kriteria where tb_kriteria.id_periode=$_GET[periode] order by ABS(tb_kriteria.id_kriteria) asc");
												} else {

													$data = mysqli_query($koneksi, "select * from tb_kriteria where tb_kriteria.id_periode=$per[id_periode] order by ABS(tb_kriteria.id_kriteria) asc");
												}
												$row = mysqli_num_rows($data);
												// $arraydata = array();
												// while ($arraydata[] = mysqli_fetch_assoc($data));
												// echo json_encode($arraydata);

												?>
												<th rowspan="2" style="vertical-align : middle;text-align:center;">No.</th>
												<th rowspan="2" style="vertical-align : middle;text-align:center;">NIM</th>
												<th rowspan="2" style="vertical-align : middle;text-align:center;">Nama Mahasiswa</th>
												<th rowspan="2" style="vertical-align : middle;text-align:center;" width="100px">Aksi</th>
												<th colspan="<?= $row  ?>" rowspan="<?= $row == 0 ? 2 : ''; ?>" style="vertical-align : middle;text-align:center;">Kriteria</th>
											</tr>
											<tr style="vertical-align : middle;text-align:center;" class="bg bg-secondary">
												<?php
												for ($n = 1; $n <= $row; $n++) {
													echo "<th>C{$n}</th>";
												}
												?>
											</tr>

										</thead>
										<tbody>
											<?php
											$i = 0;

											if (isset($_GET['periode'])) {
												$a = mysqli_query($koneksi, "select * from tb_mahasiswa where tb_mahasiswa.id_periode=$_GET[periode] order by abs(NIM) asc;");
											} else {
												// $ceknowperiode = mysqli_query($koneksi, "SELECT id_periode FROM periode order by id_periode  desc LIMIT 1");
												// $per = mysqli_fetch_assoc($ceknowperiode);
												$a = mysqli_query($koneksi, "select * from tb_mahasiswa where tb_mahasiswa.id_periode=$per[id_periode] order by abs(NIM) asc;");
											}
											while ($da = mysqli_fetch_assoc($a)) {
												echo "<tr>
												<td>" . (++$i) . "</td>
												<td>" . $da['NIM'] . "</td>
												<td>" . $da['nama_mhs'] . "</td>";
											?>
												<td>
													<a href="?nilai_kriteria=nilai_kriteria_mahasiswa&action=update&key=<?= $da['id_mhs'] ?>&search=<?= $da['id_periode'] ?>" class="btn btn-outline-primary"><i class="fas fa-edit"></i></a>
													<a onclick="return confirm('Apakah kamu yakin ingin menghapus data?')" href="?nilai_kriteria=nilai_kriteria_mahasiswa&action=delete&key=<?= $da['id_mhs'] ?>&key2=<?= $da['id_periode'] ?>" class="btn btn-outline-danger"><i class="fas fa-trash"></i></a>
												</td>
											<?php
												$idalt = $da['id_mhs'];
												//ambil nilai

												if (isset($_GET['periode'])) {
													$datap = mysqli_query($koneksi, "select * from tb_kriteria  where tb_kriteria.id_periode=$_GET[periode] order by ABS(tb_kriteria.id_kriteria) asc");
												} else {
													// $ceknowperiode = mysqli_query($koneksi, "SELECT id_periode FROM periode order by id_periode  desc LIMIT 1");
													// $per = mysqli_fetch_assoc($ceknowperiode);
													$datap = mysqli_query($koneksi, "select * from tb_kriteria  where tb_kriteria.id_periode=$per[id_periode] order by ABS(tb_kriteria.id_kriteria) asc");
												}
												while ($b = mysqli_fetch_assoc($datap)) {
													$n = mysqli_query($koneksi, "select * from  tb_kriteria left join tb_nilaikriteriamhs  on  tb_nilaikriteriamhs.id_kriteria=tb_kriteria.id_kriteria left join tb_subkriteria on tb_subkriteria.id_subkriteria=tb_nilaikriteriamhs.id_subkriteria where  tb_nilaikriteriamhs.id_mhs='$idalt' and tb_nilaikriteriamhs.id_kriteria='$b[id_kriteria]' order by ABS(tb_kriteria.id_kriteria) asc");
													$nnum = mysqli_num_rows($n);

													if ($nnum > 0) {
														$int = 0;
														$dn = mysqli_fetch_assoc($n);
														echo "<td align='center'>$dn[nilai_kriteria]</td>";
													} else {
														echo "<td align='center'>kosong</td>";
													}
												}
												echo "</tr>\n";
											}

											?>
											</tr>

										</tbody>

									</table>

								</div>
							</div>
						</div>


					</div>

					<!-- /.card -->
				</div>
				<!-- /.content-wrapper -->
			</section>
		</div>

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